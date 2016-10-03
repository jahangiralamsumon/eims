<?php

class StudentController extends Controller
{
	/**
	 * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
	 * using two-column layout. See 'protected/views/layouts/column2.php'.
	 */
	//public $layout='//layouts/main_original';

	public function filters()
	{
		return array(
				array('auth.filters.AuthFilter -DynamicSections Guardians PreviousData SubjectReg StudentListPDF'),
		);
	}

	/**
	 * Displays a particular model.
	 * @param integer $id the ID of the model to be displayed
	 */
	public function actionView($id)
	{
		$this->layout='//layouts/column2';
		$this->render('view',array(
				'model'=>$this->loadModel($id),
		));
	}


	public function actionCourses($id){
		$this->layout='//layouts/column2';

		$academic_year_array=AcademicYearInfo::academic_year_list();
		$year_id=$academic_year_array[StudentClass::find_student_class($id)];
		
		$student_obj=Student::student_details($id);
			
		$command= Yii::app()->db->createCommand()->setFetchMode(PDO::FETCH_OBJ)
		->select("ss.subject_id,ss.is_elective optional,sub.name subject_name,code")
		->from('students_subjects ss')
		->join('subjects sub','sub.id=ss.subject_id')
		->where('ss.student_id =:student_id AND sub.class_id =:class_id AND ss.year_id=:year_id', array(':student_id'=>$id,':class_id'=>$student_obj->class_id,':year_id'=>$year_id))
		->order('code,optional ASC');
		$student_sub=$command->queryAll();



		$this->render('courses',array(
				'student_sub'=>$student_sub,
				'model'=>$student_obj,
		));
	}

	public function actionAttendance($id){
		$this->layout='//layouts/column2';
		$this->render('attendance',array(
				'model'=>$this->loadModel($id),
		));

	}

	public function actionFees($id){
		$this->layout='//layouts/column2';
		$command= Yii::app()->db->createCommand()
		->select('date(start_date) start_date,date(end_date) end_date')
		->from('year_info')
		->where('year_info.status=:status',array(':status'=>1))
		->queryRow();

		$from_date=$command['start_date'];
		$to_date=date("Y-m-d");//$command['end_date'];
		$data=Journal::student_acc_status($from_date,$to_date,$id);

		$this->render('fees',array(
				'model'=>$this->loadModel($id),
				'data'=>$data
		));

	}
	/**
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 */
	public function actionCreate()
	{
		$model=new Student;
		$student_class_model=new StudentClass;


		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['Student']))
		{
			$model->attributes=$_POST['Student'];
			$student_class_model->attributes=$_POST['StudentClass'];


			/* $criteria=new CDbCriteria;
			 $criteria->select='max(student_id) AS student_id';
			$row =Student::model()->find($criteria);
			$max =isset($row->student_id)?$row->student_id:0;
			$model->student_id=$max+1; */

			//$model->student_id=date('y').$student_class_model->class_id.$student_class_model->roll_no;
			
			$academic_year_array=AcademicYearInfo::academic_year_list();
			$student_class_model->year_id=$academic_year_array[$student_class_model->class_id];
			$model->student_id=$student_class_model->year_id.$student_class_model->roll_no;
			$student_class_model->student_id=$model->student_id;

			$valid1=$model->validate();
			$valid2=$student_class_model->validate();
			$valid= $valid1 && $valid2;
			if($valid)
			{
				$transaction = Yii::app()->db->beginTransaction();
				try {

					$acc_model=new AccHead();
					$acc_model->parent=13;
					$acc_model->top_parent=3;
					$acc_model->name=$model->name.'('.$model->student_id.') A/C';
					$acc_model->category='A';
					$acc_model->lr='L';
					$acc_model->depth='2';
					$acc_model->save();
					/*afterSave event add acc opening in AccHead model */
					$model->reg_no=time();
					$student_id=$model->student_id;

					$model->img_file=CUploadedFile::getInstance($model,'img_file');
					$file_name=$model->img_file;

					$path=Yii::app()->basePath.'/../uploadedfiles/student/'.$student_id;
					if (!is_dir($path))
					{
						mkdir($path,0777);
					}
					if($model->img_file!== null){
						$model->img_file->saveAs($path.'/'.$file_name);
						$model->img_file_name=$model->img_file->name;
					}
					$model->student_acc_id=$acc_model->acc_id; // after saving  acc head to acc_head table set it to student_acc_id

					$student_class_model->save();
					$model->save();
					$user_model=new PortalUser;
					$user_model->username ='stu'.$model->student_id;
					$user_model->email = $model->email;
					$user_model->activkey= hash_hmac('sha256',microtime(),Yii::app()->params['encryptionKey']);
					$password = 12345; //12345 default
					$user_model->password=hash_hmac('sha256', $password,Yii::app()->params['encryptionKey']);
					$user_model->user_type='student';
					$user_model->save();

					$student = Student::model()->findByAttributes(array('student_id'=>$model->student_id));
					$student->saveAttributes(array('user_id'=>$user_model->id));

					$transaction->commit();

					/* Student Admission  SMS send  */
					//$this->sendAdmissionSms($model->mobile);
					/* STUDENT Student Account Confirmation */
					//$this->sendSmsAccountOpen($model->mobile,$user_model->username,$password);

					$this->redirect(array('guardians','id'=>$model->student_id));

				}
				catch (Exception $e) {
					$transaction->rollBack();
					Yii::app()->user->setFlash('error', "{$e->getMessage()}");
				}
			}
		}

		$this->render('create',array(
				'model'=>$model,
				'student_class_model'=>$student_class_model,
		));
	}

	public function actionGuardians($id,$gid=NULL,$action=NULL)
	{
		$parent_model=new Guardian;
		if($gid==NULL){
			if(isset($_POST['student_id']) && $_POST['student_id']!='')
			{

				$guardian = Student::model()->findByAttributes(array('student_id'=>$_POST['student_id']));
				if($guardian!==NUll){
					$gid = $guardian->parent_id;
				}
			}
			else if(isset($_POST['guardian_id']))
			{
			 $gid = $_POST['guardian_id'];
			 	
			}
			if($gid!=NULL and $gid!=0)
			{
				$this->redirect(array('student/guardians','id'=>$id, 'gid'=>$gid));
					
			}
			else if((isset($_POST['student_id']) or isset($_POST['guardian_id'])) and ($gid==NULL or $gid==0))
			{
				Yii::app()->user->setFlash('error',"Guardian not found..!");
			}
		}
		else{
			$parent_model = Guardian::model()->findByAttributes(array('parent_id'=>$gid));
		}
		if(isset($_POST['Guardian']))
		{
			$parent_model->attributes=$_POST['Guardian'];
			$valid=$parent_model->validate();
			if($valid)
			{
				$parent_model->save();
				$student = Student::model()->findByAttributes(array('student_id'=>$id));
				$student->saveAttributes(array('parent_id'=>$parent_model->parent_id));
				if($parent_model->user_create==0)
				{
					$user_model=new PortalUser;
					$user_model->username ='par'.$parent_model->parent_id;
					$user_model->email = $parent_model->email;
					$user_model->activkey= hash_hmac('sha256',microtime(),Yii::app()->params['encryptionKey']);
					$password = 1234; //1234 default
					$user_model->password=hash_hmac('sha256', $password,Yii::app()->params['encryptionKey']);
					$user_model->user_type='parent';
					$user_model->save();

					$parent = Guardian::model()->findByAttributes(array('parent_id'=>$parent_model->parent_id));
					$parent->saveAttributes(array('uid'=>$user_model->id));
				}
				$this->redirect(array('previousData','id'=>$id,'action'=>$action));
			}
		}
		if($action=='update'){
			$model=$this->loadModel($id);
			$this->render('update_guardians',array(
					'parent_model'=>$parent_model,
					'model'=>$model
			));
		}
		else{
			$this->render('create_guardians',array(
					'parent_model'=>$parent_model,
			));
		}


	}


	public  function actionPreviousData($id,$action=NULL){
		$model=new StuPreviousDataForm;
		$model->exam1='SSC';
		$model->exam2='HSC';

		$previous=StudentPreviousDatas::model()->find('student_id=:student_id',array(':student_id'=>$id));
		if($previous!=NULL){
			$previous_data=json_decode($previous->data);
			$model->exam1=$previous_data[0]->exam;
			$model->institution1=$previous_data[0]->institution;
			$model->board1=$previous_data[0]->board;
			$model->year1=$previous_data[0]->year;
			$model->gpa1=$previous_data[0]->gpa;

			$model->exam2=$previous_data[1]->exam;
			$model->institution2=$previous_data[1]->institution;
			$model->board2=$previous_data[1]->board;
			$model->year2=$previous_data[1]->year;
			$model->gpa2=$previous_data[1]->gpa;

		}
		$year_data_arr=array();
		for ($i=date('Y');$i>=date('Y')-15;$i--){
			$year_data_arr[$i]=$i;
		}

		if(isset($_POST['StuPreviousDataForm']))
		{
			$model->attributes=$_POST['StuPreviousDataForm'];
			$valid=$model->validate();
			if($valid)
			{
				$stu_pre_data=StudentPreviousDatas::model()->find('student_id=:student_id',array(':student_id'=>$id));
				if($stu_pre_data==Null){
					$stu_pre_data=new StudentPreviousDatas;
				}

				$pre_data=array();
				$pre_data[0]=array('exam'=>$model->exam1,'institution'=>$model->institution1,'board'=>$model->board1,'year'=>$model->year1,'gpa'=>$model->gpa1);
				$pre_data[1]=array('exam'=>$model->exam2,'institution'=>$model->institution2,'board'=>$model->board2,'year'=>$model->year2,'gpa'=>$model->gpa2);
				$stu_pre_data->student_id=$id;
				$stu_pre_data->data=json_encode($pre_data);
				$stu_pre_data->save();
				$this->redirect(array('subjectReg','id'=>$id,'action'=>$action));

			}
			if($model->has_no_data==1)
			{
				$this->redirect(array('subjectReg','id'=>$id,'action'=>$action));
			}


		}
		if($action=='update'){
			$stu_model=$this->loadModel($id);
			$this->render('previous_data_update',array(
					'model'=>$model,
					'stu_model'=>$stu_model,
					'year_data_arr'=>$year_data_arr
			));
		}
		else{
			$this->render('previous_data',array(
					'model'=>$model,
					'year_data_arr'=>$year_data_arr
			));
		}

	}

	public function actionSubjectReg($id,$action=NULL){

		$academic_year_array=AcademicYearInfo::academic_year_list();
		$year_id=$academic_year_array[StudentClass::find_student_class($id)];

		if(isset($_POST['sub'])){

			$subjects= $_POST['sub'];
			$elcetive_sub=isset($_POST['elective_sub'])?$_POST['elective_sub']:'';
			if (in_array($elcetive_sub, $subjects)){
				Yii::app()->user->setFlash('error', "Group Subject and Elective Subject must not be same");
			}
			else{

				$subjects_before_post=array();
				$records=StudentsSubjects::model()->findAll('student_id=:student_id AND is_elective=:is_elective AND year_id=:year_id ',
						array(':student_id'=>$id,':is_elective'=>'0' ,':year_id'=>$year_id));

				foreach ($records as $record){
					$subjects_before_post[$record->subject_id]=$record->subject_id;
				}

				$a1=array_diff($subjects,$subjects_before_post);
				$a2=array_diff($subjects_before_post,$subjects);
				$arr_merge=array_merge($a1,$a2);
				if(!empty($arr_merge)){

					$ss_delete=Yii::app()->db->createCommand()->delete('students_subjects','student_id=:student_id AND is_elective=:is_elective AND year_id=:year_id', array(':student_id'=>$id,':is_elective'=>'0',':year_id'=>$year_id));

					foreach ($subjects as $subject_id){
						$exists=StudentsSubjects::model()->exists('subject_id=:subject_id AND student_id=:student_id AND is_elective=:is_elective AND year_id=:year_id',
								array(':subject_id'=>$subject_id,':student_id'=>$id,':is_elective'=>'0',':year_id'=>$year_id));
						if(!$exists){
							$model=new StudentsSubjects;
							$model->student_id=$id;
							$model->subject_id=$subject_id;
							$model->year_id=$year_id;
							$model->save();
						}
					}
				}

				if(isset($_POST['elective_sub'])){
					$elcetive_sub=$_POST['elective_sub'];
					$record=StudentsSubjects::model()->find('student_id=:student_id AND is_elective=:is_elective AND year_id=:year_id ',
							array(':student_id'=>$id,':is_elective'=>'1' ,':year_id'=>$year_id));
					if ($record!=NULL){
						if($elcetive_sub!=$record->subject_id){
							$elcetive_sub_delete=Yii::app()->db->createCommand()->delete('students_subjects','student_id=:student_id AND is_elective=:is_elective AND year_id=:year_id', array(':student_id'=>$id,':is_elective'=>'1',':year_id'=>$year_id));
						}
					}
					$exists=StudentsSubjects::model()->exists('subject_id=:subject_id AND student_id=:student_id  AND year_id=:year_id',
							array(':subject_id'=>$elcetive_sub,':student_id'=>$id,':year_id'=>$year_id));
					if(!$exists){
						$model=new StudentsSubjects;
						$model->student_id=$id;
						$model->subject_id=$elcetive_sub;
						$model->is_elective=1;
						$model->year_id=$year_id;
						$model->save();

					}

				}


				Yii::app()->user->setFlash('success','Course Registration Successful.');
				$this->redirect(array('view','id'=>$id));
			}

		}


		$student_obj=Student::student_details($id);

		$student_sub=StudentsSubjects::model()->findAll('student_id=:student_id AND is_elective=:is_elective AND year_id=:year_id ',
				array(':student_id'=>$id,':is_elective'=>'0' ,':year_id'=>$year_id));
		$student_sub_arr=array();
		foreach ($student_sub as $sub){
			$student_sub_arr[$sub->subject_id]=$sub->subject->name;
		}

		$student_sub=StudentsSubjects::model()->findAll('student_id=:student_id AND is_elective=:is_elective AND year_id=:year_id ',
				array(':student_id'=>$id,':is_elective'=>'1' ,':year_id'=>$year_id));
		$student_elec_sub_arr=array();
		foreach ($student_sub as $sub){
			$student_elec_sub_arr[$sub->subject_id]=$sub->subject->name;
		}

		if($action=='update'){

			$this->render('subject_reg',array(
					'student_sub_arr'=>$student_sub_arr,
					'student_elec_sub_arr'=>$student_elec_sub_arr,
					'student_obj'=>$student_obj,
					'action'=>$action
			));
		}
		else{

			$this->render('subject_reg',array(
					'student_sub_arr'=>$student_sub_arr,
					'student_elec_sub_arr'=>$student_elec_sub_arr,
					'student_obj'=>$student_obj,
					'action'=>$action
			));
		}




	}

	protected function sendAdmissionSms($mobile){
		$admission_sms= SmsSettings::model()->findByAttributes(array('settings_key'=>'STUDENT_ADMISSION_ENABLE'));
		$to='';
		if($admission_sms->is_enabled=='1'){
			if(preg_match("/^[0-9,]{11,13}$/", $mobile)) {
				$to=strlen($mobile)>11?$mobile:'88'.$mobile;
			}

			if($to!=''){ // Send SMS if phone number is provided
				$institution=InstitutionConfigurations::model()->findByAttributes(array('id'=>1))->config_value;
				$message=SmsTemplatesSystem::model()->findByAttributes(array('sms_key'=>'STUDENT_ADMISSION'))->value;
				$message =strtr($message, array('{institution}' => $institution));
				if(Sms::check_sms_limit($to)){
					$response=Sms::send_message($message,$to,2,0);//$message,$mobile,$msgtype,$dlr
					//$response='1701|8801817750347|354de7d5-c2cd-4ba8-9005-bf0a03682b6c';
					$res_arr=explode(',',$response);

					$sms_count=0;
					foreach($res_arr as $key=>$row){
						$row_arr[]=explode('|',$row);
						if(current(explode('|',$row))=='1701')
						{
							$sms_count=$sms_count+1;
						}
					}
					$data=json_encode($row_arr);
					//print_r(json_encode($row_arr));
					//echo $sms_count;
					if($sms_count>0){
						$record=new SmsRecord();
						$record->quantity=$sms_count;
						$record->data=$data;
						$record->save();
							
						$sms_limit=InstitutionConfigurations::model()->findByAttributes(array('id'=>9));
						$sms_limit->config_value=$sms_limit->config_value-$sms_count;
						$sms_limit->save();
					}


				}
			}

		}
	}

	protected function sendSmsAccountOpen($mobile,$username,$password){
		$admission_sms= SmsSettings::model()->findByAttributes(array('settings_key'=>'STUDENT_ADMISSION_ENABLE'));
		$to='';
		if($admission_sms->is_enabled=='1'){
			if(preg_match("/^[0-9,]{11,13}$/", $mobile)) {
				$to=strlen($mobile)>11?$mobile:'88'.$mobile;
			}

			if($to!=''){ // Send SMS if phone number is provided
				$institution=InstitutionConfigurations::model()->findByAttributes(array('id'=>1))->config_value;
				$message=SmsTemplatesSystem::model()->findByAttributes(array('sms_key'=>'STUDENT_ACCOUNT_OPEN'))->value;
				$message =strtr($message, array('{institution}' => $institution,'{username}'=>$username,'{password}'=>$password));
				if(Sms::check_sms_limit($to)){
					$response=Sms::send_message($message,$to,2,0);//$message,$mobile,$msgtype,$dlr
					//$response='1701|8801817750347|354de7d5-c2cd-4ba8-9005-bf0a03682b6c';
					$res_arr=explode(',',$response);

					$sms_count=0;
					foreach($res_arr as $key=>$row){
						$row_arr[]=explode('|',$row);
						if(current(explode('|',$row))=='1701')
						{
							$sms_count=$sms_count+1;
						}
					}
					$data=json_encode($row_arr);
					//print_r(json_encode($row_arr));
					//echo $sms_count;
					if($sms_count>0){
						$record=new SmsRecord();
						$record->quantity=$sms_count;
						$record->data=$data;
						$record->save();
							
						$sms_limit=InstitutionConfigurations::model()->findByAttributes(array('id'=>9));
						$sms_limit->config_value=$sms_limit->config_value-$sms_count;
						$sms_limit->save();
					}


				}
			}

		}
	}

	/**
	 * Updates a particular model.
	 * If update is successful, the browser will be redirected to the 'view' page.
	 * @param integer $id the ID of the model to be updated
	 */
	public function actionUpdate($id)
	{
		$model=$this->loadModel($id);
		$file_before_update=$model->img_file_name;

		//SELECT * FROM `student_class` sc  left join academic_year_info ayi on sc.`year_id`=ayi.year_code AND ayi.status='1'where sc.`student_id`='2'
		$criteria=new CDbCriteria;
		$criteria->alias = 'sc';
		$criteria->join = 'JOIN academic_year_info ayi ON (sc.year_id=ayi.year_code AND sc.class_id=ayi.class_id  AND ayi.status=1)';
		$criteria->condition = 'student_id = :student_id ';
		$criteria->params = array(':student_id' =>$model->student_id);
		$student_class_model=StudentClass::model()->find($criteria);
		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		$academic_year_array=AcademicYearInfo::academic_year_list();
		$year_code=$academic_year_array[$student_class_model->class_id];

		$section_data=array();
		$section_data=CHtml::listData(Section::model()->findAll(
				'class_id=:class_id ',
				array(':class_id'=>$student_class_model->class_id)),'section_id','section_name');

		if(isset($_POST['Student']))
		{
			$model->attributes=$_POST['Student'];
			$student_class_model->attributes=$_POST['StudentClass'];

			$student_class_model->year_id=$year_code;

			$valid1=$model->validate();
			$valid2=$student_class_model->validate();
			$valid= $valid1 && $valid2;

			if($valid)
			{
				$transaction = Yii::app()->db->beginTransaction();

				try{
					$model->reg_no=time();
					$student_id=$model->student_id;
					$model->img_file=CUploadedFile::getInstance($model,'img_file');
					$file_name=$model->img_file;

					$path=Yii::app()->basePath.'/../uploadedfiles/student/'.$student_id;
					if (!is_dir($path))
					{
						mkdir($path,0777);
					}

					if($model->img_file!== null){
						$model->img_file->saveAs($path.'/'.$file_name);
						$model->img_file_name=$model->img_file->name;
					}
					else{
						$model->img_file_name=$file_before_update;

					}

					$student_class_model->year_id=$year_code;
					$student_class_model->student_id=$student_id;
					$student_class_model->save();
					$model->save();
					$transaction->commit();
					$this->redirect(array('guardians','id'=>$model->student_id,'gid'=>$model->parent_id,'action'=>'update'));
				}
				catch (Exception $e) {
					$transaction->rollBack();
					Yii::app()->user->setFlash('error', "{$e->getMessage()}");
				}
			}
		}

		$this->render('update',array(
				'model'=>$model,
				'student_class_model'=>$student_class_model,
				'section_data'=>$section_data
		));
	}

	/**
	 * Deletes a particular model.
	 * If deletion is successful, the browser will be redirected to the 'admin' page.
	 * @param integer $id the ID of the model to be deleted
	 */
	public function actionDelete($id)
	{
		if(Yii::app()->request->isPostRequest)
		{
			// we only allow deletion via POST request
			$this->loadModel($id)->delete();

			// if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
			if(!isset($_GET['ajax']))
				$this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
		}
		else
			throw new CHttpException(400,'Invalid request. Please do not repeat this request again.');
	}

	/**
	 * Lists all models.
	 */
	public function actionIndex()
	{
		$dataProvider=new CActiveDataProvider('Student');
		$this->render('index',array(
				'dataProvider'=>$dataProvider,
		));
	}

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{

		$model=new Student('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['Student']))
			$model->attributes=$_GET['Student'];

		$this->render('admin',array(
				'model'=>$model,
		));


	}

	public  function actionStudentList(){

		$filtersForm=new FiltersForm;
		if (isset($_GET['FiltersForm']))
			$filtersForm->filters=$_GET['FiltersForm'];
		$array_data=Student::list_student();
		$filteredData=$filtersForm->filter($array_data);
		$arrayDataProvider=new CArrayDataProvider($filteredData,array(
				'id'=>'id',
				'sort'=>array(
						'attributes'=>array(
								'id','roll_no'
						),
				),
				'pagination'=>array(
						'pageSize'=>30,
				),
		));

		$this->render('student_list',array(
				'dataProvider'=>$arrayDataProvider,
				'filtersForm' => $filtersForm,
		));
	}

	public function actionStudentListPDF(){

		$array_data=Student::list_student();

		$mPDF1 = Yii::app()->ePdf->mpdf();

		# You can easily override default constructor's params
		$mPDF1 = Yii::app()->ePdf->mpdf('', 'A4');

		# render (full page)
		$mPDF1->WriteHTML($this->renderPartial('export_pdf',array(
		'array_data'=>$array_data,
		),true));
		$mPDF1->Output();
	}

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer the ID of the model to be loaded
	 */
	public function loadModel($id)
	{
		$model=Student::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	/**
	 * Performs the AJAX validation.
	 * @param CModel the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='student-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}


	public function actionSubjectRegistration($student_id=null){

		if($student_id==null){
			$model=new SubjectRegForm;
			if(isset($_POST['SubjectRegForm']))
			{
				$model->attributes=$_POST['SubjectRegForm'];
				if($model->validate()){
					$this->redirect(array('subjectregistration','student_id'=>$model->student_id));
				}
					
			}
			$this->render('subjectreg',array(
					'model'=>$model,
			));
		}
		else{
			$academic_year_array=AcademicYearInfo::academic_year_list();
			$year_id=$academic_year_array[StudentClass::find_student_class($student_id)];
			if(isset($_POST['sub'])){
				$subjects= $_POST['sub'];
				$elcetive_sub=isset($_POST['elective_sub'])?$_POST['elective_sub']:'';
				if (in_array($elcetive_sub, $subjects)){
					Yii::app()->user->setFlash('error', "Group Subject and Elective Subject must not be same");
				}
				else{

					$subjects_before_post=array();
					$records=StudentsSubjects::model()->findAll('student_id=:student_id AND is_elective=:is_elective AND year_id=:year_id ',
							array(':student_id'=>$student_id,':is_elective'=>'0' ,':year_id'=>$year_id));

					foreach ($records as $record){
						$subjects_before_post[$record->subject_id]=$record->subject_id;
					}

					$a1=array_diff($subjects,$subjects_before_post);
					$a2=array_diff($subjects_before_post,$subjects);
					$arr_merge=array_merge($a1,$a2);
					if(!empty($arr_merge)){

						$ss_delete=Yii::app()->db->createCommand()->delete('students_subjects','student_id=:student_id AND is_elective=:is_elective AND year_id=:year_id', array(':student_id'=>$student_id,':is_elective'=>'0',':year_id'=>$year_id));

						foreach ($subjects as $subject_id){
							$exists=StudentsSubjects::model()->exists('subject_id=:subject_id AND student_id=:student_id AND is_elective=:is_elective AND year_id=:year_id',
									array(':subject_id'=>$subject_id,':student_id'=>$student_id,':is_elective'=>'0',':year_id'=>$year_id));
							if(!$exists){
								$model=new StudentsSubjects;
								$model->student_id=$student_id;
								$model->subject_id=$subject_id;
								$model->year_id=$year_id;
								$model->save();
							}
						}
					}

					if(isset($_POST['elective_sub'])){
						$elcetive_sub=$_POST['elective_sub'];
						$record=StudentsSubjects::model()->find('student_id=:student_id AND is_elective=:is_elective AND year_id=:year_id ',
								array(':student_id'=>$student_id,':is_elective'=>'1' ,':year_id'=>$year_id));
						if ($record!=NULL){
							if($elcetive_sub!=$record->subject_id){
								$elcetive_sub_delete=Yii::app()->db->createCommand()->delete('students_subjects','student_id=:student_id AND is_elective=:is_elective AND year_id=:year_id', array(':student_id'=>$student_id,':is_elective'=>'1',':year_id'=>$year_id));
							}
						}
						$exists=StudentsSubjects::model()->exists('subject_id=:subject_id AND student_id=:student_id  AND year_id=:year_id',
								array(':subject_id'=>$elcetive_sub,':student_id'=>$student_id,':year_id'=>$year_id));
						if(!$exists){
							$model=new StudentsSubjects;
							$model->student_id=$student_id;
							$model->subject_id=$elcetive_sub;
							$model->is_elective=1;
							$model->year_id=$year_id;
							$model->save();

						}

					}


					Yii::app()->user->setFlash('success','Course Registration Successful.');
					$this->redirect(array('subjectregistration'));
				}

			}


			$student_obj=Student::student_details($student_id);

			$command= Yii::app()->db->createCommand()->setFetchMode(PDO::FETCH_OBJ)
			->select("ss.subject_id,sub.name subject_name,")
			->from('students_subjects ss')
			->join('academic_year_info ayi', 'ss.year_id=ayi.year_code AND ayi.status=:status',array(':status'=>1))
			->join('subjects sub','sub.id=ss.subject_id')
			->where('ss.student_id =:student_id AND ss.is_elective=:is_elective', array(':student_id'=>$student_id,':is_elective'=>0));
			$student_sub=$command->queryAll();
			$student_sub_arr=array();
			foreach ($student_sub as $sub){
				$student_sub_arr[$sub->subject_id]=$sub->subject_name;
			}

			$command= Yii::app()->db->createCommand()->setFetchMode(PDO::FETCH_OBJ)
			->select("ss.subject_id,sub.name subject_name,")
			->from('students_subjects ss')
			->join('academic_year_info ayi', 'ss.year_id=ayi.year_code AND ayi.status=:status',array(':status'=>1))
			->join('subjects sub','sub.id=ss.subject_id')
			->where('ss.student_id =:student_id AND ss.is_elective=:is_elective', array(':student_id'=>$student_id,':is_elective'=>1));
			$student_sub=$command->queryAll();
			$student_elec_sub_arr=array();
			foreach ($student_sub as $sub){
				$student_elec_sub_arr[$sub->subject_id]=$sub->subject_name;
			}
			$class_sub_arr=Subjects::class_sub_list($student_obj->class_id,$student_obj->group);

			$this->render('subregform',array(
					'student_sub_arr'=>$student_sub_arr,
					'student_elec_sub_arr'=>$student_elec_sub_arr,
					'class_sub_arr'=>$class_sub_arr,
					'student_obj'=>$student_obj
			));
		}

	}

	public function actionPromotion(){
		$model=new StudentPromotionInput;
		if(isset($_POST['StudentPromotionInput']))
		{
			$model->attributes=$_POST['StudentPromotionInput'];
			if($model->validate()){
				$this->redirect(array('promotionprocess','year_id'=>$model->year_id,'class_id'=>$model->class_id));
			}

		}
		$this->render('promotion_input',array(
				'model'=>$model,
		));


	}

	public function actionPromotionProcess($year_id,$class_id){


		$students=Student::current_students($class_id,$section_id=null,$group=null,$student_id=null,$year_id);

		if(isset($_POST['student'])){
			$post_student_arr=$_POST['student'];
			
			$academic_year_array=AcademicYearInfo::academic_year_list();
			$not_promotion_year_id=$academic_year_array[$class_id]; //YearInfo::current_year_code();
			$par_class_id=Classes::model()->find('child_id=:child_id',array(':child_id'=>$class_id))->class_id;
			$promotion_year_id=$academic_year_array[$par_class_id];
			foreach($students as $key=>$student){
				$exists=StudentClass::model()->exists('student_id=:student_id AND year_id=:year_id',
						array(':student_id'=>$student->student_id,':year_id'=>$promotion_year_id));
				if(!$exists){
					if(in_array($student->student_id,$post_student_arr)){
							
						$model=new StudentClass;
						$model->student_id=$student->student_id;
						$model->class_id=$par_class_id;
						$model->group=$student->group;
						$model->shift_id=2;
						$model->roll_no=$student->roll_no;
						$model->year_id=$promotion_year_id;
						$model->save();
							
					}
					else{

						$model=new StudentClass;
						$model->student_id=$student->student_id;
						$model->class_id=$class_id;
						$model->group=$student->group;
						$model->shift_id=2;
						$model->roll_no=$student->roll_no;
						$model->year_id=$not_promotion_year_id;
						$model->save();
					}

				}
			}

			$this->redirect(array('promotion'));
		}

			

		$this->render('promotionform',array(
				'students'=>$students
		));
			
	}



	public function actionUpload()
	{

		$data = array();

		$model = new Student('upload');
		$model->picture = CUploadedFile::getInstance($model, 'picture');
		if ($model->picture !== null  && $model->validate(array('picture')))
		{
			$model->picture->saveAs(
					Yii::app()->basePath.'/../images'.'/'.$model->picture->name);

			// save picture name
			if(1)
			{
				// return data to the fileuploader
				$data[] = array(
						'name' => $model->picture->name,"http://localhost/school/images/".$model->picture->name."/".$model->picture->type,
						'type' => $model->picture->type,
						'size' => $model->picture->size,
						// we need to return the place where our image has been saved
						'url' => "http://localhost/school/images/".$model->picture->name, // Should we add a helper method?
						// we need to provide a thumbnail url to display on the list
						// after upload. Again, the helper method now getting thumbnail.

						// we need to include the action that is going to delete the picture
						// if we want to after loading
						'delete_url' => $this->createUrl('my/delete',
								array('id' =>1, 'method' => 'uploader')),
						'delete_type' => 'POST');
			} else {
				$data[] = array('error' => 'Unable to save model after saving picture');
			}
		} else {
			if ($model->hasErrors('picture'))
			{
				$data[] = array('error', $model->getErrors('picture'));
			} else {
				throw new CHttpException(500, "Could not upload file ".     CHtml::errorSummary($model));
			}
		}
		// JQuery File Upload expects JSON data
		echo json_encode($data);
	}

	public function actionDynamicSections(){

		$class_id=$_POST['StudentClass']['class_id'];

		$model=Section::model()->findAll(
				'class_id=:class_id',
				array(':class_id'=>$class_id,)
		);

		foreach($model as $row)
		{
			echo CHtml::tag('option',
					array('value'=>$row->section_id),CHtml::encode($row->section_name),true);
		}
	}
}

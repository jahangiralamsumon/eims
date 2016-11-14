<?php

class SiteController extends Controller
{

	public function filters()
	{
		return array(
				'accessControl', // perform access control for CRUD operations
				'postOnly + delete', // we only allow deletion via POST request
		);
	}

	/**
	 * Specifies the access control rules.
	 * This method is used by the 'accessControl' filter.
	 * @return array access control rules
	 */
	public function accessRules()
	{
		return array(
				array('allow',  // allow all users to perform 'index' and 'view' actions
						'actions'=>array('login','result','error'),
						'users'=>array('*'),
				),
				array('allow',
						'users'=>array('@'),
				),
				array('deny',  // deny all users
						'users'=>array('*'),
				),
		);
	}



	/**
	 * This is the default 'index' action that is invoked
	 * when an action is not explicitly requested by users.
	 */
	public function actionIndex()
	{
		// renders the view file 'protected/views/site/index.php'
		// using the default layout 'protected/views/layouts/main.php'
		$this->render('index');
	}

	/**
	 * This is the action to handle external exceptions.
	 */
	public function actionError()
	{
		if($error=Yii::app()->errorHandler->error)
		{
			if(Yii::app()->request->isAjaxRequest)
				echo $error['message'];
			else
				$this->render('error', $error);
		}
	}


	/**
	 * Displays the login page
	 */
	public function actionLogin()
	{
		$this->layout='login';
		$model=new LoginForm;

		// if it is ajax validation request
		if(isset($_POST['ajax']) && $_POST['ajax']==='login-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}

		// collect user input data
		if(isset($_POST['LoginForm']))
		{
			$model->attributes=$_POST['LoginForm'];
			// validate user input and redirect to the previous page if valid
			if($model->validate() && $model->login())
				$this->redirect(Yii::app()->user->returnUrl);
		}
		// display the login form
		$this->render('login',array('model'=>$model));
	}

	/**
	 * Logs out the current user and redirect to homepage.
	 */
	public function actionLogout()
	{
		Yii::app()->user->logout();
		$this->redirect(Yii::app()->homeUrl);
	}

	public function  actionResult(){
		$this->layout='result';

		$model=new ResultViewForm;
		$exam_data=array();
		if(isset($_POST['ResultViewForm']))
		{
			$model->attributes=$_POST['ResultViewForm'];
			$exam_data=CHtml::listData(Exam::model()->findAll(
					'class_id=:class_id OR class_id IS NULL AND year=:year',
					array(':class_id'=>$model->class_id,':year'=>$model->year)),'exam_id','name');
			if($model->validate()){

				//SELECT s.student_id, s.name,ss.*,sub.name,es.*,(SELECT max(mark) FROM exam_score WHERE exam_id=1 AND subject_id=es.subject_id )h FROM student s
				// left join students_subjects ss ON ss.student_id=s.student_id
				// left join subjects sub ON sub.id=ss.subject_id left join exam_score es ON (es.subject_id=ss.subject_id AND es.student_id=ss.student_id AND es.exam_id=1)
					
				$command= Yii::app()->db->createCommand()->setFetchMode(PDO::FETCH_OBJ)
				->select('year_code')
				->from('academic_year_info')
				->where('class_id = :class_id AND value= :year',array(':class_id' =>$model->class_id,':year'=>$model->year));
				$year_id=$command->queryRow()->year_code;


				$command= Yii::app()->db->createCommand()->setFetchMode(PDO::FETCH_OBJ)
				->select("s.student_id student_id,sub.id sub_id,sub.name subject_name,ss.is_elective is_elective,es.*,(SELECT max(mark) FROM exam_score WHERE exam_id='{$model->exam_id}' AND subject_id=ss.subject_id )heighest_mark")
				->from('student s')
				->join('students_subjects ss', 'ss.student_id=s.student_id')
				->join('academic_year_info year_info', 'ss.year_id=year_info.year_code AND year_info.year_code=:year_id',array(':year_id'=>$year_id))
				->leftJoin('subjects sub','sub.id=ss.subject_id')
				->leftJoin('exam_score es', 'es.subject_id=ss.subject_id AND es.student_id=:student_id AND es.exam_id=:exam_id',array(':student_id'=>$model->student_id,':exam_id'=>$model->exam_id))
				->where('s.student_id =:student_id ', array(':student_id'=>$model->student_id))
				->order('sub.name ASC');
				$result=$command->queryAll();
				//var_dump($result);
				//exit;
					
				$command= Yii::app()->db->createCommand()->setFetchMode(PDO::FETCH_OBJ)
				->select('s.student_id,s.name,s.img_file_name,sc.class_id,sc.roll_no,sc.group,c.class_name,sec.section_name,year_info.name year_name')
				->from('student s')
				->join('student_class sc', 's.student_id=sc.student_id')
				->join('class c', 'sc.class_id=c.class_id')
				->leftJoin('section sec', 'sec.section_id=sc.section_id')
				->join('academic_year_info year_info', 'sc.year_id=year_info.year_code AND sc.year_id=:year_id',array(':year_id'=>$year_id))
				->where('s.student_id =:student_id ', array(':student_id'=>$model->student_id));
					
				$student_obj=$command->queryRow();
				//var_dump($student_obj);
				//exit;
					
				$this->render('result',array('result'=>$result,'student_obj'=>$student_obj,'exam_id'=>$model->exam_id));

			}
			else{
					
				$this->render('result_form',array('model'=>$model,'exam_data'=>$exam_data));
			}
		}
		else{

			$this->render('result_form',array('model'=>$model,'exam_data'=>$exam_data));
		}


	}
	public function actionAutocomplete()
	{
		if (isset($_GET['q'])) {
			$criteria=new CDbCriteria;
			$criteria->alias = "name";
			$criteria->condition = "name   like '" . $_GET['q'] . "%'";
			$criteria->addSearchCondition('status', 1);
			$criteria->order = 'name ASC';
			$Students = Student::model()->findAll($criteria);

			$return_array = array();
			foreach($Students as $Student) {
				$return_array[] = array(
						'text'=>ucfirst($Student->name) ,
						'id'=>$Student->student_id,
				);
			}
			echo CJSON::encode($return_array);
		}
	}
	public function actionParentautocomplete()
	{
		if (isset($_GET['q'])) {
			$criteria=new CDbCriteria;
			$criteria->alias = "name";
			$criteria->condition = "name   like '" . $_GET['q'] . "%'";
			$criteria->order = 'name ASC';
			$guardians = Guardian::model()->findAll($criteria);

			$return_array = array();
			foreach($guardians as $guardian) {
				$return_array[] = array(
						'text'=>ucfirst($guardian->name),
						'id'=>$guardian->parent_id,
				);
			}
			echo CJSON::encode($return_array);
			Yii::app()->end();
		}


	}

	public function actionDynamicExam(){

		$class_id=isset($_POST['MarksManageForm']['class_id'])?$_POST['MarksManageForm']['class_id']:(isset($_POST['ResultViewForm']['class_id'])?$_POST['ResultViewForm']['class_id']:(isset($_POST['ResultFormGroupWise']['class_id'])?$_POST['ResultFormGroupWise']['class_id']:''));
		$year=isset($_POST['MarksManageForm']['year'])?$_POST['MarksManageForm']['year']:(isset($_POST['ResultViewForm']['year'])?$_POST['ResultViewForm']['year']:(isset($_POST['ResultFormGroupWise']['year'])?$_POST['ResultFormGroupWise']['year']:date("Y")));
		$criteria=new CDbCriteria;
		$criteria->condition ='(class_id=:class_id OR class_id IS NULL) AND year=:year';
		$criteria->params=array(':class_id'=>$class_id,':year'=>$year);
		//$criteria->addSearchCondition('class_id IS NULL');

		$model=Exam::model()->findAll($criteria);

		echo CHtml::tag('option',
				array('value'=>''),'Select Exam');
		foreach($model as $row)
		{
			echo CHtml::tag('option',
					array('value'=>$row->exam_id),CHtml::encode($row->name),true);
		}


	}

	public function actiondynamicParentSubject(){

		$class_id=isset($_POST['Subjects']['class_id'])?$_POST['Subjects']['class_id']:'';
		$group_name=isset($_POST['Subjects']['group_name'])?$_POST['Subjects']['group_name']:'';

		$parent_class=Classes::model()->find('child_id=:child_id',array(':child_id'=>$class_id));

		if(isset($parent_class->class_id)){
			$par_class_id=$parent_class->class_id;
			if ($group_name==""){
				$criteria = new CDbCriteria();
				$criteria->select = '*';
				$criteria->condition = 'class_id=:class_id AND group_name=:group_name';
				$criteria->params = array(':class_id'=>$par_class_id,':group_name'=>'');
				$records =Subjects::model()->findAll($criteria);

				echo CHtml::tag('option',
						array('value'=>''),'Select Parent Subject');
				foreach($records as $row)
				{
					echo CHtml::tag('option',
							array('value'=>$row->id),CHtml::encode($row->name),true);
				}
			}
			else {
					
					
				$criteria = new CDbCriteria();
				$criteria->select = '*';
				$criteria->condition = 'class_id=:class_id AND group_name=:group_name';
				$criteria->params = array(':class_id'=>$par_class_id,':group_name'=>$group_name);
				$records =Subjects::model()->findAll($criteria);
					
				echo CHtml::tag('option',
						array('value'=>''),'Select Parent Subject');
				foreach($records as $row)
				{
					echo CHtml::tag('option',
							array('value'=>$row->id),CHtml::encode($row->name),true);
				}
			}

		}
	}


	public function actionDynamicYear(){

		$class_id=isset($_POST['StudentPromotionInput']['class_id'])?$_POST['StudentPromotionInput']['class_id']:'';
	  
		$criteria = new CDbCriteria();
		$criteria->select = '*';
		$criteria->condition = 'class_id=:class_id';
		$criteria->params = array(':class_id'=>$class_id);
		$records =Subjects::model()->findAll($criteria);
		$model=AcademicYearInfo::model()->findAll($criteria);

		echo CHtml::tag('option',
				array('value'=>''),'Select Year');
		foreach($model as $row)
		{
			echo CHtml::tag('option',
					array('value'=>$row->year_code),CHtml::encode($row->name),true);
		}


	}


 
	public function actionMarksUpdate($mark_id){
		
		$sub_details_arr= explode(",",$_POST['sub_details']);
		$written_error=null;
		$mcq_error=null;
		$practical_error=null;
		$written=isset($_POST['written'])?$_POST['written']:0;
		$mcq=isset($_POST['mcq'])?$_POST['mcq']:0;
		$practical=isset($_POST['practical'])?$_POST['practical']:0;
		$attendance=isset($_POST['attendance'])?$_POST['attendance']:0;
		
		if($sub_details_arr[0]>0 && $written > $sub_details_arr[0]){
			$written_error=1;
		}
		
		else if ($sub_details_arr[1]>0 && $mcq> $sub_details_arr[1]){
			$mcq_error=1;
		}
		
		else if ($sub_details_arr[2]>0 && $practical> $sub_details_arr[2]){
			$practical_error=1;
		}
		
	  if($written_error==null && $mcq_error==null && $practical_error==null){	
			
		$score_update_model=ExamScore::model()->findByPk($mark_id);
		$score_update_model->written=isset($written)?$written:0;
		$score_update_model->mcq=isset($mcq)?$mcq:0;
		$score_update_model->practical=isset($practical)?$practical:0;
		$score_update_model->mark=$score_update_model->written+$score_update_model->mcq+$score_update_model->practical;
		$score_update_model->attendance=isset($attendance)?$attendance:0;
		
		if($score_update_model->save()){
		echo CJSON::encode(array(
				'status'=>'success',
			
		));
		}
	  }
	  
		else {
			echo CJSON::encode(array(
					'status'=>'failed',
					'written_error'=>$written_error,
					'mcq_error'=>$mcq_error,
					'practical_error'=>$practical_error,
					
			));
		}
		exit;
		
	}


}
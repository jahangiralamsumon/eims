<?php

class MarksController extends Controller
{
	//public $layout='//layouts/main';


	public function filters()
	{
		return array(
				'accessControl',
				array('auth.filters.AuthFilter -DynamicSubjects ResultPrint ResultGroupWise'),
		);
	}
	
	public function accessRules()
	{
		return array(
				array('allow',  // allow all users to perform 'index' and 'view' actions
						'users'=>array('@'),
				),
	
				array('deny',  // deny all users
						'users'=>array('*'),
				),
		);
	}
	
	public function actionManage()
	{
		$model=new MarksManageForm;
		$data=array();
		$exam_data=array();
		if(isset($_GET['MarksManageForm']))
		{
			$model->attributes=$_GET['MarksManageForm'];
			if ($model->validate()){
					
				$data= CHtml::listData(Subjects::model()->findAll(
						'class_id=:class_id ',
						array(':class_id'=>$model->class_id)),'id','name');
		
				
				$criteria=new CDbCriteria;
				$criteria->condition = 'class_id = :class_id AND value= :value';
				$criteria->params = array(':class_id' =>$model->class_id,':value'=>$model->year);
				$year_id=AcademicYearInfo::model()->find($criteria)->year_code;
				
				$exam_data=CHtml::listData(Exam::model()->findAll(
						'class_id=:class_id OR class_id IS NULL AND year=:year',
						array(':class_id'=>$model->class_id,':year'=>$model->year)),'exam_id','name');
				//$exists=ExamScore::model()->exists($condition,$params);
				$students=StudentsSubjects::model()->findAll('subject_id=:subject_id AND year_id=:year_id',
						array(':subject_id'=>$model->subject_id,':year_id'=>$year_id));
				//print_r($students);
				//exit;
				
				foreach ($students as $student){
					$exists=ExamScore::model()->exists('exam_id=:exam_id AND subject_id=:subject_id AND student_id=:student_id',
							array(':exam_id'=>$model->exam_id,':subject_id'=>$model->subject_id,':student_id'=>$student->student_id));
						
					if(!$exists){
						$exam_score_obj=new ExamScore;
						$exam_score_obj->exam_id=$model->exam_id;
						$exam_score_obj->subject_id=$model->subject_id;
						$exam_score_obj->class_id=$model->class_id;
						$exam_score_obj->student_id=$student->student_id;
						$exam_score_obj->save();
							
					}
						
				}

				
				$marks_input_model=new MarksInputForm;
				if(isset($_POST['MarksInputForm']))
				{
					$marks_input_model->attributes=$_POST['MarksInputForm'];
					//print_r($marks_input_model->attributes);
					if($marks_input_model->validate())
					{
						foreach ($marks_input_model->mark_id as $key=>$mark_id ){
							$score_update_model=ExamScore::model()->findByPk($mark_id);
							$score_update_model->written=isset($marks_input_model->written[$key])?$marks_input_model->written[$key]:0;
							$score_update_model->mcq=isset($marks_input_model->mcq[$key])?$marks_input_model->mcq[$key]:0;
							$score_update_model->practical=isset($marks_input_model->practical[$key])?$marks_input_model->practical[$key]:0;
							$score_update_model->mark=$score_update_model->written+$score_update_model->mcq+$score_update_model->practical;
							$score_update_model->attendance=isset($marks_input_model->attendance[$key])?$marks_input_model->attendance[$key]:0;
							$score_update_model->remark=isset($marks_input_model->remark[$key])?$marks_input_model->remark[$key]:'';
							$score_update_model->save();
						}
						Yii::app()->user->setFlash('success','Exam Score Update Successful.');
						$this->refresh();
					}
				}
				
				$criteria=new CDbCriteria();
				$criteria->condition='exam_id=:exam_id AND subject_id=:subject_id AND class_id=:class_id';
				$criteria->params=array(':exam_id'=>$model->exam_id,':subject_id'=>$model->subject_id,':class_id'=>$model->class_id);
				$criteria->order='student_id ASC';
				$subject_marks=ExamScore::model()->findAll($criteria);				
				
				$this->render('manage_marks',array('model'=>$model,'data'=>$data,'exam_data'=>$exam_data,'subject_marks'=>$subject_marks,'marks_input_model'=>$marks_input_model));
			}
			else{
			$this->render('manage_marks',array('model'=>$model,'data'=>$data,'exam_data'=>$exam_data));
			}
		}

		else{
			$this->render('manage_marks',array('model'=>$model,'data'=>$data,'exam_data'=>$exam_data));
		}
	}


	public function actionDynamicSubjects(){

		$class_id=$_POST['MarksManageForm']['class_id'];

		$model=Subjects::model()->findAll(
				'class_id=:class_id',
				array(':class_id'=>$class_id,)
		);

		foreach($model as $row)
		{
			echo CHtml::tag('option',
					array('value'=>$row->id),CHtml::encode($row->name),true);
		}
		
		
									
	}
	
	public function actionResultView(){
		$model=new ResultViewForm;
		if(isset($_POST['ResultViewForm']))
		{
			$model->attributes=$_POST['ResultViewForm'];
			if($model->validate()){
				$this->redirect(array('view','student_id'=>$model->student_id,'exam_id'=>$model->exam_id));
			}
			
		}	
		$this->render('result_view',array('model'=>$model));
		
	}
	
	public  function  actionView($student_id=null,$class_id=null,$exam_id=null,$year=null){
		
		if($student_id==null || $class_id==null|| $exam_id==null || $year==null){
		$model=new ResultViewForm;
		$exam_data=array();
		if(isset($_POST['ResultViewForm']))
		{
			$model->attributes=$_POST['ResultViewForm'];
			$exam_data=CHtml::listData(Exam::model()->findAll(
					'class_id=:class_id OR class_id IS NULL AND year=:year',
					array(':class_id'=>$model->class_id,':year'=>$model->year)),'exam_id','name');
			if($model->validate()){
				$this->redirect(array('view','student_id'=>$model->student_id,'class_id'=>$model->class_id ,'exam_id'=>$model->exam_id,'year'=>$model->year));
			}
				
		}
		$this->render('result_view',array('model'=>$model,'exam_data'=>$exam_data));
		}
		
		else{
		
		//SELECT s.student_id, s.name,ss.*,sub.name,es.*,(SELECT max(mark) FROM exam_score WHERE exam_id=1 AND subject_id=es.subject_id )h FROM student s 
		// left join students_subjects ss ON ss.student_id=s.student_id
		// left join subjects sub ON sub.id=ss.subject_id left join exam_score es ON (es.subject_id=ss.subject_id AND es.student_id=ss.student_id AND es.exam_id=1)
		$command= Yii::app()->db->createCommand()->setFetchMode(PDO::FETCH_OBJ)
		->select('year_code')
        ->from('academic_year_info')
		->where('class_id = :class_id AND value= :year',array(':class_id' =>$class_id,':year'=>$year));
		$year_id=$command->queryRow()->year_code;
		
		$command= Yii::app()->db->createCommand()->setFetchMode(PDO::FETCH_OBJ)
		->select("s.student_id student_id,sub.id sub_id,sub.name subject_name,ss.is_elective is_elective,es.*,(SELECT max(mark) FROM exam_score WHERE exam_id='{$exam_id}' AND subject_id=ss.subject_id )heighest_mark")
		->from('student s')
		->join('students_subjects ss', 'ss.student_id=s.student_id')
		->join('academic_year_info year_info', 'ss.year_id=year_info.year_code AND year_info.year_code=:year_id',array(':year_id'=>$year_id))
		->leftJoin('subjects sub','sub.id=ss.subject_id')
		->leftJoin('exam_score es', 'es.subject_id=ss.subject_id AND es.student_id=:student_id AND es.exam_id=:exam_id',array(':student_id'=>$student_id,':exam_id'=>$exam_id))
		->where('s.student_id =:student_id ', array(':student_id'=>$student_id))
		->order('sub.code ASC');
		$result=$command->queryAll();
		//var_dump($result);
		//exit;

		$student_obj=Student::student_details($student_id);
		
		//var_dump($student_obj);
		//exit;
		
		$this->render('view',array('result'=>$result,'student_obj'=>$student_obj,'year_id'=>$year_id,'exam_id'=>$exam_id));
		}
		
	}
	
	
	public  function  actionResultPrint($student_id,$exam_id,$year_id){
	
	
		//SELECT s.student_id, s.name,ss.*,sub.name,es.*,(SELECT max(mark) FROM exam_score WHERE exam_id=1 AND subject_id=es.subject_id )h FROM student s
		// left join students_subjects ss ON ss.student_id=s.student_id
		// left join subjects sub ON sub.id=ss.subject_id left join exam_score es ON (es.subject_id=ss.subject_id AND es.student_id=ss.student_id AND es.exam_id=1)
	
	
		$command= Yii::app()->db->createCommand()->setFetchMode(PDO::FETCH_OBJ)
		->select("s.student_id student_id,sub.id sub_id,sub.name subject_name,ss.is_elective is_elective,es.*,(SELECT max(mark) FROM exam_score WHERE exam_id='{$exam_id}' AND subject_id=ss.subject_id )heighest_mark")
		->from('student s')
		->join('students_subjects ss', 'ss.student_id=s.student_id')
		->join('academic_year_info year_info', 'ss.year_id=year_info.year_code AND year_info.year_code=:year_id',array(':year_id'=>$year_id))
		->leftJoin('subjects sub','sub.id=ss.subject_id')
		->leftJoin('exam_score es', 'es.subject_id=ss.subject_id AND es.student_id=:student_id AND es.exam_id=:exam_id',array(':student_id'=>$student_id,':exam_id'=>$exam_id))
		->where('s.student_id =:student_id ', array(':student_id'=>$student_id))
		->order('sub.code ASC');
		$result=$command->queryAll();
		//print_r($result);
		//exit;
		
		$student_obj=Student::student_details($student_id);

		# mPDF
		$mPDF1 = Yii::app()->ePdf->mpdf();
		
		# You can easily override default constructor's params
		$mPDF1 = Yii::app()->ePdf->mpdf('', 'A4');
		
		# render (full page)
		$mPDF1->WriteHTML($this->renderPartial('result_print',array('result'=>$result,'student_obj'=>$student_obj,'exam_id'=>$exam_id), true));
		$mPDF1->Output();
	
	
	}
	
	public function actionResultGroupWise(){
		$model=new ResultFormGroupWise;
		$exam_data=array();
		if(isset($_POST['ResultFormGroupWise']))
		{
			$model->attributes=$_POST['ResultFormGroupWise'];
			$exam_data=CHtml::listData(Exam::model()->findAll(
					'class_id=:class_id OR class_id IS NULL AND year=:year',
					array(':class_id'=>$model->class_id,':year'=>$model->year)),'exam_id','name');
			if($model->validate()){
				
				$command= Yii::app()->db->createCommand()->setFetchMode(PDO::FETCH_OBJ)
				->select('year_code')
				->from('academic_year_info')
				->where('class_id = :class_id AND value= :year',array(':class_id'=>$model->class_id,':year'=>$model->year));
				$year_id=$command->queryRow()->year_code;
								
				$students=Student::current_students($model->class_id,$section_id=null,$model->group,$student_id=null,$year_id);
				//print_r($students);
				//exit;
				
				# mPDF
				$mPDF1 = Yii::app()->ePdf->mpdf();
				
				# You can easily override default constructor's params
				$mPDF1 = Yii::app()->ePdf->mpdf('', 'A4-L',0,'','','','','10','','','L');
				
				# render (full page)
				$mPDF1->WriteHTML($this->renderPartial('result_print_group_wise',array('model'=>$model,'exam_data'=>$exam_data,'students'=>$students,'class_id'=>$model->class_id ,'group'=>$model->group,'exam_id'=>$model->exam_id,'year_id'=>$year_id), true));
				$mPDF1->Output();
			
				//$this->renderPartial('result_print_group_wise',array('model'=>$model,'exam_data'=>$exam_data,'students'=>$students,'class_id'=>$model->class_id ,'group'=>$model->group,'exam_id'=>$model->exam_id,'year_id'=>$year_id));
	
			}
			
			else {
				$this->render('result_group_wise',array('model'=>$model,'exam_data'=>$exam_data));
			}
		
		}
		else {
		$this->render('result_group_wise',array('model'=>$model,'exam_data'=>$exam_data));
		}
		
	}
	


}
<?php

class AttendanceController extends Controller
{
	//public $layout='//layouts/main';


	public function filters()
	{
		return array(
				array('auth.filters.AuthFilter -DynamicSections'),
		);
	}



	public function actionRegisterStudent(){

		$model=new AttendanceForm('student');
		$data=array();
		if(isset($_GET['AttendanceForm']))
		{
			$model->attributes=$_GET['AttendanceForm'];
			if ($model->validate()){

				$data= CHtml::listData(Section::model()->findAll(
						'class_id=:class_id ',
						array(':class_id'=>$model->class_id)),'section_id','section_name');



				//$exists=ExamScore::model()->exists($condition,$params);
				$year_id=YearInfo::current_year_code();
				if(isset($model->section_id)){
					$students=StudentClass::model()->findAll('class_id=:class_id AND section_id=:section_id AND year_id=:year_id',
							array(':class_id'=>$model->class_id,':section_id'=>$model->section_id,':year_id'=>$year_id));
				}
				else{
					$students=StudentClass::model()->findAll('class_id=:class_id AND year_id=:year_id',
							array(':class_id'=>$model->class_id,':year_id'=>$year_id));
				}


				foreach ($students as $student){

					$exists=Attendance::model()->exists('date=:date AND student_id=:student_id',
							array(':date'=>$model->date,':student_id'=>$student->student_id));

					if(!$exists){
							
						$attendance_obj=new Attendance;
						$attendance_obj->status=0;
						$attendance_obj->student_id=$student->student_id;
						$attendance_obj->date=$model->date;
						$attendance_obj->save();


					}

				}


				$attendance_input_model=new AttendanceInputForm;
				if(isset($_POST['AttendanceInputForm']))
				{
					$attendance_input_model->attributes=$_POST['AttendanceInputForm'];
					//print_r($marks_input_model->attributes);
					if($attendance_input_model->validate())
					{
						foreach ($attendance_input_model->attendance_id as $key=>$attendance_id ){
							$attendance_update_model=Attendance::model()->findByPk($attendance_id);
							$attendance_update_model->status=$attendance_input_model->status[$key];
							$attendance_update_model->save();
						}
						//Yii::app()->user->setFlash('success','Monthly Fees Generate Successful.');
						$this->refresh();
					}
				}

				/* $criteria=new CDbCriteria();
				 $criteria->condition='date=:date';
				$criteria->params=array(':date'=>$model->date);
				$daily_attendance=Attendance::model()->findAll($criteria); */
				if(isset($model->section_id)){
					$command= Yii::app()->db->createCommand()->setFetchMode(PDO::FETCH_OBJ)
					->select('a.*,sc.roll_no')
					->from('attendance a')
					->join('student_class sc', 'a.student_id=sc.student_id AND sc.class_id=:class_id AND sc.section_id=:section_id',array(':class_id'=>$model->class_id,':section_id'=>$model->section_id))
					->join('year_info', 'sc.year_id=year_info.year_code AND year_info.status=:status',array(':status'=>1))
					->where('a.date=:date',array(':date'=>$model->date))
					->order('sc.roll_no ASC');
					$daily_attendance=$command->queryAll();
				}
				else{
					$command= Yii::app()->db->createCommand()->setFetchMode(PDO::FETCH_OBJ)
					->select('a.*,sc.roll_no')
					->from('attendance a')
					->join('student_class sc', 'a.student_id=sc.student_id AND sc.class_id=:class_id',array(':class_id'=>$model->class_id))
					->join('year_info', 'sc.year_id=year_info.year_code AND year_info.status=:status',array(':status'=>1))
					->where('a.date=:date',array(':date'=>$model->date))
					->order('sc.roll_no ASC');
					$daily_attendance=$command->queryAll();
				}

				$this->render('student_register',array('model'=>$model,'data'=>$data,'daily_attendance'=>$daily_attendance,'attendance_input_model'=>$attendance_input_model));
			}
			else{
				$this->render('student_register',array('model'=>$model,'data'=>$data));
			}
		}

		else{
			$this->render('student_register',array('model'=>$model,'data'=>$data));

		}
	}


	public function actionRegisterEmployee(){

		$model=new AttendanceForm;
		$data=array();
		if(isset($_GET['AttendanceForm']))
		{
			$model->attributes=$_GET['AttendanceForm'];
			if ($model->validate()){

				$data= CHtml::listData(Section::model()->findAll(
						'class_id=:class_id ',
						array(':class_id'=>$model->class_id)),'section_id','section_name');



				//$exists=ExamScore::model()->exists($condition,$params);
				$year_id=YearInfo::current_year_code();
				if(isset($model->section_id)){
					$students=StudentClass::model()->findAll('class_id=:class_id AND section_id=:section_id AND year_id=:year_id',
							array(':class_id'=>$model->class_id,':section_id'=>$model->section_id,':year_id'=>$year_id));
				}
				else{
					$students=StudentClass::model()->findAll('class_id=:class_id AND year_id=:year_id',
							array(':class_id'=>$model->class_id,':year_id'=>$year_id));
				}


				foreach ($students as $student){

					$exists=Attendance::model()->exists('date=:date AND student_id=:student_id',
							array(':date'=>$model->date,':student_id'=>$student->student_id));

					if(!$exists){
							
						$attendance_obj=new Attendance;
						$attendance_obj->status=0;
						$attendance_obj->student_id=$student->student_id;
						$attendance_obj->date=$model->date;
						$attendance_obj->save();


					}

				}


				$attendance_input_model=new AttendanceInputForm;
				if(isset($_POST['AttendanceInputForm']))
				{
					$attendance_input_model->attributes=$_POST['AttendanceInputForm'];
					//print_r($marks_input_model->attributes);
					if($attendance_input_model->validate())
					{
						foreach ($attendance_input_model->attendance_id as $key=>$attendance_id ){
							$attendance_update_model=Attendance::model()->findByPk($attendance_id);
							$attendance_update_model->status=$attendance_input_model->status[$key];
							$attendance_update_model->save();
						}
						//Yii::app()->user->setFlash('success','Monthly Fees Generate Successful.');
						$this->refresh();
					}
				}

				/* $criteria=new CDbCriteria();
				 $criteria->condition='date=:date';
				$criteria->params=array(':date'=>$model->date);
				$daily_attendance=Attendance::model()->findAll($criteria); */
				if(isset($model->section_id)){
					$command= Yii::app()->db->createCommand()->setFetchMode(PDO::FETCH_OBJ)
					->select('a.*,sc.roll_no')
					->from('attendance a')
					->join('student_class sc', 'a.student_id=sc.student_id AND sc.class_id=:class_id AND sc.section_id=:section_id',array(':class_id'=>$model->class_id,':section_id'=>$model->section_id))
					->join('year_info', 'sc.year_id=year_info.year_code AND year_info.status=:status',array(':status'=>1))
					->where('a.date=:date',array(':date'=>$model->date))
					->order('sc.roll_no ASC');
					$daily_attendance=$command->queryAll();
				}
				else{
					$command= Yii::app()->db->createCommand()->setFetchMode(PDO::FETCH_OBJ)
					->select('a.*,sc.roll_no')
					->from('attendance a')
					->join('student_class sc', 'a.student_id=sc.student_id AND sc.class_id=:class_id',array(':class_id'=>$model->class_id))
					->join('year_info', 'sc.year_id=year_info.year_code AND year_info.status=:status',array(':status'=>1))
					->where('a.date=:date',array(':date'=>$model->date))
					->order('sc.roll_no ASC');
					$daily_attendance=$command->queryAll();
				}

				$this->render('student_register',array('model'=>$model,'data'=>$data,'daily_attendance'=>$daily_attendance,'attendance_input_model'=>$attendance_input_model));
			}
			else{
				$this->render('student_register',array('model'=>$model,'data'=>$data));
			}
		}

		else{
			$this->render('student_register',array('model'=>$model,'data'=>$data));

		}
	}

	public function actionImportFile(){
		$model=new AttendanceForm('import');
		if(isset($_POST['AttendanceForm']))
		{
			$model->attributes=$_POST['AttendanceForm'];
			if($model->validate()){
				$file=CUploadedFile::getInstance($model,'csvfile');
				$handle = fopen("$file->tempName", "r");
				$csv_data_arr=array();
				$row = 1;
				try{

					$transaction = Yii::app()->db->beginTransaction();
					while (($data = fgetcsv($handle,",")) !== FALSE) {
						if($row>1){
								
							$csv_data_arr[$row][0]=$data[0];
							$csv_data_arr[$row][1]=$data[1];
							$csv_data_arr[$row][2]=$data[2];
							
							$exists=Attendance::model()->exists('date=:date AND attendance_card_id=:attendance_card_id',
									array(':date'=>$model->date,':attendance_card_id'=>$data[0]));
								
							if(!$exists){
									
								$attendance_obj=new Attendance;
								$attendance_obj->status=1;
								$attendance_obj->attendance_card_id=$data[0];
								$student=Student::model()->find('attendance_card_id=:attendance_card_id ',array(':attendance_card_id'=>$data[0]));
								if($student!=null){
									$attendance_obj->student_id=$student->student_id;
								}
								$attendance_obj->date=$model->date;
								$attendance_obj->in_time=$data[1];
								$attendance_obj->out_time=$data[2];
								$attendance_obj->save();	
							}
								
						}
						$row++;
					}
					$transaction->commit();
					Yii::app()->user->setFlash('success','Attendance data import Successful.');
					$this->refresh();
				}
				catch(Exception $error){
					$transaction->rollback();
						
				}

			}
			//print_r($csv_data_arr);
			//exit;
		}
		$this->render('import_csv',array('model'=>$model));


	}
	public function actionDynamicSections(){

		$class_id=$_POST['AttendanceForm']['class_id'];

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
?>
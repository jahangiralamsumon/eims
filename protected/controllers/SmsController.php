<?php
class SmsController extends Controller
{

	public $layout='//layouts/column2';
	/**
	 * @return array action filters
	 */
	public function filters()
	{
		return array(
				'accessControl',
				array('auth.filters.AuthFilter -Findnumber'),
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
						'users'=>array('@'),
				),

				array('deny',  // deny all users
						'users'=>array('*'),
				),
		);
	}


	public function actionSend(){

		$model=new Sms('basic_send');

		if(isset($_POST['ajax']) && $_POST['ajax']==='send-message')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
		if(isset($_POST['Sms'])){
			$model->attributes=$_POST['Sms'];
			if ($model->validate()){

				if(Sms::check_sms_limit($model->numbers)){
					$response=Sms::send_message($model->message,$model->numbers,2,0);//$message,$mobile,$msgtype,$dlr
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

					Yii::app()->user->setFlash('success','SMS Sent.');
					$this->refresh();
				}
				else{
					Yii::app()->user->setFlash('warning','SMS limit have been exceeded.');
						
				}
			}
				
		}
		$this->render('send',array('model'=>$model));
	}

	public function actionSendstudent(){
		$model=new Sms();
		if(isset($_POST['Sms'])){
			$model->attributes=$_POST['Sms'];
			if ($model->validate()){

				if(empty($model->class_id)){
					$command= Yii::app()->db->createCommand()->setFetchMode(PDO::FETCH_OBJ)
					->select('s.student_id,s.name,mobile')
					->from('student s')
					->join('student_class sc', 's.student_id=sc.student_id')
					->join('year_info', 'sc.year_id=year_info.year_code AND year_info.status=:status',array(':status'=>1))
					->order('s.student_id ASC');
						
				}
				else{

					$command= Yii::app()->db->createCommand()->setFetchMode(PDO::FETCH_OBJ)
					->select('s.student_id,s.name,mobile')
					->from('student s')
					->join('student_class sc', 's.student_id=sc.student_id  AND sc.class_id=:class_id ',array(':class_id'=>$model->class_id))
					->join('year_info', 'sc.year_id=year_info.year_code AND year_info.status=:status',array(':status'=>1))
					->order('s.student_id ASC');
						
				}

				$valid_numbers=array();
				$students=$command->queryAll();
				foreach ($students as $student){
					if(preg_match("/^[0-9,]{11,13}$/", $student->mobile)) {
					$valid_numbers[]=strlen($student->mobile)>11?$student->mobile:'88'.$student->mobile;
					}
				}
				
				//print_r($valid_numbers);
				//exit();
				$numbers=implode(',',$valid_numbers);

				if(Sms::check_sms_limit($numbers)){
					$response=Sms::send_message($model->message,$numbers,2,0);//$message,$mobile,$msgtype,$dlr
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
				
					Yii::app()->user->setFlash('success','SMS Sent.');
					$this->refresh();
				}
				else{
					Yii::app()->user->setFlash('warning','SMS limit have been exceeded.');
				
				}
					
			}
		}
		$this->render('send_student',array('model'=>$model));

	}
	
	
	public function actionSendemployee(){

		$model=new Sms();
		if(isset($_POST['Sms'])){
			$model->attributes=$_POST['Sms'];
			if ($model->validate()){
		
				if(empty($model->department_id)){
					$command= Yii::app()->db->createCommand()->setFetchMode(PDO::FETCH_OBJ)
					->select('mobile_phone')
					->from('employees')
					->where('status=:status',array(':status'=>1))
					->order('id ASC');
		
				}
				else{
		
					$command= Yii::app()->db->createCommand()->setFetchMode(PDO::FETCH_OBJ)
					->select('mobile_phone')
					->from('employees')
					->where('status=:status AND emp_department_id=:department_id',array(':status'=>1,':department_id'=>$model->department_id))
					->order('id ASC');
		
				}
		
				$valid_numbers=array();
				$employees=$command->queryAll();
				foreach ($employees as $employee){
					if(preg_match("/^[0-9,]{11,13}$/", $employee->mobile_phone)) {
						$valid_numbers[]=strlen($employee->mobile_phone)>11?$employee->mobile_phone:'88'.$employee->mobile_phone;
					}
				}
		
				//print_r($valid_numbers);
				//exit();
				$numbers=implode(',',$valid_numbers);
						
				if(Sms::check_sms_limit($numbers)){
					$response=Sms::send_message($model->message,$numbers,2,0);//$message,$mobile,$msgtype,$dlr
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
		
					Yii::app()->user->setFlash('success','SMS Sent.');
					$this->refresh();
				}
				else{
					Yii::app()->user->setFlash('warning','SMS limit have been exceeded.');
		
				}
					
			}
		}
		$this->render('send_employee',array('model'=>$model));
		
		
	}
	
	public function actionSendbulk(){
	
		$model=new Sms('bulk_sms');
	
		if(isset($_POST['Sms'])){
			$model->attributes=$_POST['Sms'];
			if ($model->validate()){
				
				if($file=CUploadedFile::getInstance($model,'file')){
					
					$file_name=$file->tempName;					
					$field_separate_char = ",";
					$fpointer=fopen($file_name,'r');
					$valid_numbers=array();
					$row = 1;						
					while(!feof($fpointer)){
						$arr = fgetcsv($fpointer, 10*1024, $field_separate_char);
						if($row>1){
							foreach($arr as $key=>$value){
								if(trim($value)!=""){									
									if(preg_match("/^[0-9,]{11,13}$/", $value)) {
									$valid_numbers[]=strlen($value)>11?$value:'88'.$value;
									}
								}
							}
						}
						$row++;
					}	
					
					
					
				}
	
				//print_r($valid_numbers);
				//exit();
				$numbers=implode(',',$valid_numbers);

				if(Sms::check_sms_limit($numbers)){
					$response=Sms::send_message($model->message,$numbers,2,0);//$message,$mobile,$msgtype,$dlr
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
	
					Yii::app()->user->setFlash('success','SMS Sent.');
					$this->refresh();
				}
				else{
					Yii::app()->user->setFlash('warning','SMS limit have been exceeded.');
	
				}
			}
	
		}
		$this->render('send_bulk',array('model'=>$model));
	}

	
	public function actionSummary(){
		$this->layout='//layouts/column1';

		$model=new ReportGeneral();
		
		if(isset($_POST['ReportGeneral']))
		{
			$model->attributes=$_POST['ReportGeneral'];
			if ($model->validate()){
				
				$command= Yii::app()->db->createCommand()->setFetchMode(PDO::FETCH_OBJ)
				->select('sum(quantity) quantity,date(time) date')
				->from('sms_record')
				->where('date(time)>=:from_date AND date(time)<=:to_date',array(':from_date'=>$model->from_date,':to_date'=>$model->to_date))
				->group('date(time)');
				//->order('drcr');
				//echo $command->text;
				$records=$command->queryAll();
				//print_r($records);
				//exit;

				$this->render('summary',array('data'=>$records,'model'=>$model));
			}
		
			else{
				$this->render('summary',array('model'=>$model));
			}
		
		}
			
		else{
			$this->render('summary',array('model'=>$model));
		}
		
		
		
	}
	
	public function actionReport(){
		$this->layout='//layouts/column1';
	
		$model=new ReportGeneral();
	
		if(isset($_GET['ReportGeneral']))
		{
			$model->attributes=$_GET['ReportGeneral'];
			if ($model->validate()){
	
				$command= Yii::app()->db->createCommand()->setFetchMode(PDO::FETCH_OBJ)
				->select('quantity,data,time')
				->from('sms_record')
				->where('date(time)>=:from_date AND date(time)<=:to_date',array(':from_date'=>$model->from_date,':to_date'=>$model->to_date))
				->order('id');
				//echo $command->text;
				$records=$command->queryAll();
				//print_r($records);
				//exit;
				
				$raw_data=array();
				$id=1;
				foreach ($records as $key=>$row){		
					$json_data=json_decode($row->data);
					foreach ($json_data as $r){			
					 $raw_data[]= array('id'=>$id,'msg_id'=>$r['2'],'number'=>$r['1'],'status'=>$r['0'],'date'=>$row->time);					
					 $id++;
					}
					
						
						
				}
				
				$filtersForm=new FiltersForm;
				if (isset($_GET['FiltersForm']))
				$filtersForm->filters=$_GET['FiltersForm'];
				$filteredData=$filtersForm->filter($raw_data);
				
				$arrayDataProvider=new CArrayDataProvider($filteredData, array(
						'id'=>'id',
						'sort'=>array(
								'attributes'=>array(
										'number', 'date',

								),
							
						), 					
						'pagination'=>array(
								'pageSize'=>10,
								
						),
		
				));
				
				
				
				$this->render('report',array('arrayDataProvider'=>$arrayDataProvider,'filtersForm' => $filtersForm,'model'=>$model));
				
				
			}
	
			else{
				$this->render('report',array('model'=>$model));
			}
	
		}
			
		else{
			$this->render('report',array('model'=>$model));
		}
	
	
	
	}
	

	public function actionFindnumber(){

		if(isset($_GET['q'])){
			$queryterm  = $_GET['q'];

			$persons    = Student::model()->findAll(array(  'order'    => 'student_id',
					'condition'=> 'phone LIKE :phone',
					'params'   => array(':phone'=>$queryterm . '%')
			));
			$data = array();
			// ***** BEGIN change here
			foreach ($persons as $person) {
				$data[] = array(
						'id'   => $person->phone,
						'text' => $person->phone,
				);
			}
			// this one didn't work: $data = CJSON::encode(CHtml::listData($persons, 'uuid', 'lastname')) ;
			echo CJSON::encode($data) ;
		}
		Yii::app()->end();

	}

	public function actionAjaxsend() {
		$model=new Sms();
		$model->attributes=$_POST['Sms'];
		if(!$model->validate())
		{
			//echo CHtml::encode(CActiveForm::validate($model));
			echo CHtml::errorSummary($model);

				
			Yii::app()->end();
		}
		else {
			echo CHtml::encode(print_r($_POST, true));
		}

	}


}
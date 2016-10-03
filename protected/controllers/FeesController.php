<?php

class FeesController extends Controller
{

	//public $layout='//layouts/main';


	public function filters()
	{
		return array(
				array('auth.filters.AuthFilter -DynamicParticular DynamicSections PrintView PrintReceipt'),
		);
	}



	public function actionPreFeeAllocation(){
		$model=new PreFeeAllocation();
		$data= CHtml::listData(FeeParticulars::model()->findAll('is_all=:is_all AND is_monthly=:is_monthly',array(':is_all'=>'1',':is_monthly'=>'0')),'id','name');
		if(isset($_POST['PreFeeAllocation']))
		{
			$model->attributes=$_POST['PreFeeAllocation'];
			if(empty($model->class_id)){
				$model->is_all='1';  //class_id empty for this fee particular is for all class;
			}
			if($model->validate()){
				$model->save();
				Yii::app()->user->setFlash('success','Fees Allocation Successful.');
				$this->refresh();

			}
			else{
				if(empty($model->class_id)){
					$data= CHtml::listData(FeeParticulars::model()->findAll('is_all=:is_all AND is_monthly=:is_monthly',array(':is_all'=>'1',':is_monthly'=>'0')),'id','name');
				}
				else{
					$data= CHtml::listData(FeeParticulars::model()->findAll(
							'class_id=:class_id AND is_all=:is_all AND is_monthly=:is_monthly',
							array(':class_id'=>$model->class_id,':is_all'=>'0',':is_monthly'=>'0')),'id','name');
				}
			}

		}

		$this->render('pre_fee_alo',array(
				'model'=>$model,'data'=>$data));

	}
	
	
	public function actionStudentFeeAllocation(){
		$model=new PreFeeAllocation('StudentFeeAllocation');
		$prt_model=new FeeParticulars;
		if(isset($_POST['PreFeeAllocation']))
		{
			$model->attributes=$_POST['PreFeeAllocation'];
			$prt_model->attributes=$_POST['FeeParticulars'];


			$criteria=new CDbCriteria;
			$criteria->select='max(id) AS id';
			$row =FeeParticulars::model()->find($criteria);
			$max =isset($row->id)?$row->id:0;
			$prt_model->id=$max+1;			
			$model->fee_particular_id=$prt_model->id;
			
			$valid1=$prt_model->validate();
			$valid2=$model->validate();
			$valid= $valid1 && $valid2;
			if($valid)
			{
					$prt_model->save();
					$model->save();
					Yii::app()->user->setFlash('success','Add Fees to Student Successful.');
					$this->refresh();
				
				
			}
		}	
		
		$this->render('fee_alo_stu',array(
				'model'=>$model,
				'prt_model'=>$prt_model
				));
		
		
	}

	public function actionDynamicParticular(){

		$class_id=$_POST['PreFeeAllocation']['class_id'];

		if(empty($class_id)){
			$model=FeeParticulars::model()->findAll('is_all=:is_all AND is_monthly=:is_monthly',
					array(':is_all'=>'1',':is_monthly'=>'0')
			);
		}
		else{
			$model=FeeParticulars::model()->findAll(
					'class_id=:class_id AND is_all=:is_all  AND is_monthly=:is_monthly',
					array(':class_id'=>$class_id,':is_all'=>'0',':is_monthly'=>'0')
			);
		}
		foreach($model as $row)
		{
			echo CHtml::tag('option',
					array('value'=>$row->id),CHtml::encode($row->name),true);
		}
	}

	public function actionFeesPayment(){
		$model=new FeesPaymentForm;
		$data=array();
		if(isset($_GET['FeesPaymentForm']))
		{
			$model->attributes=$_GET['FeesPaymentForm'];
			if ($model->validate()){

				$data= CHtml::listData(Section::model()->findAll(
						'class_id=:class_id ',
						array(':class_id'=>$model->class_id)),'section_id','section_name');


				$command= Yii::app()->db->createCommand()
				->select('date(start_date) start_date,date(end_date) end_date')
				->from('year_info')
				->where('year_info.status=:status',array(':status'=>1))
				->queryRow();

				$from_date=$command['start_date'];
				$to_date=date("Y-m-d");

				$student_data=Journal::student_acc_status_classwise($from_date,$to_date,$model->class_id);

				$this->render('fee_payment',array('model'=>$model,'data'=>$data,'student_data'=>$student_data));

			}
			else{
				$this->render('fee_payment',array('model'=>$model,'data'=>$data));
			}
		}

		else{
			$this->render('fee_payment',array('model'=>$model,'data'=>$data));

		}


	}

	public function actionDynamicSections(){

		if(isset($_POST['FeesPaymentForm']['class_id'])){		
		$class_id=$_POST['FeesPaymentForm']['class_id'];
		}
		
		else if (isset($_POST['ReportForm']['class_id'])){
		$class_id=$_POST['ReportForm']['class_id'];
		}
		
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


	public function actionFeesCollection($sid=null){
		//FeesPayment controler Action simplified  when $sid not set  act FeesPayment controler action.
		if($sid==null){
				
			$model=new FeesPaymentForm;
			$data=array();
			if(isset($_GET['FeesPaymentForm']))
			{
				$model->attributes=$_GET['FeesPaymentForm'];
				if ($model->validate()){
						
					$data= CHtml::listData(Section::model()->findAll(
							'class_id=:class_id ',
							array(':class_id'=>$model->class_id)),'section_id','section_name');
						
						
					$command= Yii::app()->db->createCommand()
					->select('date(start_date) start_date,date(end_date) end_date')
					->from('year_info')
					->where('year_info.status=:status',array(':status'=>1))
					->queryRow();
						
					$from_date=$command['start_date'];
					$to_date=date("Y-m-d");
						
					$student_data=Journal::student_acc_status_classwise($from_date,$to_date,$model->class_id,$model->section_id,$model->group);
						
					$this->render('fee_payment',array('model'=>$model,'data'=>$data,'student_data'=>$student_data));
						
				}
				else{
					$this->render('fee_payment',array('model'=>$model,'data'=>$data));
				}
			}
				
			else{
				$this->render('fee_payment',array('model'=>$model,'data'=>$data));
					
			}
				
				
				
		}
		else{

			$model=new FeeCollection();
			$model->student_id=$sid;
			
			$student_obj=Student::student_details($sid);

			if(isset($_POST['FeeCollection']))
			{
				$model->attributes=$_POST['FeeCollection'];
				$model->payment_date=new CDbExpression('NOW()');
				if($model->validate()){
					$transaction = Yii::app()->db->beginTransaction();
					try
					{
						$r1=$model->save();
						$std_acc_id=Student::student_acc_code($model->student_id);
						/* Send SMS Fees Collection */
						//$this->sendFeesCollectionSms($model);
						/* Voucher Entry  Start */
						$v_model=new Voucher;
						//$model->scenario ='entry';
						$criteria=new CDbCriteria;
						$criteria->select='max(voucher_id) AS voucher_id';
						$row =Voucher::model()->find($criteria);
						$max =isset($row->voucher_id)?$row->voucher_id:0;
						$v_model->voucher_id=$max+1;
						$v_model->voucher_type=$model->payment_mode=='1'?2:4; // 2 for Cash Receipt(CC) 4 for Bank Receipt(BC).
						$v_model->voucher_date=new CDbExpression('NOW()');
						$r2=$v_model->save();

						$dr_account=$model->payment_mode=='1'?1:20;// 1 for Accounting Head CASH 20 for Accounting Head Bank
						$cr_account=$std_acc_id;//;Accounting Head acc_id 11 for Tution Fees
						/* Voucher Entry  end */

						/* Journal Entry start*/
						$journal_record1=new Journal;
						$journal_record1->voucher_id=$v_model->voucher_id;
						$journal_record1->acc_code=$dr_account;
						$journal_record1->drcr='dr';
						$journal_record1->amount=$model->amount;
						$journal_record1->drcr_id=$cr_account;
						$journal_record1->particular=$model->payment_mode=='1'?'Cash Received':'Bank Received';
						$r3=$journal_record1->save();

						$journal_record2=new Journal;
						$journal_record2->voucher_id=$v_model->voucher_id;
						$journal_record2->acc_code=$cr_account;
						$journal_record2->drcr='cr';
						$journal_record2->amount=$model->amount;
						$journal_record2->drcr_id=$dr_account;
						$journal_record2->particular=$model->payment_mode=='1'?'Cash Received':'Bank Received';
						$r4=$journal_record2->save();
						/* journal Entry End*/

						if($r1 && $r2 && $r3 && $r4){
							$transaction->commit();
							Yii::app()->user->setFlash('success','Fees Payment Successful.');
							//$this->refresh();
							$this->redirect(array('printview','sid'=>$model->student_id,'fcid'=>$model->id));
						}
						else{
							$transaction->rollBack();
						}


					}
					catch (Exception $e)
					{
						$transaction->rollBack();
						//echo $e->getMessage();
					}

				}
			}

			$this->render('fee_collection',array(
					'model'=>$model,
					'student_obj'=>$student_obj,
			));

		}

	}

	public function actionPrintView($sid,$fcid){

		$student_obj=Student::student_details($sid);

		$command= Yii::app()->db->createCommand()
		->select('date(start_date) start_date,date(end_date) end_date')
		->from('year_info')
		->where('year_info.status=:status',array(':status'=>1))
		->queryRow();

		$from_date=$command['start_date'];
		$to_date=$command['end_date'];
		$data=Journal::student_acc_status($from_date,$to_date,$sid);
		$acc_status=$data[0];


		$fc_obj=FeeCollection::model()->findByPk($fcid);

		$this->render('print_view',array(
				'model'=>$student_obj,
				'acc_status'=>$acc_status,
				'fc_obj'=>$fc_obj,
		));



	}


	public function actionPrintReceipt($sid,$fcid){


		$student_obj=Student::student_details($sid);

		$command= Yii::app()->db->createCommand()
		->select('date(start_date) start_date,date(end_date) end_date')
		->from('year_info')
		->where('year_info.status=:status',array(':status'=>1))
		->queryRow();

		$from_date=$command['start_date'];
		$to_date=$command['end_date'];
		$data=Journal::student_acc_status($from_date,$to_date,$sid);
		$acc_status=$data[0];

		$fc_obj=FeeCollection::model()->findByPk($fcid);

		$title=$student_obj->name.' Fees Print Receipt';

		# mPDF
		$mPDF1 = Yii::app()->ePdf->mpdf();
		# You can easily override default constructor's params
		$mPDF1 = Yii::app()->ePdf->mpdf('utf-8', 'A4',0,'',15,15,25,16,4,9,'P');


		# render (full page)
		$mPDF1->WriteHTML($this->renderPartial('print_receipt',array(
		'model'=>$student_obj,
		'acc_status'=>$acc_status,
		'fc_obj'=>$fc_obj,
		),true));

		$mPDF1->Output($title.'.pdf', "I");


	}


	protected function sendFeesCollectionSms($model){
		$fees_sms= SmsSettings::model()->findByAttributes(array('settings_key'=>'FEES_ENABLE'));
		$mobile=Student::model()->findByPk($model->student_id)->mobile;
		$amount=$model->amount;
		$payment_date=$model->payment_date;
		if($fees_sms->is_enabled=='1'){
			if(preg_match("/^[0-9,]{11,13}$/", $mobile)) {
				$to=strlen($mobile)>11?$mobile:'88'.$mobile;
			}

			if($to!=''){ // Send SMS if phone number is provided
				$institution=InstitutionConfigurations::model()->findByAttributes(array('id'=>1))->config_value;
				$message=SmsTemplatesSystem::model()->findByAttributes(array('sms_key'=>'FEES_COLLECTION'))->value;
				$message =strtr($message, array('{amount}' => $amount,'{institution}' => $institution,'{payment_date}'=>$payment_date));
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

	/*
	 *actionGenerate
	*Month Fee Generate Form
	*/
	public function actionGenerate()
	{
		$model=new FeeGenForm;


		if(isset($_POST['FeeGenForm']))
		{
			$model->attributes=$_POST['FeeGenForm'];
			if($model->validate()){
				$this->monthlyfeegen($model->month,$model->year,$model->class_id);
					
				Yii::app()->user->setFlash('success','Monthly Fees Generate Successful.');
				$this->refresh();


			}
		}

		$this->render('feegenform',array(
				'model'=>$model));
	}

	public function actionFeesView(){
		$model=new FeeViewForm;


		if(isset($_POST['FeeViewForm']))
		{
			$model->attributes=$_POST['FeeViewForm'];
			if($model->validate()){

				$result=Student::view_fee_details($model->student_id,$model->month,$model->year);
				$this->render('feeviewform',array(
						'model'=>$model,'result'=>$result));

			}
			else{
				$this->render('feeviewform',array(
						'model'=>$model));
			}
		}

		else{

			$this->render('feeviewform',array(
					'model'=>$model));
		}
	}


	public function  actionDueList(){
		
		
		$model=new ReportForm;
		$section_data=array();
		if(isset($_POST['ReportForm']))
		{
			$model->attributes=$_POST['ReportForm'];
			if ($model->validate()){
		
				$section_data= CHtml::listData(Section::model()->findAll(
						'class_id=:class_id ',
						array(':class_id'=>$model->class_id)),'section_id','section_name');
		
		
				$command= Yii::app()->db->createCommand()
				->select('date(start_date) start_date,date(end_date) end_date')
				->from('year_info')
				->where('year_info.status=:status',array(':status'=>1))
				->queryRow();
		
				$from_date=$command['start_date'];
				$to_date=date("Y-m-d");
		
				$data=Journal::student_acc_status_classwise($from_date,$to_date,$model->class_id,$model->section_id,$model->group);
		
				$this->render('due_list',array('section_data'=>$section_data,'data'=>$data,'model'=>$model,'from_date'=>$from_date,'to_date'=>$to_date));
		
			}
			else{
				$this->render('due_list',array('model'=>$model,'section_data'=>$section_data));
			}
		}
		
		else{
			$this->render('due_list',array('model'=>$model,'section_data'=>$section_data));
				
		}
		
/* 
		$command= Yii::app()->db->createCommand()
		->select('date(start_date) start_date,date(end_date) end_date')
		->from('year_info')
		->where('year_info.status=:status',array(':status'=>1))
		->queryRow();
		
		$from_date=$command['start_date'];
		$to_date=date("Y-m-d");
		
		$data=Journal::student_acc_status_classwise($from_date,$to_date);
		//krsort($data);

		$this->render('due_list',array('data'=>$data,'from_date'=>$from_date,'to_date'=>$to_date)); */
	}

	private  function monthlyfeegen($month,$year,$class_id=null){
			
		$prt_arr=FeeParticulars::prt_arr();
		$students=Student::current_students($class_id);
		if(count($students)>0){

			$command= Yii::app()->db->createCommand()
			->select('id fee_particular_id')
			->from('fee_particulars')
			->where('is_all=:is_all AND is_monthly=:is_monthly', array(':is_all'=>'1',':is_monthly'=>'1'));
			$prt_for_all=$command->queryAll();

			$command= Yii::app()->db->createCommand()
			->select('id fee_particular_id,class_id')
			->from('fee_particulars')
			->where('is_all=:is_all  AND is_monthly=:is_monthly', array(':is_all'=>'0',':is_monthly'=>'1'));
			$prt_for_classwise=$command->queryAll();

			$command= Yii::app()->db->createCommand()
			->select('fee_particular_id')
			->from('pre_fee_allocation')
			->where('is_all=:is_all AND month=:month AND year=:year', array(':is_all'=>'1',':month'=>$month,':year'=>$year));
			$pre_aloc_prt_all=$command->queryAll();


			$command= Yii::app()->db->createCommand()
			->select('fee_particular_id,class_id')
			->from('pre_fee_allocation')
			->where('is_all=:is_all AND month=:month AND year=:year', array(':is_all'=>'0',':month'=>$month,':year'=>$year));
			$pre_aloc_prt_classwise=$command->queryAll();
				
				
			$command= Yii::app()->db->createCommand()
			->select('fee_particular_id,student_id')
			->from('pre_fee_allocation')
			->where('is_all=:is_all AND class_id=:class_id AND month=:month AND year=:year', array(':is_all'=>'0',':class_id'=>'0',':month'=>$month,':year'=>$year));
			$pre_aloc_prt_stuwise=$command->queryAll();

			

			foreach ($students as $student){

				$feeobj =new FeeDetails();
				$feeobj->month=$month;
				$feeobj->year=$year;
				$feeobj->student_id = $student->student_id;
				if ($feeobj->validate())
				{
					$feeobj->save();
				}
					

				/* Voucher Entry  Start */
				$v_model=new Voucher;
				//$model->scenario ='entry';
				$criteria=new CDbCriteria;
				$criteria->select='max(voucher_id) AS voucher_id';
				$row =Voucher::model()->find($criteria);
				$max =isset($row->voucher_id)?$row->voucher_id:0;
				$v_model->voucher_id=$max+1;
				$v_model->voucher_type=5;
				$v_model->voucher_date=date('Y-m-d', mktime(0, 0, 0, $month+1,0,$year));
				$v_model->save();
					
				$dr_account=$student->student_acc_id;//Accounting Head acc_id
				//$cr_account=11;//;Accounting Head acc_id 11 for Tution Fees
				/* Voucher Entry  end */

				$this->fees_journal_record_entry($prt_for_all,$prt_arr,$feeobj->fee_id,$v_model->voucher_id,$dr_account);


				if(!empty($prt_for_classwise)){
					$all_prt_for_class=array();
					foreach($prt_for_classwise as $row){
						if($row['class_id']==$student->class_id){
							$all_prt_for_class[]=array('fee_particular_id'=>$row['fee_particular_id']);
						}
					}
					
					$this->fees_journal_record_entry($all_prt_for_class,$prt_arr,$feeobj->fee_id,$v_model->voucher_id,$dr_account);
				}

			
			$this->fees_journal_record_entry($pre_aloc_prt_all,$prt_arr,$feeobj->fee_id,$v_model->voucher_id,$dr_account);

					
			 if(!empty($pre_aloc_prt_classwise)){
			 	$pre_aloc_prt_stuclass_wise=array();
			 	foreach ($pre_aloc_prt_classwise as $row){
			 		if($row['class_id']==$student->class_id){
			 			$pre_aloc_prt_stuclass_wise[]=array('fee_particular_id'=>$row['fee_particular_id']);
			 		}
			 	}
			 	
			 	$this->fees_journal_record_entry($pre_aloc_prt_stuclass_wise,$prt_arr,$feeobj->fee_id,$v_model->voucher_id,$dr_account);
			 }

		

			 if(!empty($pre_aloc_prt_stuwise)){
			 	$pre_aloc_prt_forstu=array();
			 	foreach ($pre_aloc_prt_stuwise as $row){
			 		if($row['student_id']==$student->student_id){
			 			$pre_aloc_prt_forstu[]=array('fee_particular_id'=>$row['fee_particular_id']);
			 		}
			 	}
			 	
			 	$this->fees_journal_record_entry($pre_aloc_prt_forstu,$prt_arr,$feeobj->fee_id,$v_model->voucher_id,$dr_account);
			 }



			}
		}


		$trace= new FeeAllocationTrace;
		$trace->month=$month;
		$trace->year=$year;
		$trace->create_time=new CDbExpression('NOW()');
		if($class_id!=null){
			$trace->class_id=$class_id;
		}
		$trace->save();
	
			
	}

	private function fees_journal_record_entry($particulars,$prt_arr,$fee_id,$voucher_id,$dr_account){
		if (!empty($particulars)){

			foreach ($particulars as $prt){

				$fee_allocation = new FeeAllocation();
				$fee_allocation->fee_id=$fee_id;
				$fee_allocation->fee_particular_id = $prt['fee_particular_id'];

				if ($fee_allocation->validate())
				{
					$fee_allocation->save();
				}
				$cr_account=$prt_arr[$fee_allocation->fee_particular_id]['acc_head_id'];//FeeParticulars::prt_acc_head($fee_allocation->fee_particular_id);
				$journal_record1=new Journal;
				$journal_record1->voucher_id=$voucher_id;
				$journal_record1->acc_code=$dr_account;
				$journal_record1->drcr='dr';
				$journal_record1->amount=$prt_arr[$fee_allocation->fee_particular_id]['amount'];//FeeParticulars::amount($fee_allocation->fee_particular_id);
				$journal_record1->drcr_id=$cr_account;
				$journal_record1->particular=$prt_arr[$fee_allocation->fee_particular_id]['name'];//FeeParticulars::prt_name($fee_allocation->fee_particular_id);
				$journal_record1->save();

				$journal_record2=new Journal;
				$journal_record2->voucher_id=$voucher_id;
				$journal_record2->acc_code=$cr_account;
				$journal_record2->drcr='cr';
				$journal_record2->amount=$prt_arr[$fee_allocation->fee_particular_id]['amount'];//FeeParticulars::amount($fee_allocation->fee_particular_id);
				$journal_record2->drcr_id=$dr_account;
				$journal_record2->particular=$prt_arr[$fee_allocation->fee_particular_id]['name'];//FeeParticulars::prt_name($fee_allocation->fee_particular_id);
				$journal_record2->save();

			}
		}
	}
}
<?php

class AccountsController extends Controller
{
	
	public function filters()
	{
		return array(
				array('auth.filters.AuthFilter -VoucherPrintView'),
		);
	}
	//public $layout='//layouts/main';
	public function actionStudentLedger()
	{
		
		$model=new LedgerViewForm();
		$model->scenario ='student_ledger';
		if(isset($_POST['LedgerViewForm']))
		{
			$model->attributes=$_POST['LedgerViewForm'];
			if ($model->validate()){
			$acc_id=Student::student_acc_code($model->student_id);
			$ledger_data=Journal::student_ledger($acc_id,$model->from_date,$model->to_date);
			$this->render('student_ledger',array('ledger_data'=>$ledger_data,'model'=>$model));
			}

			else{
				$this->render('student_ledger',array('model'=>$model));
			}
			
		}	
			
	    else{
	  	$this->render('student_ledger',array('model'=>$model));
	    }
	  	
	}
	
	
	public function actionLedger()
	{
	
		$model=new LedgerViewForm();
		$model->scenario ='general_ledger';
		if(isset($_POST['LedgerViewForm']))
		{
			$model->attributes=$_POST['LedgerViewForm'];
			if ($model->validate()){

				$ledger_data=Journal::ledger($model->acc_id,$model->from_date,$model->to_date);
				$this->render('general_ledger',array('ledger_data'=>$ledger_data,'model'=>$model));
			}
	
			else{
				$this->render('general_ledger',array('model'=>$model));
			}
				
		}
			
		else{
			$this->render('general_ledger',array('model'=>$model));
		}
	
	}
	
	public function  actionLedgerprint($acc_id,$from_date,$to_date){
		
		$ledger_data=Journal::ledger($acc_id,$from_date,$to_date);		
		# mPDF
		$mPDF1 = Yii::app()->ePdf->mpdf();
		
		# You can easily override default constructor's params
		$mPDF1 = Yii::app()->ePdf->mpdf('', 'A4');
		
		# render (full page)
		$mPDF1->WriteHTML($this->renderPartial('general_ledger_print',array('ledger_data'=>$ledger_data,'acc_id'=>$acc_id,'from_date'=>$from_date,'to_date'=>$to_date),true));
		$mPDF1->Output();
		
		
	}
	
	
	public function actionVoucherEntry()
	{
		
		$model=new Voucher;
		$model->scenario ='entry';
		// uncomment the following code to enable ajax-based validation
		/*
		 if(isset($_POST['ajax']) && $_POST['ajax']==='voucher-EntryPV-form')
		 {
		echo CActiveForm::validate($model);
		Yii::app()->end();
		}
		*/
	
		if(isset($_POST['Voucher']))
		{
	
			$criteria=new CDbCriteria;
			$criteria->select='max(voucher_id) AS voucher_id';
			$row =Voucher::model()->find($criteria);
			$max =isset($row->voucher_id)?$row->voucher_id:0;
			$model->voucher_id=$max+1;
			$model->user_id=Yii::app()->user->id;
			$model->is_update='1';
			$model->attributes=$_POST['Voucher'];
			//print_r($model->attributes);
			$dr_account=$_POST['Voucher']['dr_account'];
			$cr_account=$_POST['Voucher']['cr_account'];
			$amount=$_POST['Voucher']['amount'];
			if($model->validate())
			{
				$model->save();
				$journal_record1=new Journal;
				$journal_record1->voucher_id=$model->voucher_id;
				$journal_record1->acc_code=$dr_account;
				$journal_record1->drcr='dr';
				$journal_record1->amount=$amount;
				$journal_record1->drcr_id=$cr_account;
				$journal_record1->particular=$model->particulars;
				$journal_record1->save();
	
				$journal_record2=new Journal;
				$journal_record2->voucher_id=$model->voucher_id;
				$journal_record2->acc_code=$cr_account;
				$journal_record2->drcr='cr';
				$journal_record2->amount=$amount;
				$journal_record2->drcr_id=$dr_account;
				$journal_record2->particular=$model->particulars;
				$journal_record2->save();
				Yii::app()->user->setFlash('success','Journal Entry Successful.');
				$this->refresh();
			}
		}
		$this->render('voucher_entry',array('model'=>$model));
	}
	
	public function actionVoucherManage(){
	
		if(isset($_POST['voucher_view']))
		{
	
			$from_date=$_POST['voucher_view']['from_date'];
			$to_date=$_POST['voucher_view']['to_date'];
			$vouchers = Yii::app()->db->createCommand()
			->select('*,SUM(amount) amount')
			->from('journal j')
			->join('acc_head a', 'a.acc_id=j.acc_code')
			->join('voucher v', 'j.voucher_id=v.voucher_id')
			->where('date(voucher_date)>=:from_date AND date(voucher_date)<=:to_date AND is_update=:is_update',  array(':from_date'=>$from_date,':to_date'=>$to_date,':is_update'=>'1'))
			->order('j.voucher_id desc,drcr asc')
			->group('j.voucher_id,j.drcr,j.acc_code')
			->queryAll();
			$this->render('voucher_all',array('vouchers'=>$vouchers,'from_date'=>$from_date,'to_date'=>$to_date));
		}
		else{
			$from_date=date("Y-m-d");
			$to_date=date("Y-m-d");
			$this->render('voucher_all',array('from_date'=>$from_date,'to_date'=>$to_date));
		}
	
	}
	
	public function actionDailyVoucher(){
	
		$model=new VoucherViewForm();
		$model->scenario ='daily_voucher';
		if(isset($_POST['VoucherViewForm']))
		{
			$model->attributes=$_POST['VoucherViewForm'];
			if ($model->validate()){
			$vouchers = Yii::app()->db->createCommand()
			->select('*,SUM(amount) amount')
			->from('journal j')
			->join('acc_head a', 'a.acc_id=j.acc_code')
			->join('voucher v', 'j.voucher_id=v.voucher_id')
			->where('date(voucher_date)=:date',  array(':date'=>$model->date))
			->order('j.voucher_id desc,drcr asc')
			->group('j.voucher_id,j.drcr,j.acc_code')
			->queryAll();
			$this->render('voucher_daily',array('vouchers'=>$vouchers,'model'=>$model));
			}
			else{
			$this->render('voucher_daily',array('model'=>$model));
			}
		}
		else{
			$model->date=date("Y-m-d");
			$this->render('voucher_daily',array('model'=>$model));
		}
	
	}
	
	public function actionVoucherPrint(){
	
		if(isset($_POST['voucher_view']))
		{
	
			$from_date=$_POST['voucher_view']['from_date'];
			$to_date=$_POST['voucher_view']['to_date'];
			$vouchers = Yii::app()->db->createCommand()
			->select('*,SUM(amount) amount')
			->from('journal j')
			->join('acc_head a', 'a.acc_id=j.acc_code')
			->join('voucher v', 'j.voucher_id=v.voucher_id')
			->where('date(voucher_date)>=:from_date AND date(voucher_date)<=:to_date',  array(':from_date'=>$from_date,':to_date'=>$to_date))
			->order('j.voucher_id desc,drcr asc')
			->group('j.voucher_id,j.drcr,j.acc_code')
			->queryAll();
			$this->render('voucher_print',array('vouchers'=>$vouchers,'from_date'=>$from_date,'to_date'=>$to_date));
		}
		else{
			$from_date=date("Y-m-d");
			$to_date=date("Y-m-d");
			$this->render('voucher_print',array('from_date'=>$from_date,'to_date'=>$to_date));
		}
	
	}
	
	public function actionVoucherPrintView($id){
		
		$dr_accounts = Yii::app()->db->createCommand()->setFetchMode(PDO::FETCH_OBJ)
		->select('*,SUM(amount) amount')
		->from('journal j')
		->where('voucher_id=:voucher_id AND drcr=:drcr',array(':voucher_id'=>$id,':drcr'=>'dr'))
		->order('j.serial asc')
		->group('j.voucher_id,j.acc_code')
		->queryAll();
		
		$cr_accounts = Yii::app()->db->createCommand()->setFetchMode(PDO::FETCH_OBJ)
		->select('*,SUM(amount) amount')
		->from('journal j')
		->where('voucher_id=:voucher_id AND drcr=:drcr',array(':voucher_id'=>$id,':drcr'=>'cr'))
		->order('j.serial asc')
		->group('j.voucher_id,j.acc_code')
		->queryAll();
		
		$voucher= Yii::app()->db->createCommand()->setFetchMode(PDO::FETCH_OBJ)
		->select('*')
		->from('voucher v')
		->join('voucher_type vt', 'v.voucher_type=vt.voucher_type')
		->where('voucher_id=:voucher_id',  array(':voucher_id'=>$id))
		->queryRow();
		
		//$this->render('voucher_print_view',array('voucher'=>$voucher,'dr_accounts'=>$dr_accounts,'cr_accounts'=>$cr_accounts));
		

		
		# mPDF
		$mPDF1 = Yii::app()->ePdf->mpdf();
		
		# You can easily override default constructor's params
		$mPDF1 = Yii::app()->ePdf->mpdf('', 'A4');
		
		# render (full page)
		$mPDF1->WriteHTML($this->renderPartial('voucher_print_view',array('voucher'=>$voucher,'dr_accounts'=>$dr_accounts,'cr_accounts'=>$cr_accounts),true));
		$mPDF1->Output();
		
		
		
		
	}
	
	public function actionVoucherEdit($id)
	{
		$model=new VoucherEntryForm;
		$records=Journal::model()->findAll(array(
				'select'=>'*',
				'condition'=>'voucher_id=:voucher_id AND drcr=:drcr',
				'params'=>array(':voucher_id'=>$id,':drcr'=>'dr'),
		));
		if(isset($_POST['VoucherEntryForm']))
		{
			$model->attributes=$_POST['VoucherEntryForm'];
			if($model->validate()){
				$command = Yii::app()->db->createCommand();
				$command->update('voucher', array(
						'last_updated'=>date("Y-m-d H:i:s"),
				),'voucher_id=:voucher_id', array(':voucher_id'=>$id));

				foreach ($model->acc_code as $key=>$acc_code){
					Journal::model()->updateAll(array('amount'=>$model->amount[$key],'particular'=>$model->particular[$key]),
					'voucher_id=:voucher_id AND (acc_code=:acc_code AND drcr_id=:drcr_id OR acc_code=:drcr_id AND drcr_id=:acc_code)',array(':voucher_id'=>$id,':acc_code'=>$acc_code,':drcr_id'=>$model->drcr_id[$key]));
				}
				
					
				Yii::app()->user->setFlash('success','Voucher Edit Successful.');
				$this->refresh();
				
				//$this->redirect(array('VoucherManage'));
			}
	
		}

		$this->render('voucher_edit',array('model'=>$model,'records'=>$records));
	}
	
	
	public function actionTrialBalance(){
			
		$model=new TBViewForm();
		
		if(isset($_POST['TBViewForm']))
		{
			$model->attributes=$_POST['TBViewForm'];
			if ($model->validate()){
				$data=Journal::prep_tb($model->from_date,$model->to_date);	
				krsort($data);
				$this->render('trial_balance',array('data'=>$data,'model'=>$model));
			}
		
			else{
				$this->render('trial_balance',array('model'=>$model));
			}
				
		}
			
		else{
			$this->render('trial_balance',array('model'=>$model));
		}
	
	}
	
	
	public function  actionIncomeStatement(){
		
		$command= Yii::app()->db->createCommand()
		->select('date(start_date) start_date,date(end_date) end_date')
		->from('year_info')
		->where('year_info.status=:status',array(':status'=>1))
		->queryRow();
		
		$from_date=$command['start_date'];
		$to_date=$command['end_date'];			
		$data=Journal::prep_tb($from_date,$to_date);
		//krsort($data);
	  
		$this->render('income_statement',array('data'=>$data,'from_date'=>$from_date,'to_date'=>$to_date));
	}
	
	
	public function  actionBalanceSheet(){
	
		$command= Yii::app()->db->createCommand()
		->select('date(start_date) start_date,date(end_date) end_date')
		->from('year_info')
		->where('year_info.status=:status',array(':status'=>1))
		->queryRow();
	
		$from_date=$command['start_date'];
		$to_date=$command['end_date'];
		$data=Journal::prep_tb($from_date,$to_date);
		//krsort($data);
		 
		$this->render('balance_sheet',array('data'=>$data,'from_date'=>$from_date,'to_date'=>$to_date));
	}
	
	
	public function  actionManageAccHead(){
	

		//$data=AccHead::manage_acc_head();
		$data=AccHead::manage_acc_head_withoutstudenthead();
		//krsort($data);

		$this->render('manage_acchead',array('data'=>$data));
	}
	
	public function actionCreateAccHead($parent,$top_parent,$depth,$category,$lr)
	{
		$model=new AccHead;
	

		if(isset($_POST['AccHead']))
		{
			$model->attributes=$_POST['AccHead'];
			$model->parent=$parent;
			$model->top_parent=$top_parent;
			$model->depth=$depth;
			$model->category=$category;
			$model->lr=$lr;
			if($model->save()){
				/*afterSave event add acc opening in AccHead model */
				$this->redirect(array('manageacchead'));
			}
		}
	
		$this->render('acc_head_create',array(
				'model'=>$model,
		));
	}
	
	/**
	 * Updates a particular model.
	 * If update is successful, the browser will be redirected to the 'view' page.
	 * @param integer $id the ID of the model to be updated
	 */
	public function actionAccHeadEdit($id)
	{
		$model=$this->loadModel($id);
	
		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);
	
		if(isset($_POST['AccHead']))
		{
			$model->attributes=$_POST['AccHead'];
			if($model->save())
			$this->redirect(array('manageacchead'));
		}
	
		$this->render('acc_head_edit',array(
				'model'=>$model,
		));
	}
	
	/**
	 * Deletes a particular model.
	 * If deletion is successful, the browser will be redirected to the 'admin' page.
	 * @param integer $id the ID of the model to be deleted
	 */
	public function actionAccHeadDelete($id)
	{
		if(Yii::app()->request->isPostRequest)
		{
			// we only allow deletion via POST request
			$criteria = new CDbCriteria();
			$criteria->select = 'acc_id';
			$criteria->condition = 'acc_id =:acc_id AND  is_delete =:is_delete';
			$criteria->params = array(':acc_id'=>$id,':is_delete' =>'1');
			$model = AccHead::model()->find($criteria);
			if($model!==null){			
			$this->loadModel($id)->delete();
			}
	        $this->redirect(array('manageacchead'));
		}
		else
			throw new CHttpException(400,'Invalid request. Please do not repeat this request again.');
	}
	
	public function loadModel($id)
	{
		$model=AccHead::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}


}
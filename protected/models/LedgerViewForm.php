<?php
class LedgerViewForm extends  CFormModel{
	
	public $from_date;
	public $to_date;
	public $student_id;
	public $acc_id;
	
	public function rules()
	{
		return array(
				array('from_date,to_date', 'required'),
				array('student_id','required','on'=>'student_ledger'),
				array('acc_id','required','on'=>'general_ledger'),
	
		);
	}
	
	
	
	
}
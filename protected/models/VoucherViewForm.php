<?php
class VoucherViewForm extends  CFormModel{
	
	public $from_date;
	public $to_date;
	public $date;
		
	public function rules()
	{
		return array(
				array('from_date,to_date','required','on'=>'all_voucher'),
				array('date','required','on'=>'daily_voucher'),
	
		);
	}
	
	public function attributeLabels()
	{
		return array(
				'from_date'=>'From Date',
				'to_date'=>'To Date',
				'date'=>'Date',
		);
	}
	
	
	
	
}
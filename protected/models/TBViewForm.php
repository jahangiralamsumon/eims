<?php
class TBViewForm extends  CFormModel{
	
	public $from_date;
	public $to_date;

	
	public function rules()
	{
		return array(
				array('from_date,to_date', 'required'),
	
		);
	}
	
	
	
	
}
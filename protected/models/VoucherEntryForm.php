<?php

class VoucherEntryForm extends CFormModel
{
	public $acc_code=array();
	public $drcr_id=array();
	public $amount=array();
	public $particular=array();

	/**
	 * Declares the validation rules.
	 */
	public function rules()
	{
		return array(	
		array('acc_code','type','type'=>'array'),
		array('drcr_id','type','type'=>'array'),
		array('amount','type', 'type'=>'array'),
		array('particular','type', 'type'=>'array'),
		array('amount','check_required'),
		);
	}

	public function check_required($attribute,$params){
		$fields=$this->attributes['amount'];
		foreach ($fields as $key=>$field)
		{
			
				if($field==""){
					$this->addError('amount'.'['.$key.']', "This Field is Required");
				}
				else if(!is_numeric($field)){
					$this->addError('amount'.'['.$key.']', "Must be Numerical");
				}
				
		
		}
	


	}



	public function attributeLabels()
	{
		return array(
			'amount[0]'=>'Amount',
		);
	}
}
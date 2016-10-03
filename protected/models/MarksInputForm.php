<?php

class MarksInputForm extends CFormModel
{
	public $subject_id;
	public $mark_id=array();
	public $markobtained=array();
	public $written=array();
	public $mcq=array();
	public $practical=array();
	public $attendance=array();
	public $remark=array();
	/**
	 * Declares the validation rules.
	 */
	public function rules()
	{
		return array(	
		array('mark_id','type', 'type'=>'array'),
		array('written','type', 'type'=>'array'),
		array('mcq','type', 'type'=>'array'),
		array('practical','type', 'type'=>'array'),
		array('markobtained','type', 'type'=>'array'),
		array('attendance','type','type'=>'array'),
		array('remark','type', 'type'=>'array'),
		array('written','check_required','mark_field'=>1,'msg'=>'CQ Mark Field is Required'),
		array('mcq','check_required','mark_field'=>2,'msg'=>'MCQ Mark Field is Required'),
		array('practical','check_required','mark_field'=>3,'msg'=>'Practical Mark Field is Required'),
		array('subject_id','safe'),		
		);
	}

	public function check_required($attribute,$params){
		if ($params['mark_field']==1){
		$fields=$this->attributes['written'];
		$active_field='written';
		}
		else if ($params['mark_field']==2){
			$fields=$this->attributes['mcq'];
			$active_field='mcq';
		}
		else if ($params['mark_field']==3){
			$fields=$this->attributes['practical'];
			$active_field='practical';
		}
		foreach ($fields as $key=>$field)
		{
			   $sub_details=Subjects::model()->findByPk($this->subject_id);
			   
				if($field==""){
					$this->addError($active_field.'['.$key.']', $params['msg']);
				}
				else if(!is_numeric($field)){
					$this->addError($active_field.'['.$key.']', "Must be Numerical");
				}
				
				else if($field>$sub_details->$active_field){
					$this->addError($active_field.'['.$key.']', $active_field." mark must less than".$sub_details->$active_field);
				}
				
		
		}
	


	}



	public function attributeLabels()
	{
		return array(
			'markobtained'=>'Mark Obtained',
		);
	}
}
<?php
class StudentPromotionInput extends  CFormModel{

	public $class_id;
	public $year_id;
	
	public function rules()
	{
		return array(
				array('class_id,year_id', 'required'),
	
	
		);
	}
	
	
	public function attributeLabels()
	{
		return array(
				'class_id'=>'Class',
				'year_id'=>'Academic Year'
		);
	}
	
}
?>
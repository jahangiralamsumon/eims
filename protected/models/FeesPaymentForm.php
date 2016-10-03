<?php

class FeesPaymentForm extends  CFormModel{
	public $class_id;
	public $section_id;
	public $group;
	public function rules()
	{
		return array(
				array('class_id', 'required'),
				array('section_id, class_id', 'numerical', 'integerOnly'=>true),
				array('group','safe'),

		);
	}


	public function attributeLabels()
	{
		return array(
				'class_id'=>'Class',
				'section_id'=>'Section',
				'group'=>'Group',
		);
	}

}
?>
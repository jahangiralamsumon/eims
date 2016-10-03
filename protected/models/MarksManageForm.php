<?php
class MarksManageForm extends  CFormModel{
	public $year;
	public $exam_id;
	public $class_id;
	public $subject_id;
	
	public function rules()
	{
		return array(
				array('year,exam_id,class_id,subject_id', 'required'),
	            array('year','safe'),
	
		);
	}
	
	
	public function attributeLabels()
	{
		return array(
				'year'=>'Year',
				'exam_id'=>'Exam',
				'class_id'=>'Class',
				'subject_id'=>'Subject'
		);
	}
	
}
?>
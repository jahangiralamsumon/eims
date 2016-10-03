<?php
class SubjectRegForm extends  CFormModel{

	public $student_id;
	
	public function rules()
	{
		return array(
				array('student_id', 'required'),
				array('student_id', 'validstudent'),
	
		);
	}
	
	public function validstudent($attribute, $params){ 		
	$row=Student::current_students($class_id=null,$section_id=null,$group=null,$this->student_id);	
	if(empty($row)){
		$this->addError($attribute, 'Student ID not found');
	}
	
	}
	
	public function attributeLabels()
	{
		return array(
				'student_id'=>'Student ID',
		);
	}
	
}
?>
<?php

class AttendanceForm extends  CFormModel{
	public $class_id;
	public $section_id;
	public $date;
	public $csvfile;

	public function rules()
	{
		return array(
				array('class_id','required','on'=>'student'),
				array('date', 'required'),
				array('csvfile', 'file','allowEmpty' => false,'types' => 'csv','on'=>'import'),
				array('csvfile','csv_data','on'=>'import'),
				array('section_id, class_id', 'numerical', 'integerOnly'=>true),

		);
	}

	public function csv_data($attribute, $params){
		$file=CUploadedFile::getInstanceByName('AttendanceForm[csvfile]');
		if($file){
		$handle = fopen("$file->tempName", "r");		
		$header = fgetcsv($handle, 1000, ",") ;
		if($header[0]!='Attendance Card ID' OR $header[1]!='In Time' OR $header[2]!='Out Time'  ){
			$this->addError($attribute, 'Attendance csv file data not valid.');
		}
		}
		
	}

	public function attributeLabels()
	{
		return array(
				'class_id'=>'Class',
				'section_id'=>'Section',
				'csvfile'=>'Addendance data',
				'date'=>'Date'
		);
	}

}
?>
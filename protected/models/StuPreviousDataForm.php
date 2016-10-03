<?php
class StuPreviousDataForm extends CFormModel{
	
	public $exam1;
	public $exam2;
	public $institution1;
	public $institution2;
	public $board1;
	public $board2;
	public $year1;
	public $year2;
	public $gpa1;
    public $gpa2;
    public $has_no_data;
	
	public function rules()
	{
		return array(
				array('institution1,board1,year1,gpa1', 'required'),
				array('gpa1,gpa2', 'numerical'),
				array('exam1,exam2,institution2,board2,year2,has_no_data', 'safe'),
				
	
		);
	}
	
	
	public function attributeLabels()
	{
		return array(
				'exam1' => 'Exam',
				'institution1' => 'Institution',
				'board1' => 'Board',
				'year1' => 'Year',
				'gpa1' => 'GPA',
				'exam2' => 'Exam',
				'institution2' => 'Institution',
				'board2' => 'Board',
				'year2' => 'Year',
				'gpa2' => 'GPA',
			
		);
	}
	
	
	
	
}
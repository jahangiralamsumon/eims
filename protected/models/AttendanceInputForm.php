<?php
class AttendanceInputForm extends CFormModel
{
	public $attendance_id=array();
	public $status=array();

	/**
	 * Declares the validation rules.
	 */
	public function rules()
	{
		return array(	
		array('attendance_id','type', 'type'=>'array'),
		array('status','type', 'type'=>'array'),
		);
	}




}
?>
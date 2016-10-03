<?php
class InstituteConfigForm extends CFormModel
{
	
	public $institution_name;
	public $institution_short_name;
	public $institution_code;
	public $institution_address;
	public $institution_phone;
	public $institution_fax;
	public $institution_email;
	public $logo;
	
	
	public function rules()
	{
		return array(
				array('institution_name,institution_short_name,institution_code,institution_phone,institution_email', 'required'),
				array('institution_address,institution_fax', 'length', 'max'=>500),
				array('logo', 'file','allowEmpty' => true,'types' => 'jpg,jpeg,gif,png', 'maxSize' => 1024 * 1024 * 2, 'tooLarge' => 'Size should be less then 2MB !!!'),			   
				array('institution_email','email'),
	
	
		);
	}
	
	
	public function attributeLabels()
	{
		return array(
				'institution_name'=>'Institution Name',
				'institution_address'=>'Institution Address',
				'institution_phone'=>'Phone',
				'institution_short_name'=>'Short Name'
		);
	}
	
}
?>
<?php

class ChangePassword extends CFormModel
{
	public $new_password;
	public $password;
	public $repeat_password;

	/**
	 * Declares the validation rules.
	 * The rules state that username and password are required,
	 * and password needs to be authenticated.
	 */
	public function rules()
	{
		return array(
		array('password,new_password,repeat_password', 'required'),
		array('password','check_current_password'),
		array('repeat_password', 'compare','compareAttribute'=>'new_password'),
		);

	}

	public function check_current_password($attribute,$params){
		$pass= hash_hmac('sha256', $this->password,Yii::app()->params['encryptionKey']);
		$record=User::model()->findByAttributes(array('password'=>$pass,'id'=>Yii::app()->user->id));
		if($record===null){
			$this->addError($attribute, 'Current Password Invalid');
		}
	}

	/**
	 * Declares attribute labels.
	 */
	public function attributeLabels()
	{
		return array(
			'password'=>'Current Password',
		);
	}

}

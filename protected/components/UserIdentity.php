<?php

/**
 * UserIdentity represents the data needed to identity a user.
 * It contains the authentication method that checks if the provided
 * data can identity the user.
 */
class UserIdentity extends CUserIdentity
{
		private $_id;

	/**
	 * Authenticates a user.
	 * @return boolean whether authentication succeeds.
	 */
	/**
	 * Authenticates a user.
	 * The example implementation makes sure if the username and password
	 * are both 'demo'.
	 * In practical applications, this should be changed to authenticate
	 * against some persistent user identity storage (e.g. database).
	 * @return boolean whether authentication succeeds.
	 * 
	 */
	
	public function authenticate()
	{
	
		$user=User::model()->find('LOWER(username)=?',array(strtolower($this->username)));
		if($user===null)
		$this->errorCode=self::ERROR_USERNAME_INVALID;
		else if($user->password!==hash_hmac('sha256',$this->password,Yii::app()->params['encryptionKey'])) 
		$this->errorCode=self::ERROR_PASSWORD_INVALID;
		else
		{
			$this->_id=$user->id;
			//$this->username=$user->user_name;
		    
			$this->setState('username',$user->username);
		    
		    $arrayAuthRoleItems = Yii::app()->authManager->getAuthItems(2,$user->id);
		    $roles=array_keys($arrayAuthRoleItems);
		    $this->setState('roles',$roles);
		    
			$this->errorCode=self::ERROR_NONE;
		}
		return $this->errorCode==self::ERROR_NONE;
	}
	
	/**
	 * @return integer the ID of the user record
	 */
	public function getId()
	{
		return $this->_id;
	}
}
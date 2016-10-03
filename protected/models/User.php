<?php

/**
 * This is the model class for table "user".
 *
 * The followings are the available columns in table 'user':
 * @property integer $id
 * @property string $username
 * @property string $password
 * @property string $name
 * @property string $short_name
 * @property string $email
 * @property string $user_img
 * @property string $reg_date
 */
class User extends CActiveRecord
{
	
	
	public function beforeSave() {
		if ($this->isNewRecord){
		$this->password = hash_hmac('sha256', $this->password,Yii::app()->params['encryptionKey']);		
		$this->reg_date = date("Y-m-d H:i:s");
		}
	
		return parent::beforeSave();
	}
	
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'user';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('username,name, short_name, email,password', 'required'),	
			array('user_img', 'file','allowEmpty' => true,'types' => 'jpg,jpeg,gif,png', 'maxSize' => 1024 * 1024 * 2, 'tooLarge' => 'Size should be less then 2MB !!!'),
			array('id,status', 'numerical', 'integerOnly'=>true),
			array('username, email', 'length', 'max'=>300),
			array('password,name, short_name', 'length', 'max'=>200),
			array('username', 'unique'),
			array('email', 'email'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, username, password, name, short_name, email, user_img, reg_date', 'safe', 'on'=>'search'),
		);
	}

	/**
	 * @return array relational rules.
	 */
	public function relations()
	{
		// NOTE: you may need to adjust the relation name and the related
		// class name for the relations automatically generated below.
		return array(
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'username' => 'Username',
			'password' => 'Password',
			'name' => 'Name',
			'short_name' => 'Short Name',
			'email' => 'Email',
			'user_img' => 'User Img',
			'reg_date' => 'Reg Date',
		);
	}

	/**
	 * Retrieves a list of models based on the current search/filter conditions.
	 *
	 * Typical usecase:
	 * - Initialize the model fields with values from filter form.
	 * - Execute this method to get CActiveDataProvider instance which will filter
	 * models according to data in model fields.
	 * - Pass data provider to CGridView, CListView or any similar widget.
	 *
	 * @return CActiveDataProvider the data provider that can return the models
	 * based on the search/filter conditions.
	 */
	public function search()
	{
		// @todo Please modify the following code to remove attributes that should not be searched.

		$criteria=new CDbCriteria;

		$criteria->compare('id',$this->id);
		$criteria->compare('username',$this->username,true);
		$criteria->compare('password',$this->password,true);
		$criteria->compare('name',$this->name,true);
		$criteria->compare('short_name',$this->short_name,true);
		$criteria->compare('email',$this->email,true);
		$criteria->compare('user_img',$this->user_img,true);
		$criteria->compare('reg_date',$this->reg_date,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return User the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
	
	public static function get_user_shortname($id){
		$user=self::model()->find('id=?',array($id));
		if($user!==null){
			return $user->short_name;
		}
	
	}
	
	public  static function get_user_img($id){
		
		$user=self::model()->find('id=?',array($id));
		$url=Yii::app()->baseUrl.'/uploadedfiles/userimage/default.jpg';
		if($user!==null){
			if(!empty($user->user_img))
			$url=Yii::app()->baseUrl.'/uploadedfiles/userimage/'.$id.'/'.$user->user_img;
			
		}
		
		return $url;
	}
	
	/**
	 * Returns the roles assigned to a specific user.
	 * If no user id is provided the logged in user will be used.
	 * @param integer $userId the user id of the user for which roles to get.
	 * @param boolean $sort whether to sort the items by their weights.
	 * @return array the roles.
	 */

	
	public function role($data,$row)
	{
		
		$auth = Yii::app()->authManager;		
		$roles = $auth->getRoles($data->id);  //public array getRoles(mixed $userId=NULL)
		
		if(count($roles)<1)
		{
			return 'No roles';
		}
		else
		{

			foreach($roles as $role)
			{
				$role->name;
			}
			return  $role->name;
		}
	
	
	}
	
	public static function find_rule($user_id){
		
		$auth = Yii::app()->authManager;
		$roles = $auth->getRoles($user_id);  //public array getRoles(mixed $userId=NULL)
		
		if(count($roles)<1)
		{
			return 'No roles';
		}
		else
		{
		
			foreach($roles as $role)
			{
				$role->name;
			}
			return  $role->name;
		}
		
		
	}
}

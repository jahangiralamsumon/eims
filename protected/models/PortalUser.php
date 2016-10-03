<?php

class PortalUser extends CActiveRecord
{
	const STATUS_NOACTIVE=0;
	const STATUS_ACTIVE=1;
	const STATUS_BANNED=-1;
	
	//TODO: Delete for next version (backward compatibility)
	const STATUS_BANED=-1;
	
	/**
	 * The followings are the available columns in table 'users':
	 * @var integer $id
	 * @var string $username
	 * @var string $password
	 * @var string $email
	 * @var string $activkey
     * @var timestamp $create_at
     * @var timestamp $lastvisit_at
	 * @var integer $user_type
	 * @var integer $status

	 */
		
	
	
	/**
	 * Returns the static model of the specified AR class.
	 * @return CActiveRecord the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

	/**
	 * @return string the associated database table name
	 */

	public function tableName()
	{
		return 'portal_users';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.CConsoleApplication
		return array(
			array('username', 'length', 'max'=>20, 'min' => 1,'message' => "Incorrect username (length between 3 and 20 characters)."),
			array('password', 'length', 'max'=>128, 'min' => 1,'message' => "Incorrect password (minimal length 4 symbols)."),
			array('email', 'email'),
			array('username', 'unique', 'message' => "This user's name already exists."),
			array('email', 'unique', 'message' => "This user's email address already exists."),
			array('username', 'match', 'pattern' => '/^[A-Za-z0-9_]+$/u','message' => "Incorrect symbols (A-z0-9)."),
			array('status', 'in', 'range'=>array(self::STATUS_NOACTIVE,self::STATUS_ACTIVE,self::STATUS_BANNED)),
			array('user_type', 'in', 'range'=>array('student','teacher','parent')),
            array('create_at', 'default', 'value' => date('Y-m-d H:i:s'), 'setOnEmpty' => true, 'on' => 'insert'),
            array('lastvisit_at', 'default', 'value' => '0000-00-00 00:00:00', 'setOnEmpty' => true, 'on' => 'insert'),
			array('status', 'numerical', 'integerOnly'=>true),
			array('id, username, password, email, activkey, create_at, lastvisit_at,user_type, status', 'safe', 'on'=>'search'),
			array('username,password', 'required'),
			array('username', 'length', 'max'=>20, 'min' => 1,'message' => "Incorrect username (length between 3 and 20 characters)."),
			array('email', 'email'),
			array('username', 'unique', 'message' => "This user's name already exists."),
			
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
				'email' => 'Email',
				'activkey' => 'activation key',
				'create_at' => 'Registration date',
				'lastvisit_at' => 'Last visit',
				'user_type' => 'User Type',
				'status' => 'Status',
		);
	}
	public function scopes()
    {
        return array(
            'active'=>array(
                'condition'=>'status='.self::STATUS_ACTIVE,
            ),
            'notactive'=>array(
                'condition'=>'status='.self::STATUS_NOACTIVE,
            ),
            'banned'=>array(
                'condition'=>'status='.self::STATUS_BANNED,
            ),
          
   
        );
    }
	
	
	public static function itemAlias($type,$code=NULL) {
		$_items = array(
			'UserStatus' => array(
				self::STATUS_NOACTIVE => 'Not active',
				self::STATUS_ACTIVE => 'Active',
				self::STATUS_BANNED => 'Banned',
			),
		
		);
		if (isset($code))
			return isset($_items[$type][$code]) ? $_items[$type][$code] : false;
		else
			return isset($_items[$type]) ? $_items[$type] : false;
	}
	
/**
     * Retrieves a list of models based on the current search/filter conditions.
     * @return CActiveDataProvider the data provider that can return the models based on the search/filter conditions.
     */
    public function search()
    {
        // Warning: Please modify the following code to remove attributes that
        // should not be searched.

        $criteria=new CDbCriteria;
        
        $criteria->compare('id',$this->id);
        $criteria->compare('username',$this->username,true);
        $criteria->compare('password',$this->password);
        $criteria->compare('email',$this->email,true);
        $criteria->compare('activkey',$this->activkey);
        $criteria->compare('create_at',$this->create_at);
        $criteria->compare('lastvisit_at',$this->lastvisit_at);
        $criteria->compare('user_type',$this->user_type,true);
        $criteria->compare('status',$this->status);

        return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
    }

    public function getCreatetime() {
        return strtotime($this->create_at);
    }

    public function setCreatetime($value) {
        $this->create_at=date('Y-m-d H:i:s',$value);
    }

    public function getLastvisit() {
        return strtotime($this->lastvisit_at);
    }

    public function setLastvisit($value) {
        $this->lastvisit_at=date('Y-m-d H:i:s',$value);
    }
	public function getFullName() {
				return $this->username;
			}
	public function getSuggest($q) {
		$c = new CDbCriteria();
		$c->addSearchCondition('username', $q, true, 'OR');
		$c->addSearchCondition('email', $q, true, 'OR');
		return $this->findAll($c);
	}
	public function name($data,$row){
		$name = Profile::model()->findByAttributes(array('user_id'=>$data->id));
		return CHtml::link($name->lastname.' '.$name->firstname,array("admin/view","id"=>$data->id));
	}
	public function role($data,$row)
	{
		$roles=Rights::getAssignedRoles($data->id); // check for single role
		    if(count($roles)<1)
			{
				return 'No roles';
			}
		    else
			{
				foreach($roles as $role)
				{
				return $role->name;
			    }
	        }
		
		
	}
	
	public static  function app_url(){
		$command= Yii::app()->db->createCommand()->setFetchMode(PDO::FETCH_OBJ)
		->select('config_value')
		->from('institution_configurations')
		->where('id =:id ', array('id'=>8));
		 return  $command->queryRow()->config_value;
		
	}
	
	public static function student_img_url($id){
		 $app_url=self::app_url();	
		$student=Student::model()->findByPk($id);
		if($student!==null){
			return $app_url.'/uploadedfiles/student/'.$student->student_id.'/'.$student->img_file_name;
		}
	
	}
	
	public static function user_name(){
		$user_id=Yii::app()->user->id;
		$command= Yii::app()->db->createCommand()->setFetchMode(PDO::FETCH_OBJ)
		->select('name')
		->from('student')
		->where('user_id =:user_id ', array('user_id'=>$user_id));
		$row=$command->queryRow();
		if(count($row)>0)
		return $row->name;
	}
	
	public static function  ins_logo_url(){
		$app_url=self::app_url();	
		$command= Yii::app()->db->createCommand()->setFetchMode(PDO::FETCH_OBJ)
		->select('config_value')
		->from('institution_configurations')
		->where('id =:id ', array('id'=>7));
        $file_name=$command->queryRow()->config_value;
		
		return $app_url.'/uploadedfiles/institution_logo/'. $file_name;
	}
}
<?php

/**
 * This is the model class for table "parent".
 *
 * The followings are the available columns in table 'parent':
 * @property integer $parent_id
 * @property integer $uid
 * @property string $password
 * @property string $name
 * @property string $relation
 * @property string $email
 * @property string $office_phone
 * @property string $mobile_phone
 * @property string $office_address
 * @property string $city
 * @property integer $country_id
 * @property string $dob
 * @property string $occupation
 * @property string $income
 * @property string $education
 * @property string $created_at
 * @property string $updated_at
 *
 * The followings are the available model relations:
 * @property Student[] $students
 */
class Guardian extends CActiveRecord
{
	public $user_create;
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'parent';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('name,mobile_phone', 'required'),
			array('uid, country_id', 'numerical', 'integerOnly'=>true),
			array('password', 'length', 'max'=>100),
			array('name, relation, email, office_phone, mobile_phone, office_address, city, occupation, income, education', 'length', 'max'=>255),
			array('dob', 'type', 'type' => 'date', 'dateFormat' => 'yyyy-MM-dd'),
			array('dob, created_at, updated_at,user_create', 'safe'),
			array('email', 'email'),
			array('email', 'unique', 'message' => "Email allready in use."),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('parent_id, uid, password, name, relation, email, office_phone, mobile_phone, office_address, city, country_id, dob, occupation, income, education, created_at, updated_at', 'safe', 'on'=>'search'),
		);
	}

	
	public function beforeSave() {		
		if ($this->dob=='') {
			$this->dob =null;	
		}
		if ($this->isNewRecord) {
			$this->created_at = new CDbExpression('NOW()');
			$this->updated_at='0000-00-00 00:00:00';
		}
		else{
			$this->updated_at= new CDbExpression('NOW()');
		}
	
		return parent::beforeSave();
	}
	
	/**
	 * @return array relational rules.
	 */
	public function relations()
	{
		// NOTE: you may need to adjust the relation name and the related
		// class name for the relations automatically generated below.
		return array(
			'students' => array(self::HAS_MANY, 'Student', 'parent_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'parent_id' => 'Parent ID',
			'uid' => 'Uid',
			'password' => 'Password',
			'name' => 'Parent Name',
			'relation' => 'Relation',
			'email' => 'Email',
			'office_phone' => 'Office Phone',
			'mobile_phone' => 'Mobile Phone',
			'office_address' => 'Office Address',
			'city' => 'City',
			'country_id' => 'Country',
			'dob' => 'Dob',
			'occupation' => 'Occupation',
			'income' => 'Income',
			'education' => 'Education',
			'created_at' => 'Created At',
			'updated_at' => 'Updated At',
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

		$criteria->compare('parent_id',$this->parent_id);
		$criteria->compare('uid',$this->uid);
		$criteria->compare('password',$this->password,true);
		$criteria->compare('name',$this->name,true);
		$criteria->compare('relation',$this->relation,true);
		$criteria->compare('email',$this->email,true);
		$criteria->compare('office_phone',$this->office_phone,true);
		$criteria->compare('mobile_phone',$this->mobile_phone,true);
		$criteria->compare('office_address',$this->office_address,true);
		$criteria->compare('city',$this->city,true);
		$criteria->compare('country_id',$this->country_id);
		$criteria->compare('dob',$this->dob,true);
		$criteria->compare('occupation',$this->occupation,true);
		$criteria->compare('income',$this->income,true);
		$criteria->compare('education',$this->education,true);
		$criteria->compare('created_at',$this->created_at,true);
		$criteria->compare('updated_at',$this->updated_at,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return guardian the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}

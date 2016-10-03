<?php

/**
 * This is the model class for table "sms_settings".
 *
 * The followings are the available columns in table 'sms_settings':
 * @property integer $id
 * @property string $settings_key
 * @property integer $is_enabled
 */
class SmsSettings extends CActiveRecord
{

	/**
	 * Returns the static model of the specified AR class.
	 * @return SmsSettings the static model class
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
		return 'sms_settings';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('settings_key', 'required'),
			array('is_enabled', 'numerical', 'integerOnly'=>true),
			array('settings_key', 'length', 'max'=>255),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, settings_key, is_enabled', 'safe', 'on'=>'search'),
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
			'settings_key' => 'Settings Key',
			'is_enabled' => 'Is Enabled',
		);
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
		$criteria->compare('settings_key',$this->settings_key,true);
		$criteria->compare('is_enabled',$this->is_enabled);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
	
	
	public function defaultScope() {
		return array(
				'order' => 'id ASC'
		);
	}
	
	public function sendSms($to,$from,$message)
	{
		// Add SMS gateway settings here.
		
		/*require_once('/path/to/extensions/twilio/Services/Twilio.php');
 
		$sid = "{{ ACCOUNT SID }}"; // Your Account SID from www.twilio.com/user/account
		$token = "{{  AUTH TOKEN }}"; // Your Auth Token from www.twilio.com/user/account
		 
		$client = new Services_Twilio($sid, $token);
		$message = $client->account->sms_messages->create(
		  '+14158141829', // From a valid Twilio number
		  '+14159352345', // Text this number
		  "Hello world! This is admin, testing our twilio api"
		);*/
		
		
		
	
	}
}
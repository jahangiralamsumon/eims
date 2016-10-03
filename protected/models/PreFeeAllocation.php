<?php

/**
 * This is the model class for table "pre_fee_allocation".
 *
 * The followings are the available columns in table 'pre_fee_allocation':
 * @property integer $id
 * @property integer $fee_particular_id
 * @property string $is_all
 * @property integer $class_id
 * @property integer $student_id
 * @property string $month
 * @property string $year
 * @property string $created_at
 */
class PreFeeAllocation extends CActiveRecord
{
	public $is_valid;
	
	public function beforeSave() {
	   $this->created_at = new CDbExpression('NOW()');
		return parent::beforeSave();
	}
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'pre_fee_allocation';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('fee_particular_id,month, year', 'required'),
			array('student_id','required','on' => 'StudentFeeAllocation'),
			array('student_id', 'validstudent','on' => 'StudentFeeAllocation'),
			array('fee_particular_id, class_id,student_id', 'numerical', 'integerOnly'=>true),
			array('is_all', 'length', 'max'=>1),
			array('month', 'length', 'max'=>100),
			array('year', 'length', 'max'=>4),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, fee_particular_id, is_all, class_id,student_id,month, year, created_at', 'safe', 'on'=>'search'),
			array('is_valid','check_valid')	
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
			'fee_particular_id' => 'Fee Particular',
			'is_all' => 'Is All',
			'class_id' => 'Class',
			'student_id'=>'Student ID',	
			'month' => 'Month',
			'year' => 'Year',
			'created_at' => 'Created At',
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
		$criteria->compare('fee_particular_id',$this->fee_particular_id);
		$criteria->compare('is_all',$this->is_all,true);
		$criteria->compare('class_id',$this->class_id);
		$criteria->compare('month',$this->month,true);
		$criteria->compare('year',$this->year,true);
		$criteria->compare('created_at',$this->created_at,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return PreFeeAllocation the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
	
	public function validstudent($attribute, $params){
		$row=Student::current_students($class_id=null,$section_id=null,$group=null,$this->student_id);
		if(empty($row)){
			$this->addError($attribute, 'Student ID not found');
		}
	
	}
	public function check_valid($attribute){
		$month=$this->attributes['month'];
		$year=$this->attributes['year'];
		$is_all=$this->attributes['is_all'];
		$class_id=$this->attributes['class_id'];
		$fee_particular_id=$this->attributes['fee_particular_id'];
		
		$criteria = new CDbCriteria();
		$criteria->select = '*';
		$criteria->condition = '(class_id=:class_id OR class_id IS NULL) AND month=:month AND year=:year';
		$criteria->params = array(':class_id'=>$class_id,':month'=>$month, ':year'=>$year);
		$record =FeeAllocationTrace::model()->find($criteria);
		if($record!==null){
			$this->addError($attribute, 'Fees For This Month Already Generated.');
		}
		
		$criteria = new CDbCriteria();
		$criteria->select = 'id';
		$criteria->condition = '(month=:month AND year=:year AND  fee_particular_id=:particular_id AND is_all=:is_all) OR (month=:month AND year=:year AND  fee_particular_id=:particular_id AND class_id=:class_id)';
		$criteria->params = array(':month'=>$month, ':year'=>$year,':is_all'=>'1',':particular_id'=>$fee_particular_id,':class_id'=>$class_id);
		$record =self::model()->find($criteria);
		if($record!==null){
			$this->addError($attribute, 'This Particular Already Allocated For This Month.');
		}
	
	}
}

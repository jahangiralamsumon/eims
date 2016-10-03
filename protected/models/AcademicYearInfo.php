<?php

/**
 * This is the model class for table "academic_year_info".
 *
 * The followings are the available columns in table 'academic_year_info':
 * @property integer $year_code
 * @property string $name
 * @property string $value
 * @property string $start_date
 * @property string $end_date
 * @property string $description
 * @property integer $class_id
 * @property integer $status
 */
class AcademicYearInfo extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'academic_year_info';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('year_code, name,value,start_date, end_date, description, class_id, status', 'required'),
			array('year_code, class_id, status', 'numerical', 'integerOnly'=>true),
			array('name', 'length', 'max'=>300),
			array('description', 'length', 'max'=>200),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('year_code, name, start_date, end_date, description, class_id, status', 'safe', 'on'=>'search'),
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
			'year_code' => 'Year Code',
			'name' => 'Name',
			'value'=>'Year',	
			'start_date' => 'Start Date',
			'end_date' => 'End Date',
			'description' => 'Description',
			'class_id' => 'Class',
			'status' => 'Status',
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

		$criteria->compare('year_code',$this->year_code);
		$criteria->compare('name',$this->name,true);
		$criteria->compare('name',$this->value,true);
		$criteria->compare('start_date',$this->start_date,true);
		$criteria->compare('end_date',$this->end_date,true);
		$criteria->compare('description',$this->description,true);
		$criteria->compare('class_id',$this->class_id);
		$criteria->compare('status',$this->status);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return AcademicYearInfo the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
	
	public static function academic_year_list(){
		$items=array();
		$criteria=new CDbCriteria();
		$criteria->select='year_code,class_id';
		$criteria->condition='status=:status';
		$criteria->params=array(':status'=>1,);	
		$models=self::model()->findAll($criteria);
		foreach($models as $model)
			$items[$model->class_id]=$model->year_code;
		return $items;
	}
	
	public static function year_list(){
		$items=array();
		$criteria=new CDbCriteria();
		$criteria->select='distinct value';
		$criteria->order='value DESC';
		$models=self::model()->findAll($criteria);
		foreach($models as $model)
			$items[$model->value]=$model->value;
		return $items;
	}
	
}

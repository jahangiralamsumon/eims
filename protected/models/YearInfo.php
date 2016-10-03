<?php

/**
 * This is the model class for table "year_info".
 *
 * The followings are the available columns in table 'year_info':
 * @property integer $year_code
 * @property string $name
 * @property string $start_date
 * @property string $end_date
 * @property string $description
 * @property integer $status
 *
 * The followings are the available model relations:
 * @property Exam[] $exams
 * @property StudentClass[] $studentClasses
 */
class YearInfo extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'year_info';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('year_code,name,start_date, end_date, description, status', 'required'),
			array('year_code, status', 'numerical', 'integerOnly'=>true),
			array('name', 'length', 'max'=>300),
			array('description', 'length', 'max'=>200),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('year_code,name, start_date, end_date, description, status', 'safe', 'on'=>'search'),
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
			'exams' => array(self::HAS_MANY, 'Exam', 'year_id'),
			'studentClasses' => array(self::HAS_MANY, 'StudentClass', 'year_id'),
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
			'start_date' => 'Start Date',
			'end_date' => 'End Date',
			'description' => 'Description',
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
		$criteria->compare('start_date',$this->start_date,true);
		$criteria->compare('end_date',$this->end_date,true);
		$criteria->compare('description',$this->description,true);
		$criteria->compare('status',$this->status);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return YearInfo the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
	
	
	public static function current_year_code(){
		$criteria=new CDbCriteria();
		$criteria->select='year_code';
		$criteria->condition='status=:status';
		$criteria->params=array(':status'=>1,);
		return self::model()->find($criteria)->year_code;
	}
	
	
	
	public static function items()
	{
		$items=array();
		$models=self::model()->findAll();
		foreach($models as $model)
			$items[$model->year_code]=$model->name;
		return $items;
	}
	
	public static function item($id)
	{
		$model=self::model()->findbyPk($id);
		return isset($model->name)?$model->name:false;
	}
	
	public function defaultScope() {
		return array(
				'order' => 'start_date DESC'
		);
	}
}

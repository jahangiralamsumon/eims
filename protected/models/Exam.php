<?php

/**
 * This is the model class for table "exam".
 *
 * The followings are the available columns in table 'exam':
 * @property integer $exam_id
 * @property integer $result_published
 * @property integer $class_id
 * @property string $name
 * @property string $start_date
 * @property string $end_date
 * @property string $year
 *
 * The followings are the available model relations:
 * @property YearInfo $year
 */
class Exam extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'exam';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('name, start_date, end_date, year', 'required'),
			array('class_id,result_published', 'numerical', 'integerOnly'=>true),
			array('name', 'length', 'max'=>200),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('exam_id, name, start_date, end_date,class_id,result_published,year', 'safe', 'on'=>'search'),
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
			'exam_id' => 'Exam',
			'name' => 'Name',
			'start_date' => 'Start Date',
			'end_date' => 'End Date',
			'class_id' => 'Applicable Class',
			'year' => 'Year',
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

		$criteria->compare('exam_id',$this->exam_id);
		$criteria->compare('name',$this->name,true);
		$criteria->compare('start_date',$this->start_date,true);
		$criteria->compare('end_date',$this->end_date,true);
		$criteria->compare('class_id',$this->class_id);
		$criteria->compare('result_published',$this->result_published);
		$criteria->compare('year',$this->year);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Exam the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
	
	public static function year_exam_list($class_id=null){
		$command= Yii::app()->db->createCommand()
		->select('year_code')
		->from('year_info')
		->where('status=:status', array(':status'=>'1'))
		->queryRow();
			
		$year_id=$command['year_code'];
		
		$criteria=new CDbCriteria;
		$criteria->condition ='(class_id=:class_id OR class_id IS NULL) AND year_id=:year_id';
		$criteria->params=array(':class_id'=>$class_id,':year_id'=>$year_id);
		$records =self::model()->findAll($criteria);
		
		$arr=array();
		foreach ($records as $row){
			$arr[$row->exam_id]=$row->name;
		}
		return $arr;		
		
	}
	
	public static function exam_name($exam_id){
		$exam_obj=self::model()->findByPk($exam_id);
		return  $exam_obj->name;
	}
	
}

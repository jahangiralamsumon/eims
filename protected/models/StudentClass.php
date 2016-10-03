<?php

/**
 * This is the model class for table "student_class".
 *
 * The followings are the available columns in table 'student_class':
 * @property integer $id
 * @property integer $student_id
 * @property integer $shift_id
 * @property integer $class_id
 * @property integer $section_id
 * @property integer $year_id
 *
 * The followings are the available model relations:
 * @property Class $class
 * @property Section $section
 * @property Shift $shift
 * @property YearInfo $year
 */
class StudentClass extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'student_class';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('student_id,roll_no,class_id,shift_id,year_id,group', 'required'),
			array('student_id, shift_id, class_id, section_id,roll_no,year_id', 'numerical', 'integerOnly'=>true),
			array('group', 'length', 'max'=>100),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, student_id, shift_id, class_id, section_id,group,roll_no,year_id', 'safe', 'on'=>'search'),
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
			'class' => array(self::BELONGS_TO, 'Class', 'class_id'),
			'section' => array(self::BELONGS_TO, 'Section', 'section_id'),
			'shift' => array(self::BELONGS_TO, 'Shift', 'shift_id'),
			'year' => array(self::BELONGS_TO, 'YearInfo', 'year_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'student_id' => 'Student',
			'shift_id' => 'Shift',
			'class_id' => 'Class',
			'section_id' => 'Section',
			'group'=>'Group',	
			'roll_no'=>'Roll No',	
			'year_id' => 'Year',
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
		$criteria->compare('student_id',$this->student_id);
		$criteria->compare('shift_id',$this->shift_id);
		$criteria->compare('class_id',$this->class_id);
		$criteria->compare('section_id',$this->section_id);
		$criteria->compare('group',$this->group);
		$criteria->compare('roll_no',$this->roll_no);	
		$criteria->compare('year_id',$this->year_id);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return StudentClass the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
	
	public static function class_roll($student_id,$year_id=null){
		if($year_id==null){
			$year_id=YearInfo::current_year_code();
		}
		$student=self::model()->findByAttributes(array('student_id'=>$student_id,'year_id'=>$year_id));
		if($student!==null){
			return $student->roll_no;
		}
	}
	
	public static function find_student_class($student_id){
		$criteria=new CDbCriteria;
		$criteria->alias = 'sc';
		$criteria->join = 'JOIN academic_year_info ayi ON sc.year_id=ayi.year_code  AND ayi.status=1';
		$criteria->condition = 'student_id = :student_id ';
		$criteria->params = array(':student_id' =>$student_id);
		return  self::model()->find($criteria)->class_id;
	
		
	}
}

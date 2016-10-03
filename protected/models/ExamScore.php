<?php

/**
 * This is the model class for table "exam_score".
 *
 * The followings are the available columns in table 'exam_score':
 * @property integer $id
 * @property integer $exam_id
 * @property integer $subject_id
 * @property integer $class_id
 * @property integer $student_id
 * @property string $mark
 * @property integer $attendance
 * @property string $remark
 */
class ExamScore extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'exam_score';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('exam_id,class_id, subject_id,student_id', 'required'),
			array('id, exam_id, subject_id, class_id, student_id, attendance', 'numerical', 'integerOnly'=>true),
			array('written, mcq, practical', 'numerical'),
			array('mark', 'length', 'max'=>7),
			array('remark', 'length', 'max'=>200),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, exam_id, subject_id, class_id, student_id, mark, attendance, remark', 'safe', 'on'=>'search'),
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
			'exam_id' => 'Exam',
			'subject_id' => 'Subject',
			'class_id' => 'Class',
			'student_id' => 'Student',
			'mark' => 'Mark',
			'attendance' => 'Attendance',
			'remark' => 'Remark',
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
		$criteria->compare('exam_id',$this->exam_id);
		$criteria->compare('subject_id',$this->subject_id);
		$criteria->compare('class_id',$this->class_id);
		$criteria->compare('student_id',$this->student_id);
		$criteria->compare('mark',$this->mark,true);
		$criteria->compare('attendance',$this->attendance);
		$criteria->compare('remark',$this->remark,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return ExamScore the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}

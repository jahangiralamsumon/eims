<?php

/**
 * This is the model class for table "grade".
 *
 * The followings are the available columns in table 'grade':
 * @property integer $grade_id
 * @property string $name
 * @property string $grade_point
 * @property integer $mark_from
 * @property integer $mark_upto
 * @property string $comment
 */
class Grade extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'grade';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('name, grade_point, mark_from, mark_upto, comment', 'required'),
			array('mark_from, mark_upto', 'numerical', 'integerOnly'=>true),
			array('name', 'length', 'max'=>100),
			array('grade_point', 'length', 'max'=>5),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('grade_id, name, grade_point, mark_from, mark_upto, comment', 'safe', 'on'=>'search'),
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
			'grade_id' => 'Grade',
			'name' => 'Name',
			'grade_point' => 'Grade Point',
			'mark_from' => 'Mark From',
			'mark_upto' => 'Mark Upto',
			'comment' => 'Comment',
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

		$criteria->compare('grade_id',$this->grade_id);
		$criteria->compare('name',$this->name,true);
		$criteria->compare('grade_point',$this->grade_point,true);
		$criteria->compare('mark_from',$this->mark_from);
		$criteria->compare('mark_upto',$this->mark_upto);
		$criteria->compare('comment',$this->comment,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Grade the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
	
	public  static  function get_grade($written,$mcq,$practical,$mark,$subject_id) {
		$sub_details=Subjects::model()->findByPk($subject_id);
		if($sub_details->written>0 && $sub_details->written>(($written*3)+1)){
			return 'F';
		}
		else if ($sub_details->mcq>0 && $sub_details->mcq>(($mcq*3)+1)){
			return 'F';
		}
		
		else if ($sub_details->practical>0 && $sub_details->practical>(($practical*3)+1)){
			return 'F';
		}
		
		else{
			
			$command= Yii::app()->db->createCommand()->setFetchMode(PDO::FETCH_OBJ)
			->select('*')
			->from('grade')
			//->where(':mark BETWEEN mark_from AND mark_upto ',array(':mark'=>$mark))
			->where('mark_from<=:mark AND mark_upto>=:mark', array(':mark'=>$mark));
			return  isset($command->queryRow()->name)?$command->queryRow()->name:'F';
			
		}
		
	}
	
	public  static  function get_grade_point($written,$mcq,$practical,$mark,$subject_id) {
		$sub_details=Subjects::model()->findByPk($subject_id);
		if($sub_details->written>0 && $sub_details->written>(($written*3)+1)){
			return 0;
		}
		else if ($sub_details->mcq>0 && $sub_details->mcq>(($mcq*3)+1)){
			return 0;
		}
	
		else if ($sub_details->practical>0 && $sub_details->practical>(($practical*3)+1)){
			return 0;
		}
	
		else{
				
			$command= Yii::app()->db->createCommand()->setFetchMode(PDO::FETCH_OBJ)
			->select('*')
			->from('grade')
			//->where(':mark BETWEEN mark_from AND mark_upto ',array(':mark'=>$mark))
			->where('mark_from<=:mark AND mark_upto>=:mark', array(':mark'=>$mark));
			return  isset($command->queryRow()->grade_point)?$command->queryRow()->grade_point:0;
				
		}
	
	}
}

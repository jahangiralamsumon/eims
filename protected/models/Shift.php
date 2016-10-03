<?php

/**
 * This is the model class for table "shift".
 *
 * The followings are the available columns in table 'shift':
 * @property integer $shift_id
 * @property string $shift_code
 * @property string $shift_name
 *
 * The followings are the available model relations:
 * @property StudentClass[] $studentClasses
 */
class Shift extends CActiveRecord
{
	
	public function beforeSave() {
		if ($this->isNewRecord) {
			$criteria=new CDbCriteria;
			$criteria->select='max(shift_id) AS shift_id';
			$row =self::model()->find($criteria);
			$max =isset($row->shift_id)?$row->shift_id:0;
			$this->shift_id=$max+1;
		}
	
		return parent::beforeSave();
	}
	
	
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'shift';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('shift_code,shift_name', 'required'),
			array('shift_id', 'numerical', 'integerOnly'=>true),
			array('shift_code, shift_name', 'length', 'max'=>200),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('shift_id, shift_code, shift_name', 'safe', 'on'=>'search'),
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
			'studentClasses' => array(self::HAS_MANY, 'StudentClass', 'shift_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'shift_id' => 'Shift ID',
			'shift_code' => 'Shift Code',
			'shift_name' => 'Shift Name',
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

		$criteria->compare('shift_id',$this->shift_id);
		$criteria->compare('shift_code',$this->shift_code,true);
		$criteria->compare('shift_name',$this->shift_name,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Shift the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}

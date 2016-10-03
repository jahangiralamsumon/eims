<?php

/**
 * This is the model class for table "acc_opening".
 *
 * The followings are the available columns in table 'acc_opening':
 * @property integer $acc_opening_id
 * @property integer $acc_code
 * @property string $dr_amount
 * @property string $cr_amount
 * @property integer $year_code
 */
class AccOpening extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'acc_opening';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('acc_code,year_code', 'required'),
			array('acc_code, year_code', 'numerical', 'integerOnly'=>true),
			array('dr_amount, cr_amount', 'length', 'max'=>18),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('acc_opening_id, acc_code, dr_amount, cr_amount, year_code', 'safe', 'on'=>'search'),
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
			'acc_opening_id' => 'Acc Opening',
			'acc_code' => 'Acc Code',
			'dr_amount' => 'Dr Amount',
			'cr_amount' => 'Cr Amount',
			'year_code' => 'Year Code',
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

		$criteria->compare('acc_opening_id',$this->acc_opening_id);
		$criteria->compare('acc_code',$this->acc_code);
		$criteria->compare('dr_amount',$this->dr_amount,true);
		$criteria->compare('cr_amount',$this->cr_amount,true);
		$criteria->compare('year_code',$this->year_code);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return AccOpening the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}

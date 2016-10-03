<?php

/**
 * This is the model class for table "emp_designation".
 *
 * The followings are the available columns in table 'emp_designation':
 * @property integer $designation_id
 * @property string $designation_name
 * @property integer $designation_order
 */
class EmpDesignation extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'emp_designation';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('designation_name, designation_order', 'required'),
			array('designation_order', 'numerical', 'integerOnly'=>true),
			array('designation_name', 'length', 'max'=>100),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('designation_id, designation_name, designation_order', 'safe', 'on'=>'search'),
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
			'designation_id' => 'Designation',
			'designation_name' => 'Designation Name',
			'designation_order' => 'Designation Order',
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

		$criteria->compare('designation_id',$this->designation_id);
		$criteria->compare('designation_name',$this->designation_name,true);
		$criteria->compare('designation_order',$this->designation_order);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return EmpDesignation the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
	
	public static function items()
	{
		$items=array();
		$models=self::model()->findAll(array('order' => 'designation_order'));
		foreach($models as $model)
			$items[$model->designation_id]=$model->designation_name;
		return $items;
	}
	
	
	public static function item($id)
	{
		$model=self::model()->findbyPk($id);
		return isset($model->designation_id)?$model->designation_name:false;
	}
}

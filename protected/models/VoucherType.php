<?php

/**
 * This is the model class for table "voucher_type".
 *
 * The followings are the available columns in table 'voucher_type':
 * @property integer $voucher_type
 * @property string $name
 * @property string $prefix
 */
class VoucherType extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'voucher_type';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('voucher_type, name, prefix', 'required'),
			array('voucher_type', 'numerical', 'integerOnly'=>true),
			array('name', 'length', 'max'=>200),
			array('prefix', 'length', 'max'=>5),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('voucher_type, name, prefix', 'safe', 'on'=>'search'),
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
			'voucher_type' => 'Voucher Type',
			'name' => 'Name',
			'prefix' => 'Prefix',
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

		$criteria->compare('voucher_type',$this->voucher_type);
		$criteria->compare('name',$this->name,true);
		$criteria->compare('prefix',$this->prefix,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return VoucherType the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
	
	public static function all_type(){
		$items=array();
		$records=Yii::app()->db->createCommand()->setFetchMode(PDO::FETCH_OBJ)
		->select('voucher_type,name')
		->from('voucher_type')
		->order('voucher_type asc')
		->queryAll();
		foreach ($records as $obj){
			$items[$obj->voucher_type]=$obj->name;
		}
		return $items;
	}
}

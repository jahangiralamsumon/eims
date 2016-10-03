<?php

/**
 * This is the model class for table "fee_categories".
 *
 * The followings are the available columns in table 'fee_categories':
 * @property integer $id
 * @property string $name
 * @property string $description
 * @property integer $group_id
 * @property integer $acc_head_id
 * @property string $created_at
 * @property string $updated_at
 */
class FeeCategories extends CActiveRecord
{
	
	public function beforeSave() {
			
		if ($this->isNewRecord) {
			$this->created_at = new CDbExpression('NOW()');
		}
		else{
			$this->updated_at= new CDbExpression('NOW()');
		}
	
		return parent::beforeSave();
	}
	
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'fee_categories';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('name,group_id', 'required'),
			array('name', 'length', 'max'=>255),
			array('description, created_at, updated_at', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, name, description,group_id,created_at, updated_at', 'safe', 'on'=>'search'),
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
			'name' => 'Name',
			'description' => 'Description',
			'group_id'=>'Group',
			'acc_head_id' => 'Acc Head',
			'created_at' => 'Created At',
			'updated_at' => 'Updated At',
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
		$criteria->compare('name',$this->name,true);
		$criteria->compare('description',$this->description,true);
		$criteria->compare('group_id',$this->group_id);
		$criteria->compare('acc_head_id',$this->acc_head_id);
		$criteria->compare('created_at',$this->created_at,true);
		$criteria->compare('updated_at',$this->updated_at,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return FeeCategories the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
	
	
	
	public static function Categories_array(){
		$group_arr=self::Categories_group();
		$items=array();
		$records=Yii::app()->db->createCommand()->setFetchMode(PDO::FETCH_OBJ)
		->select('id,name,group_id')
		->from('fee_categories')
		->order('group_id ASC')
		->queryAll();
		foreach ($records as $obj){
			$items[]=array('id'=>$obj->id,'name'=> $obj->name,'group'=>$group_arr[$obj->group_id]);
		}
		return $items;
	}
	
	public static function Categories_group(){
		$items=array();
		$records=Yii::app()->db->createCommand()->setFetchMode(PDO::FETCH_OBJ)
		->select('acc_id,name')
		->where('acc_id IN(:acc_id1,:acc_id2)', array(':acc_id1'=>'11',':acc_id2'=>'12'))
		->from('acc_head')
		->queryAll();
		foreach ($records as $obj){
			$items[$obj->acc_id]=$obj->name;
		}
		return $items;
	}
}

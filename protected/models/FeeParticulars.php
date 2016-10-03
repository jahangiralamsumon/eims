<?php

/**
 * This is the model class for table "fee_particulars".
 *
 * The followings are the available columns in table 'fee_particulars':
 * @property integer $id
 * @property string $name
 * @property string $description
 * @property string $amount
 * @property integer $fee_category_id
 * @property string $is_monthly
 * @property string $is_all
 * @property integer $class_id
 * @property string $created_at
 * @property string $updated_at
 */
class FeeParticulars extends CActiveRecord
{
	
	private static $_items=array();
	
	public function beforeSave() {
			
		if ($this->isNewRecord) {
			$this->created_at = new CDbExpression('NOW()');
		}
		else{
			$this->updated_at= new CDbExpression('NOW()');
		}
	
		return parent::beforeSave();
	}
	
	public static function items()
	{
		$models=self::model()->findAll();
		foreach($models as $model)
			self::$_items[$model->id]=$model->name;
		return self::$_items;
	}
	
	
	public static function prt_name($id)
	{
		$model=self::model()->findbyPk($id);
		return isset($model->name)?$model->name:false;
	}
	
	public static function amount($id)
	{
		$model=self::model()->findbyPk($id);
		return isset($model->amount)?$model->amount:false;
	}
	
	public  static function prt_acc_head($id){
		
		$command= Yii::app()->db->createCommand()->setFetchMode(PDO::FETCH_OBJ)
		->select('fc.acc_head_id')
		->from('fee_particulars fp')
		->join('fee_categories fc','fp.fee_category_id=fc.id')
		->where('fp.id=:id', array('id'=>$id))
		->queryRow();		
		return  $command->acc_head_id;
	}
	
	public  static function prt_arr(){
		$prt_arr=array();
		$command= Yii::app()->db->createCommand()->setFetchMode(PDO::FETCH_OBJ)
		->select('fp.id,fp.amount,fp.name,fc.acc_head_id')
		->from('fee_particulars fp')
		->join('fee_categories fc','fp.fee_category_id=fc.id');
		$prt_acc_head=$command->queryAll();
		foreach ($prt_acc_head as $row){
			$prt_arr[$row->id]['acc_head_id']=$row->acc_head_id;
			$prt_arr[$row->id]['amount']=$row->amount;
			$prt_arr[$row->id]['name']=$row->name;
		}
		return  $prt_arr;
	}
	
	
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'fee_particulars';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('name,amount,fee_category_id,', 'required'),
			array('fee_category_id, class_id', 'numerical', 'integerOnly'=>true),
			array('name', 'length', 'max'=>255),
			array('amount','length', 'max'=>15),
			array('amount', 'numerical','min'=>1),
			array('is_monthly, is_all', 'length', 'max'=>1),
			array('description, created_at, updated_at', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, name, description, amount, fee_category_id,is_monthly, is_all,class_id, created_at, updated_at', 'safe', 'on'=>'search'),
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
			'amount' => 'Amount',
			'fee_category_id' =>'Fee Category',
			'is_monthly' =>'Is Monthly',
			'is_all' => 'Is for All',
			'class_id' => 'Applicable Class',
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
		$criteria->compare('amount',$this->amount,true);
		$criteria->compare('fee_category_id',$this->fee_category_id);
		$criteria->compare('is_monthly',$this->is_monthly,true);
		$criteria->compare('is_all',$this->is_all,true);
		$criteria->compare('class_id',$this->class_id);
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
	 * @return FeeParticulars the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}

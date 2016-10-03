<?php

/**
 * This is the model class for table "acc_head".
 *
 * The followings are the available columns in table 'acc_head':
 * @property integer $acc_id
 * @property integer $acc_code
 * @property integer $parent
 * @property integer $top_parent
 * @property string $name
 * @property string $category
 * @property integer $depth
 * @property string $open_date
 * @property string $lr
 * @property string $address
 * @property integer $acc_order
 */
class AccHead extends CActiveRecord
{

	public function beforeSave() {
		if ($this->isNewRecord) {
			$criteria=new CDbCriteria;
			$criteria->select='max(acc_id) AS acc_id';
			$row =self::model()->find($criteria);
			$max =isset($row->acc_id)?$row->acc_id:0;
			//$max=75;
			$this->acc_id=$max+1;
			$this->acc_code=$this->acc_id;
			$this->open_date =date("Y-m-d");
		}

		return parent::beforeSave();
	}
	
	public function afterSave() {
		parent::afterSave();
	
		if ($this->isNewRecord){
			$year_id=YearInfo::current_year_code();
			$acc_opening = new AccOpening();
			$acc_opening->acc_code =$this->acc_id;
			$acc_opening->dr_amount =0;
			$acc_opening->cr_amount =0;
			$acc_opening->year_code = $year_id;
			$acc_opening->save();
		}
	}

	/**
	 * @return string the associated database table name
	 */
	public static function ledger_account(){
		$items=array();
		$records=Yii::app()->db->createCommand()->setFetchMode(PDO::FETCH_OBJ)
		->select('acc_id,name')
		->where('lr=:lr AND parent!=:parent', array(':lr'=>'L',':parent'=>'13'))
		->from('acc_head')
		->order('depth asc')
		->queryAll();
		foreach ($records as $obj){
			$items[$obj->acc_id]=$obj->name;
		}
		return $items;
	}
	public static function payment_v_cr_account(){
		$items=array();
		$records=Yii::app()->db->createCommand()->setFetchMode(PDO::FETCH_OBJ)
		->select('acc_id,name')
		->where('acc_id=:acc_id1 or acc_id=:acc_id2', array(':acc_id1'=>1,':acc_id2'=>2))
		->from('acc_head')
		->queryAll();
		foreach ($records as $obj){
			$items[$obj->acc_id]=$obj->name;
		}
		return $items;
	}

	public static function mer_acc_accounts(){
		$items=array();
		$records=Yii::app()->db->createCommand()->setFetchMode(PDO::FETCH_OBJ)
		->select('acc_id,name')
		->where('parent=:parent', array(':parent'=>'4'))
		->from('acc_head')
		->queryAll();
		foreach ($records as $obj){
			$items[$obj->acc_id]=$obj->name;
		}
		return $items;
	}

	public static function acc_head_name($id){
		$row=Yii::app()->db->createCommand()->setFetchMode(PDO::FETCH_OBJ)
		->select('name')
		->where('acc_id=:acc_id', array(':acc_id'=>$id))
		->from('acc_head')
		->queryRow();
		return isset($row->name)?$row->name:'';
	}

	public static function mer_acc_id($id){
		$row=Yii::app()->db->createCommand()->setFetchMode(PDO::FETCH_OBJ)
		->select('acc_id')
		->where('merchant_id=:merchant_id', array(':merchant_id'=>$id))
		->from('acc_head')
		->queryRow();
		return $row->acc_id;
	}

	public function tableName()
	{
		return 'acc_head';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
				array('name,category,lr,depth', 'required'),
				array('acc_id, acc_code, parent, top_parent, depth, acc_order', 'numerical', 'integerOnly'=>true),
				array('name', 'length', 'max'=>200),
				array('category, lr', 'length', 'max'=>100),
				// The following rule is used by search().
				// @todo Please remove those attributes that should not be searched.
				array('acc_id, acc_code, parent, top_parent, name, category, depth, open_date, lr,merchant_id, acc_order', 'safe', 'on'=>'search'),
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
				'acc_id' => 'Acc',
				'acc_code' => 'Acc Code',
				'parent' => 'Parent',
				'top_parent' => 'Top Parent',
				'name' => 'Name',
				'category' => 'Category',
				'depth' => 'Depth',
				'open_date' => 'Open Date',
				'lr' => 'Lr',
				'merchant_id' => 'Merchant ID',
				'acc_order' => 'Acc Order',
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

		$criteria->compare('acc_id',$this->acc_id);
		$criteria->compare('acc_code',$this->acc_code);
		$criteria->compare('parent',$this->parent);
		$criteria->compare('top_parent',$this->top_parent);
		$criteria->compare('name',$this->name,true);
		$criteria->compare('category',$this->category,true);
		$criteria->compare('depth',$this->depth);
		$criteria->compare('open_date',$this->open_date,true);
		$criteria->compare('lr',$this->lr,true);
		$criteria->compare('merchant_id',$this->merchant_id,true);
		$criteria->compare('acc_order',$this->acc_order);

		return new CActiveDataProvider($this, array(
				'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return AccHead the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
	
	public static function manage_acc_head(){
		$data=array();

		$command= Yii::app()->db->createCommand()
		->select('max(depth) depth')
		->from('acc_head')
		->queryRow();
	
		$depth=$command['depth'];
		$key=0;
		while($depth>=0){
			$command=Yii::app()->db->createCommand()->setFetchMode(PDO::FETCH_OBJ)
			->select('*')
			->from('acc_head ah')
			->where('ah.depth=:depth AND ah.status=:status', array(':depth'=>$depth,':status'=>1))
			->order('acc_order ASC');
			$result=$command->queryAll();
			foreach ($result as $row){
				$data[$key]=array('acc_id'=>$row->acc_id,'name'=>$row->name,'parent'=>$row->parent,'top_parent'=>$row->top_parent,'category'=>$row->category,'depth'=>$depth,'lr'=>$row->lr);
				$key++;
	
			}
			$depth=$depth-1;
		
		}
	
		return $data;
	}
	
	public static function manage_acc_head_withoutstudenthead(){
		$data=array();
	
		$command= Yii::app()->db->createCommand()
		->select('max(depth) depth')
		->from('acc_head')
		->queryRow();
	
		$depth=$command['depth'];
		$key=0;
		while($depth>=0){
			$command=Yii::app()->db->createCommand()->setFetchMode(PDO::FETCH_OBJ)
			->select('*')
			->from('acc_head ah')
			->where('ah.depth=:depth AND ah.status=:status AND ah.acc_id!=:acc_id AND ah.parent!=:parent', array(':depth'=>$depth,':status'=>1,':acc_id'=>'13',':parent'=>'13'))
			->order('acc_order ASC');
			$result=$command->queryAll();
			foreach ($result as $row){
				$data[$key]=array('acc_id'=>$row->acc_id,'name'=>$row->name,'parent'=>$row->parent,'top_parent'=>$row->top_parent,'category'=>$row->category,'depth'=>$depth,'lr'=>$row->lr);
				$key++;
	
			}
			$depth=$depth-1;
	
		}
	
		return $data;
	}
}

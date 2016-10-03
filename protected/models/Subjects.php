<?php

/**
 * This is the model class for table "subjects".
 *
 * The followings are the available columns in table 'subjects':
 * @property integer $id
 * @property string $name
 * @property string $code
 * @property interger $parent_sub_id;
 * @property integer $class_id
 * @property string $group_name
 * @property string $written
 * @property string $mcq
 * @property string $practical
 * @property integer $is_elective
 * @property string $created_at
 * @property string $updated_at
 */
class Subjects extends CActiveRecord
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
		return 'subjects';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('name,class_id,written', 'required'),
			array('written','compare','compareValue'=>'0','operator'=>'>','message'=>'Written must be greater than 0'),
			array('class_id,parent_sub_id,is_elective,written,mcq,practical', 'numerical', 'integerOnly'=>true),
			array('name, code', 'length', 'max'=>255),
			array('created_at, updated_at,group_name', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, name, code,parent_sub_id,class_id,group_name,is_elective,written,mcq,practical,created_at, updated_at', 'safe', 'on'=>'search'),
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
			'code' => 'Code',
			'parent_sub_id'=>'Parent Subject',	
			'class_id' => 'Class',
			'group_name'=>'Group',
			'is_elective' => 'Is Elective',
			'mcq'=>'MCQ',	
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
		$criteria->compare('code',$this->code,true);
		$criteria->compare('parent_sub_id',$this->parent_sub_id);
		$criteria->compare('class_id',$this->class_id);
		$criteria->compare('is_elective',$this->is_elective);
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
	 * @return Subjects the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
	
	public static function class_sub_list($class_id,$group_name){
	
		$criteria = new CDbCriteria();
		$criteria->select = '*';
		$criteria->condition = 'class_id=:class_id AND group_name=:group_name';
		$criteria->params = array(':class_id'=>$class_id,':group_name'=>'');
		$records =self::model()->findAll($criteria);
	
		$arr=array();
		foreach ($records as $row){
			$arr[$row->id]=$row->name;
		}
		
		$criteria = new CDbCriteria();
		$criteria->select = '*';
		$criteria->condition = 'class_id=:class_id AND group_name=:group_name';
		$criteria->params = array(':class_id'=>$class_id,':group_name'=>$group_name);
		$records =self::model()->findAll($criteria);
		$arr2=array();
		foreach ($records as $row){
			$arr2[$row->id]=$row->name;
		}
		
		return ($arr+$arr2);
	
	}
	
	public static function  sub_list($class_id,$group_name,$sub_type=NULL){
		
		if($sub_type==NULL){ // $sub_type=null  return c
		$criteria = new CDbCriteria();
		$criteria->select = '*';
		$criteria->condition = 'class_id=:class_id AND group_name=:group_name';
		$criteria->params = array(':class_id'=>$class_id,':group_name'=>'');
		$records =self::model()->findAll($criteria);
		}
		
		if($sub_type==1){
			$criteria = new CDbCriteria();
			$criteria->select = '*';
			$criteria->condition = 'class_id=:class_id AND group_name=:group_name AND group_name!=:group_name1';
			$criteria->params = array(':class_id'=>$class_id,':group_name'=>$group_name,':group_name1'=>'');
			$records =self::model()->findAll($criteria);
		}
		
		if($sub_type==2){
			$criteria = new CDbCriteria();
			$criteria->select = '*';
			$criteria->condition = 'class_id=:class_id AND group_name=:group_name AND is_elective=:is_elective';
			$criteria->params = array(':class_id'=>$class_id,':group_name'=>$group_name,':is_elective'=>1);
			$records =self::model()->findAll($criteria);
		}
		
		
		$arr=array();
		foreach ($records as $row){
			$arr[$row->id]=$row->name;
		}
		
		return $arr;
		
	}
	
	public static function  sub_code($sub_id){
		$model=Subjects::model()->findByPk($sub_id);
		if($model!==null){
			return $model->code;
		}
		
	}
	
	public function defaultScope() {
		return array(
				'order' => 'code ASC'
		);
	}
}

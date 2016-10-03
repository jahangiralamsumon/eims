<?php

/**
 * This is the model class for table "class".
 *
 * The followings are the available columns in table 'class':
 * @property integer $class_id
 * @property string $class_name
 * @property integer $child_id
 *
 * The followings are the available model relations:
 * @property Section[] $sections
 * @property StudentClass[] $studentClasses
 */
class Classes extends CActiveRecord
{
	
	private static $_items=array();
	
	public static function items()
	{
		$models=self::model()->findAll();
		foreach($models as $model)
			self::$_items[$model->class_id]=$model->class_name;
		return self::$_items;
	}
	
	
	public static function item($id)
	{
		$model=self::model()->findbyPk($id);
		return isset($model->class_name)?$model->class_name:false;
	}
	
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'class';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('class_id,class_name', 'required'),
			array('class_id,child_id', 'numerical', 'integerOnly'=>true),
			array('class_name', 'length', 'max'=>200),
			array('class_name', 'unique'),
			array('child_id', 'unique'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('class_id, class_name', 'safe', 'on'=>'search'),
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
			'sections' => array(self::HAS_MANY, 'Section', 'class_id'),
			'studentClasses' => array(self::HAS_MANY, 'StudentClass', 'class_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'class_id' => 'Class',
			'class_name' => 'Class Name',
			'child_id'	=>'Child Class'
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

		$criteria->compare('class_id',$this->class_id);
		$criteria->compare('class_name',$this->class_name,true);
		$criteria->compare('child_id',$this->class_id);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Classes the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
	
	
	public function scopes() {
		return array(
				'byname' => array('order' => 'class_name ASC'),
				'byid'=> array('order' => 'class_id ASC'),
		);
	}
	
	public  static function group_option(){
		return  array(
				'HSC'=>array('science'=>'Science',
						'business'=>'Business Studies',
						'humanities'=>'Humanities'),
				'Pass'=>array(
						'bss'=>'BSS',
				),
		
		);
	}
}

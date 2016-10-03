<?php

/**
 * This is the model class for table "section".
 *
 * The followings are the available columns in table 'section':
 * @property integer $section_id
 * @property string $section_name
 * @property integer $class_id
 *
 * The followings are the available model relations:
 * @property Class $class
 * @property StudentClass[] $studentClasses
 */
class Section extends CActiveRecord
{
	
	public function beforeSave() {
		if ($this->isNewRecord) {
			$criteria=new CDbCriteria;
			$criteria->select='max(section_id) AS section_id';
			$row =self::model()->find($criteria);
			$max =isset($row->section_id)?$row->section_id:0;
			$this->section_id=$max+1;
		}
	
		return parent::beforeSave();
	}
	
	private static $_items=array();
	
	public static function items()
	{
		$models=self::model()->findAll();
		foreach($models as $model)
			self::$_items[$model->section_id]=$model->section_name;
		return self::$_items;
	}
	
	
	public static function item($id)
	{
		$model=self::model()->findbyPk($id);
		return isset($model->section_name)?$model->section_name:false;
	}
	
	
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'section';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('section_name,class_id', 'required'),
			array('section_id, class_id', 'numerical', 'integerOnly'=>true),
			array('section_name', 'length', 'max'=>200),
			array('section_name','uniqueSectionName','on'=>'insert'),
			array('section_name','uniqueSectionNameUpdate','on'=>'update'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('section_id, section_name, class_id', 'safe', 'on'=>'search'),
		);
	}

	public function uniqueSectionName($attribute, $params)
	{
	
		$class_name=Classes::item($this->class_id);
		if(Section::model()->exists('section_name=:section_name AND class_id=:class_id',array(':section_name'=>$this->section_name,':class_id'=>$this->class_id)))
		{
			$this->addError($attribute, $this->section_name.' Section already exists for  class '.$class_name);
		}
	}
	
	public function uniqueSectionNameUpdate($attribute, $params)
	{
	
		$class_name=Classes::item($this->class_id);
		if(Section::model()->exists('section_name=:section_name AND class_id=:class_id AND section_id!=:section_id ',array(':section_name'=>$this->section_name,':class_id'=>$this->class_id,':section_id'=>$this->section_id)))
		{
			$this->addError($attribute, $this->section_name.' Section already exists for  class '.$class_name);
		}
	}
	/**
	 * @return array relational rules.
	 */
	public function relations()
	{
		// NOTE: you may need to adjust the relation name and the related
		// class name for the relations automatically generated below.
		return array(
			'class' => array(self::BELONGS_TO, 'Class', 'class_id'),
			'studentClasses' => array(self::HAS_MANY, 'StudentClass', 'section_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'section_id' => 'Section ID',
			'section_name' => 'Section Name',
			'class_id' => 'Class Name',
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

		$criteria->compare('section_id',$this->section_id);
		$criteria->compare('section_name',$this->section_name,true);
		$criteria->compare('class_id',$this->class_id);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
			'sort'=>array(
						'defaultOrder'=>'class_id,section_name ASC',
			),
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Section the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}

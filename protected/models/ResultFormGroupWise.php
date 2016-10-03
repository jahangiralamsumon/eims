<?php
class ResultFormGroupWise extends  CFormModel{

	public $year;
	public $class_id;
	public $exam_id;
	public $group;
	public $exam_status;


	public function rules()
	{
		return array(
				array('year,class_id,exam_id,group', 'required'),
				array('exam_status','result_is_published'),
				array('exam_status','input_data_vaildate'),

		);
	}


	public function attributeLabels()
	{
		return array(
				'year'=>'Year',
				'class_id'=>'Class',
				'exam_id'=>'Exam',
				'group'=>'Group',
		);
	}


	public function result_is_published($attribute, $params){
		$criteria=new CDbCriteria;
		$criteria->condition = 'exam_id=:exam_id AND result_published=:result_published';
		$criteria->params = array(':exam_id'=>$this->exam_id,':result_published'=>1);
		if (!Exam::model()->exists($criteria)) {
			$this->addError($attribute, 'Exam result yet not published');
		}

	}

	public function input_data_vaildate($attribute, $params){
		$criteria=new CDbCriteria;
		$criteria->condition ='(class_id=:class_id OR class_id IS NULL) AND year=:year';
		$criteria->params=array(':class_id'=>$this->class_id,':year'=>$this->year);
		//$criteria->addSearchCondition('class_id IS NULL');
		$model=Exam::model()->findAll($criteria);
		if ($model===null){
			$this->addError($attribute, 'Input data invalid');
		}

	}




}
?>
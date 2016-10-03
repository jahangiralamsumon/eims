<?php
class ResultViewForm extends  CFormModel{
	
	public $year;
	public $class_id;
	public $exam_id;
	public $student_id;
	public $exam_status;

	
	public function rules()
	{
		return array(
				array('year,class_id,exam_id,student_id', 'required'),
				array('student_id', 'validstudent'),
				array('exam_status','result_is_published'),
				array('exam_status','input_data_vaildate'),			
				array('exam_status','exam_data')
	
		);
	}
	
	
	public function attributeLabels()
	{
		return array(
				'year'=>'Year',
				'class_id'=>'Class',
				'exam_id'=>'Exam',
				'student_id'=>'Student ID',
		);
	}
	
	public function validstudent($attribute, $params){
				
		$criteria=new CDbCriteria;
		$criteria->condition = 'student_id=:student_id AND class_id=:class_id AND year_id=(SELECT year_code FROM academic_year_info WHERE class_id = :class_id AND value= :year)';
		$criteria->params = array(':student_id'=>$this->student_id, ':class_id'=>$this->class_id,':year'=>$this->year);
		if (!StudentClass::model()->exists($criteria)) {
			$this->addError($attribute, 'Student ID not found');
		}
		
	}
	
	public function result_is_published($attribute, $params){
		$criteria=new CDbCriteria;
		$criteria->condition = 'result_published=:result_published';
		$criteria->params = array(':result_published'=>1);
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
	
	public function exam_data($attribute, $params){	
		
		
		$command= Yii::app()->db->createCommand()->setFetchMode(PDO::FETCH_OBJ)
		->select("s.student_id student_id")
		->from('student s')
		->join('students_subjects ss', 'ss.student_id=s.student_id')
		->join('academic_year_info ayi', 'ss.year_id=ayi.year_code AND ayi.year_code=(SELECT year_code FROM academic_year_info WHERE class_id = :class_id AND value= :year)',array(':class_id' =>$this->class_id,':year'=>$this->year))
		->join('subjects sub','sub.id=ss.subject_id AND sub.class_id=:class_id',array(':class_id'=>$this->class_id))
		->leftJoin('exam_score es', 'es.subject_id=ss.subject_id AND es.student_id=:student_id AND es.exam_id=:exam_id',array(':student_id'=>$this->student_id,':exam_id'=>$this->exam_id))
		->join('exam','exam.exam_id=es.exam_id AND (exam.class_id=:class_id OR exam.class_id IS NULL) AND exam.year=:year',array(':class_id'=>$this->class_id,':year'=>$this->year))
		->where('s.student_id =:student_id ', array(':student_id'=>$this->student_id));
		$result=$command->queryAll();
		if(empty($result)){
			$this->addError($attribute, 'Result not Found!');
		}
	}
	
	
}
?>
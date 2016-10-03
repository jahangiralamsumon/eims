<?php
class FeeViewForm extends  CFormModel{
	public $student_id;
	public $month;
	public $year;
	public $is_gen;
	
	public function rules()
	{
		return array(
				array('month,year,student_id', 'required'),
				array('is_gen','check_is_gen')
				

		);
	}
	
	public static function months(){
		return array(
				'01'=>'Jan',
				'02'=>'Feb',
				'03'=>'Mar',
				'04'=>'Apr',
				'05'=>'May',
				'06'=>'Jun',
				'07'=>'Jul',
				'08'=>'Agr',
				'09'=>'Sep',
				'10'=>'Oct',
				'11'=>'Nov',
				'12'=>'Dec'
				);
	}
	
	public static function years(){
		
		
		$command= Yii::app()->db->createCommand()
		->select('year(start_date) start_year,year(end_date) end_year')
		->from('year_info')
		->where('status=:status', array(':status'=>'1'))
		->queryRow();
			
		$start_year=$command['start_year'];
		$end_year=$command['end_year'];
		
		
		for ($i=$start_year;$i<=$end_year;$i++){
			$arr[$i]=$i;
		}
		return $arr;
	}
	
	
	public function check_is_gen($attribute){
		$month=$this->attributes['month'];
		$year=$this->attributes['year'];
		$criteria = new CDbCriteria();
		$criteria->select = '*';
		$criteria->condition = 'month=:month AND year=:year';
		$criteria->params = array(':month'=>$month, ':year'=>$year);
		$record =FeeAllocationTrace::model()->find($criteria);
		if($record===null){
			$this->addError($attribute, 'Fees for this month has not been generated.');
		}
	
	}
	
	
}

?>
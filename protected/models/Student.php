<?php

/**
 * This is the model class for table "student".
 *
 * The followings are the available columns in table 'student':
 * @property integer $student_id
 * @property string $reg_no 
 * @property string $admission_date
 * @property string $name
 * @property string $father_name
 * @property string $mother_name
 * @property string $present_address
 * @property string $permanent_address
 * @property string $phone
 * @property string $mobile
 * @property string $email
 * @property string $sex
 * @property string $birthday
 * @property string $religion
 * @property string $blood_group
 * @property integer $nationality_id
 * @property string $img_file
 * @property string $user_id
 * @property string $password
 * @property integer $parent_id
 * @property string $created_at
 * @property string $updated_at
 * @property integer $status
 *
 * The followings are the available model relations:
 * @property Countries $nationality
 * @property Parent $parent
 */
class Student extends CActiveRecord
{
	
	public $img_file; 	
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
		return 'student';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('student_id,name,admission_no,admission_date, father_name, mother_name,present_address,birthday, nationality_id,mobile', 'required'),
			array('birthday,admission_date', 'type', 'type' => 'date', 'dateFormat' => 'yyyy-MM-dd'),
			array('updated_at', 'default', 'value' => '0000-00-00 00:00:00', 'setOnEmpty' => true, 'on' => 'insert'),
			array('student_id, nationality_id, parent_id,student_acc_id,status', 'numerical', 'integerOnly'=>true),
			array('reg_no, phone, mobile, sex, religion, password', 'length', 'max'=>100),
			array('name, father_name, mother_name', 'length', 'max'=>300),
			array('present_address, permanent_address', 'length', 'max'=>500),
			array('email, img_file_name, user_id', 'length', 'max'=>200),
			array('blood_group', 'length', 'max'=>50),
			array('img_file', 'file','allowEmpty' => true,'types' => 'jpg,jpeg,gif,png', 'maxSize' => 1024 * 1024 * 2, 'tooLarge' => 'Size should be less then 2MB !!!'),
			array('email', 'email'),
			array('email', 'unique', 'message' => "Email allready in use."),
			array('attendance_card_id','safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('student_id, reg_no, admission_date,admission_no,name, father_name, mother_name, present_address, permanent_address, phone, mobile, email, sex, birthday, religion, blood_group, nationality_id,user_id, password, parent_id, created_at, updated_at, status,', 'safe', 'on'=>'search'),
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
			'nationality' => array(self::BELONGS_TO, 'Countries', 'nationality_id'),
			'parent' => array(self::BELONGS_TO, 'Parent', 'parent_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'student_id' => 'Student ID',
			'reg_no' => 'Reg No',
			'admission_date' => 'Admission Date',
			'name' => 'Name',
			'father_name' => 'Father Name',
			'mother_name' => 'Mother Name',
			'present_address' => 'Present Address',
			'permanent_address' => 'Permanent Address',
			'phone' => 'Phone',
			'mobile' => 'Mobile',
			'email' => 'Email',
			'sex' => 'Sex',
			'birthday' => 'Birthday',
			'religion' => 'Religion',
			'blood_group' => 'Blood Group',
			'nationality_id' => 'Nationality',
			'img_file_name'=>'Image File Name',	
			'user_id' => 'User',
			'password' => 'Password',
			'parent_id' => 'Parent',
			'attendance_card_id'=>'Attendance Card No',	
			'created_at' => 'Created At',
			'updated_at' => 'Updated At',
			'status' => 'Status',
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

		$criteria->compare('student_id',$this->student_id);
		$criteria->compare('reg_no',$this->reg_no,true);
		$criteria->compare('admission_date',$this->admission_date,true);
		$criteria->compare('admission_no',$this->admission_no,true);
		$criteria->compare('name',$this->name,true);
		$criteria->compare('father_name',$this->father_name,true);
		$criteria->compare('mother_name',$this->mother_name,true);
		$criteria->compare('present_address',$this->present_address,true);
		$criteria->compare('permanent_address',$this->permanent_address,true);
		$criteria->compare('phone',$this->phone,true);
		$criteria->compare('mobile',$this->mobile,true);
		$criteria->compare('email',$this->email,true);
		$criteria->compare('sex',$this->sex,true);
		$criteria->compare('birthday',$this->birthday,true);
		$criteria->compare('religion',$this->religion,true);
		$criteria->compare('blood_group',$this->blood_group,true);
		$criteria->compare('nationality_id',$this->nationality_id);
		$criteria->compare('user_id',$this->user_id,true);
		$criteria->compare('password',$this->password,true);
		$criteria->compare('parent_id',$this->parent_id);
		$criteria->compare('created_at',$this->created_at,true);
		$criteria->compare('updated_at',$this->updated_at,true);
		$criteria->compare('status',$this->status);
		
		
		
		$criteria->join="INNER JOIN student_class sc ON sc.student_id=t.student_id INNER JOIN class on sc.class_id=class.class_id INNER JOIN academic_year_info ayi ON (sc.year_id=ayi.year_code AND sc.class_id=ayi.class_id  AND ayi.status=1)";

		
		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
				'sort'=>array(
						'defaultOrder'=>'t.name ASC',
				),
		));
	}
	
	public static function list_student(){
		$list_student= Yii::app()->db->createCommand()
		->select('s.student_id id,reg_no,s.name name,sc.class_id class_id,sc.section_id section_id,sc.group group,roll_no')
		->from('student s')
		->join('student_class sc', 's.student_id=sc.student_id')
		->join('class c', 'sc.class_id=c.class_id')
		->join('academic_year_info ayi', 'sc.year_id=ayi.year_code AND sc.class_id=ayi.class_id AND ayi.status=:status',array(':status'=>1))
		->order('c.class_id,s.name ASC');
		return $list_student->queryAll();
	}
	
	public static function current_students($class_id=null,$section_id=null,$group=null,$student_id=null,$year_id=null){
		$command= Yii::app()->db->createCommand()->setFetchMode(PDO::FETCH_OBJ)
		->select('s.student_id student_id,s.name student_name,student_acc_id,sc.class_id,sc.section_id section_id,sc.group,sc.roll_no,c.class_name,sec.section_name,ayi.name year_name')
		->from('student s')
		->join('student_class sc', 's.student_id=sc.student_id')
		->join('class c', 'sc.class_id=c.class_id')
		->leftJoin('section sec', 'sec.section_id=sc.section_id');
		if($year_id!=null){
		 $command->join('academic_year_info ayi', 'sc.year_id=ayi.year_code AND sc.class_id=ayi.class_id  AND sc.year_id=:year_id',array(':year_id'=>$year_id));
		}
		
		else{
		$command->join('academic_year_info ayi', 'sc.year_id=ayi.year_code AND sc.class_id=ayi.class_id AND ayi.status=:status',array(':status'=>1));
		}
		
		if ($section_id!=null && $class_id!=null){
		 $command->where('sc.class_id=:class_id AND sc.section_id=:section_id ',array(':class_id'=>$class_id,':section_id'=>$section_id));

		}
		
		else if ($group!=null && $class_id!=null){
			$command->where('sc.class_id=:class_id AND sc.group=:group ',array(':class_id'=>$class_id,':group'=>$group));
		
		}
		else if ($class_id!=null){
		$command->where('sc.class_id=:class_id',array(':class_id'=>$class_id));
		}
		
		else if ($student_id!=null){
			$command->where('s.student_id=:student_id',array(':student_id'=>$student_id));
		}
		
		
		$command->order('sc.class_id,sc.roll_no ASC');
		
		return $command->queryAll();
	}
	
	
	public  static function student_details($student_id){
		
		$command= Yii::app()->db->createCommand()->setFetchMode(PDO::FETCH_OBJ)
		->select('s.student_id,s.name,s.img_file_name,s.parent_id,sc.class_id,sc.roll_no,sc.group,c.class_name,sec.section_name,ayi.name year_name')
		->from('student s')
		->join('student_class sc', 's.student_id=sc.student_id')
		->join('class c', 'sc.class_id=c.class_id')
		->leftJoin('section sec', 'sec.section_id=sc.section_id')
		->join('academic_year_info ayi', 'sc.year_id=ayi.year_code AND sc.class_id=ayi.class_id AND ayi.status=:status',array(':status'=>1))
		->where('s.student_id =:student_id', array('student_id'=>$student_id));
	  return $command->queryRow();
	}
	
	
	
	public static function total_student(){
		
		$command= Yii::app()->db->createCommand()
		->select('count(student_id) num')
		->from('student_class sc ')
		->join('academic_year_info ayi', 'sc.year_id=ayi.year_code AND sc.class_id=ayi.class_id AND ayi.status=:status',array(':status'=>1))
		->queryRow();
		
		return $command['num'];
		
	}
	
	public static function view_fee_details($student_id,$month,$year){
		

		$fees_month= date('M-Y', mktime(0, 0, 0, $month,1, $year));
		$from_date= date('Y-m-t', mktime(0, 0, 0, $month,-1, $year)); // Last Day of before $month month
		
		//select YearCode,@startDate=StartDate from yearinfo where @dtFrom between StartDate and EndDate
		
		$command= Yii::app()->db->createCommand()
		->select('date(start_date) start_date,year_code')
		->from('year_info')
		//->where(':from_date BETWEEN date(start_date) AND date(end_date)',array(':from_date'=>$from_date))
		->where('date(start_date)<=:from_date AND date(end_date)>=:from_date', array(':from_date'=>$from_date))
		->queryRow();
			
		$start_date=$command['start_date'];
		$year_code=$command['year_code'];
		
		//SELECT @OpenBalance=isnull((AO.DRAMOUNT-AO.CRAMOUNT),0) FROM ACCHEAD AH,ACCOPENING AO WHERE AH.ACCID=@AccID AND AH.ACCID=AO.ACCCODE AND AO.YEARCODE=@yrCode

		$acc_id=self::student_acc_code($student_id);
		$command= Yii::app()->db->createCommand()
		->select('IFNULL((ao.dr_amount-ao.cr_amount),0) ob')
		->from('acc_head ah')
		->join('acc_opening ao','ao.acc_code=ah.acc_id')
		->where('ah.acc_id=:acc_id AND ao.year_code=:year_code', array('acc_id'=>$acc_id,':year_code'=>$year_code))
		->queryRow();
		
		$open_balance=$command['ob'];
			
		//select drcr, sum(isnull(amount,0)) from journal where AccId=@AccID and vid in (select vid from voucher where vdate>=@startDate and vdate<@dtFrom) group by drcr order by drcr
		
		$command= Yii::app()->db->createCommand()->setFetchMode(PDO::FETCH_OBJ)
		->select('drcr,sum(IFNULL(amount,0)) amount')
		->from('journal')
		->where('acc_code=:acc_code AND voucher_id IN (select voucher_id from voucher where voucher_date>=:start_date and voucher_date<:from_date)', array('acc_code'=>$acc_id,':start_date'=>$start_date,':from_date'=>$from_date))
		->group('drcr')
		->order('drcr');
		$result=$command->queryAll();
		
		$opendramt=0;
		$opencramt=0;
		//print_r($result);
		foreach ($result as $row)
		{
			if($row->drcr=='dr')
				$opendramt=$opendramt+$row->amount;
			else
				$opencramt=$opencramt+$row->amount;
		}
		
		$open_balance=$open_balance+$opendramt-$opencramt ;
				
		
		//SELECT * FROM `fee_details` fd  JOIN fee_allocation  fa ON  (fa.`fee_id`=fd.`fee_id` AND fd.student_id='4' AND fd.month='02' AND fd.year='2015') 
		//LEFT JOIN fee_particulars fp ON fp.id=fa.fee_particular_id
		
		//OR
		
		//SELECT * FROM `fee_details` fd LEFT JOIN fee_allocation  fa ON  fa.`fee_id`=fd.`fee_id` LEFT JOIN fee_particulars fp ON fp.id=fa.fee_particular_id WHERE 
		//fd.student_id=4 AND fd.month='02' AND fd.year='2015'
		
		$command= Yii::app()->db->createCommand()
		->select('fp.name,fp.amount,fd.fee_id fee_id')
		->from('fee_details fd')
		->join('fee_allocation  fa', 'fa.fee_id=fd.fee_id AND fd.student_id=:student_id AND fd.month=:month AND fd.year=:year',array(':student_id'=>$student_id,':month'=>$month,':year'=>$year))
		->join('fee_particulars fp', 'fp.id=fa.fee_particular_id');
		//->where('date(payment_time)>=:from_date AND date(payment_time)<=:to_date',  array(':from_date'=>$from_date,':to_date'=>$to_date))
		//->order('s.name1 ASC');
		$fees_partculars=$command->queryAll();
	
		$student_obj=self::model()->findbyPk($student_id);
		
		return  array('0'=>array('arrears'=>$open_balance,'fees_month'=>$fees_month),'1'=>$fees_partculars,'2'=>$student_obj);
		
	}
	
	public static function student_acc_code($id){
		$model=self::model()->findbyPk($id);
		return  $model->student_acc_id;	
		
		/* $criteria = new CDbCriteria();
		$criteria->select = 'student_acc_id';
		$criteria->condition = 'reg_no = :id';
		$criteria->params = array(':id' => $id);		
		$model = self::model()->find($criteria);
		return  $model->student_acc_id; */
	}
	
	public static function student_name($id){
		$model=self::model()->findbyPk($id);
		return  $model->name;
	

	}
	

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Student the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}

<?php

/**
 * This is the model class for table "employees".
 *
 * The followings are the available columns in table 'employees':
 * @property integer $id
 * @property string $emp_number
 * @property string $emp_attendance_card_id
 * @property string $joining_date
 * @property string $name
 * @property string $name_bn
 * @property string $gender
 * @property string $blood_group
 * @property string $religion
 * @property string $job_title
 * @property integer $emp_designation_id
 * @property integer $emp_department_id
 * @property integer $employee_category_id
 * @property integer $employee_grade_id
 * @property string $qualification
 * @property string $experience_detail
 * @property integer $experience_year
 * @property integer $experience_month
 * @property string $date_of_birth
 * @property string $marital_status
 * @property integer $children_count
 * @property string $father_name
 * @property string $mother_name
 * @property string $husband_name
 * @property string $national_id_no
 * @property string $home_address
 * @property string $home_city
 * @property integer $country_id
 * @property string $office_address
 * @property string $office_phone
 * @property string $mobile_phone
 * @property string $home_phone
 * @property string $email
 * @property string $fax
 * @property string $photo_file_name
 * @property string $created_at
 * @property string $updated_at
 * @property integer $user_id
 * @property string $is_deleted
 * @property integer $status
 */
class Employees extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'employees';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('emp_number,joining_date,name,religion,mobile_phone,emp_department_id', 'required'),
			array('emp_designation_id, emp_department_id, employee_category_id, employee_grade_id, experience_year, experience_month, children_count, country_id, user_id, status', 'numerical', 'integerOnly'=>true),
			array('emp_number, name, name_bn, blood_group, job_title, qualification, father_name, mother_name, husband_name, home_address, home_city, office_address, office_phone, mobile_phone, home_phone, email, fax, photo_file_name', 'length', 'max'=>255),
			array('emp_attendance_card_id', 'length', 'max'=>250),
			array('gender,marital_status', 'length', 'max'=>10),
			array('religion', 'length', 'max'=>500),
			array('national_id_no', 'length', 'max'=>100),
			array('is_deleted', 'length', 'max'=>1),
			array('experience_year, experience_month', 'exp_validation'),
			array('emp_number', 'unique'),
			array('email','email'),	
			array('photo_file_name', 'file','allowEmpty' => true,'types' => 'jpg,jpeg,gif,png', 'maxSize' => 1024 * 1024 * 2, 'tooLarge' => 'Size should be less then 2MB !!!'),
			array('experience_detail, date_of_birth, created_at, updated_at', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, emp_number, emp_attendance_card_id, joining_date, name, name_bn, gender, blood_group, religion, job_title, emp_designation_id, emp_department_id, employee_category_id, employee_grade_id, qualification, experience_detail, experience_year, experience_month, date_of_birth, marital_status, children_count, father_name, mother_name, husband_name, national_id_no, home_address, home_city, country_id, office_address, office_phone, mobile_phone, home_phone, email, fax, photo_file_name, created_at, updated_at, user_id, is_deleted, status', 'safe', 'on'=>'search'),
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
			'emp_number' => 'Employee  Number',
			'emp_attendance_card_id' => 'Emp Attendance Card',
			'joining_date' => 'Joining Date',
			'name' => 'Name',
			'name_bn' => 'Name Bangla',
			'gender' => 'Gender',
			'blood_group' => 'Blood Group',
			'religion' => 'Religion',
			'job_title' => 'Job Title',
			'emp_designation_id' => 'Designation',
			'emp_department_id' => 'Department',
			'employee_category_id' => 'Category',
			'employee_grade_id' => 'Employee Grade',
			'qualification' => 'Qualification',
			'experience_detail' => 'Experience Details',
			'experience_year' => 'Experience Year',
			'experience_month' => 'Experience Month',
			'date_of_birth' => 'Date Of Birth',
			'marital_status' => 'Marital Status',
			'children_count' => 'Children Count',
			'father_name' => 'Father Name',
			'mother_name' => 'Mother Name',
			'husband_name' => 'Husband Name',
			'national_id_no' => 'National Id No',
			'home_address' => 'Home Address',
			'home_city' => 'Home City',
			'country_id' => 'Country',
			'office_address' => 'Office Address',
			'office_phone' => 'Office Phone',
			'mobile_phone' => 'Mobile Phone',
			'home_phone' => 'Home Phone',
			'email' => 'Email',
			'fax' => 'Fax',
			'photo_file_name' => 'Photo',
			'created_at' => 'Created At',
			'updated_at' => 'Updated At',
			'user_id' => 'User',
			'is_deleted' => 'Is Deleted',
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

		$criteria->compare('id',$this->id);
		$criteria->compare('emp_number',$this->emp_number,true);
		$criteria->compare('emp_attendance_card_id',$this->emp_attendance_card_id,true);
		$criteria->compare('joining_date',$this->joining_date,true);
		$criteria->compare('name',$this->name,true);
		$criteria->compare('name_bn',$this->name_bn,true);
		$criteria->compare('gender',$this->gender,true);
		$criteria->compare('blood_group',$this->blood_group,true);
		$criteria->compare('religion',$this->religion,true);
		$criteria->compare('job_title',$this->job_title,true);
		$criteria->compare('emp_designation_id',$this->emp_designation_id);
		$criteria->compare('emp_department_id',$this->emp_department_id);
		$criteria->compare('employee_category_id',$this->employee_category_id);
		$criteria->compare('employee_grade_id',$this->employee_grade_id);
		$criteria->compare('qualification',$this->qualification,true);
		$criteria->compare('experience_detail',$this->experience_detail,true);
		$criteria->compare('experience_year',$this->experience_year);
		$criteria->compare('experience_month',$this->experience_month);
		$criteria->compare('date_of_birth',$this->date_of_birth,true);
		$criteria->compare('marital_status',$this->marital_status,true);
		$criteria->compare('children_count',$this->children_count);
		$criteria->compare('father_name',$this->father_name,true);
		$criteria->compare('mother_name',$this->mother_name,true);
		$criteria->compare('husband_name',$this->husband_name,true);
		$criteria->compare('national_id_no',$this->national_id_no,true);
		$criteria->compare('home_address',$this->home_address,true);
		$criteria->compare('home_city',$this->home_city,true);
		$criteria->compare('country_id',$this->country_id);
		$criteria->compare('office_address',$this->office_address,true);
		$criteria->compare('office_phone',$this->office_phone,true);
		$criteria->compare('mobile_phone',$this->mobile_phone,true);
		$criteria->compare('home_phone',$this->home_phone,true);
		$criteria->compare('email',$this->email,true);
		$criteria->compare('fax',$this->fax,true);
		$criteria->compare('photo_file_name',$this->photo_file_name,true);
		$criteria->compare('created_at',$this->created_at,true);
		$criteria->compare('updated_at',$this->updated_at,true);
		$criteria->compare('user_id',$this->user_id);
		$criteria->compare('is_deleted',$this->is_deleted,true);
		$criteria->compare('status',$this->status);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Employees the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
	
	
	public function exp_validation(){
		if($this->experience_year == ''&&$this->experience_month == ''){
			$this->addError('experience_month', 'Enter experience details');
		}
	}
	
	public function defaultScope() {
		return array(
				'order' => 'emp_department_id,name ASC'
		);
	}
	
	public static function total_employee(){
		return self::model()->count('status=:status ',array(':status'=>1));
	}
}

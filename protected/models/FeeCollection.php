<?php

/**
 * This is the model class for table "fee_collection".
 *
 * The followings are the available columns in table 'fee_collection':
 * @property integer $id
 * @property string $amount
 * @property integer $student_id
 * @property integer $fee_id
 * @property string $payment_mode
 * @property string $transaction_id
 * @property string $payment_date
 * @property string $receipt_no
 * @property string $voucher_no
 * @property string $remark
 */
class FeeCollection extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'fee_collection';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('student_id,payment_mode,amount,payment_date', 'required'),
			array('student_id', 'validstudent'),
			array('student_id, fee_id', 'numerical', 'integerOnly'=>true),
			array('amount', 'length', 'max'=>15),
			array('amount', 'numerical','min'=>1),
			array('payment_mode', 'length', 'max'=>300),
			array('transaction_id', 'length', 'max'=>100),
			array('receipt_no, voucher_no', 'length', 'max'=>255),
			array('payment_date,remark', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, amount, student_id, fee_id, payment_mode, transaction_id, payment_date, receipt_no, voucher_no, remark', 'safe', 'on'=>'search'),
		);
	}

	
	public function validstudent($attribute, $params){
		$row=Student::student_details($this->student_id);
		if(empty($row)){
			$this->addError($attribute, 'Student ID not found');
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
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'amount' => 'Amount',
			'student_id' => 'Student ID',
			'fee_id' => 'Fees Track NO',
			'payment_mode' => 'Payment Mode',
			'transaction_id' => 'Transaction',
			'payment_date' => 'Payment Date',
			'receipt_no' => 'Receipt No',
			'voucher_no' => 'Voucher No',
			'remark' => 'Remark',
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
		$criteria->compare('amount',$this->amount,true);
		$criteria->compare('student_id',$this->student_id);
		$criteria->compare('fee_id',$this->fee_id);
		$criteria->compare('payment_mode',$this->payment_mode,true);
		$criteria->compare('transaction_id',$this->transaction_id,true);
		$criteria->compare('payment_date',$this->payment_date,true);
		$criteria->compare('receipt_no',$this->receipt_no,true);
		$criteria->compare('voucher_no',$this->voucher_no,true);
		$criteria->compare('remark',$this->remark,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return FeeCollection the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
	
	public static function std_collection_history($student_id){		
		$command= Yii::app()->db->createCommand()->setFetchMode(PDO::FETCH_OBJ)
		->select('*')
		->from('fee_collection')
		->limit('5')
		->where('student_id=:student_id',array(':student_id'=>$student_id))
		->order('id DESC');
		return  $command->queryAll();
	}
}

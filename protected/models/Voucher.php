<?php

/**
 * This is the model class for table "voucher".
 *
 * The followings are the available columns in table 'voucher':
 * @property integer $voucher_id
 * @property string $voucher_date
 * @property integer $voucher_type
 * @property string $voucher_no
 * @property string $posted
 * @property integer $user_id
 * @property string $particulars
 * @property integer $Location
 * @property string $LastUpdated
 *
 * The followings are the available model relations:
 * @property UserInfo $user
 */
class Voucher extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public $dr_account;
	public $cr_account;
	public $amount;
	public function tableName()
	{
		return 'voucher';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
		array('voucher_id, voucher_date, voucher_type', 'required'),
		array('voucher_id, voucher_type, user_id, location', 'numerical', 'integerOnly'=>true),
		array('voucher_no, posted', 'length', 'max'=>100),
		array('particulars', 'length', 'max'=>500),
		array('is_update','safe'),
		// The following rule is used by search().
		// @todo Please remove those attributes that should not be searched.
		array('voucher_id, voucher_date, voucher_type, voucher_no, posted, user_id, particulars,location, last_updated', 'safe', 'on'=>'search'),
		array('dr_account,cr_account,amount,voucher_type','required','on'=>'entry'),
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
			'user' => array(self::BELONGS_TO, 'UserInfo', 'user_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'voucher_id' => 'Voucher',
			'voucher_date' => 'Voucher Date',
			'voucher_type' => 'Voucher Type',
			'voucher_no' => 'Voucher No',
			'posted' => 'Posted',
			'user_id' => 'User',
			'particulars' => 'Particulars',
			'location' => 'Location',
			'last_updated' => 'Last Updated',
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

		$criteria->compare('voucher_id',$this->voucher_id);
		$criteria->compare('voucher_date',$this->voucher_date,true);
		$criteria->compare('voucher_type',$this->voucher_type);
		$criteria->compare('voucher_no',$this->voucher_no,true);
		$criteria->compare('posted',$this->posted,true);
		$criteria->compare('user_id',$this->user_id);
		$criteria->compare('particulars',$this->particulars,true);
		$criteria->compare('location',$this->location);
		$criteria->compare('last_updated',$this->last_updated,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Voucher the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

	public static function brvoucher_entry($merchant_account_id,$amount,$comm_amount){

		$merchant= Yii::app()->db->createCommand()->setFetchMode(PDO::FETCH_OBJ)
		->select('acc_code')
		->from('merchant_info')
		->leftJoin('acc_head', 'acc_head.merchant_id=merchant_info.merchant_id')
		->where('merchant_account_id=:merchant_account_id', array(':merchant_account_id'=>$merchant_account_id));
		$merchant_acc_id=$merchant->queryRow()->acc_code;

		$transaction = Yii::app()->db->beginTransaction();
		try
		{
			$model=new Voucher;
			//$model->scenario ='entry';
			$criteria=new CDbCriteria;
			$criteria->select='max(voucher_id) AS voucher_id';
			$row =Voucher::model()->find($criteria);
			$max =isset($row->voucher_id)?$row->voucher_id:0;
			$model->voucher_id=$max+1;
			$model->voucher_type=1;
			$model->voucher_date=new CDbExpression('NOW()');
			$dr_account=2;//Accounting Head acc_id
			$cr_account=$merchant_acc_id;//;Accounting Head acc_id where merchant id
			$amount=$amount;
			$r1=$model->save();

			$journal_record1=new Journal;
			$journal_record1->voucher_id=$model->voucher_id;
			$journal_record1->acc_code=$dr_account;
			$journal_record1->drcr='dr';
			$journal_record1->amount=$amount;
			$journal_record1->drcr_id=$cr_account;
			$journal_record1->particular='Bank Received';
			$r2=$journal_record1->save();

			$journal_record2=new Journal;
			$journal_record2->voucher_id=$model->voucher_id;
			$journal_record2->acc_code=$cr_account;
			$journal_record2->drcr='cr';
			$journal_record2->amount=$amount;
			$journal_record2->drcr_id=$dr_account;
			$journal_record2->particular='Bank Received';
			$r3=$journal_record2->save();
				

			$model1=new Voucher;
			//$model1->scenario ='entry';
			$criteria=new CDbCriteria;
			$criteria->select='max(voucher_id) AS voucher_id';
			$row =Voucher::model()->find($criteria);
			$max =isset($row->voucher_id)?$row->voucher_id:0;
			$model1->voucher_id=$max+1;
			$model1->voucher_type=5;
			$model1->voucher_date=new CDbExpression('NOW()');
			$dr_account=$merchant_acc_id;//Accounting Head acc_id
			$cr_account=6;//;Accounting Head acc_id where merchant id
			$amount=$comm_amount;
			$r4=$model1->save();
				
			$journal_record3=new Journal;
			$journal_record3->voucher_id=$model1->voucher_id;
			$journal_record3->acc_code=$dr_account;
			$journal_record3->drcr='dr';
			$journal_record3->amount=$amount;
			$journal_record3->drcr_id=$cr_account;
			$journal_record3->particular='Transaction Charge';
			$r5=$journal_record3->save();

			$journal_record4=new Journal;
			$journal_record4->voucher_id=$model1->voucher_id;
			$journal_record4->acc_code=$cr_account;
			$journal_record4->drcr='cr';
			$journal_record4->amount=$amount;
			$journal_record4->drcr_id=$dr_account;
			$journal_record4->particular='Transaction Charge';
			$r6=$journal_record4->save();
			
			if($r1 && $r2 && $r3 && $r4 && $r5 && $r6){
				$transaction->commit();
		    }
		    else{
		    $transaction->rollBack();
		    }
		}
		
		catch (Exception $e)
		{
			$transaction->rollBack();
			//echo $e->getMessage();
		} 
			
			 
	}

}
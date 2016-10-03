<?php

/**
 * This is the model class for table "journal".
 *
 * The followings are the available columns in table 'journal':
 * @property integer $serial
 * @property integer $voucher_id
 * @property integer $acc_code
 * @property string $drcr
 * @property double $amount
 * @property integer $drcr_id
 * @property string $particular
 *
 * The followings are the available model relations:
 * @property Journal $voucher
 * @property Journal[] $journals
 */
class Journal extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public $voucher_date;
	public function tableName()
	{
		return 'journal';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
				array('voucher_id, acc_code, drcr, amount, drcr_id', 'required'),
				array('voucher_id, acc_code, drcr_id', 'numerical', 'integerOnly'=>true),
				array('amount', 'numerical'),
				array('drcr', 'length', 'max'=>10),
				array('particular', 'length', 'max'=>500),
				// The following rule is used by search().
				// @todo Please remove those attributes that should not be searched.
				array('serial, voucher_id, acc_code, drcr, amount, drcr_id, particular', 'safe', 'on'=>'search'),
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
				'voucher' => array(self::BELONGS_TO, 'Voucher', 'voucher_id'),
				'journals' => array(self::HAS_MANY, 'Journal', 'voucher_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
				'serial' => 'Serial',
				'voucher_id' => 'Voucher',
				'acc_code' => 'Acc Code',
				'drcr' => 'Drcr',
				'amount' => 'Amount',
				'drcr_id' => 'Drcr',
				'particular' => 'Particular',
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

		$criteria->compare('serial',$this->serial);
		$criteria->compare('voucher_id',$this->voucher_id);
		$criteria->compare('acc_code',$this->acc_code);
		$criteria->compare('drcr',$this->drcr,true);
		$criteria->compare('amount',$this->amount);
		$criteria->compare('drcr_id',$this->drcr_id);
		$criteria->compare('particular',$this->particular,true);

		return new CActiveDataProvider($this, array(
				'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Journal the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

	public static function ledger($acc_id,$from_date,$to_date){
		$row_data=array();
		$ledger_data=array();

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
		->where('acc_code=:acc_code AND voucher_id IN (select voucher_id from voucher where date(voucher_date)>=:start_date and date(voucher_date)<:from_date)', array('acc_code'=>$acc_id,':start_date'=>$start_date,':from_date'=>$from_date))
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

		$row_data['voucher_date']=date("d-M-y",strtotime($from_date));
		$row_data['particular']='Opening';

		if ($open_balance>0){
			$row_data['dr_amount']=intval($open_balance)<0?(-1*$open_balance):$open_balance;
			$row_data['cr_amount']=0;
			//insert into @Ledger values(@accID,@Name,0,'Opening',@dtFrom,0,'',@OpenBalance,0,@OpenBalance,'')
		}

		else{
			$row_data['cr_amount']=intval($open_balance)<0?(-1*$open_balance):$open_balance;
			$row_data['dr_amount']=0;
			//	insert into @Ledger values(@accID,@Name,0,'Opening',@dtFrom,0,'',0,@OpenBalance,@OpenBalance,'')
		}

		$row_data['balance']=intval($open_balance)<0?number_format(-1*$open_balance,2,'.',''):number_format($open_balance,2,'.','');

		$row_data['type']=intval($open_balance)!=0?$open_balance>0?'Debit':'Credit':'';
		$ledger_data[0]=$row_data;

			
		$command= Yii::app()->db->createCommand()->setFetchMode(PDO::FETCH_OBJ)
		->select('sum(IFNULL(amount,0)) amt,j.*,v.*')
		->from('journal j')
		->join('voucher v','v.voucher_id=j.voucher_id')
		->where('acc_code=:acc_code AND date(voucher_date)>=:from_date AND date(voucher_date)<=:to_date',
				array('acc_code'=>$acc_id,':from_date'=>$from_date,':to_date'=>$to_date))
		->group('drcr,v.voucher_id')
		->order('voucher_date,v.voucher_id');
		//->order('drcr');
		//echo $command->text;
		$records=$command->queryAll();
		//print_r($records);

		foreach ($records as $k=>$row){
			$row_data['voucher_date']=date("d-M-y",strtotime($row->voucher_date));
			$row_data['particular']=$row->particular.' (' .AccHead::acc_head_name($row->drcr_id).')';
			if($row->drcr=='dr'){
				$row_data['dr_amount']=$row->amt;
				$row_data['cr_amount']=number_format(0,2,'.','');//0 to 0.00
			}
			else{
				$row_data['cr_amount']=$row->amt;
				$row_data['dr_amount']=number_format(0,2,'.','');
			}
			$dr_cr=$row_data['dr_amount']-$row_data['cr_amount'];

			if($k>0){
				$sum[$k]=$sum[$k-1]+$dr_cr;
				//echo number_format($sum[$k],2,'.','');
			}
			else{
				$sum[$k]=$dr_cr+$open_balance;
				//echo number_format($sum[$k],2,'.','');
			}

			$row_data['balance']=intval($sum[$k])<0?number_format(-1*$sum[$k],2,'.',''):number_format($sum[$k],2,'.','');

			$row_data['type']=intval($sum[$k])!=0?$sum[$k]>0?'Debit':'Credit':'';

			$ledger_data[$k+1]=$row_data;

		}

		return  $ledger_data;

	}


	public static function student_ledger($acc_id,$from_date,$to_date){
		$row_data=array();
		$ledger_data=array();

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
		->where('acc_code=:acc_code AND voucher_id IN (select voucher_id from voucher where date(voucher_date)>=:start_date and date(voucher_date)<:from_date)', array('acc_code'=>$acc_id,':start_date'=>$start_date,':from_date'=>$from_date))
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

		$row_data['voucher_date']=date("d-M-y",strtotime($from_date));
		$row_data['particular']='Opening';

		if ($open_balance>0){
			$row_data['dr_amount']=intval($open_balance)<0?(-1*$open_balance):$open_balance;
			$row_data['cr_amount']=0;
			//insert into @Ledger values(@accID,@Name,0,'Opening',@dtFrom,0,'',@OpenBalance,0,@OpenBalance,'')
		}

		else{
			$row_data['cr_amount']=intval($open_balance)<0?(-1*$open_balance):$open_balance;
			$row_data['dr_amount']=0;
			//	insert into @Ledger values(@accID,@Name,0,'Opening',@dtFrom,0,'',0,@OpenBalance,@OpenBalance,'')
		}

		$row_data['balance']=intval($open_balance)<0?number_format(-1*$open_balance,2,'.',''):number_format($open_balance,2,'.','');

		$row_data['type']=intval($open_balance)!=0?$open_balance>0?'Debit':'Credit':'';
		$ledger_data[0]=$row_data;

			
		$command= Yii::app()->db->createCommand()->setFetchMode(PDO::FETCH_OBJ)
		->select('sum(IFNULL(amount,0)) amt,GROUP_CONCAT(particular) prt,j.*,v.*')
		->from('journal j')
		->join('voucher v','v.voucher_id=j.voucher_id')
		->where('acc_code=:acc_code AND date(voucher_date)>=:from_date AND date(voucher_date)<=:to_date',
		array('acc_code'=>$acc_id,':from_date'=>$from_date,':to_date'=>$to_date))
		->group('month(voucher_date),drcr');
		//->order('drcr');
		//echo $command->text;
		$records=$command->queryAll();
		//print_r($records);

		foreach ($records as $k=>$row){
			$row_data['voucher_date']=date("M-y",strtotime($row->voucher_date));
			$row_data['particular']=$row->prt;
			if($row->drcr=='dr'){
				$row_data['dr_amount']=$row->amt;
				$row_data['cr_amount']=number_format(0,2,'.','');//0 to 0.00
			}
			else{
				$row_data['cr_amount']=$row->amt;
				$row_data['dr_amount']=number_format(0,2,'.','');
			}
			$dr_cr=$row_data['dr_amount']-$row_data['cr_amount'];

			if($k>0){
		 	$sum[$k]=$sum[$k-1]+$dr_cr;
		 	//echo number_format($sum[$k],2,'.','');
			}
			else{
		 	$sum[$k]=$dr_cr+$open_balance;
		 	//echo number_format($sum[$k],2,'.','');
			}

		 $row_data['balance']=intval($sum[$k])<0?number_format(-1*$sum[$k],2,'.',''):number_format($sum[$k],2,'.','');

		 $row_data['type']=intval($sum[$k])!=0?$sum[$k]>0?'Debit':'Credit':'';

		 $ledger_data[$k+1]=$row_data;

		}

		return  $ledger_data;

	}


	public static function prep_tb($from_date,$to_date){
		$data=array();
		$command= Yii::app()->db->createCommand()
		->select('date(start_date) start_date,year_code')
		->from('year_info')
		//->where(':from_date BETWEEN date(start_date) AND date(end_date)',array(':from_date'=>$from_date))
		->where('date(start_date)<=:from_date AND date(end_date)>=:from_date', array(':from_date'=>$from_date))
		->queryRow();
			
		$start_date=$command['start_date'];
		$year_code=$command['year_code'];
		//select AccId,a.AccCode,Name, Parent, LR, (isnull(dramount,0)-isnull(cramount,0)) openbalance from acchead a,accopening b where a.depth= @depth and b.yearcode=@yrCode and a.accid=b.acccode order by a.acccode

		$command= Yii::app()->db->createCommand()
		->select('max(depth) depth')
		->from('acc_head')
		->queryRow();

		$depth=$command['depth'];
		$key=0;
		while($depth>=0){
			$command=Yii::app()->db->createCommand()->setFetchMode(PDO::FETCH_OBJ)
			->select('ah.acc_id,ah.acc_code,name,parent,category,lr,IFNULL((ao.dr_amount-ao.cr_amount),0) ob')
			->from('acc_head ah')
			->leftJoin('acc_opening ao','ah.acc_id=ao.acc_code  AND ao.year_code=:year_code', array(':year_code'=>$year_code))
			->where('ah.depth=:depth', array(':depth'=>$depth))
			->order('acc_order ASC');
			$result=$command->queryAll();
			foreach ($result as $row){
				$start_balance=0;
				$range_balance=0;
				if($row->lr=='L'){
					$start_balance=$row->ob;
					$command= Yii::app()->db->createCommand()->setFetchMode(PDO::FETCH_OBJ)
					->select('sum(IFNULL(amount,0)) amount')
					->from('journal')
					->where('acc_code=:acc_id AND voucher_id IN (select voucher_id from voucher where date(voucher_date)>=:start_date and date(voucher_date)<:from_date) AND drcr=:drcr', array('acc_id'=>$row->acc_id,':start_date'=>$start_date,':from_date'=>$from_date,':drcr'=>'dr'))
					->queryRow();
					$open_debit=$command->amount;

					$command= Yii::app()->db->createCommand()->setFetchMode(PDO::FETCH_OBJ)
					->select('sum(IFNULL(amount,0)) amount')
					->from('journal')
					->where('acc_code=:acc_id AND voucher_id IN (select voucher_id from voucher where date(voucher_date)>=:start_date and date(voucher_date)<:from_date) AND drcr=:drcr', array('acc_id'=>$row->acc_id,':start_date'=>$start_date,':from_date'=>$from_date,':drcr'=>'cr'))
					->queryRow();
					$open_credit=$command->amount;

					$start_balance=$start_balance+$open_debit-$open_credit;
					//select @openDebit=isnull(sum(Amount),0) from Journal where AccId=@accID and vid in(select vid from voucher where vdate>=@dtStart and vdate < @dtFrom) and DRCR='D'
					//select @openCredit=isnull(sum(Amount),0) from Journal where AccId= @accID  and vid in(select vid from voucher where vdate>=@dtStart and vdate < @dtFrom) and DRCR='C'
					//set @startBalance=@startBalance+@openDebit-@openCredit

					$command= Yii::app()->db->createCommand()->setFetchMode(PDO::FETCH_OBJ)
					->select('sum(IFNULL(amount,0)) amount')
					->from('journal')
					->where('acc_code=:acc_id AND voucher_id IN (select voucher_id from voucher where date(voucher_date)>=:from_date and date(voucher_date)<=:to_date) AND drcr=:drcr', array('acc_id'=>$row->acc_id,':from_date'=>$from_date,':to_date'=>$to_date,':drcr'=>'dr'))
					->queryRow();
					$range_debit=$command->amount;

					$command= Yii::app()->db->createCommand()->setFetchMode(PDO::FETCH_OBJ)
					->select('sum(IFNULL(amount,0)) amount')
					->from('journal')
					->where('acc_code=:acc_id AND voucher_id IN (select voucher_id from voucher where date(voucher_date)>=:from_date and date(voucher_date)<=:to_date) AND drcr=:drcr', array('acc_id'=>$row->acc_id,':from_date'=>$from_date,':to_date'=>$to_date,':drcr'=>'cr'))
					->queryRow();
					$range_credit=$command->amount;
					$range_balance=$range_debit-$range_credit;

					//select @rangeDebit=isnull(sum(Amount),0) from Journal where AccId=@accID and vid in(select vid from voucher where vdate>=@dtFrom and vdate <=@dtTo) and DRCR='D'
					//select @rangeCredit=isnull(sum(Amount),0) from Journal where AccId=@accID and vid in(select vid from voucher where vdate>=@dtFrom and vdate <=@dtTo) and DRCR='C'
					//set @rangeBalance = @rangeDebit - @rangeCredit
				}
				else{
					$len=count($data);
					for ($i=0;$i<$len;$i++){
						if( $row->acc_id==$data[$i]['parent']){
							$start_balance=$start_balance+$data[$i]['upto_balance'];
						}

					}
						
					for ($i=0;$i<$len;$i++){
						if($row->acc_id==$data[$i]['parent']){
							$range_balance=$range_balance+$data[$i]['tran_balance'];
						}
					}
					//select @startBalance=isnull(sum(uptobalance),0) from @tblTB where parent=@accID
					//select @rangeBalance=isnull(sum(tranBalance),0) from @tblTB where parent=@accID

				}

				$upto_balance=$start_balance;
				$tran_balance=$range_balance;
				$balance=$upto_balance+$tran_balance;
				$data[$key]=array('acc_id'=>$row->acc_id,'name'=>$row->name,'parent'=>$row->parent,'upto_balance'=>$upto_balance,'tran_balance'=>$tran_balance,'balance'=>$balance,'category'=>$row->category,'depth'=>$depth,'lr'=>$row->lr);
				$key++;

			}
			$depth=$depth-1;
		}

		return $data;
	}


	public static function student_acc_status($from_date,$to_date,$student_id=null){
		$data=array();
		$command= Yii::app()->db->createCommand()
		->select('date(start_date) start_date,year_code')
		->from('year_info')
		//->where(':from_date BETWEEN date(start_date) AND date(end_date)',array(':from_date'=>$from_date))
		->where('date(start_date)<=:from_date AND date(end_date)>=:from_date', array(':from_date'=>$from_date))
		->queryRow();
			
		$start_date=$from_date;
		$year_code=$command['year_code'];
		//select AccId,a.AccCode,Name, Parent, LR, (isnull(dramount,0)-isnull(cramount,0)) openbalance from acchead a,accopening b where a.depth= @depth and b.yearcode=@yrCode and a.accid=b.acccode order by a.acccode
         
		$students=Student::current_students(null,null,null,$student_id);//($class_id=null,$section_id=null,$group=null,$student_id=null)
			
		foreach ($students as $key=>$student){
			$command=Yii::app()->db->createCommand()->setFetchMode(PDO::FETCH_OBJ)
			->select('ah.acc_id,ah.acc_code,name,parent,category,lr,IFNULL((ao.dr_amount-ao.cr_amount),0) ob')
			->from('acc_head ah')
			->join('acc_opening ao','ao.acc_code=ah.acc_id')
			->where('ah.acc_id=:acc_id AND ao.year_code=:year_code', array(':acc_id'=>$student->student_acc_id,':year_code'=>$year_code))
			->order('acc_order ASC');
			$row=$command->queryRow();
	
				
			$start_balance=0;
			$range_balance=0;
			$start_balance=isset($row->ob)?$row->ob:0;
	
			$command= Yii::app()->db->createCommand()->setFetchMode(PDO::FETCH_OBJ)
			->select('sum(IFNULL(amount,0)) amount')
			->from('journal')
			->where('acc_code=:acc_id AND voucher_id IN (select voucher_id from voucher where date(voucher_date)>=:start_date and date(voucher_date)<:from_date) AND drcr=:drcr', array('acc_id'=>$row->acc_id,':start_date'=>$start_date,':from_date'=>$from_date,':drcr'=>'dr'))
			->queryRow();
			$open_debit=$command->amount;
				
	
			$command= Yii::app()->db->createCommand()->setFetchMode(PDO::FETCH_OBJ)
			->select('sum(IFNULL(amount,0)) amount')
			->from('journal')
			->where('acc_code=:acc_id AND voucher_id IN (select voucher_id from voucher where date(voucher_date)>=:start_date and date(voucher_date)<:from_date) AND drcr=:drcr', array('acc_id'=>$row->acc_id,':start_date'=>$start_date,':from_date'=>$from_date,':drcr'=>'cr'))
			->queryRow();
			$open_credit=$command->amount;
	
			$start_balance=$start_balance+$open_debit-$open_credit;
			//select @openDebit=isnull(sum(Amount),0) from Journal where AccId=@accID and vid in(select vid from voucher where vdate>=@dtStart and vdate < @dtFrom) and DRCR='D'
			//select @openCredit=isnull(sum(Amount),0) from Journal where AccId= @accID  and vid in(select vid from voucher where vdate>=@dtStart and vdate < @dtFrom) and DRCR='C'
			//set @startBalance=@startBalance+@openDebit-@openCredit
	
			$command= Yii::app()->db->createCommand()->setFetchMode(PDO::FETCH_OBJ)
			->select('sum(IFNULL(amount,0)) amount')
			->from('journal')
			->where('acc_code=:acc_id AND voucher_id IN (select voucher_id from voucher where date(voucher_date)>=:from_date and date(voucher_date)<=:to_date) AND drcr=:drcr', array('acc_id'=>$row->acc_id,':from_date'=>$from_date,':to_date'=>$to_date,':drcr'=>'dr'))
			->queryRow();
			$range_debit=$command->amount;
	
			$command= Yii::app()->db->createCommand()->setFetchMode(PDO::FETCH_OBJ)
			->select('sum(IFNULL(amount,0)) amount')
			->from('journal')
			->where('acc_code=:acc_id AND voucher_id IN (select voucher_id from voucher where date(voucher_date)>=:from_date and date(voucher_date)<=:to_date) AND drcr=:drcr', array('acc_id'=>$row->acc_id,':from_date'=>$from_date,':to_date'=>$to_date,':drcr'=>'cr'))
			->queryRow();
			$range_credit=$command->amount;
			$range_balance=$range_debit-$range_credit;
	
			//select @rangeDebit=isnull(sum(Amount),0) from Journal where AccId=@accID and vid in(select vid from voucher where vdate>=@dtFrom and vdate <=@dtTo) and DRCR='D'
			//select @rangeCredit=isnull(sum(Amount),0) from Journal where AccId=@accID and vid in(select vid from voucher where vdate>=@dtFrom and vdate <=@dtTo) and DRCR='C'
			//set @rangeBalance = @rangeDebit - @rangeCredit
	
	
	
			$upto_balance=$start_balance;
			$tran_balance=$range_balance;
			$balance=$upto_balance+$tran_balance;
			$data[$key]=array('acc_id'=>$row->acc_id,'name'=>$row->name,'upto_balance'=>$upto_balance,'tran_balance'=>$tran_balance,'balance'=>$balance,'student_id'=>$student->student_id,'student_name'=>$student->student_name,'class_id'=>$student->class_id);
	
	
		}

		return $data;
	}


	public static function student_acc_status_classwise($from_date,$to_date,$class_id=null,$section_id=null,$group=null){
		$data=array();
		$command= Yii::app()->db->createCommand()
		->select('date(start_date) start_date,year_code')
		->from('year_info')
		//->where(':from_date BETWEEN date(start_date) AND date(end_date)',array(':from_date'=>$from_date))
		->where('date(start_date)<=:from_date AND date(end_date)>=:from_date', array(':from_date'=>$from_date))
		->queryRow();
			
		$start_date=$command['start_date'];
		$year_code=$command['year_code'];
		//select AccId,a.AccCode,Name, Parent, LR, (isnull(dramount,0)-isnull(cramount,0)) openbalance from acchead a,accopening b where a.depth= @depth and b.yearcode=@yrCode and a.accid=b.acccode order by a.acccode
		 
		$students=Student::current_students($class_id,$section_id,$group);
			
		foreach ($students as $key=>$student){
			$command=Yii::app()->db->createCommand()->setFetchMode(PDO::FETCH_OBJ)
			->select('ah.acc_id,ah.acc_code,name,parent,category,lr,IFNULL((ao.dr_amount-ao.cr_amount),0) ob')
			->from('acc_head ah')
			->join('acc_opening ao','ao.acc_code=ah.acc_id')
			->where('ah.acc_id=:acc_id AND ao.year_code=:year_code', array(':acc_id'=>$student->student_acc_id,':year_code'=>$year_code))
			->order('acc_order ASC');
			$row=$command->queryRow();
	
				
			$start_balance=0;
			$range_balance=0;
			$start_balance=isset($row->ob)?$row->ob:0;
	
			$command= Yii::app()->db->createCommand()->setFetchMode(PDO::FETCH_OBJ)
			->select('sum(IFNULL(amount,0)) amount')
			->from('journal')
			->where('acc_code=:acc_id AND voucher_id IN (select voucher_id from voucher where date(voucher_date)>=:start_date and date(voucher_date)<:from_date) AND drcr=:drcr', array('acc_id'=>$row->acc_id,':start_date'=>$start_date,':from_date'=>$from_date,':drcr'=>'dr'))
			->queryRow();
			$open_debit=$command->amount;
				
	
			$command= Yii::app()->db->createCommand()->setFetchMode(PDO::FETCH_OBJ)
			->select('sum(IFNULL(amount,0)) amount')
			->from('journal')
			->where('acc_code=:acc_id AND voucher_id IN (select voucher_id from voucher where date(voucher_date)>=:start_date and date(voucher_date)<:from_date) AND drcr=:drcr', array('acc_id'=>$row->acc_id,':start_date'=>$start_date,':from_date'=>$from_date,':drcr'=>'cr'))
			->queryRow();
			$open_credit=$command->amount;
	
			$start_balance=$start_balance+$open_debit-$open_credit;
			//select @openDebit=isnull(sum(Amount),0) from Journal where AccId=@accID and vid in(select vid from voucher where vdate>=@dtStart and vdate < @dtFrom) and DRCR='D'
			//select @openCredit=isnull(sum(Amount),0) from Journal where AccId= @accID  and vid in(select vid from voucher where vdate>=@dtStart and vdate < @dtFrom) and DRCR='C'
			//set @startBalance=@startBalance+@openDebit-@openCredit
	
			$command= Yii::app()->db->createCommand()->setFetchMode(PDO::FETCH_OBJ)
			->select('sum(IFNULL(amount,0)) amount')
			->from('journal')
			->where('acc_code=:acc_id AND voucher_id IN (select voucher_id from voucher where date(voucher_date)>=:from_date and date(voucher_date)<=:to_date) AND drcr=:drcr', array('acc_id'=>$row->acc_id,':from_date'=>$from_date,':to_date'=>$to_date,':drcr'=>'dr'))
			->queryRow();
			$range_debit=$command->amount;
	
			$command= Yii::app()->db->createCommand()->setFetchMode(PDO::FETCH_OBJ)
			->select('sum(IFNULL(amount,0)) amount')
			->from('journal')
			->where('acc_code=:acc_id AND voucher_id IN (select voucher_id from voucher where date(voucher_date)>=:from_date and date(voucher_date)<=:to_date) AND drcr=:drcr', array('acc_id'=>$row->acc_id,':from_date'=>$from_date,':to_date'=>$to_date,':drcr'=>'cr'))
			->queryRow();
			$range_credit=$command->amount;
			$range_balance=$range_debit-$range_credit;
	
			//select @rangeDebit=isnull(sum(Amount),0) from Journal where AccId=@accID and vid in(select vid from voucher where vdate>=@dtFrom and vdate <=@dtTo) and DRCR='D'
			//select @rangeCredit=isnull(sum(Amount),0) from Journal where AccId=@accID and vid in(select vid from voucher where vdate>=@dtFrom and vdate <=@dtTo) and DRCR='C'
			//set @rangeBalance = @rangeDebit - @rangeCredit
	
	
	
			$upto_balance=$start_balance;
			$tran_balance=$range_balance;
			$balance=$upto_balance+$tran_balance;
			$data[$key]=array('acc_id'=>$row->acc_id,'name'=>$row->name,'upto_balance'=>$upto_balance,'tran_balance'=>$tran_balance,'balance'=>$balance,'student_id'=>$student->student_id,'student_name'=>$student->student_name,'roll_no'=>$student->roll_no,'class_id'=>$student->class_id,'group'=>$student->group);
	
	
		}
	
		return $data;
	}	



}

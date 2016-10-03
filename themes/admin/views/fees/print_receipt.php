<html>
<head>
<title><?php  echo  $title ?></title>
<link rel="stylesheet" type="text/css" href="<?php  echo Yii::app()->request->baseUrl;?>/css/print-receipt.css" media="screen, print, projection" />
</head>
<body>

<div id="pcr">


<table class="table table-bordered table-main">
	<tr>
		<td colspan=3 class="text-left padding-left padding-right" style="border-bottom:1px solid #000;height:80px">
		<table>
			<tr>
				<td rowspan=2>  <img src="<?php echo InstitutionConfigurations::ins_logo() ?>" style="width:80px; height:60px "> </td>
				<td class="text-left org-title"><?php echo InstitutionConfigurations::model()->findByAttributes(array('id'=>1))->config_value; ?></td>
			</tr>
			<tr><td class="text-left org-address"><?php echo InstitutionConfigurations::model()->findByAttributes(array('id'=>3))->config_value; ?></td></tr>
		</table>
		</td>
	</tr>
	<tr>
		<th colspan=3 class="border-none"> 
			Fees Receipt
		</th>
	</tr>
	<tr>
		<td class="text-left padding-left"><?php echo "<b>Student No : </b>". $model->student_id;?></td>
		<td></td>
		<td class="text-right padding-right"><?php echo "<b>Receipt Date : </b>". date("d-M-Y",strtotime( $fc_obj->payment_date)); ?></td>
	</tr>
	<tr>
		<td colspan=3 class="text-left padding-left"><?php  echo "<b>Name : </b>".$model->name;?></td>
	</tr>
	<tr>
		<td colspan=3 class="text-left padding-left"><?php echo "<b>Class : </b>".$model->class_name ?></td>
	</tr>
	<tr>
		<td class="text-left padding-left"><?php echo "<b>Group : </b>". ucfirst($model->group);; ?></td>
		<td></td>
		<td></td>
	</tr>
	<tr>
	<td colspan=3 class="text-left padding-left"><?php echo "<b>Section : </b>".$model->section_name ?></td>
	</tr>
	<tr>
		<th colspan=3 style="padding:1%;" class="border-none"><?php echo "Fees Collection Details"; ?></th>
	</tr>
	<!-----Start fees collection category fees details description---->
	<tr>
		<td colspan=3 class="padding-left padding-right">
		<?php 
		$due_amount=0;
		if(($acc_status['balance'])>0 )
		{
		
			$due_amount=number_format($acc_status['balance']+$fc_obj->amount,2,'.','') ;
		
		}
		 ?>
		<table border="1" class="table table-border" style="width:100%;">
			<tr class="header">
				<th>Recepit No</th>
				<th>Remark</th>
				<th>Payment Mode</th>
			</tr>
			
			<tr>
				<td class="text-center"><?php echo $fc_obj->receipt_no ; ?></td>	
				<td class="text-center"><?php echo $fc_obj->remark; ?></td>	
				<td class="text-center"><?php echo $fc_obj->payment_mode=='1'?'Cash':'Bank';  ?></td>	
		    </tr>
		
			<tr>
				<th class="text-right border-hide padding-right" colspan=2>Total Amount Due</th>
				<th><?php echo number_format($due_amount,2,'.','');?></th>
			</tr>
			<tr>
				<th class="text-right border-hide padding-right" colspan=2>Total Paid Fees</th>
				<th><?php echo number_format($fc_obj->amount,2,'.','');?></th>
			</tr>
			<tr>
				<th class="text-right border-hide padding-right" colspan=2>Total Unpaid Fees</th>
				<th><?php if($acc_status['balance']>0)
								{
								
								echo number_format($acc_status['balance'],2,'.','') ;
																								
								} 
								else{
								echo number_format(0,2,'.','') ;	
								}
								
								?>
		        </th>
			</tr>
		</table>
		</td>
	</tr>
	<!---End fees collection category fees details description--->
	<!---Start payment history of this category--->
	<tr>
		<th class="border-none text-left padding-left" colspan=3 style="height:50px">Payment History</th>
	</tr>
	<tr>
		<td colspan=3 class="padding-left padding-right" style="padding-bottom:2%;">
		<?php 
		$colection_record=FeeCollection::std_collection_history($model->student_id);	
		?>
		<table class="table table-border" style="width:100%;">
			<tr class="header">
				<th>SI.No</th>
				<th>Recepit No</th>
				<th>Date</th>
				<th>Payment mode</th>
			
				<th>Amount</th>
			</tr>
			
			
				<?php foreach($colection_record as $key=>$row) {
				echo '<tr>';
				echo '<td class="text-center">'.($key+1).'</td>';
				echo '<td class="text-center">'.$row->receipt_no.'</td>';
				echo '<td class="text-center">'.date("d-M-Y",strtotime( $row->payment_date)).'</td>';		
				echo '<td class="text-center">'.(($row->payment_mode==1) ? "Cash" : "Bank").'</td>';
				echo '<td class="text-center">'.$row->amount.'</td>';
				echo '</tr>';
		      } ?>
	
		</table>
		</td>
	</tr>
	<!----End payment history of this category---->
	<!----------Start footer signation------------>
	<tr>
		<td colspan=3 class="text-right vcenter" style="height:80px;padding-right:12%;font-weight:bold;border-top:1px solid #000;">
			Signature :
		</td>
	</tr>
	<!----------End footer signation------------>
	

</table>
</div>
</body>
</html>

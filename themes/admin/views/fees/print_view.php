<script>
    window.opener.document.getElementById("row_"+<?php echo $model->student_id ?>).style.display="none";
</script>
<?php
$this->breadcrumbs=array(
		'Fees'=>array(''),
		'Fees Collection'=>array('feesPayment'),
		$model->name,
		'Print View',
);
?>
<div class="row">


	<div class="col-md-12">
		<div class="panel">
			<div class="panel-heading">
				<span class="panel-title">Fees Collection</span>
			</div>
			<div class="panel-body">		

				<div class="row">
			    					<div class="col-md-3">
			     <?php if(empty($model->img_file_name)) {?>
				<div class="fileupload fileupload-new admin-form"
					data-provides="fileupload">
					<div class="fileupload-preview thumbnail mb20">
						<img data-src="holder.js/100%x140" alt="100%x140"
							style="height: 220px; width: 100%; display: block;"
							src=""
							data-holder-rendered="true">
					</div>				
				</div>
				<?php } else {?>
				<div class="fileupload fileupload-new admin-form"
					data-provides="fileupload">
					<div class="fileupload-preview thumbnail mb20">
						<img
							style="height: 220px; width: 100%; display: block;"
							src="<?php echo Yii::app()->baseUrl.'/uploadedfiles/student/'.$model->student_id.'/'.$model->img_file_name?>"
							data-holder-rendered="true">
					</div>				
				</div>
				
				<?php } ?>
			</div>
			<div class="col-md-9">
				<h2>
					<?php echo $model->name ?>
					<small>Profile</small>
				</h2>
					<table class="table table-hover table-bordered  table-striped ">
				
						<tr>

							<th  width="50%">Class </th>
							<td  width="50%"><?php echo $model->class_name?></td>
						</tr>
						<tr>	
							<th>Section</th>
							<td><?php echo $model->section_name ?></td>
							
						</tr>
						<tr>	
							<th>Group</th>
							<td><?php echo ucfirst($model->group); ?></td>
							
						</tr>
						<tr>	
							<th>Roll No</th>
							<td><?php echo $model->roll_no ?></td>
							
						</tr>
						<tr>	
							<th>Year</th>
							<td><?php echo $model->year_name ?></td>
							
						</tr>
					</table>	
			</div>
			
			
			<div class="col-md-12">
				<h2 class="page-header mtn"> Payment  Details </h2>
				<table class="table table-hover table-bordered   ">
				
						<tr>

							<th  width="50%"> Amount</th>
							<td  width="50%"><?php echo number_format($fc_obj->amount,2,'.','') ; ?> </td>
						</tr>
						<tr>

							<th  width="50%">Recepit No </th>
							<td  width="50%"><?php echo $fc_obj->receipt_no ; ?> </td>
						</tr>
						<tr>
						   <th>Payment Date </th>
						   <td><?php echo date("d-M-Y",strtotime( $fc_obj->payment_date)) ; ?></td>
						</tr>
						
							<tr>
						   <th>Payment Mode </th>
						   <td><?php echo $fc_obj->payment_mode=='1'?'Cash':'Bank'; ?></td>
						</tr>
				

					
				</table>
				<br>
				
			</div>
			<div class="col-md-12">
				
				<div class="pull-right">
					<table class="table ">
						
							<tr>
								<td><b>Total Amount Due </b></td>
								<td><?php 
								if(($acc_status['balance']+$fc_obj->amount)>0 )
								{
								
									echo number_format($acc_status['balance']+$fc_obj->amount,2,'.','') ;
																								
								}
								else{
									echo number_format(0,2,'.','') ;
								}
								?> 
								</td>
							</tr>
						
					
							<tr>
								<td><b>Total Paid Fees</b></td>
								<td><?php echo number_format($fc_obj->amount,2,'.','') ; ?></td>
							</tr>
							<tr class="warning">
								<td><b>Balance Due</b>
								</td>
								<td>
								<?php 
								if(($acc_status['balance'])>0 )
								{
								
									echo number_format($acc_status['balance'],2,'.','') ;
																								
								}
								else{
									echo number_format(0,2,'.','') ;
								}
								?> 
								</td>
							</tr>
						
					</table>
				</div>
				<div class="clearfix"></div>
				<div class="invoice-buttons">								
				  <?php echo CHtml::link('<i class="fa fa-print pr5"></i>Print receipt',array('/fees/printreceipt','sid'=>$fc_obj->student_id,'fcid'=>$fc_obj->id),array('class'=>'btn btn-primary','target'=>'_blank')); ?>
				</div>
			</div>
		


				</div>
			</div>
		</div>
	</div>

</div>


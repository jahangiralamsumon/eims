<?php
/* @var $this AllowProductController */
/* @var $model AllowProduct */
/* @var $form CActiveForm */
$this->breadcrumbs=array(
		'Accounts'=>array(''),
		'Reports'=>array(''),
		'Daily Voucher',
);

?>
<div class="row">
       <?php if(!isset($vouchers)):?>
     <div class="col-md-12">
		<?php $form=$this->beginWidget('booster.widgets.TbActiveForm',array(
				'id'=>'daily-voucher-form',
				'type' => 'horizontal',
				'enableAjaxValidation'=>false,
)); ?>

		<div class="panel">
			<div class="panel-heading">
				<span class="panel-title"> Daily Voucher </span>
			</div>
			<div class="panel-body">
				<p class="help-block">
					Fields with <span class="required">*</span> are required.
				</p>

				<?php echo $form->errorSummary($model); ?>

			
				<?php echo $form->datePickerGroup($model,'date',array(
						'wrapperHtmlOptions' => array(
						'class' => 'col-sm-4',
						),'widgetOptions'=>array('options'=>array('dateFormat' => 'yy-mm-dd','changeMonth'=>true,
        'changeYear'=>true,'yearRange'=>'1950:2050',),'htmlOptions'=>array('class'=>'span5')), 'prepend'=>'<i class="glyphicon glyphicon-calendar"></i>')); ?>
			
				<div class="form-actions">
					<?php $this->widget('booster.widgets.TbButton', array(
							'buttonType'=>'submit',
							'context'=>'primary',
							'label'=>'View',
		)); ?>
				</div>
			</div>

		</div>
		<?php $this->endWidget(); ?>
	</div>
     <?php endif;?>
    <?php if(isset($vouchers)):?>
	<div class="col-md-12">	    
		<div class="panel">
		  	<div class="panel-heading">
						<span class="panel-title"> Daily Voucher </span>
					</div>
			<div class="panel-body">
			      <div class="invoice-buttons">
				    <a href="javascript:window.print()" class="btn btn-default mr10"><i
						class="fa fa-print pr5"></i> Print</a>
				 </div>
				
				<h2 style="text-align: center;"> Daily Voucher <small>(<?php echo date("d-M-Y",strtotime($model->date)) ?> )</small></h2>
				
				<table class="table table-bordered ">
					<tr>
						<th>Date</th>
						<th>Voucher NO</th>
						<th>Account</th>
						<th>Debit</th>
						<th>Credit</th>
						<th>Naration</th>
					</tr>

					<?php foreach ($vouchers as $key=>$row):

					?>
					<tr>

						<?php   
						if($key>0){
						 if($vouchers[$key]['voucher_id']!= $vouchers[$key-1]['voucher_id']){
                         $cmd=Yii::app()->db->createCommand()->setFetchMode(PDO::FETCH_OBJ)
                         ->select('COUNT(DISTINCT(acc_code)) num')
                         ->from('journal j')
                         ->where('voucher_id=:voucher_id',array(':voucher_id'=>$row['voucher_id']));
                         $num=$cmd->queryRow()->num;
                         ?>
						<td rowspan="<?php echo $num;?>"><?php echo date("d-M-y",strtotime($row['voucher_date']))?>
						</td>
						<td rowspan="<?php echo $num;?>"><?php echo $row['voucher_no']?></td>
						<?php 
						 }
						}
						if($key==0){
						$cmd=Yii::app()->db->createCommand()->setFetchMode(PDO::FETCH_OBJ)
						 ->select('COUNT(DISTINCT(acc_code)) num')
						->from('journal j')
						->where('voucher_id=:voucher_id',array(':voucher_id'=>$row['voucher_id']));
						$num=$cmd->queryRow()->num;
						?>
						<td rowspan="<?php echo $num; ?>"><?php echo date("d-M-y",strtotime($row['voucher_date']))?>
						</td>
                        <td rowspan="<?php echo $num;?>"><?php echo $row['voucher_no']?></td>
						<?php 
						}

						?>
						
						<td><?php echo $row['name']?></td>
						<td><?php echo $row['drcr']=='dr'?$row['amount']:''?></td>
						<td><?php echo $row['drcr']=='cr'?$row['amount']:''?></td>
						<?php   
						if($key>0){
						 if($vouchers[$key]['voucher_id']!= $vouchers[$key-1]['voucher_id']){
                         ?>
						<td rowspan="<?php echo $num;?>">
						<?php echo $row['particulars']?>
						</td>
						<?php 
							}
						}
						if($key==0){
					   ?>
						<td rowspan="<?php echo $num;?>">
						<?php echo $row['particulars']?>
						</td>

						<?php }

						?>
					</tr>
					<?php endforeach; ?>
				</table>
			</div>
		</div>
	</div>
	<?php endif;?>
</div>


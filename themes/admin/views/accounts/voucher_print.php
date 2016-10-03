<?php
/* @var $this AllowProductController */
/* @var $model AllowProduct */
/* @var $form CActiveForm */
$this->breadcrumbs=array(
		'Accounts'=>array(''),
		'Voucher Print',
);

?>
<div class="row">
	<div class="col-md-12">
		<div class="panel">
			<div class="panel-heading">
				<span class="panel-title">All Voucher</span>
			</div>
			<div class="panel-body">
				<div class="form">
					<?php $form=$this->beginWidget('CActiveForm', array(
							'id'=>''
)); ?>
					<table class="table table-bordered">
						<tr>
							<th>From date</th>
							<th>To Date</th>
						</tr>
						<tr>
							<td>
								<div class="col-sm-5">
									<?php
									$this->widget('zii.widgets.jui.CJuiDatePicker', array(
    'name'=>'voucher_view[from_date]',

		// additional javascript options for the date picker plugin
    'options'=>array(
        'showAnim'=>'fold',
   		'dateFormat' => 'yy-mm-dd',
		'changeMonth'=> true,
		'changeYear'=> true,
		),
    'htmlOptions'=>array(
        'class'=>'form-control '
        ),
        'value'=>$from_date,
        ));

        ?>
								</div>
							</td>
							<td>
								<div class="col-sm-5">
									<?php
									$this->widget('zii.widgets.jui.CJuiDatePicker', array(
    'name'=>'voucher_view[to_date]',
		// additional javascript options for the date picker plugin
    'options'=>array(
        'showAnim'=>'fold',
  		'dateFormat' => 'yy-mm-dd',
		'changeMonth'=> true,
		'changeYear'=> true,
		''
		),
    'htmlOptions'=>array(
         'class'=>'form-control'
        ),
        'value'=>$to_date,
        ));
        ?>
								</div>
							</td>
						</tr>
					</table>
					<br>

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
		<?php if(isset($vouchers)):?>
		<div class="panel">
			<div class="panel-body">
				<table class="table table-bordered ">
					<tr>
						<th>Date</th>
						<th>Voucher NO</th>
						<th>Account</th>
						<th>Debit</th>
						<th>Credit</th>
						<th>Action</th>
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
						<td rowspan="<?php echo $num;?>"><?php echo CHtml::link('Print',array('VoucherPrintView','id'=>$row['voucher_id']),array('class'=>'btn btn-default','target'=>'_blank')); ?>
						</td>
						<?php 
							}
						}
						if($key==0){
					   ?>
						<td rowspan="<?php echo $num;?>"><?php echo CHtml::link('Print',array('VoucherPrintView','id'=>$row['voucher_id']),array('class'=>'btn btn-default','target'=>'_blank')); ?>
						</td>

						<?php }

						?>
					</tr>
					<?php endforeach; ?>
				</table>
			</div>
		</div>
		<?php endif;?>
	</div>
</div>


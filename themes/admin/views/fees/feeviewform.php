<?php
$this->breadcrumbs=array(
		'Fees'=>array(''),
		'Monthly Fees',
);
?>
<div class="row">
	<?php $form=$this->beginWidget('booster.widgets.TbActiveForm',array(
			'id'=>'fee-view-form',
			'type' => 'horizontal',
			'enableAjaxValidation'=>false,
)); ?>
	<div class="col-md-12">
		<div class="panel">
			<div class="panel-heading">
				<span class="panel-title">Fee Details</span>
			</div>
			<div class="panel-body">
				<p class="help-block">
					Fields with <span class="required">*</span> are required.
				</p>

				<?php echo $form->errorSummary($model); ?>

				<?php echo $form->textFieldGroup($model,'student_id',array(
						'wrapperHtmlOptions' => array(
						'class' => 'col-sm-5',
						),
					'widgetOptions'=>array('htmlOptions'=>array('class'=>'span5','maxlength'=>15)
				))); ?>

				<?php echo $form->dropDownListGroup(
						$model,
						'month',
						array(
						'wrapperHtmlOptions' => array(
						'class' => 'col-sm-5',
						),
						'widgetOptions' => array(
						'data' =>FeeGenForm::months(),
						'htmlOptions' =>array('empty' => 'Select Month','class'=>'span2'),

						)
					)
				);
				?>

				<?php echo $form->dropDownListGroup(
						$model,
						'year',
						array(
						'wrapperHtmlOptions' => array(
						'class' => 'col-sm-5',
						),
						'widgetOptions' => array(
						'data' =>FeeGenForm::years(),
						'htmlOptions' =>array('empty' => 'Select Year','class'=>'span2'),

						)
					)
				);
				?>


				<div class="form-actions">
					<?php $this->widget('booster.widgets.TbButton', array(
							'buttonType'=>'submit',
							'context'=>'primary',
							'label'=>'View',
		)); ?>
				</div>
			</div>
		</div>
	</div>
	<?php $this->endWidget(); ?>

	<?php if(isset($result)):?>


</div>

<div class="panel invoice-panel">
	<div class="panel-heading">
		<span class="panel-title"> <span class="glyphicon glyphicon-print"></span>
			Monthly Fees
		</span>
		<div class="panel-header-menu pull-right mr10">
			<a href="javascript:window.print()"
				class="btn btn-xs btn-default btn-gradient mr5"> <i
				class="fa fa-print fs13"></i>
			</a>

		</div>
	</div>
	<div class="panel-body p20" id="invoice-item">

		<div class="row" id="invoice-info">
			<div class="col-md-6">
				<div class="panel panel-alt">
					<div class="panel-heading">
						<span class="panel-title"> <i class="fa fa-user"></i> Student Info
						</span>
					</div>
					<div class="panel-body">
						<table class="table table-bordered">
						   	<tr>
								<th>ID</th>
								<td><?php echo $result['2']->student_id;?></td>
							</tr>
							<tr>
								<th>Student Name</th>
								<td><?php echo $result['2']->name;?></td>
							</tr>
						
						</table>
					</div>
				</div>
			</div>

			<div class="col-md-6">
				<div class="panel panel-alt">
					<div class="panel-heading">
						<span class="panel-title"> <i class="fa fa-info"></i> Fees Details
						</span>
						<div class="panel-btns pull-right ml10"></div>
					</div>
					<div class="panel-body">
					
					<table class="table table-bordered">
							<tr>
								<th>Fees Track no #:</th>
								<td><?php echo $result[1][0]['fee_id'] ?></td>
							</tr>
							<tr>
								<th>Fees Month:</th>
								<td><?php echo $result[0]['fees_month'] ?></td>
							</tr>
						</table>
						
					</div>
				</div>
			</div>
		</div>
		<div class="row" id="invoice-table">
			<div class="col-md-12">
				<table class="table table-striped">
					<thead>
						<tr>
							<th><b>#</b></th>
							<th><b>Particulars</b></th>
							<th><b>Amount</b></th>
							
						</tr>
					</thead>
					<tbody>
						<?php
						$total=0;
						foreach ($result[1] as $key=>$row):?>
						<tr>
							<td><b><?php echo $key+1 ;?> </b></td>
							<td><?php echo $row['name']?></td>
							<td><?php echo $row['amount'];
                             $total=$total+$row['amount'];
							?></td>

						
						<tr>
							<?php endforeach; ?>
					
					</tbody>
				</table>
			</div>
		</div>
		<div class="row" id="invoice-footer">
			<div class="col-md-12">
				<div class="pull-left mt20 fs15 text-primary">This is Computer
					Generated.</div>
				<div class="pull-right">
					<table class="table" id="invoice-summary">
						<thead>
							<tr>
								<th><b>Arrears</b>
								</th>
								<th> <?php echo number_format($result[0]['arrears'],2,'.','')?></th>
							</tr>
						</thead>
						<tbody>
							<tr>
								<td><b>Current Month Fee</b>
								</td>
								<td><?php echo  number_format($total,2,'.',''); ?></td>
							</tr>
							<tr>
								<td><b>Balance Due:</b>
								</td>
								<td>
					<?php

					$total_amount=number_format(($total+$result[0]['arrears']),2,'.','');
					if($total_amount<0){
                	echo $total_amount*-1;
					echo '(Credit)';
					}
					else if($total_amount>0){
               		 echo $total_amount;
					echo '(Debit)';
				}
				?>
								</td>
							</tr>
						</tbody>
					</table>
				</div>
				<div class="clearfix"></div>
				<div class="invoice-buttons">
					<a href="javascript:window.print()" class="btn btn-default mr10"><i
						class="fa fa-print pr5"></i> Print</a>
					<button class="btn btn-primary btn-gradient" type="button">
						<i class="fa fa-floppy-o pr5"></i> Save
					</button>
				</div>
			</div>
		</div>

	</div>
</div>
<?php endif;?>

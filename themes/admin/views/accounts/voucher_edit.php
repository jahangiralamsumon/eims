<?php
$this->breadcrumbs=array(
		'Accounts'=>array('index'),
		'Voucher  Edit',
);
?>
<div class="row">
	<div class="col-md-12">
		<?php $form=$this->beginWidget('booster.widgets.TbActiveForm',array(
				'id'=>'voucher-edit-form',
				'type' => 'horizontal',
				'enableAjaxValidation'=>false,
)); ?>

		<div class="panel">
			<div class="panel-heading">
				<span class="panel-title">Voucher Edit</span>
			</div>
			<div class="panel-body">
				<p class="help-block">
					Fields with <span class="required">*</span> are required.
				</p>

				<?php if(Yii::app()->user->hasFlash('success')):?>

				<?php $this->widget('booster.widgets.TbAlert', array(
						'fade'=>true, // use transitions?
						'closeText'=>'&times;', // close link text - if set to false, no close link is displayed
						'alerts'=>array( // configurations per alert type
            'success'=>array('block'=>true, 'fade'=>true, 'closeText'=>'&times;'), // success, info, warning, error or danger
       		 ),
   		 )); ?>

				<?php echo Yii::app()->user->getFlash('success'); ?>

				<?php endif; ?>

				<?php  echo $form->errorSummary($model); ?>
				<?php foreach ($records as $key=>$row) :?>
				<div class="col-md-6">
					<div class="form-group">
						<label class="col-lg-3 control-label">Debit Account</label>
						<div class="col-lg-8">
							<p class="form-control-static text-muted">
								<?php echo AccHead::acc_head_name($row->acc_code) ?>
								<?php echo CHtml::activeHiddenField($model,'acc_code['.$key.']',array('value'=>$row->acc_code)); ?>
							</p>
						</div>
					</div>


					<div class="form-group">
						<label class="col-lg-3 control-label"
							for="VoucherEntryForm_amount_<?php echo $key ?>">Amount</label>
						<div class="col-lg-8">
							<?php echo CHtml::activeTextField($model,'amount['.$key.']',array('class'=>'form-control','value'=>$row->amount)); ?>
							<?php echo $form->error($model,'amount['.$key.']'); ?>
						</div>
					</div>




					<div class="form-group">
						<label class="col-lg-3 control-label"
							for="VoucherEntryForm_particular_<?php echo $key ?>">Particular</label>
						<div class="col-lg-8">
							<?php echo CHtml::activetextArea($model,'particular['.$key.']',array('class'=>'form-control','value'=>$row->particular)); ?>
							<?php echo $form->error($model,'particular['.$key.']'); ?>
						</div>
					</div>

				</div>
				<div class="col-md-6">
					<div class="form-group">
						<label class="col-lg-3 control-label">Credit Account</label>
						<div class="col-lg-8">
							<p class="form-control-static text-muted">
								<?php echo AccHead::acc_head_name($row->drcr_id) ?>
								<?php echo CHtml::activeHiddenField($model,'drcr_id['.$key.']',array('value'=>$row->drcr_id)); ?>
							</p>
						</div>
					</div>

				</div>
				<div class="clearfix"></div>
				<?php endforeach; ?>
				<div class="form-actions">
					<?php $this->widget('booster.widgets.TbButton', array(
							'buttonType'=>'submit',
							'context'=>'primary',
							'label'=>'Save',
		)); ?>
				</div>
			</div>

		</div>
		<?php $this->endWidget(); ?>
	</div>
</div>

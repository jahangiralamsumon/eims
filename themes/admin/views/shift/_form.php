<?php $form=$this->beginWidget('booster.widgets.TbActiveForm',array(
		'id'=>'shift-form',
		'enableAjaxValidation'=>false,
)); ?>

<div class="panel">
	<div class="panel-heading">
		<span class="panel-title">Shift Details</span>
	</div>
	<div class="panel-body">
		<p class="help-block">
			Fields with <span class="required">*</span> are required.
		</p>

		<?php echo $form->errorSummary($model); ?>


		<?php echo $form->textFieldGroup($model,'shift_code',array('widgetOptions'=>array('htmlOptions'=>array('class'=>'span5','maxlength'=>45)))); ?>

		<?php echo $form->textFieldGroup($model,'shift_name',array('widgetOptions'=>array('htmlOptions'=>array('class'=>'span5','maxlength'=>45)))); ?>

		<div class="form-actions">
			<?php $this->widget('booster.widgets.TbButton', array(
					'buttonType'=>'submit',
					'context'=>'primary',
					'label'=>$model->isNewRecord ? 'Create' : 'Save',
		)); ?>
		</div>

	</div>
</div>
<?php $this->endWidget(); ?>

<?php $form=$this->beginWidget('booster.widgets.TbActiveForm',array(
	'id'=>'sms-settings-form',
	'enableAjaxValidation'=>false,
	'type' => 'horizontal',
)); ?>
<div class="panel">
			<div class="panel-heading">
				<span class="panel-title">SMS Setup Details</span>
			</div>
			<div class="panel-body">
<p class="help-block">Fields with <span class="required">*</span> are required.</p>

<?php echo $form->errorSummary($model); ?>

	<?php echo $form->textFieldGroup($model,'settings_key',array(
			'wrapperHtmlOptions' => array('class' => 'col-sm-5',),
			'widgetOptions'=>array('htmlOptions'=>array('readonly'=>$model->isNewRecord ? '' : 'readonly','class'=>'span5','maxlength'=>255)))); ?>

	<?php echo $form->checkBoxGroup($model,'is_enabled',array('widgetOptions'=>array('htmlOptions'=>array('class'=>'span5','value'=>1)))); ?>

	
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

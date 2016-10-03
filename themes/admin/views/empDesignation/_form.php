<?php $form=$this->beginWidget('booster.widgets.TbActiveForm',array(
	'id'=>'emp-designation-form',
	'type' => 'horizontal',
	'enableAjaxValidation'=>false,
)); ?>
<div class="panel">
			<div class="panel-heading">
				<span class="panel-title">Designation Details</span>
			</div>
			<div class="panel-body">
<p class="help-block">Fields with <span class="required">*</span> are required.</p>

<?php echo $form->errorSummary($model); ?>
	
	<?php echo $form->textFieldGroup(
			$model,
			'designation_name',
			array(
				'wrapperHtmlOptions' => array(
					'class' => 'col-sm-5',
				),
               'htmlOptions'=>array('class'=>'span5','maxlength'=>100)
			)
		); ?>
	<?php echo $form->numberFieldGroup(
			$model,
			'designation_order',
			array(
				'wrapperHtmlOptions' => array(
					'class' => 'col-sm-4',
				),
               'htmlOptions'=>array('class'=>'span5',)
			)
		); ?>

<div class="form-actions">
	<?php $this->widget('booster.widgets.TbButton', array(
			'buttonType'=>'submit',
			'context'=>'primary',
			'label'=>$model->isNewRecord ? 'Add' : 'Save',
		)); ?>
</div>

<?php $this->endWidget(); ?>
</div>
</div>
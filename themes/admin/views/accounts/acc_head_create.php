<?php
$this->breadcrumbs=array(
		'Accounts'=>array('index'),
		'Settings'=>array('manageacchead'),
		'Acc Head Create',
);
?>
<div class="panel">
			<div class="panel-heading">
				<span class="panel-title">Create Account Head</span>
			</div>
			<div class="panel-body">
<?php $form=$this->beginWidget('booster.widgets.TbActiveForm',array(
	'id'=>'acc-head-form',
	'enableAjaxValidation'=>false,
		'type' => 'horizontal',
)); ?>

<p class="help-block">Fields with <span class="required">*</span> are required.</p>

<?php echo $form->errorSummary($model); ?>

	<?php echo $form->textFieldGroup(
			$model,
			'name',
			array(
				'wrapperHtmlOptions' => array(
					'class' => 'col-sm-4',
				),
               'htmlOptions'=>array('class'=>'span5','maxlength'=>200)
			)
		); ?>


<div class="form-actions">
	<?php $this->widget('booster.widgets.TbButton', array(
			'buttonType'=>'submit',
			'context'=>'primary',
			'label'=>$model->isNewRecord ? 'Create' : 'Save',
		)); ?>
</div>

<?php $this->endWidget(); ?>
</div>
</div>

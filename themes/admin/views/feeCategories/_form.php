<?php $form=$this->beginWidget('booster.widgets.TbActiveForm',array(
	'id'=>'fee-categories-form',
	'type' => 'horizontal',
	'enableAjaxValidation'=>false,
)); ?>
<div class="panel">
	<div class="panel-heading">
		<span class="panel-title">Fee Categories Details</span>
	</div>
	<div class="panel-body">
<p class="help-block">Fields with <span class="required">*</span> are required.</p>

<?php echo $form->errorSummary($model); ?>

	<?php echo $form->textFieldGroup($model,'name',array('widgetOptions'=>array('htmlOptions'=>array('class'=>'span5','maxlength'=>255)))); ?>

	<?php echo $form->textAreaGroup($model,'description', array('widgetOptions'=>array('htmlOptions'=>array('rows'=>6, 'cols'=>50, 'class'=>'span8')))); ?>
  <?php echo $form->dropDownListGroup(
								$model,
								'group_id',
								array(
						'wrapperHtmlOptions' => array(
						'class' => 'col-sm-5',
						),
						'widgetOptions' => array(
						'data' =>FeeCategories::Categories_group(),
						'htmlOptions' =>array('empty' => 'Select Category Group','class'=>'span2','disabled'=>$model->isNewRecord ? '' : 'disabled'),

						)
					)
						);
						?>

<div class="form-actions">
	<?php $this->widget('booster.widgets.TbButton', array(
			'buttonType'=>'submit',
			'context'=>'primary',
			'label'=>$model->isNewRecord ? 'Create' : 'Save',
		)); ?>
</div>
</div>
</div>
<?php $this->endWidget();?>

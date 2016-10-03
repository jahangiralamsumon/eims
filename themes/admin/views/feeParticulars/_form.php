<?php $form=$this->beginWidget('booster.widgets.TbActiveForm',array(
	'id'=>'fee-particulars-form',
	'type' => 'horizontal',
	'enableAjaxValidation'=>false,
)); ?>
<div class="panel">
	<div class="panel-heading">
		<span class="panel-title">Fee Particulars Details</span>
	</div>
	<div class="panel-body">
<p class="help-block">Fields with <span class="required">*</span> are required.</p>

<?php echo $form->errorSummary($model); ?>

	<?php echo $form->textFieldGroup($model,'name',array('widgetOptions'=>array('htmlOptions'=>array('class'=>'span5','maxlength'=>255)))); ?>

	<?php echo $form->textAreaGroup($model,'description', array('widgetOptions'=>array('htmlOptions'=>array('rows'=>6, 'cols'=>50, 'class'=>'span8')))); ?>

	<?php echo $form->textFieldGroup($model,'amount',array('widgetOptions'=>array('htmlOptions'=>array('class'=>'span5','maxlength'=>15)))); ?>

	<?php echo $form->dropDownListGroup(
								$model,
								'fee_category_id',
								array(
						'wrapperHtmlOptions' => array(
						'class' => 'col-sm-5',
						),
						'widgetOptions' => array(
						'data' => CHtml::listData(FeeCategories::Categories_array(),'id','name','group'),
						'htmlOptions' =>array('empty' => 'Select Fee Category','class'=>'span2'),

						)
					)
						);
						?>

	<?php echo $form->dropDownListGroup(
								$model,
								'class_id',
								array(
						'wrapperHtmlOptions' => array(
						'class' => 'col-sm-5',
						),
						'widgetOptions' => array(
						'data' => CHtml::listData(Classes::model()->byname()->findAll(),'class_id','class_name'),
						'htmlOptions' =>array('empty' => 'All','class'=>'span2'),

						)
					)
						);
						?>
 <?php echo $form->checkBoxGroup($model,'is_monthly',array('value'=>1,'hint'=>'Enabling this  will make the particulars is monthly fee.')); ?>						

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

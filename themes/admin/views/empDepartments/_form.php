<?php $form=$this->beginWidget('booster.widgets.TbActiveForm',array(
	'id'=>'emp-departments-form',
	'type' => 'horizontal',
	'enableAjaxValidation'=>false,
)); ?>
<div class="panel">
			<div class="panel-heading">
				<span class="panel-title">Department Details</span>
			</div>
			<div class="panel-body">
<p class="help-block">Fields with <span class="required">*</span> are required.</p>

<?php echo $form->errorSummary($model); ?>

<?php echo $form->textFieldGroup(
			$model,
			'name',
			array(
				'wrapperHtmlOptions' => array(
					'class' => 'col-sm-5',
				),
               'htmlOptions'=>array('class'=>'span5','maxlength'=>255)
			)
		); ?>
<?php echo $form->textFieldGroup(
			$model,
			'code',
			array(
				'wrapperHtmlOptions' => array(
					'class' => 'col-sm-5',
				),
               'htmlOptions'=>array('class'=>'span5','maxlength'=>255)
			)
		); ?>
	<?php echo $form->dropDownListGroup($model,'status', array('wrapperHtmlOptions' => array(
						'class' => 'col-sm-4',
						),'widgetOptions'=>array('data'=>array("1"=>"Active","0"=>"Incative"), 'htmlOptions'=>array('class'=>'input-large')))); ?>
	
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

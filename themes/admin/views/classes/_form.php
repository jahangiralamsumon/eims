		
<?php $form=$this->beginWidget('booster.widgets.TbActiveForm',array(
	'id'=>'classes-form',
	'enableAjaxValidation'=>false,
	'type' => 'horizontal',
)); ?>
<div class="panel">
			<div class="panel-heading">
				<span class="panel-title">Class Details</span>
			</div>
			<div class="panel-body">
<p class="help-block">Fields with <span class="required">*</span> are required.</p>

<?php echo $form->errorSummary($model); ?>
	
		
		<?php echo $form->textFieldGroup(
			$model,
			'class_name',
			array(
				'wrapperHtmlOptions' => array(
					'class' => 'col-sm-4',
				),
               'htmlOptions'=>array('class'=>'span5','maxlength'=>200)
			)
		); ?>
		
			<?php echo $form->dropDownListGroup(
								$model,
								'child_id',
								array(
						'wrapperHtmlOptions' => array(
						'class' => 'col-sm-5',
						),
						'widgetOptions' => array(
						'data' => CHtml::listData(Classes::model()->byid()->findAll(),'class_id','class_name'),
						'htmlOptions' =>array('empty' => 'Select Child Class','class'=>'span2'),

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

<?php $this->endWidget(); ?>
		
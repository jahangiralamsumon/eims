<?php $form=$this->beginWidget('booster.widgets.TbActiveForm',array(
	'id'=>'year-info-form',
		'type' => 'horizontal',
	'enableAjaxValidation'=>false,
)); ?>
<div class="panel">
	<div class="panel-heading">
		<span class="panel-title"><?php echo isset($panel_title)?$panel_title:''?> </span>
	</div>
	<div class="panel-body">
<p class="help-block">Fields with <span class="required">*</span> are required.</p>

<?php echo $form->errorSummary($model); ?>
	<?php echo $form->textFieldGroup($model,'name',array(
						'wrapperHtmlOptions' => array(
						'class' => 'col-sm-5',
						),
					'widgetOptions'=>array('htmlOptions'=>array('class'=>'span5','maxlength'=>300)
				))); ?>

	<?php echo $form->dateTimePickerGroup($model,'start_date',array(
						'wrapperHtmlOptions' => array(
						'class' => 'col-sm-4',
						),'widgetOptions'=>array('options'=>array('dateFormat' => 'yy-mm-dd',),'htmlOptions'=>array('class'=>'span5')), 'prepend'=>'<i class="glyphicon glyphicon-calendar"></i>')); ?>
	
	<?php echo $form->dateTimePickerGroup($model,'end_date',array(
						'wrapperHtmlOptions' => array(
						'class' => 'col-sm-4',
						),'widgetOptions'=>array('options'=>array('dateFormat' => 'yy-mm-dd',),'htmlOptions'=>array('class'=>'span5')), 'prepend'=>'<i class="glyphicon glyphicon-calendar"></i>')); ?>
	

	<?php echo $form->textAreaGroup($model,'description',array('widgetOptions'=>array('htmlOptions'=>array('class'=>'span5','maxlength'=>300)))); ?>

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

<?php $this->endWidget(); ?>
</div>
</div>

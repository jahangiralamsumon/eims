<?php $form=$this->beginWidget('booster.widgets.TbActiveForm',array(
	'id'=>'sms-templates-system-form',
	'enableAjaxValidation'=>false,
	'type' => 'horizontal',
)); ?>
<div class="panel">
			<div class="panel-heading">
				<span class="panel-title">SMS Template Details</span>
			</div>
			<div class="panel-body">
<p class="help-block">Fields with <span class="required">*</span> are required.</p>

<?php echo $form->errorSummary($model); ?>

	<?php echo $form->textFieldGroup($model,'title',array('wrapperHtmlOptions' => array('class' => 'col-sm-5',),'widgetOptions'=>array('htmlOptions'=>array('class'=>'span5','maxlength'=>500)))); ?>

	
   	<?php echo $form->textFieldGroup($model,'sms_key',array(
			'wrapperHtmlOptions' => array('class' => 'col-sm-5',),
			'widgetOptions'=>array('htmlOptions'=>array('readonly'=>$model->isNewRecord ? '' : 'readonly','class'=>'span5','maxlength'=>500)))); ?>
			
	<?php echo $form->textAreaGroup($model,'value', array('wrapperHtmlOptions' => array('class' => 'col-sm-7',),'widgetOptions'=>array('htmlOptions'=>array('rows'=>6, 'cols'=>50, 'class'=>'span8')))); ?>

	<?php echo $form->dropDownListGroup($model,'category', array('wrapperHtmlOptions' => array('class' => 'col-sm-5',), 'widgetOptions'=>array('data'=>array("employee"=>"employee","student"=>"student","parent"=>"parent",), 'htmlOptions'=>array('class'=>'input-large')))); ?>


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

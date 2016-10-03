<?php
$this->breadcrumbs=array(
	'Student'=>array('studentlist'),
	'Course Registration',
);
?>

<?php $form=$this->beginWidget('booster.widgets.TbActiveForm',array(
		'id'=>'sub-reg-form',
		'type' => 'horizontal',
		'enableAjaxValidation'=>false,
)); ?>
<div class="row">
<div class="col-md-12">
<div class="panel">
	<div class="panel-heading">
		<span class="panel-title">Course Registration</span>
	</div>
	<div class="panel-body">
		<p class="help-block">
			Fields with <span class="required">*</span> are required.
		</p>

			<?php if(Yii::app()->user->hasFlash('success')):?>

				<?php $this->widget('booster.widgets.TbAlert', array(
						'fade'=>true, // use transitions?
						'closeText'=>'&times;', // close link text - if set to false, no close link is displayed
						'alerts'=>array( // configurations per alert type
            'success'=>array('block'=>true, 'fade'=>true, 'closeText'=>'&times;'), // success, info, warning, error or danger
        ),
    )); ?>

				<?php echo Yii::app()->user->getFlash('success'); ?>


				<?php endif; ?>
		
		<?php echo $form->errorSummary($model); ?>

		
		    <?php echo $form->textFieldGroup($model,'student_id',array(
						'wrapperHtmlOptions' => array(
						'class' => 'col-sm-5',
						),
					'widgetOptions'=>array('htmlOptions'=>array('class'=>'span5',)
				))); ?>
		
		   

		<div class="form-actions">
			<?php $this->widget('booster.widgets.TbButton', array(
					'buttonType'=>'submit',
					'context'=>'primary',
					'label'=>'Submit',
		)); ?>
		</div>
	</div>
</div>
</div>

<?php $this->endWidget(); ?>
</div>
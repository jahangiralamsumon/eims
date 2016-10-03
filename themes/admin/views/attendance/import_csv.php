
<?php
$this->breadcrumbs=array(
		'Attendance'=>array('index'),
		'Import Attendance File',
);
?>


<div class="row">
	<div class="col-md-12">
		<div class="panel">
			<div class="panel-heading">
				<span class="panel-title">Import Attendance File</span>
			</div>
			<div class="panel-body">
				<p class="help-block">
					Fields with <span class="required">*</span> are required.
				</p>
				<?php $form=$this->beginWidget('booster.widgets.TbActiveForm',array(
						'id'=>'attendance-form',
						'type' => 'horizontal',
						'enableAjaxValidation'=>false,
						'htmlOptions'=>array('enctype' => 'multipart/form-data'),
						
)); ?>
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


				
					<div class="form-group">
							<?php echo $form->labelEx($model, 'csvfile',array('class'=>'col-sm-3 control-label')); ?>
							<div class="col-sm-6">
								<?php 
								echo $form->fileField($model, 'csvfile',array('class'=>'btn btn-success fileinput-button'));
								echo $form->error($model, 'csvfile');
								?>
							</div>
						</div>
				<?php echo $form->datePickerGroup($model,'date',array(
						'wrapperHtmlOptions' => array(
						'class' => 'col-sm-4',
						),'widgetOptions'=>array('options'=>array('dateFormat' => 'yy-mm-dd','changeMonth'=>true,
        'changeYear'=>true,'yearRange'=>'1950:2050',),'htmlOptions'=>array('class'=>'span5')), 'prepend'=>'<i class="glyphicon glyphicon-calendar"></i>')); ?>


				<div class="form-actions">
					<?php $this->widget('booster.widgets.TbButton', array(
							'buttonType'=>'submit',
							'context'=>'primary',
							'label'=>'Import',
		)); ?>
				</div>
				<?php $this->endWidget(); ?>
			</div>
		</div>
	</div>



</div>	
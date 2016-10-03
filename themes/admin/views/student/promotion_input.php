<?php
$this->breadcrumbs=array(
	'Student'=>array('studentlist'),
	'Promotion',
);
?>

<?php $form=$this->beginWidget('booster.widgets.TbActiveForm',array(
		'id'=>'std-promotion-form',
		'type' => 'horizontal',
		'enableAjaxValidation'=>false,
)); ?>
<div class="row">
<div class="col-md-12">
<div class="panel">
	<div class="panel-heading">
		<span class="panel-title">Class Promotion </span>
	</div>
	<div class="panel-body">
		<p class="help-block">
			Fields with <span class="required">*</span> are required.
		</p>

		
		<?php echo $form->errorSummary($model); ?>

		
		
		
		   	<?php echo $form->dropDownListGroup(
								$model,
								'class_id',
								array(
						'wrapperHtmlOptions' => array(
						'class' => 'col-sm-5',
						),
						'widgetOptions' => array(
						'data' => CHtml::listData(Classes::model()->findAll(),'class_id','class_name'),
						'htmlOptions' =>array('empty' => 'Select Class','class'=>'span2','ajax' => array(
							'type'=>'POST', //request type
							'url'=>CController::createUrl('site/dynamicYear'), //url to call
							'update'=>'#'.CHtml::activeId($model,'year_id')
						)),

						)
					)
						);
						?>
		   <?php echo $form->dropDownListGroup(
								$model,
								'year_id',
								array(
						'wrapperHtmlOptions' => array(
						'class' => 'col-sm-5',
						),
						'widgetOptions' => array(
						'data' => array(),
						'htmlOptions' =>array('empty' => 'Select Year','class'=>'span2'),

						)
					)
						);
						?>				

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
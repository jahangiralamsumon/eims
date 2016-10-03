<?php
$this->breadcrumbs=array(
	'Result'=>array('manage'),
	'Exam Result',
);
?>

<?php $form=$this->beginWidget('booster.widgets.TbActiveForm',array(
		'id'=>'result-view-form',
		'type' => 'horizontal',
		'enableAjaxValidation'=>false,
)); ?>
<div class="row">
<div class="col-md-12">
<div class="panel">
	<div class="panel-heading">
		<span class="panel-title">Student Result</span>
	</div>
	<div class="panel-body">
		<p class="help-block">
			Fields with <span class="required">*</span> are required.
		</p>

		
		<?php echo $form->errorSummary($model); ?>

		
		<?php echo $form->dropDownListGroup(
				$model,
				'year',
				array(
						'wrapperHtmlOptions' => array(
						'class' => 'col-sm-5',
						),
						'widgetOptions' => array(
						'data' => AcademicYearInfo::year_list(),
						'htmlOptions' =>array('empty' => 'Select Year','class'=>'span2'),

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
						'data' =>CHtml::listData(Classes::model()->findAll(),'class_id','class_name'),
						'htmlOptions' =>array('empty' => 'Select Class','class'=>'span2','ajax' => array(
						'type'=>'POST', //request type
						'url'=>CController::createUrl('site/dynamicExam'), //url to call
						'update'=>'#'.CHtml::activeId($model,'exam_id')
						)),

						)
					)
					);
				?>
		
		   
		
		<?php echo $form->dropDownListGroup(
				$model,
				'exam_id',
				array(
						'wrapperHtmlOptions' => array(
						'class' => 'col-sm-5',
						),
						'widgetOptions' => array(
						'data' =>$exam_data,
						'htmlOptions' =>array('empty' => 'Select Exam','class'=>'span2'),

						)
					)
		);
		?>
    
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
					'label'=>'View',
		)); ?>
		</div>
	</div>
</div>
</div>

<?php $this->endWidget(); ?>
</div>
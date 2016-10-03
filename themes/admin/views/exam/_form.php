<?php $form=$this->beginWidget('booster.widgets.TbActiveForm',array(
		'id'=>'exam-form',
		'type' => 'horizontal',
		'enableAjaxValidation'=>false,
)); ?>

<div class="panel">
	<div class="panel-heading">
		<span class="panel-title">Exam Details</span>
	</div>
	<div class="panel-body">

		<p class="help-block">
			Fields with <span class="required">*</span> are required.
		</p>

		<?php echo $form->errorSummary($model); ?>


		<?php echo $form->textFieldGroup($model,'name',array(
				'wrapperHtmlOptions' => array(
							'class' => 'col-sm-5',
				),
			'htmlOptions'=>array('class'=>'span5','maxlength'=>200))); ?>

		<?php echo $form->datePickerGroup($model,'start_date',array('wrapperHtmlOptions' => array(
				'class' => 'col-sm-5',
						),'widgetOptions'=>array('options'=>array('dateFormat' => 'yy-mm-dd'),'htmlOptions'=>array('class'=>'span5')), 'prepend'=>'<i class="glyphicon glyphicon-calendar"></i>',)); ?>

		<?php echo $form->datePickerGroup($model,'end_date',array('wrapperHtmlOptions' => array(
				'class' => 'col-sm-5',
						),'widgetOptions'=>array('options'=>array('dateFormat' => 'yy-mm-dd'),'htmlOptions'=>array('class'=>'span5')), 'prepend'=>'<i class="glyphicon glyphicon-calendar"></i>',)); ?>

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
		<?php echo $form->checkBoxGroup($model,'result_published',array('value'=>1,)); ?>						
		
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

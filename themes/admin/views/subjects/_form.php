<?php $form=$this->beginWidget('booster.widgets.TbActiveForm',array(
		'id'=>'subjects-form',
		'type' => 'horizontal',
		'enableAjaxValidation'=>false,
)); ?>

<div class="panel">
	<div class="panel-heading">
		<span class="panel-title">Subject Details</span>
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
			'htmlOptions'=>array('class'=>'span5','maxlength'=>255))); ?>

		<?php echo $form->textFieldGroup($model,'code',array(
				'wrapperHtmlOptions' => array(
							'class' => 'col-sm-5',
				),
			'htmlOptions'=>array('class'=>'span5','maxlength'=>255))); ?>

		<?php echo $form->dropDownListGroup(
				$model,
				'class_id',
				array(
						'wrapperHtmlOptions' => array(
						'class' => 'col-sm-5',
						),
						'widgetOptions' => array(
						'data' => CHtml::listData(Classes::model()->byname()->findAll(),'class_id','class_name'),
						'htmlOptions' =>array('empty' => 'Select Class','class'=>'span2','ajax' => array(
							'type'=>'POST', //request type
							'url'=>CController::createUrl('site/dynamicParentSubject'), //url to call
							'update'=>'#'.CHtml::activeId($model,'parent_sub_id')
					)),

						)
					)
		);
		?>


		<?php echo $form->dropDownListGroup(
				$model,
				'group_name',
				array(
						'wrapperHtmlOptions' => array(
						'class' => 'col-sm-5',
						),
						'widgetOptions' => array(
                         'data'=>Classes::group_option(),
						'htmlOptions' =>array('empty' =>'Select Group','class'=>'span2','ajax' => array(
		'type'=>'POST', //request type
		'url'=>CController::createUrl('site/dynamicParentSubject'), //url to call
		'update'=>'#'.CHtml::activeId($model,'parent_sub_id')
)),


						)
					)
		);
		?>
		<?php echo $form->checkBoxGroup($model,'is_elective',array('value'=>1,'hint'=>'Enabling this  will make the subject is elective.')); ?>

		<?php echo $form->dropDownListGroup(
				$model,
				'parent_sub_id',
				array(
						'wrapperHtmlOptions' => array(
						'class' => 'col-sm-5',
						),
						'widgetOptions' => array(
		                 'data'=>$parent_sub_data,
						'htmlOptions' =>array('empty' => 'Select Parent Subject','class'=>'span2'),

						)
					)
		);
		?>

		<div class="col-md-12">
			<h3>Mark Distribution</h3>
			<div class="col-md-4">
				<?php echo $form->textFieldGroup($model,'written',array('widgetOptions'=>array('htmlOptions'=>array('class'=>'span5',)))); ?>
			</div>
			<div class="col-md-4">
				<?php echo $form->textFieldGroup($model,'mcq',array('widgetOptions'=>array('htmlOptions'=>array('class'=>'span5')))); ?>
			</div>
			<div class="col-md-4">
				<?php echo $form->textFieldGroup($model,'practical',array('widgetOptions'=>array('htmlOptions'=>array('class'=>'span5')))); ?>
			</div>
		</div>
	</div>
	<div class="panel-footer">
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

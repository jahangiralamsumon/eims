<p class="help-block">
		Fields with <span class="required">*</span> are required.
	</p>
<div class="row">
	<?php $form=$this->beginWidget('booster.widgets.TbActiveForm',array(
			'id'=>'student-form',
			'enableAjaxValidation'=>false,
			'type' => 'horizontal',
			'htmlOptions' => array('enctype' => 'multipart/form-data'),
)); ?>

	

	<?php echo $form->errorSummary($model); ?>
	
	<?php
$this->widget('booster.widgets.TbAlert', array(
    'alerts'=>array( // configurations per alert type
        'fade'=>true, // use transitions?
		'closeText'=>'&times;',
        'error'=>array('block'=>true, 'fade'=>true, 'closeText'=>'&times;'), // success, info, warning, error or danger,
    ),
));
?>

	<div class="col-md-12">
		<div class="panel">
			<div class="panel-heading">
				<span class="panel-title">Admission Info</span>
			</div>
			<div class="panel-body">
				<div class="row">
					<div class="col-md-6">


						<?php echo $form->dropDownListGroup(
								$student_class_model,
								'shift_id',
								array(
						'wrapperHtmlOptions' => array(
						'class' => 'col-sm-5',
						),
						'widgetOptions' => array(
						'data' => CHtml::listData(Shift::model()->findAll(),'shift_id','shift_name'),
						'htmlOptions' =>array('empty' => 'Select Shift','class'=>'span2'),

						)
					)
						);
						?>

						<?php echo $form->dropDownListGroup(
								$student_class_model,
								'class_id',
								array(
						'wrapperHtmlOptions' => array(
						'class' => 'col-sm-5',
						),
						'widgetOptions' => array(
						'data' =>CHtml::listData(Classes::model()->findAll(),'class_id','class_name'),
						'htmlOptions' =>array('empty' => 'Select Class','class'=>'span2','ajax' => array(
						'type'=>'POST', //request type
						'url'=>CController::createUrl('Student/dynamicsections'), //url to call
						'update'=>'#'.CHtml::activeId($student_class_model,'section_id')
						)),

						)
					 )
						);
						?>
						<?php echo $form->dropDownListGroup(
								$student_class_model,
								'section_id',
								array(
						'wrapperHtmlOptions' => array(
						'class' => 'col-sm-5',
						),
						'widgetOptions' => array(
                         'data'=>$section_data,
						'htmlOptions' =>array('empty' =>'Select Section','class'=>'span2'),

						)
					)
						);
						?>
						
						
						<?php echo $form->dropDownListGroup(
								$student_class_model,
								'group',
								array(
						'wrapperHtmlOptions' => array(
						'class' => 'col-sm-5',
						),
						'widgetOptions' => array(
                         'data'=>Classes::group_option(),
						'htmlOptions' =>array('empty' =>'Select Group','class'=>'span2'),

						)
					)
						);
						?>

					</div>
					<div class="col-md-6">
						
						<?php echo $form->textFieldGroup($model,'admission_no',
								array(
						'wrapperHtmlOptions' => array(
						'class' => 'col-sm-5',
						),
						'widgetOptions'=>array('htmlOptions'=>array('class'=>'span5','maxlength'=>300)))); ?>

						<?php //echo $form->datePickerGroup($model,'admission_date',array('widgetOptions'=>array('options'=>array( 'dateFormat' => 'yy-mm-dd'),'htmlOptions'=>array('class'=>'span5')), 'prepend'=>'<i class="glyphicon glyphicon-calendar"></i>',)); ?>
                        <?php echo $form->datePickerGroup($model,'admission_date',array('wrapperHtmlOptions' => array('class' => 'col-sm-5'),'widgetOptions'=>array('options'=>array('dateFormat' => 'yy-mm-dd','changeMonth'=>true,'changeYear'=>true,'yearRange'=>'1950:2050',),'htmlOptions'=>array('class'=>'span5')), 'prepend'=>'<i class="glyphicon glyphicon-calendar"></i>')); ?>
						
                          <?php echo $form->textFieldGroup($student_class_model,'roll_no',
								array(
						'wrapperHtmlOptions' => array(
						'class' => 'col-sm-5',
						),
						'widgetOptions'=>array('htmlOptions'=>array('class'=>'span5',)))); ?>
						
						<?php 
						
						echo $form->textFieldGroup($model,'attendance_card_id',
								array(
										'wrapperHtmlOptions' => array(
												'class' => 'col-sm-5',
										),
										'widgetOptions'=>array('htmlOptions'=>array('class'=>'span5',))));
						?>
						

					</div>
				</div>
			</div>
		</div>
	</div>


	<div class="col-md-6">

		<div class="panel">
			<div class="panel-heading">
				<span class="panel-title">Personal Details</span>
			</div>
			<div class="panel-body">
					 					                 
				<?php echo $form->textFieldGroup($model,'name',array('widgetOptions'=>array('htmlOptions'=>array('class'=>'span5','maxlength'=>300)))); ?>


				<?php echo $form->dropDownListGroup(
						$model,
						'sex',
						array(
						'wrapperHtmlOptions' => array(
						'class' => 'col-sm-5',
						),
						'widgetOptions' => array(
						'data' => array('Select Gender','M' => 'Male', 'F' => 'Female'),
						'htmlOptions' => array(),
						)
					)
				);
				?>
				<?php echo $form->datePickerGroup($model,'birthday',array('widgetOptions'=>array('options'=>array('dateFormat' => 'yy-mm-dd','changeMonth'=>true,
        'changeYear'=>true,'yearRange'=>'1950:2050',),'htmlOptions'=>array('class'=>'span5')), 'prepend'=>'<i class="glyphicon glyphicon-calendar"></i>')); ?>
				<?php echo $form->dropDownListGroup(
						$model,
						'blood_group',
						array(
						'wrapperHtmlOptions' => array(
						'class' => 'col-sm-5',
						),
						'widgetOptions' => array(
						'data' => array('A+' => 'A+', 'A-' => 'A-', 'B+' => 'B+', 'B-' => 'B-', 'O+' => 'O+', 'O-' => 'O-', 'AB+' => 'AB+', 'AB-' => 'AB-'),
						'htmlOptions' =>array('empty' => 'Unknown'),

						)
					)
				);
			 ?>

				<?php echo $form->dropDownListGroup(
						$model,
						'nationality_id',
						array(
						'wrapperHtmlOptions' => array(
						'class' => 'col-sm-5',
						),
						'widgetOptions' => array(
						'data' => CHtml::listData(Countries::model()->findAll(),'id','name'),
						'htmlOptions' =>array('empty' => 'Select Nationality','class'=>'span2'),

						)
					)
				);
			 ?>

				<?php echo $form->textFieldGroup($model,'religion',array('widgetOptions'=>array('htmlOptions'=>array('class'=>'span5','maxlength'=>100)))); ?>

				<div class="form-group">
					<?php echo $form->labelEx($model, 'img_file',array('class'=>'col-sm-3 control-label')); ?>
					<div class="col-sm-9">
						<?php 
						echo $form->fileField($model, 'img_file',array('class'=>'btn btn-success fileinput-button'));
						echo $form->error($model, 'img_file');
						?>
					</div>
				</div>

			</div>
		</div>
</div>
	<div class="col-md-6">

		<div class="panel">
			<div class="panel-heading">
				<span class="panel-title">Contact Details</span>
			</div>
			<div class="panel-body">

				<?php echo $form->textAreaGroup(
						$model,
						'present_address',
						array(
				'	wrapperHtmlOptions' => array(
						'class' => 'col-sm-5',
					),
					'widgetOptions' => array(
						'htmlOptions' => array('rows' => 5),
						)
						)
				);
				?>

				<?php echo $form->textAreaGroup(
						$model,
						'permanent_address',
						array(
				'	wrapperHtmlOptions' => array(
						'class' => 'col-sm-5',
					),
					'widgetOptions' => array(
						'htmlOptions' => array('rows' => 5),
						)
						)
				);
				?>

				<?php echo $form->textFieldGroup($model,'phone',array('widgetOptions'=>array('htmlOptions'=>array('class'=>'span5','maxlength'=>100)))); ?>

				<?php echo $form->textFieldGroup($model,'mobile',array('widgetOptions'=>array('htmlOptions'=>array('class'=>'span5','maxlength'=>100)))); ?>

				<?php echo $form->textFieldGroup($model,'email',array('widgetOptions'=>array('htmlOptions'=>array('class'=>'span5','maxlength'=>200)))); ?>


				<?php echo $form->textFieldGroup($model,'father_name',array('widgetOptions'=>array('htmlOptions'=>array('class'=>'span5','maxlength'=>300)))); ?>

				<?php echo $form->textFieldGroup($model,'mother_name',array('widgetOptions'=>array('htmlOptions'=>array('class'=>'span5','maxlength'=>300)))); ?>

			</div>
		</div>

	</div>

	
	
	<div class="col-md-12">
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


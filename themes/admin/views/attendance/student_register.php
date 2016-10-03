
<?php
$this->breadcrumbs=array(
		'Attendance'=>array('index'),
		'Student Attendance Register',
);
?>


<div class="row">
	<div class="col-md-12">
		<div class="panel">
			<div class="panel-heading">
				<span class="panel-title">Student Attendance Register</span>
			</div>
			<div class="panel-body">
				<p class="help-block">
					Fields with <span class="required">*</span> are required.
				</p>
				<?php $form=$this->beginWidget('booster.widgets.TbActiveForm',array(
						'id'=>'student-attendance-form',
						'type' => 'horizontal',
						'method'=>'GET',
						'enableAjaxValidation'=>false,
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
						'url'=>CController::createUrl('Attendance/dynamicsections'), //url to call
						'update'=>'#'.CHtml::activeId($model,'section_id')
						)),

						)
					)
				);
				?>
				<?php echo $form->dropDownListGroup(
						$model,
						'section_id',
						array(
								'wrapperHtmlOptions' => array(
								'class' => 'col-sm-5',
								),
                              	'widgetOptions' => array(
								'data' =>$data	,
                                'htmlOptions' =>array('empty' => 'Select Section','class'=>'span2'),
								))
				);
				?>
				<?php echo $form->datePickerGroup($model,'date',array(
						'wrapperHtmlOptions' => array(
						'class' => 'col-sm-4',
						),'widgetOptions'=>array('options'=>array('dateFormat' => 'yy-mm-dd','changeMonth'=>true,
        'changeYear'=>true,'yearRange'=>'1950:2050',),'htmlOptions'=>array('class'=>'span5')), 'prepend'=>'<i class="glyphicon glyphicon-calendar"></i>')); ?>


				<div class="form-actions">
					<?php $this->widget('booster.widgets.TbButton', array(
							'buttonType'=>'submit',
							'context'=>'primary',
							'label'=>'Manage Attendance',
		)); ?>
				</div>
				<?php $this->endWidget(); ?>
			</div>
		</div>
	</div>


	<?php  if(isset($daily_attendance)):?>
	
	<div class="col-md-12">
		<div class="panel">
			<div class="panel-body">
			<?php $form=$this->beginWidget('booster.widgets.TbActiveForm',array(
			'id'=>'attendance-input-form',
			'type' => 'horizontal',
			'enableAjaxValidation'=>false,
			)); ?>
			<?php echo $form->errorSummary($attendance_input_model); ?>
				<h1>Manage Attendance</h1>
				
				<table class="items table table-bordered">
					<tr>
						<th>Roll No</th>
						<th>Student Name</th>					    
						<th>Remark</th>
			
					</tr>

					<?php foreach ($daily_attendance as $key=>$row):?>
					<tr>
					   <td><?php echo $row->roll_no ?></td>
						<td>
						<?php echo CHtml::activeHiddenField($attendance_input_model,'attendance_id['.$key.']',array('value'=>$row->attendance_id)); ?>
						<?php echo Student::student_name($row->student_id) ?></td>
						<td>
						<div class="col-sm-6">
							<?php //echo CHtml::textField('markobtained['.$row->student_id.']',isset($row->mark)?$row->mark:0,array('id'=>'markobtained'.$row->student_id,'class'=>'form-control')); ?>
						     <?php echo CHtml::activeDropDownList($attendance_input_model,'status['.$key.']',array('1'=>'Present','2'=>'Absent'), array('class'=>'form-control','options' =>array($row->status=>array('selected'=>true)))); ?>
						     <?php echo $form->error($attendance_input_model,'status['.$key.']'); ?>
						     </div>
						</td>
					</tr>
					
				
					<?php endforeach; ?>
				</table>
				<br>
				<div class="form-actions">
			<?php $this->widget('booster.widgets.TbButton', array(
					'buttonType'=>'submit',
					'context'=>'primary',
					'label'=>'Save',
		)); ?>
		</div>
                <?php $this->endWidget(); ?>
			</div>
		</div>
	</div>
	<?php endif;?>
	
</div>	
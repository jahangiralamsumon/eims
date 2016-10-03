<?php
$this->breadcrumbs=array(
	'Student'=>array('studentlist'),
	'Student Promotion',
);
?>

<?php $form=$this->beginWidget('booster.widgets.TbActiveForm',array(
		'id'=>'std-promotion-form',
		'type' => 'horizontal',
		'enableAjaxValidation'=>false,
));  ?>
<div class="row">
<div class="col-md-12">
<div class="panel">
	<div class="panel-heading">
		<span class="panel-title">Student Promotion</span>
	</div>
	<div class="panel-body">
	<div class="col-md-6">

    	<?php foreach($students as $key=>$student): ?>
    
    	<div class="checkbox-custom checkbox-primary mb5">
	   <?php 

		echo CHtml::checkbox('student['.$student->student_id.']',true,array('id'=>$student->student_id,'value'=>$student->student_id,/*'class'=>'checkbox_class'*/));
		echo CHtml::label($student->student_name.'('.$student->roll_no.')',$student->student_id);
		?>
		</div>
	
		<?php endforeach; ?>
	 	   
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
</div>
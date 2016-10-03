<?php
$this->breadcrumbs=array(
	'Students'=>array('studentlist'),
	$model->name=>array('view','id'=>$model->student_id),
	'Update',
);

?>

	<h1>Update Student <?php echo $model->student_id; ?></h1>
	<header id="topbar" class="ph10">
	<div class="topbar-left">
		<ul class="nav nav-list nav-list-topbar pull-left ">
			<li class="active"><?php  echo CHtml::link('<i class="glyphicons glyphicons-adress_book"></i> Student Details'); ?>
			</li>
			<li><?php echo CHtml::link('<i class="glyphicons glyphicons-parents"></i> Parent Details',array('/student/guardians','id'=>$model->student_id,'gid'=>$model->parent_id,'action'=>'update'),array()); ?>
			</li>
			<li><?php echo CHtml::link('<i class="glyphicons glyphicons-unshare"></i> Previous Details',array('/student/previousData','id'=>$model->student_id,'action'=>'update'),array()); ?>
			</li>
			<li><?php echo CHtml::link('<i class="glyphicons glyphicons-book"></i> Courses',array('/student/subjectReg','id'=>$model->student_id,'action'=>'update'),array()); ?>
			</li>
			<li><?php echo CHtml::link('<i class="glyphicons glyphicons-user"></i> Student Profile',array('/student/view','id'=>$model->student_id,),array()); ?>
			</li>

		</ul>
	</div>
</header>
<br>

<?php echo $this->renderPartial('_form', array('model'=>$model,'student_class_model'=>$student_class_model,'section_data'=>$section_data)); ?>
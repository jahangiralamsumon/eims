<?php if($action=='update'){?>
<?php
$this->breadcrumbs=array(
		'Students'=>array('studentlist'),
		$student_obj->name=>array('view','id'=>$student_obj->student_id),
		'Update',
);

?>

<h1>
	Update Student
	<?php echo $student_obj->student_id; ?>
</h1>

<header id="topbar" class="ph10">
	<div class="topbar-left">
		<ul class="nav nav-list nav-list-topbar pull-left ">
			<li><?php  echo CHtml::link('<i class="glyphicons glyphicons-adress_book"></i> Student Details',array('/student/update','id'=>$student_obj->student_id),array()); ?>
			</li>
			<li><?php echo CHtml::link('<i class="glyphicons glyphicons-parents"></i> Parent Details',array('/student/guardians','id'=>$student_obj->student_id,'gid'=>$student_obj->parent_id,'action'=>'update'),array()); ?>
			</li>
			<li><?php echo CHtml::link('<i class="glyphicons glyphicons-unshare"></i> Previous Details',array('/student/previousData','id'=>$student_obj->student_id,'action'=>'update'),array()); ?>
			</li>
			<li  class="active"><?php echo CHtml::link('<i class="glyphicons glyphicons-book"></i> Courses',array('/student/subjectReg','id'=>$student_obj->student_id,'action'=>'update'),array()); ?>
			</li>
			<li><?php echo CHtml::link('<i class="glyphicons glyphicons-user"></i> Student Profile',array('/student/view','id'=>$student_obj->student_id,),array()); ?>
			</li>

		</ul>
	</div>
</header>
<br>
<?php  } else{?>
<?php
$this->breadcrumbs=array(
	'Students'=>array('studentlist'),
	'Create',
);

?>

<h1>New Admission</h1>

<header id="topbar" class="ph10">
	<div class="topbar-left">
		<ul class="nav nav-list nav-list-topbar pull-left ">
			<li><?php  echo CHtml::link('<i class="glyphicons glyphicons-adress_book"></i> Student Details'); ?>
			</li>
			<li><?php echo CHtml::link('<i class="glyphicons glyphicons-parents"></i> Parent Details'); ?>
			</li>
			<li><?php echo CHtml::link('<i class="glyphicons glyphicons-unshare"></i> Previous Details'); ?>
			</li>
			<li class="active"><?php echo CHtml::link('<i class="glyphicons glyphicons-book"></i> Courses'); ?>
			</li>
			<li><?php echo CHtml::link('<i class="glyphicons glyphicons-user"></i> Student Profile'); ?>
			</li>

		</ul>
	</div>
</header>
<br>
<?php }?>
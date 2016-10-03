<?php
$this->breadcrumbs=array(
	'Students'=>array('studentlist'),
	'Create',
);

$this->menu=array(
array('label'=>'List Student','url'=>array('index')),
array('label'=>'Manage Student','url'=>array('admin')),
);
?>

<h1>New Admission</h1>
<header id="topbar" class="ph10">
<div class="topbar-left">
			<ul
				class="nav nav-list nav-list-topbar pull-left ">
				<li class="active">
				<?php  echo CHtml::link('<i class="glyphicons glyphicons-adress_book"></i> Student Details'); ?>
				</li>
				<li>
				<?php echo CHtml::link('<i class="glyphicons glyphicons-parents"></i> Parent Details'); ?>
				</li>
				<li>
				<?php echo CHtml::link('<i class="glyphicons glyphicons-unshare"></i> Previous Details'); ?>
				</li>
				<li>
				<?php echo CHtml::link('<i class="glyphicons glyphicons-book"></i> Courses'); ?>
				
				</li>
		        <li>
				<?php echo CHtml::link('<i class="glyphicons glyphicons-user"></i> Student Profile'); ?>
				</li>
				
			</ul>
			</div>
</header>
<br>
<?php echo $this->renderPartial('_form', array('model'=>$model,'student_class_model'=>$student_class_model,'section_data'=>array())); ?>
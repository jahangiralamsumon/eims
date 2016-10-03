<?php
$this->breadcrumbs=array(
	'Grades'=>array('create'),
	$model->name=>array('view','id'=>$model->grade_id),
	'Update',
);

	$this->menu=array(
	array('label'=>'Create Grade','url'=>array('create')),
	array('label'=>'View Grade','url'=>array('view','id'=>$model->grade_id)),
	array('label'=>'Manage Grade','url'=>array('admin')),
	);
	?>
<div class="tray tray-center p20 va-t posr">
	<h1>Update Grade <?php echo $model->grade_id; ?></h1>

<?php echo $this->renderPartial('_form',array('model'=>$model)); ?>
</div>
<?php
$this->breadcrumbs=array(
	'Shifts'=>array('index'),
	$model->shift_id=>array('view','id'=>$model->shift_id),
	'Update',
);

	$this->menu=array(
	array('label'=>'List Shift','url'=>array('index')),
	array('label'=>'Create Shift','url'=>array('create')),
	array('label'=>'View Shift','url'=>array('view','id'=>$model->shift_id)),
	array('label'=>'Manage Shift','url'=>array('admin')),
	);
	?>

	<h1>Update Shift <?php echo $model->shift_id; ?></h1>

<?php echo $this->renderPartial('_form',array('model'=>$model)); ?>
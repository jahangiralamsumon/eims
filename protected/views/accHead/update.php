<?php
$this->breadcrumbs=array(
	'Acc Heads'=>array('index'),
	$model->name=>array('view','id'=>$model->acc_id),
	'Update',
);

	$this->menu=array(
	array('label'=>'List AccHead','url'=>array('index')),
	array('label'=>'Create AccHead','url'=>array('create')),
	array('label'=>'View AccHead','url'=>array('view','id'=>$model->acc_id)),
	array('label'=>'Manage AccHead','url'=>array('admin')),
	);
	?>

	<h1>Update AccHead <?php echo $model->acc_id; ?></h1>

<?php echo $this->renderPartial('_form',array('model'=>$model)); ?>
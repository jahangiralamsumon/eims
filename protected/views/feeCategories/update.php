<?php
$this->breadcrumbs=array(
	'Fee Categories'=>array('index'),
	$model->name=>array('view','id'=>$model->id),
	'Update',
);

	$this->menu=array(
	array('label'=>'List FeeCategories','url'=>array('index')),
	array('label'=>'Create FeeCategories','url'=>array('create')),
	array('label'=>'View FeeCategories','url'=>array('view','id'=>$model->id)),
	array('label'=>'Manage FeeCategories','url'=>array('admin')),
	);
	?>

	<h1>Update FeeCategories <?php echo $model->id; ?></h1>

<?php echo $this->renderPartial('_form',array('model'=>$model)); ?>
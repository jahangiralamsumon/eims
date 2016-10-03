<?php
$this->breadcrumbs=array(
	'Fee Particulars'=>array('index'),
	$model->name=>array('view','id'=>$model->id),
	'Update',
);

	$this->menu=array(
	array('label'=>'List FeeParticulars','url'=>array('index')),
	array('label'=>'Create FeeParticulars','url'=>array('create')),
	array('label'=>'View FeeParticulars','url'=>array('view','id'=>$model->id)),
	array('label'=>'Manage FeeParticulars','url'=>array('admin')),
	);
	?>

	<h1>Update FeeParticulars <?php echo $model->id; ?></h1>

<?php echo $this->renderPartial('_form',array('model'=>$model)); ?>
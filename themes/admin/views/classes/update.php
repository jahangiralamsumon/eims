<?php
$this->breadcrumbs=array(
	'Classes'=>array('index'),
	$model->class_id=>array('view','id'=>$model->class_id),
	'Update',
);

	$this->menu=array(
	array('label'=>'List Classes','url'=>array('index')),
	array('label'=>'Create Class','url'=>array('create')),
	array('label'=>'View Class','url'=>array('view','id'=>$model->class_id)),
	array('label'=>'Manage Classes','url'=>array('admin')),
	);
	?>

<div class="tray tray-center p20 va-t posr">	
	<h1>Update Classes <?php echo $model->class_id; ?></h1>

<?php echo $this->renderPartial('_form',array('model'=>$model)); ?>
</div>
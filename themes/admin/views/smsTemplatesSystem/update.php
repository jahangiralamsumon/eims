<?php
$this->breadcrumbs=array(
	'System Generated Template'=>array('index'),
	$model->title=>array('view','id'=>$model->id),
	'Update',
);

	$this->menu=array(
	array('label'=>'Create System Generated Template','url'=>array('create')),
	array('label'=>'View System Generated Template','url'=>array('view','id'=>$model->id)),
	array('label'=>'Manage System Generated Template','url'=>array('admin')),
	);
	?>
   <div class="tray tray-center p20 va-t posr">
	<h1>Update System Generated Template<?php echo $model->id; ?></h1>

<?php echo $this->renderPartial('_form',array('model'=>$model)); ?>
</div>
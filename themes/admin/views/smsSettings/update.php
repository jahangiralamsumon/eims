<?php
$this->breadcrumbs=array(
	'SMS Settings'=>array('admin'),
	$model->id=>array('view','id'=>$model->id),
	'Update',
);

	$this->menu=array(
	array('label'=>'Create SMS Settings','url'=>array('create')),
	array('label'=>'View SMS  Settings','url'=>array('view','id'=>$model->id)),
	array('label'=>'Manage SMS Settings','url'=>array('admin')),
	);
	?>
<div class="tray tray-center p20 va-t posr">
	<h1>Update SMS Settings <?php echo $model->id; ?></h1>

<?php echo $this->renderPartial('_form',array('model'=>$model)); ?>
</div>
<?php
$this->breadcrumbs=array(
	'Designation'=>array('index'),
	$model->designation_id=>array('view','id'=>$model->designation_id),
	'Update',
);

	$this->menu=array(
	array('label'=>'Add Designation','url'=>array('create')),
	array('label'=>'View Designation','url'=>array('view','id'=>$model->designation_id)),
	array('label'=>'Manage Designation','url'=>array('admin')),
	);
	?>
<div class="tray tray-center p20 va-t posr">
	<h1>Update Designation <?php echo $model->designation_id; ?></h1>

<?php echo $this->renderPartial('_form',array('model'=>$model)); ?>
</div>
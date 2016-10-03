<?php
$this->breadcrumbs=array(
	'Shifts'=>array('index'),
	$model->shift_id,
);

$this->menu=array(
array('label'=>'List Shift','url'=>array('index')),
array('label'=>'Create Shift','url'=>array('create')),
array('label'=>'Update Shift','url'=>array('update','id'=>$model->shift_id)),
array('label'=>'Delete Shift','url'=>'#','linkOptions'=>array('submit'=>array('delete','id'=>$model->shift_id),'confirm'=>'Are you sure you want to delete this item?')),
array('label'=>'Manage Shift','url'=>array('admin')),
);
?>

<h1>View Shift #<?php echo $model->shift_id; ?></h1>

<?php $this->widget('booster.widgets.TbDetailView',array(
'data'=>$model,
'attributes'=>array(
		'shift_id',
		'shift_title',
		'shift_name',
),
)); ?>

<?php
$this->breadcrumbs=array(
	'Subjects'=>array('index'),
	$model->name,
);

$this->menu=array(
array('label'=>'List Subjects','url'=>array('index')),
array('label'=>'Create Subjects','url'=>array('create')),
array('label'=>'Update Subjects','url'=>array('update','id'=>$model->id)),
array('label'=>'Delete Subjects','url'=>'#','linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
array('label'=>'Manage Subjects','url'=>array('admin')),
);
?>

<h1>View Subjects #<?php echo $model->id; ?></h1>

<?php $this->widget('booster.widgets.TbDetailView',array(
'data'=>$model,
'attributes'=>array(
		'id',
		'name',
		'code',
		'class_id',
		'is_elective',
		'is_deleted',
		'created_at',
		'updated_at',
),
)); ?>

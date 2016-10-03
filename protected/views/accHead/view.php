<?php
$this->breadcrumbs=array(
	'Acc Heads'=>array('index'),
	$model->name,
);

$this->menu=array(
array('label'=>'List AccHead','url'=>array('index')),
array('label'=>'Create AccHead','url'=>array('create')),
array('label'=>'Update AccHead','url'=>array('update','id'=>$model->acc_id)),
array('label'=>'Delete AccHead','url'=>'#','linkOptions'=>array('submit'=>array('delete','id'=>$model->acc_id),'confirm'=>'Are you sure you want to delete this item?')),
array('label'=>'Manage AccHead','url'=>array('admin')),
);
?>

<h1>View AccHead #<?php echo $model->acc_id; ?></h1>

<?php $this->widget('booster.widgets.TbDetailView',array(
'data'=>$model,
'attributes'=>array(
		'acc_id',
		'acc_code',
		'parent',
		'top_parent',
		'name',
		'category',
		'depth',
		'open_date',
		'lr',
		'acc_order',
		'status',
),
)); ?>

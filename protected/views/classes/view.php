<?php
$this->breadcrumbs=array(
	'Classes'=>array('index'),
	$model->class_id,
);

$this->menu=array(
array('label'=>'List Classes','url'=>array('index')),
array('label'=>'Create Classes','url'=>array('create')),
array('label'=>'Update Classes','url'=>array('update','id'=>$model->class_id)),
array('label'=>'Delete Classes','url'=>'#','linkOptions'=>array('submit'=>array('delete','id'=>$model->class_id),'confirm'=>'Are you sure you want to delete this item?')),
array('label'=>'Manage Classes','url'=>array('admin')),
);
?>

<h1>View Classes #<?php echo $model->class_id; ?></h1>

<?php $this->widget('booster.widgets.TbDetailView',array(
'data'=>$model,
'attributes'=>array(
		'class_id',
		'class_name',
),
)); ?>

<?php
$this->breadcrumbs=array(
	'Fee Categories'=>array('index'),
	$model->name,
);

$this->menu=array(
array('label'=>'List FeeCategories','url'=>array('index')),
array('label'=>'Create FeeCategories','url'=>array('create')),
array('label'=>'Update FeeCategories','url'=>array('update','id'=>$model->id)),
array('label'=>'Delete FeeCategories','url'=>'#','linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
array('label'=>'Manage FeeCategories','url'=>array('admin')),
);
?>

<h1>View FeeCategories #<?php echo $model->id; ?></h1>

<?php $this->widget('booster.widgets.TbDetailView',array(
'data'=>$model,
'attributes'=>array(
		'id',
		'name',
		'description',
		'class_id',
		'is_master',
		'created_at',
		'updated_at',
),
)); ?>

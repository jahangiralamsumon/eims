<?php
$this->breadcrumbs=array(
	'Emp Departments'=>array('index'),
	$model->name,
);

$this->menu=array(
array('label'=>'List EmpDepartments','url'=>array('index')),
array('label'=>'Create EmpDepartments','url'=>array('create')),
array('label'=>'Update EmpDepartments','url'=>array('update','id'=>$model->id)),
array('label'=>'Delete EmpDepartments','url'=>'#','linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
array('label'=>'Manage EmpDepartments','url'=>array('admin')),
);
?>

<h1>View EmpDepartments #<?php echo $model->id; ?></h1>

<?php $this->widget('booster.widgets.TbDetailView',array(
'data'=>$model,
'attributes'=>array(
		'id',
		'code',
		'name',
		'status',
),
)); ?>

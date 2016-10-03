<?php
$this->breadcrumbs=array(
	'Emp Designations'=>array('index'),
	$model->designation_id,
);

$this->menu=array(
array('label'=>'List EmpDesignation','url'=>array('index')),
array('label'=>'Create EmpDesignation','url'=>array('create')),
array('label'=>'Update EmpDesignation','url'=>array('update','id'=>$model->designation_id)),
array('label'=>'Delete EmpDesignation','url'=>'#','linkOptions'=>array('submit'=>array('delete','id'=>$model->designation_id),'confirm'=>'Are you sure you want to delete this item?')),
array('label'=>'Manage EmpDesignation','url'=>array('admin')),
);
?>

<h1>View EmpDesignation #<?php echo $model->designation_id; ?></h1>

<?php $this->widget('booster.widgets.TbDetailView',array(
'data'=>$model,
'attributes'=>array(
		'designation_id',
		'designation_name',
		'designation_order',
),
)); ?>

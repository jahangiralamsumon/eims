<?php
$this->breadcrumbs=array(
	'Year Infos'=>array('index'),
	$model->name,
);

$this->menu=array(
array('label'=>'List YearInfo','url'=>array('index')),
array('label'=>'Create YearInfo','url'=>array('create')),
array('label'=>'Update YearInfo','url'=>array('update','id'=>$model->year_code)),
array('label'=>'Delete YearInfo','url'=>'#','linkOptions'=>array('submit'=>array('delete','id'=>$model->year_code),'confirm'=>'Are you sure you want to delete this item?')),
array('label'=>'Manage YearInfo','url'=>array('admin')),
);
?>

<h1>View YearInfo #<?php echo $model->year_code; ?></h1>

<?php $this->widget('booster.widgets.TbDetailView',array(
'data'=>$model,
'attributes'=>array(
		'year_code',
		'name',
		'start_date',
		'end_date',
		'description',
		'status',
),
)); ?>

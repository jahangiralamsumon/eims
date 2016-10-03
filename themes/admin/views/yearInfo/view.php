<?php
$this->breadcrumbs=array(
	'Year Infos'=>array('index'),
	$model->name,
);

$this->menu=array(
	array('label'=>'Add Acadamic Year','url'=>array('create')),
	array('label'=>'Manage Acadamic Year','url'=>array('admin')),
	);
?>
<div class="tray tray-center p25 va-t posr">
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
</div>

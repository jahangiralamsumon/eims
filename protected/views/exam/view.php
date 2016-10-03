<?php
$this->breadcrumbs=array(
	'Exams'=>array('index'),
	$model->name,
);

$this->menu=array(
array('label'=>'List Exam','url'=>array('index')),
array('label'=>'Create Exam','url'=>array('create')),
array('label'=>'Update Exam','url'=>array('update','id'=>$model->exam_id)),
array('label'=>'Delete Exam','url'=>'#','linkOptions'=>array('submit'=>array('delete','id'=>$model->exam_id),'confirm'=>'Are you sure you want to delete this item?')),
array('label'=>'Manage Exam','url'=>array('admin')),
);
?>

<h1>View Exam #<?php echo $model->exam_id; ?></h1>

<?php $this->widget('booster.widgets.TbDetailView',array(
'data'=>$model,
'attributes'=>array(
		'exam_id',
		'name',
		'start_date',
		'end_date',
		'year_id',
),
)); ?>

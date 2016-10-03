<?php
$this->breadcrumbs=array(
		'Exams'=>array('create'),
		$model->name,
);

$this->menu=array(
		array('label'=>'Create Exam','url'=>array('create')),
		array('label'=>'Update Exam','url'=>array('update','id'=>$model->exam_id)),
		array('label'=>'Manage Exam','url'=>array('admin')),
);
?>
<div class="tray tray-center p20 va-t posr">

	<div class="panel">
		<div class="panel-heading">
			<span class="panel-title">View Exam #<?php echo $model->exam_id; ?>
			</span>
		</div>
		<div class="panel-body">
			<?php $this->widget('booster.widgets.TbDetailView',array(
					'data'=>$model,
					'attributes'=>array(
		'exam_id',
		'name',
		'start_date',
		'end_date',
       array(
		'name' => 'year',
		'value' => $model->year,
),
),
)); ?>
		</div>
	</div>
</div>

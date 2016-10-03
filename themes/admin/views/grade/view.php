<?php
$this->breadcrumbs=array(
	'Grades'=>array('create'),
	$model->name,
);

$this->menu=array(
array('label'=>'Create Grade','url'=>array('create')),
array('label'=>'Update Grade','url'=>array('update','id'=>$model->grade_id)),
array('label'=>'Delete Grade','url'=>'#','linkOptions'=>array('submit'=>array('delete','id'=>$model->grade_id),'confirm'=>'Are you sure you want to delete this item?')),
array('label'=>'Manage Grade','url'=>array('admin')),
);
?>
<div class="tray tray-center p20 va-t posr">
<div class="panel">
		<div class="panel-heading">
			<span class="panel-title">View Grade #<?php echo $model->grade_id; ?>
			</span>
		</div>
		<div class="panel-body ">


<?php $this->widget('booster.widgets.TbDetailView',array(
'data'=>$model,
'attributes'=>array(
		'grade_id',
		'name',
		'grade_point',
		'mark_from',
		'mark_upto',
		'comment',
),
)); ?>
</div>
</div>
</div>

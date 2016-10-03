<?php
$this->breadcrumbs=array(
	'Subjects'=>array('create'),
	$model->name,
);

$this->menu=array(
array('label'=>'Create Subjects','url'=>array('create')),
array('label'=>'Update Subjects','url'=>array('update','id'=>$model->id)),
array('label'=>'Delete Subjects','url'=>'#','linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
array('label'=>'Manage Subjects','url'=>array('admin')),
);
?>
<div class="tray tray-center p20 va-t posr">

<div class="panel">
		<div class="panel-heading">
			<span class="panel-title">View Subjects #<?php echo $model->id; ?>
			</span>
		</div>
		<div class="panel-body ">
<?php $this->widget('booster.widgets.TbDetailView',array(
'data'=>$model,
'attributes'=>array(
		'id',
		'name',
		'code',
		'class_id',
		'is_elective',
		'created_at',
		'updated_at',
),
)); ?>
</div>
</div>
</div>
<?php
$this->breadcrumbs=array(
	'Classes'=>array('index'),
	$model->class_id,
);

$this->menu=array(
array('label'=>'Create Classes','url'=>array('create')),
array('label'=>'Update Classes','url'=>array('update','id'=>$model->class_id)),
array('label'=>'Delete Classes','url'=>'#','linkOptions'=>array('submit'=>array('delete','id'=>$model->class_id),'confirm'=>'Are you sure you want to delete this item?')),
array('label'=>'Manage Classes','url'=>array('admin')),
);
?>
<div class="tray tray-center p20 va-t posr">

<div class="panel">
		<div class="panel-heading">
			<span class="panel-title">View Classes #<?php echo $model->class_id; ?>
			</span>
		</div>
		<div class="panel-body ">
<?php $this->widget('booster.widgets.TbDetailView',array(
'data'=>$model,
'attributes'=>array(
		'class_id',
		'class_name',
         array(
					'name' => 'child_id',
					'value' => Classes::item($model->child_id),
			),
),
)); ?>
</div>
</div>
</div>
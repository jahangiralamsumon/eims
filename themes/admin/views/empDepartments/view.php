<?php
$this->breadcrumbs=array(
	'Department'=>array('admin'),
	$model->name,
);

$this->menu=array(
array('label'=>'Add Department','url'=>array('create')),
array('label'=>'Update Department','url'=>array('update','id'=>$model->id)),
array('label'=>'Delete Department','url'=>'#','linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
array('label'=>'Manage Department','url'=>array('admin')),
);
?>
<div class="tray tray-center p20 va-t posr">

<div class="panel">
		<div class="panel-heading">
			<span class="panel-title">View Department #<?php echo $model->id; ?>
			</span>
		</div>
		<div class="panel-body ">

<?php $this->widget('booster.widgets.TbDetailView',array(
'data'=>$model,
'attributes'=>array(
		'id',
		'code',
		'name',
		'status',
),
)); ?>
</div>
</div>
</div>


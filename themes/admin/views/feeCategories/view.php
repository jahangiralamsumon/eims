<?php
$this->breadcrumbs=array(
	'Fee Categories'=>array('index'),
	$model->name,
);

$this->menu=array(
array('label'=>'List Fee Categories','url'=>array('index')),
array('label'=>'Create Fee Categories','url'=>array('create')),
array('label'=>'Update Fee Categories','url'=>array('update','id'=>$model->id)),
array('label'=>'Delete Fee Categories','url'=>'#','linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
array('label'=>'Manage Fee Categories','url'=>array('admin')),
);
?>
<div class="tray tray-center p20 va-t posr">

<div class="panel">
		<div class="panel-heading">
			<span class="panel-title">View FeeCategories #<?php echo $model->id; ?>
			</span>
		</div>
		<div class="panel-body ">
<?php $this->widget('booster.widgets.TbDetailView',array(
'data'=>$model,
'attributes'=>array(
		'id',
		'name',
		'description',
		'created_at',
		'updated_at',
),
)); ?>
</div>
</div>
</div>

<?php
$this->breadcrumbs=array(
	'System Generated Template'=>array('index'),
	$model->title,
);

$this->menu=array(
array('label'=>'Create System Generated Template','url'=>array('create')),
array('label'=>'Update System Generated Template','url'=>array('update','id'=>$model->id)),
array('label'=>'Manage System Generated Template','url'=>array('admin')),
);
?>
<div class="tray tray-center p20 va-t posr">

	<div class="panel">
		<div class="panel-heading">
			<span class="panel-title">View System Generated Template  #<?php echo $model->id; ?>
			</span>
		</div>
		<div class="panel-body">


<?php $this->widget('booster.widgets.TbDetailView',array(
'data'=>$model,
'attributes'=>array(
		'id',
		'title',
		'sms_key',
		'value',
		'category',
		'last_update',
),
)); ?>
</div>
</div>
</div>
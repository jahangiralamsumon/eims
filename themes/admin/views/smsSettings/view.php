<?php
$this->breadcrumbs=array(
	'SMS Settings'=>array('admin'),
	$model->id,
);

$this->menu=array(
array('label'=>'Create SMS Settings','url'=>array('create')),
array('label'=>'Update SMS  Settings','url'=>array('update','id'=>$model->id)),
array('label'=>'Manage SMS  Settings','url'=>array('admin')),
);
?>
<div class="tray tray-center p20 va-t posr">

	<div class="panel">
		<div class="panel-heading">
			<span class="panel-title">View SMS Settings #<?php echo $model->id; ?>
			</span>
		</div>
		<div class="panel-body">


<?php $this->widget('booster.widgets.TbDetailView',array(
'data'=>$model,
'attributes'=>array(
		'id',
		'settings_key',
		'is_enabled',
),
)); ?>
</div>
</div>
</div>

<?php
$this->breadcrumbs=array(
	'Designation'=>array('admin'),
	$model->designation_id,
);

$this->menu=array(
array('label'=>'Add Designation','url'=>array('create')),
array('label'=>'Update Designation','url'=>array('update','id'=>$model->designation_id)),
array('label'=>'Delete Designation','url'=>'#','linkOptions'=>array('submit'=>array('delete','id'=>$model->designation_id),'confirm'=>'Are you sure you want to delete this item?')),
array('label'=>'Manage Designation','url'=>array('admin')),
);
?>
<div class="tray tray-center p20 va-t posr">

<div class="panel">
		<div class="panel-heading">
			<span class="panel-title">View Designation #<?php echo  $model->designation_id;  ?>
			</span>
		</div>
		<div class="panel-body ">

<?php $this->widget('booster.widgets.TbDetailView',array(
'data'=>$model,
'attributes'=>array(
		'designation_id',
		'designation_name',
		'designation_order',
),
)); ?>
</div>
</div>
</div>

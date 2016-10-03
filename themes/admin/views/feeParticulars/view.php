<?php
$this->breadcrumbs=array(
	'Fee Particulars'=>array('index'),
	$model->name,
);

$this->menu=array(
array('label'=>'Create FeeParticulars','url'=>array('create')),
array('label'=>'Update FeeParticulars','url'=>array('update','id'=>$model->id)),
array('label'=>'Delete FeeParticulars','url'=>'#','linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
array('label'=>'Manage FeeParticulars','url'=>array('admin')),
);
?>
<div class="tray tray-center p20 va-t posr">

<div class="panel">
		<div class="panel-heading">
			<span class="panel-title">View FeeParticulars #<?php echo $model->id; ?>
			</span>
		</div>
		<div class="panel-body ">
<?php $this->widget('booster.widgets.TbDetailView',array(
'data'=>$model,
'attributes'=>array(
		'id',
		'name',
		'description',
		'amount',
		'fee_category_id',
		'is_monthly',
		'is_all',
		'class_id',
		'created_at',
		'updated_at',
),
)); ?>
</div>
</div>
</div>


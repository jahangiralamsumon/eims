<?php
$this->breadcrumbs=array(
	'Users'=>array('index'),
	$model->name,
);

$this->menu=array(
array('label'=>'List User','url'=>array('index')),
array('label'=>'Create User','url'=>array('create')),
array('label'=>'Update User','url'=>array('update','id'=>$model->id)),
array('label'=>'Delete User','url'=>'#','linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
array('label'=>'Manage User','url'=>array('admin')),
);
?>


<div class="tray tray-center p20 va-t posr">

<div class="panel">
		<div class="panel-heading">
			<span class="panel-title">View User #<?php echo $model->id; ?>
			</span>
		</div>
		<div class="panel-body ">
<?php $this->widget('booster.widgets.TbDetailView',array(
'data'=>$model,
'attributes'=>array(
		'id',
		'username',
       	array(
		'name'=>'Role',
		'value' =>User::find_rule($model->id),
        ),
		'name',
		'short_name',
		'email',
		'reg_date',
),
)); ?>
</div>
</div>
</div>
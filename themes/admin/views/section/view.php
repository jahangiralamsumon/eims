<?php
$this->breadcrumbs=array(
	'Sections'=>array(''),
	$model->section_id,
);

$this->menu=array(
array('label'=>'Create Section','url'=>array('create')),
array('label'=>'Update Section','url'=>array('update','id'=>$model->section_id)),
array('label'=>'Delete Section','url'=>'#','linkOptions'=>array('submit'=>array('delete','id'=>$model->section_id),'confirm'=>'Are you sure you want to delete this item?')),
array('label'=>'Manage Section','url'=>array('admin')),
);
?>
<div class="tray tray-center p20 va-t posr">
<div class="panel">
		<div class="panel-heading">
			<span class="panel-title">View Section #<?php echo $model->section_id; ?>
			</span>
		</div>
		<div class="panel-body ">

<?php $this->widget('booster.widgets.TbDetailView',array(
'data'=>$model,
'attributes'=>array(
		'section_id',
		'section_name',
		 array(
					'name' => 'class_id',
					'value' => Classes::item($model->class_id),
			),
),
)); ?>
</div>
</div>
</div>
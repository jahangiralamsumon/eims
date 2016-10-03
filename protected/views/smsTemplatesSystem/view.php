<?php
$this->breadcrumbs=array(
	'Sms Templates Systems'=>array('index'),
	$model->title,
);

$this->menu=array(
array('label'=>'List SmsTemplatesSystem','url'=>array('index')),
array('label'=>'Create SmsTemplatesSystem','url'=>array('create')),
array('label'=>'Update SmsTemplatesSystem','url'=>array('update','id'=>$model->id)),
array('label'=>'Delete SmsTemplatesSystem','url'=>'#','linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
array('label'=>'Manage SmsTemplatesSystem','url'=>array('admin')),
);
?>

<h1>View SmsTemplatesSystem #<?php echo $model->id; ?></h1>

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

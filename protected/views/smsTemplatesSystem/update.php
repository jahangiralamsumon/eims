<?php
$this->breadcrumbs=array(
	'Sms Templates Systems'=>array('index'),
	$model->title=>array('view','id'=>$model->id),
	'Update',
);

	$this->menu=array(
	array('label'=>'List SmsTemplatesSystem','url'=>array('index')),
	array('label'=>'Create SmsTemplatesSystem','url'=>array('create')),
	array('label'=>'View SmsTemplatesSystem','url'=>array('view','id'=>$model->id)),
	array('label'=>'Manage SmsTemplatesSystem','url'=>array('admin')),
	);
	?>

	<h1>Update SmsTemplatesSystem <?php echo $model->id; ?></h1>

<?php echo $this->renderPartial('_form',array('model'=>$model)); ?>
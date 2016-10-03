<?php
$this->breadcrumbs=array(
	'Sms Templates Systems'=>array('index'),
	'Create',
);

$this->menu=array(
array('label'=>'List SmsTemplatesSystem','url'=>array('index')),
array('label'=>'Manage SmsTemplatesSystem','url'=>array('admin')),
);
?>

<h1>Create SmsTemplatesSystem</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>
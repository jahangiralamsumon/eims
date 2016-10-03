<?php
$this->breadcrumbs=array(
	'Sms Settings'=>array('index'),
	'Create',
);

$this->menu=array(
array('label'=>'List SmsSettings','url'=>array('index')),
array('label'=>'Manage SmsSettings','url'=>array('admin')),
);
?>

<h1>Create SmsSettings</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>
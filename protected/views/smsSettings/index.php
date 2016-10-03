<?php
$this->breadcrumbs=array(
	'Sms Settings',
);

$this->menu=array(
array('label'=>'Create SmsSettings','url'=>array('create')),
array('label'=>'Manage SmsSettings','url'=>array('admin')),
);
?>

<h1>Sms Settings</h1>

<?php $this->widget('booster.widgets.TbListView',array(
'dataProvider'=>$dataProvider,
'itemView'=>'_view',
)); ?>

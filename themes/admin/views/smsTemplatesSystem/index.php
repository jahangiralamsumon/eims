<?php
$this->breadcrumbs=array(
	'Sms Templates Systems',
);

$this->menu=array(
array('label'=>'Create SmsTemplatesSystem','url'=>array('create')),
array('label'=>'Manage SmsTemplatesSystem','url'=>array('admin')),
);
?>

<h1>Sms Templates Systems</h1>

<?php $this->widget('booster.widgets.TbListView',array(
'dataProvider'=>$dataProvider,
'itemView'=>'_view',
)); ?>

<?php
$this->breadcrumbs=array(
	'Shifts',
);

$this->menu=array(
array('label'=>'Create Shift','url'=>array('create')),
array('label'=>'Manage Shift','url'=>array('admin')),
);
?>

<h1>Shifts</h1>

<?php $this->widget('booster.widgets.TbListView',array(
'dataProvider'=>$dataProvider,
'itemView'=>'_view',
)); ?>

<?php
$this->breadcrumbs=array(
	'Employees',
);

$this->menu=array(
array('label'=>'Create Employees','url'=>array('create')),
array('label'=>'Manage Employees','url'=>array('admin')),
);
?>

<h1>Employees</h1>

<?php $this->widget('booster.widgets.TbListView',array(
'dataProvider'=>$dataProvider,
'itemView'=>'_view',
)); ?>

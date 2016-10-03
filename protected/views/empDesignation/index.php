<?php
$this->breadcrumbs=array(
	'Emp Designations',
);

$this->menu=array(
array('label'=>'Create EmpDesignation','url'=>array('create')),
array('label'=>'Manage EmpDesignation','url'=>array('admin')),
);
?>

<h1>Emp Designations</h1>

<?php $this->widget('booster.widgets.TbListView',array(
'dataProvider'=>$dataProvider,
'itemView'=>'_view',
)); ?>

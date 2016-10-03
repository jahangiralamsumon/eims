<?php
$this->breadcrumbs=array(
	'Emp Departments',
);

$this->menu=array(
array('label'=>'Create EmpDepartments','url'=>array('create')),
array('label'=>'Manage EmpDepartments','url'=>array('admin')),
);
?>

<h1>Emp Departments</h1>

<?php $this->widget('booster.widgets.TbListView',array(
'dataProvider'=>$dataProvider,
'itemView'=>'_view',
)); ?>

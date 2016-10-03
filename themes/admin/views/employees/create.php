<?php
$this->breadcrumbs=array(
	'Employee'=>array('admin'),
	'Add Employee',
);

$this->menu=array(
array('label'=>'Manage Employees','url'=>array('admin')),
);
?>

<h1>Add Employee </h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>
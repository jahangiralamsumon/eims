<?php
$this->breadcrumbs=array(
	'Emp Departments'=>array('index'),
	'Create',
);

$this->menu=array(
array('label'=>'List EmpDepartments','url'=>array('index')),
array('label'=>'Manage EmpDepartments','url'=>array('admin')),
);
?>

<h1>Create EmpDepartments</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>
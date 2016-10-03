<?php
$this->breadcrumbs=array(
	'Emp Designations'=>array('index'),
	'Create',
);

$this->menu=array(
array('label'=>'List EmpDesignation','url'=>array('index')),
array('label'=>'Manage EmpDesignation','url'=>array('admin')),
);
?>

<h1>Create EmpDesignation</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>
<?php
$this->breadcrumbs=array(
	'Emp Departments'=>array('index'),
	$model->name=>array('view','id'=>$model->id),
	'Update',
);

	$this->menu=array(
	array('label'=>'List EmpDepartments','url'=>array('index')),
	array('label'=>'Create EmpDepartments','url'=>array('create')),
	array('label'=>'View EmpDepartments','url'=>array('view','id'=>$model->id)),
	array('label'=>'Manage EmpDepartments','url'=>array('admin')),
	);
	?>

	<h1>Update EmpDepartments <?php echo $model->id; ?></h1>

<?php echo $this->renderPartial('_form',array('model'=>$model)); ?>
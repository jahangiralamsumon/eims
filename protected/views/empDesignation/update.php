<?php
$this->breadcrumbs=array(
	'Emp Designations'=>array('index'),
	$model->designation_id=>array('view','id'=>$model->designation_id),
	'Update',
);

	$this->menu=array(
	array('label'=>'List EmpDesignation','url'=>array('index')),
	array('label'=>'Create EmpDesignation','url'=>array('create')),
	array('label'=>'View EmpDesignation','url'=>array('view','id'=>$model->designation_id)),
	array('label'=>'Manage EmpDesignation','url'=>array('admin')),
	);
	?>

	<h1>Update EmpDesignation <?php echo $model->designation_id; ?></h1>

<?php echo $this->renderPartial('_form',array('model'=>$model)); ?>
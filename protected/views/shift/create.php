<?php
$this->breadcrumbs=array(
	'Shifts'=>array('index'),
	'Create',
);

$this->menu=array(
array('label'=>'List Shift','url'=>array('index')),
array('label'=>'Manage Shift','url'=>array('admin')),
);
?>

<h1>Create Shift</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>
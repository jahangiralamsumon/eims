<?php
$this->breadcrumbs=array(
	'Acc Heads'=>array('index'),
	'Create',
);

$this->menu=array(
array('label'=>'List AccHead','url'=>array('index')),
array('label'=>'Manage AccHead','url'=>array('admin')),
);
?>

<h1>Create AccHead</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>
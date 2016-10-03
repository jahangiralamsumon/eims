<?php
$this->breadcrumbs=array(
	'Classes'=>array('index'),
	'Create',
);

$this->menu=array(
array('label'=>'List Classes','url'=>array('index')),
array('label'=>'Manage Classes','url'=>array('admin')),
);
?>

<h1>Create Classes</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>
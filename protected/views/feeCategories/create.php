<?php
$this->breadcrumbs=array(
	'Fee Categories'=>array('index'),
	'Create',
);

$this->menu=array(
array('label'=>'List FeeCategories','url'=>array('index')),
array('label'=>'Manage FeeCategories','url'=>array('admin')),
);
?>

<h1>Create FeeCategories</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>
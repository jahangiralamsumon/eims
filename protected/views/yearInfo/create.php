<?php
$this->breadcrumbs=array(
	'Year Infos'=>array('index'),
	'Create',
);

$this->menu=array(
array('label'=>'List YearInfo','url'=>array('index')),
array('label'=>'Manage YearInfo','url'=>array('admin')),
);
?>

<h1>Create YearInfo</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>
<?php
$this->breadcrumbs=array(
	'Fee Particulars'=>array('index'),
	'Create',
);

$this->menu=array(
array('label'=>'List FeeParticulars','url'=>array('index')),
array('label'=>'Manage FeeParticulars','url'=>array('admin')),
);
?>

<h1>Create FeeParticulars</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>
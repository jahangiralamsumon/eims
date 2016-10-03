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
<div class="tray tray-center p25 va-t posr">
<h1>Create Shift</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>
</div>
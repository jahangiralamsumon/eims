<?php
$this->breadcrumbs=array(
	'Designations'=>array('admin'),
	'Create',
);

$this->menu=array(
array('label'=>'Manage Designation','url'=>array('admin')),
);
?>
<div class="tray tray-center p20 va-t posr">
<h1>Add Designation</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>
</div>
<?php
$this->breadcrumbs=array(
	'Grades'=>array('create'),
	'Create',
);

$this->menu=array(
array('label'=>'Manage Grade','url'=>array('admin')),
);
?>
<div class="tray tray-center p20 va-t posr">
<h1>Create Grade</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>
</div>
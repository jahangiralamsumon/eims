<?php
$this->breadcrumbs=array(
	'Departments'=>array('admin'),
	'Create',
);

$this->menu=array(
array('label'=>'Manage Department','url'=>array('admin')),
);
?>
<div class="tray tray-center p20 va-t posr">
<h1>Department Setup</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>
</div>
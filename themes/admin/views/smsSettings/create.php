<?php
$this->breadcrumbs=array(
	'SMS Settings'=>array('admin'),
	'Create',
);

$this->menu=array(

array('label'=>'Manage SMS Settings','url'=>array('admin')),
);
?>
<div class="tray tray-center p20 va-t posr">
<h1>Create SMS Settings</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>
</div>
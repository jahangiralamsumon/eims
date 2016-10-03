<?php
$this->breadcrumbs=array(
	'System Generated Templates'=>array('index'),
	'Create',
);

$this->menu=array(
array('label'=>'Manage System Generated Templates','url'=>array('admin')),
);
?>
<div class="tray tray-center p20 va-t posr">
<h1>Create System Generated Template</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>
</div>
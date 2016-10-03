<?php
$this->breadcrumbs=array(
	'Sections'=>array(''),
	'Create',
);

$this->menu=array(
array('label'=>'Manage Section','url'=>array('admin')),
);
?>
<div class="tray tray-center p20 va-t posr">
<h1>Create Section</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>
</div>
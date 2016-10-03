<?php
$this->breadcrumbs=array(
	'Fee Categories'=>array('index'),
	'Create',
);

$this->menu=array(
array('label'=>'List Fee Categories','url'=>array('index')),
array('label'=>'Manage Fee Categories','url'=>array('admin')),
);
?>
<div class="tray tray-center p20 va-t posr">
<h1>Create Fee Categories</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>
</div>
<?php
$this->breadcrumbs=array(
	'Classes'=>array('index'),
	'Create',
);

$this->menu=array(
array('label'=>'Manage Classes','url'=>array('admin')),
); 
?>

<div class="tray tray-center p20 va-t posr">
<h1>Create Classes</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>


</div>


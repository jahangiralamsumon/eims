<?php
$this->breadcrumbs=array(
	'Year Infos'=>array('index'),
	'Add Academic Year',
);

$this->menu=array(
array('label'=>'Manage Academic Year','url'=>array('admin')),
);
?>
<div class="tray tray-center p25 va-t posr">

<?php echo $this->renderPartial('_form', array('model'=>$model,'panel_title'=>'Add Academic Year')); ?>
</div>
<?php
$this->breadcrumbs=array(
	'Year Infos'=>array('index'),
	$model->name=>array('view','id'=>$model->year_code),
	'Update',
);

	$this->menu=array(
	array('label'=>'Add Acadamic Year','url'=>array('create')),
	array('label'=>'Manage Acadamic Year','url'=>array('admin')),
	);
	?>
<div class="tray tray-center p25 va-t posr">
<?php echo $this->renderPartial('_form',array('model'=>$model,'panel_title'=>'Update Acadamic Year')); ?>
</div>
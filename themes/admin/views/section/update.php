<?php
$this->breadcrumbs=array(
	'Sections'=>array(''),
	$model->section_id=>array('view','id'=>$model->section_id),
	'Update',
);

	$this->menu=array(
	array('label'=>'Create Section','url'=>array('create')),
	array('label'=>'View Section','url'=>array('view','id'=>$model->section_id)),
	array('label'=>'Manage Section','url'=>array('admin')),
	);
	?>
<div class="tray tray-center p20 va-t posr">
	<h1>Update Section <?php echo $model->section_id; ?></h1>

<?php echo $this->renderPartial('_form',array('model'=>$model)); ?>

</div>
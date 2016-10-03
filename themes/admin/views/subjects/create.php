<?php
$this->breadcrumbs=array(
	'Subjects'=>array('create'),
	'Create',
);

$this->menu=array(
array('label'=>'Manage Subjects','url'=>array('admin')),
);
?>
<div class="tray tray-center p20 va-t posr">
<h1>Create Subjects</h1>

<?php echo $this->renderPartial('_form',array('model'=>$model,'parent_sub_data'=>array())); ?>

</div>
<?php
$this->breadcrumbs=array(
	'Fee Particulars'=>array(''),
	'Create',
);

$this->menu=array(
array('label'=>'Manage Fee Particulars','url'=>array('admin')),
);
?>
<div class="tray tray-center p20 va-t posr">
<h1>Create Fee Particulars</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>

</div>
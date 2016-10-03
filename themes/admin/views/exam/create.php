<?php
$this->breadcrumbs=array(
	'Exams'=>array('index'),
	'Create',
);

$this->menu=array(
array('label'=>'Manage Exam','url'=>array('admin')),
);
?>
<div class="tray tray-center p20 va-t posr">
<h1>Create Exam</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>

</div>
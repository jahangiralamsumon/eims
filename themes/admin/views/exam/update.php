<?php
$this->breadcrumbs=array(
	'Exams'=>array(''),
	$model->name=>array('view','id'=>$model->exam_id),
	'Update',
);

	$this->menu=array(
	array('label'=>'Create Exam','url'=>array('create')),
	array('label'=>'View Exam','url'=>array('view','id'=>$model->exam_id)),
	array('label'=>'Manage Exam','url'=>array('admin')),
	);
	?>
<div class="tray tray-center p20 va-t posr">
	<h1>Update Exam <?php echo $model->exam_id; ?></h1>

<?php echo $this->renderPartial('_form',array('model'=>$model)); ?>

</div>
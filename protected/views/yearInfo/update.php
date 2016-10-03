<?php
$this->breadcrumbs=array(
	'Year Infos'=>array('index'),
	$model->name=>array('view','id'=>$model->year_code),
	'Update',
);

	$this->menu=array(
	array('label'=>'List YearInfo','url'=>array('index')),
	array('label'=>'Create YearInfo','url'=>array('create')),
	array('label'=>'View YearInfo','url'=>array('view','id'=>$model->year_code)),
	array('label'=>'Manage YearInfo','url'=>array('admin')),
	);
	?>

	<h1>Update YearInfo <?php echo $model->year_code; ?></h1>

<?php echo $this->renderPartial('_form',array('model'=>$model)); ?>
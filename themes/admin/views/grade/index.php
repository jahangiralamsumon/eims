<?php
$this->breadcrumbs=array(
	'Grades',
);

$this->menu=array(
array('label'=>'Create Grade','url'=>array('create')),
array('label'=>'Manage Grade','url'=>array('admin')),
);
?>

<h1>Grades</h1>

<?php $this->widget('booster.widgets.TbListView',array(
'dataProvider'=>$dataProvider,
'itemView'=>'_view',
)); ?>

<?php
$this->breadcrumbs=array(
	'Subjects',
);

$this->menu=array(
array('label'=>'Create Subjects','url'=>array('create')),
array('label'=>'Manage Subjects','url'=>array('admin')),
);
?>

<h1>Subjects</h1>

<?php $this->widget('booster.widgets.TbListView',array(
'dataProvider'=>$dataProvider,
'itemView'=>'_view',
)); ?>

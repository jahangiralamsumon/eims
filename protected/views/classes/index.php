<?php
$this->breadcrumbs=array(
	'Classes',
);

$this->menu=array(
array('label'=>'Create Classes','url'=>array('create')),
array('label'=>'Manage Classes','url'=>array('admin')),
);
?>

<h1>Classes</h1>

<?php $this->widget('booster.widgets.TbListView',array(
'dataProvider'=>$dataProvider,
'itemView'=>'_view',
)); ?>

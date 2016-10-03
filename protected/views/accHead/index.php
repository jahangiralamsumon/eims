<?php
$this->breadcrumbs=array(
	'Acc Heads',
);

$this->menu=array(
array('label'=>'Create AccHead','url'=>array('create')),
array('label'=>'Manage AccHead','url'=>array('admin')),
);
?>

<h1>Acc Heads</h1>

<?php $this->widget('booster.widgets.TbListView',array(
'dataProvider'=>$dataProvider,
'itemView'=>'_view',
)); ?>

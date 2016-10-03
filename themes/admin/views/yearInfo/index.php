<?php
$this->breadcrumbs=array(
	'Year Infos',
);

$this->menu=array(
array('label'=>'Create YearInfo','url'=>array('create')),
array('label'=>'Manage YearInfo','url'=>array('admin')),
);
?>

<h1>Year Infos</h1>

<?php $this->widget('booster.widgets.TbListView',array(
'dataProvider'=>$dataProvider,
'itemView'=>'_view',
)); ?>

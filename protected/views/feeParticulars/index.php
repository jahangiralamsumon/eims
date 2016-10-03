<?php
$this->breadcrumbs=array(
	'Fee Particulars',
);

$this->menu=array(
array('label'=>'Create FeeParticulars','url'=>array('create')),
array('label'=>'Manage FeeParticulars','url'=>array('admin')),
);
?>

<h1>Fee Particulars</h1>

<?php $this->widget('booster.widgets.TbListView',array(
'dataProvider'=>$dataProvider,
'itemView'=>'_view',
)); ?>

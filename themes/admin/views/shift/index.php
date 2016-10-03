<?php
$this->breadcrumbs=array(
	'Shifts',
);

$this->menu=array(
array('label'=>'Create Shift','url'=>array('create')),
array('label'=>'Manage Shift','url'=>array('admin')),
);
?>
<div class="tray tray-center p25 va-t posr">
<h1>Shifts</h1>

<?php $this->widget('booster.widgets.TbListView',array(
'dataProvider'=>$dataProvider,
'itemView'=>'_view',
)); ?>
</div>
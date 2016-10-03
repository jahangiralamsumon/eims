<?php
$this->breadcrumbs=array(
	'Classes',
);

$this->menu=array(
array('label'=>'Create Classes','url'=>array('create')),
array('label'=>'Manage Classes','url'=>array('admin')),
);
?>
<div class="tray tray-center p20 va-t posr">
<h1>Classes</h1>

<?php $this->widget('booster.widgets.TbListView',array(
'dataProvider'=>$dataProvider,
'itemView'=>'_view',
)); ?>

</div>
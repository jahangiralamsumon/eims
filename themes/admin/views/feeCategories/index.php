<?php
$this->breadcrumbs=array(
	'Fee Categories',
);

$this->menu=array(
array('label'=>'Create Fee Categories','url'=>array('create')),
array('label'=>'Manage Fee Categories','url'=>array('admin')),
);
?>
<div class="tray tray-center p25 va-t posr">
<h1>Fee Categories</h1>

<?php $this->widget('booster.widgets.TbListView',array(
'dataProvider'=>$dataProvider,
'itemView'=>'_view',
)); ?>
</div>
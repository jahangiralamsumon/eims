<?php
$this->breadcrumbs=array(
	'Users',
);

$this->menu=array(
array('label'=>'Create User','url'=>array('create')),
array('label'=>'Manage User','url'=>array('admin')),
);
?>
<div class="tray tray-center p20 va-t posr">
<h1>Users</h1>

<?php $this->widget('booster.widgets.TbListView',array(
'dataProvider'=>$dataProvider,
'itemView'=>'_view',
)); ?>
</div>
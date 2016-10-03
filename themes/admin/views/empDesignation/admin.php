<?php
$this->breadcrumbs=array(
	'Designation'=>array('admin'),
	'Manage',
);

$this->menu=array(
array('label'=>'Add Designation','url'=>array('create')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
$('.search-form').toggle();
return false;
});
$('.search-form form').submit(function(){
$.fn.yiiGridView.update('emp-designation-grid', {
data: $(this).serialize()
});
return false;
});
");
?>

<div class="tray tray-center p20 va-t posr">

<div class="panel">
                        <div class="panel-heading">
                            <span class="panel-title">
                                Manage Designations
                               </span> 
                           
                        </div>
                        <div class="panel-body">
<?php $this->widget('booster.widgets.TbGridView',array(
'id'=>'emp-designation-grid',
'type'=>'striped bordered condensed',		
'dataProvider'=>$model->search(),
'filter'=>$model,
'columns'=>array(
		'designation_id',
		'designation_name',
		'designation_order',
array(
'class'=>'booster.widgets.TbButtonColumn',
),
),
)); ?>
</div>
</div>
</div>

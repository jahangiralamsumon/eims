<?php
$this->breadcrumbs=array(
	'Department'=>array('admin'),
	'Manage',
);

$this->menu=array(
array('label'=>'Create Department','url'=>array('create')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
$('.search-form').toggle();
return false;
});
$('.search-form form').submit(function(){
$.fn.yiiGridView.update('emp-departments-grid', {
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
                                Manage Department
                               </span> 
                           
                        </div>
                        <div class="panel-body">


<?php 
$this->widget('booster.widgets.TbGridView',array(
'id'=>'emp-departments-grid',
'type'=>'striped bordered condensed',		
'dataProvider'=>$model->search(),
'filter'=>$model,
'columns'=>array(
		'id',
		'code',
		'name',
		'status',
array(
'class'=>'booster.widgets.TbButtonColumn',
),
),
)); ?>
</div>
</div>
</div>

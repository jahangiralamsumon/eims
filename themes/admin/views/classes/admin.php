<?php
$this->breadcrumbs=array(
	'Classes'=>array('index'),
	'Manage',
);

$this->menu=array(
array('label'=>'Create Class','url'=>array('create'),'itemOptions' => array('class' => 'nav-header')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
$('.search-form').toggle();
return false;
});
$('.search-form form').submit(function(){
$.fn.yiiGridView.update('classes-grid', {
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
                                Manage Classes
                               </span> 
                           
                        </div>
                        <div class="panel-body pn">
                           <?php $this->widget('booster.widgets.TbGridView',array(
'id'=>'classes-grid',
'dataProvider'=>$model->search(),
'filter'=>$model,
'columns'=>array(
		'class_id',
		'class_name',
array(
'class'=>'booster.widgets.TbButtonColumn',
),
),
)); ?>
                        </div>
                    </div>
</div>
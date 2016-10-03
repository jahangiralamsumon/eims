<?php
$this->breadcrumbs=array(
	'Users'=>array('index'),
	'Manage',
);

$this->menu=array(
array('label'=>'Create User','url'=>array('create')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
$('.search-form').toggle();
return false;
});
$('.search-form form').submit(function(){
$.fn.yiiGridView.update('user-grid', {
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
                                Manage Users</span>
                            <div class="pull-right">
                                
                            </div>
                        </div>
                        <div class="panel-body ">
<?php $this->widget('booster.widgets.TbGridView',array(
'id'=>'user-grid',
'dataProvider'=>$model->search(),
'filter'=>$model,
'columns'=>array(
		'username',
        array(
		'header'=>'Role',
		'type'=>'raw',
		'value' => array($model,'role'),
        ),
		'name',
		'short_name',
		'email',
		/*
		'user_img',
		'reg_date',
		*/
array(
'class'=>'booster.widgets.TbButtonColumn',
),
),
)); ?>
</div>
</div>
</div>
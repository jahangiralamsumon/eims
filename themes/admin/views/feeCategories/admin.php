<?php
$this->breadcrumbs=array(
	'Fee Categories'=>array('index'),
	'Manage',
);

$this->menu=array(
array('label'=>'List Fee Categories','url'=>array('index')),
array('label'=>'Create Fee Categories','url'=>array('create')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
$('.search-form').toggle();
return false;
});
$('.search-form form').submit(function(){
$.fn.yiiGridView.update('fee-categories-grid', {
data: $(this).serialize()
});
return false;
});
");
?>
<div class="tray tray-center p20 va-t posr">
<div class="panel">
		<div class="panel-heading">
			<span class="panel-title">Manage Fee Categories
			</span>
		</div>
		<div class="panel-body pn">
<?php $this->widget('booster.widgets.TbGridView',array(
'id'=>'fee-categories-grid',
'dataProvider'=>$model->search(),
'filter'=>$model,
'columns'=>array(
		'id',
		'name',
        array('header'=>'Category Group',
		'name'=>'group_id',
		'value'=>'AccHead::acc_head_name($data->group_id)',
		'filter'=>FeeCategories::Categories_group(),
		'htmlOptions'=>array('width'=>'120px'),

),
		'created_at',
		/*
		'updated_at',
		*/
array(
'class'=>'booster.widgets.TbButtonColumn',
),
),
)); ?>
</div>
</div>
</div>

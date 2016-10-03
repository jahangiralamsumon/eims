<?php
$this->breadcrumbs=array(
	'Emp Designations'=>array('index'),
	'Manage',
);

$this->menu=array(
array('label'=>'List EmpDesignation','url'=>array('index')),
array('label'=>'Create EmpDesignation','url'=>array('create')),
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

<h1>Manage Emp Designations</h1>

<p>
	You may optionally enter a comparison operator (<b>&lt;</b>, <b>&lt;=</b>, <b>&gt;</b>, <b>&gt;=</b>, <b>
		&lt;&gt;</b>
	or <b>=</b>) at the beginning of each of your search values to specify how the comparison should be done.
</p>

<?php echo CHtml::link('Advanced Search','#',array('class'=>'search-button btn')); ?>
<div class="search-form" style="display:none">
	<?php $this->renderPartial('_search',array(
	'model'=>$model,
)); ?>
</div><!-- search-form -->

<?php $this->widget('booster.widgets.TbGridView',array(
'id'=>'emp-designation-grid',
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

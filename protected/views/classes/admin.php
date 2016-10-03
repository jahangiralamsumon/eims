<?php
$this->breadcrumbs=array(
	'Classes'=>array('index'),
	'Manage',
);


$this->widget(
		'booster.widgets.TbMenu',
		array(
				'type' => 'list',
				'items' => array(
						array(
								'label' => 'List header',
								'itemOptions' => array('class' => 'nav-header')
						),
						array(
								'label' => 'Home',
								'url' => '#',
								'itemOptions' => array('class' => 'active')
						),
						array('label' => 'Library', 'url' => '#'),
						array('label' => 'Applications', 'url' => '#'),
						array(
								'label' => 'Another list header',
								'itemOptions' => array('class' => 'nav-header')
						),
						array('label' => 'Profile', 'url' => '#'),
						array('label' => 'Settings', 'url' => '#'),
						'',
						array('label' => 'Help', 'url' => '#'),
				)
		)
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

<h1>Manage Classes</h1>

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

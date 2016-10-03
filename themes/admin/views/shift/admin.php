<?php
$this->breadcrumbs=array(
		'Shifts'=>array('index'),
		'Manage',
);

$this->menu=array(
		array('label'=>'List Shift','url'=>array('index')),
		array('label'=>'Create Shift','url'=>array('create')),
);

Yii::app()->clientScript->registerScript('search', "
		$('.search-button').click(function(){
		$('.search-form').toggle();
		return false;
});
		$('.search-form form').submit(function(){
		$.fn.yiiGridView.update('shift-grid', {
		data: $(this).serialize()
});
		return false;
});
		");
?>
<div class="tray tray-center p25 va-t posr">
	<h1>Manage Shifts</h1>


	<?php echo CHtml::link('Advanced Search','#',array('class'=>'search-button btn')); ?>
	<div class="search-form" style="display: none">
		<?php $this->renderPartial('_search',array(
				'model'=>$model,
)); ?>
	</div>
	<!-- search-form -->
	<div class="panel">
		<div class="panel-heading">
			<span class="panel-title"> <span class="glyphicons glyphicons-table"></span>
			</span>
			<div class="pull-right"></div>
		</div>
		<div class="panel-body pn">
			<?php $this->widget('booster.widgets.TbGridView',array(
					'id'=>'shift-grid',
					'dataProvider'=>$model->search(),
					'filter'=>$model,
					'columns'=>array(
		'shift_id',
		'shift_code',
		'shift_name',
array(
		'class'=>'booster.widgets.TbButtonColumn',
),
),
)); ?>
		</div>
	</div>
</div>

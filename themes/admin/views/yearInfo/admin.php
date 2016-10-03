<?php
$this->breadcrumbs=array(
		'Academic Year'=>array(''),
		'Manage',
);

$this->menu=array(
		array('label'=>'Add Academic Year','url'=>array('create')),
);

Yii::app()->clientScript->registerScript('search', "
		$('.search-button').click(function(){
		$('.search-form').toggle();
		return false;
});
		$('.search-form form').submit(function(){
		$.fn.yiiGridView.update('year-info-grid', {
		data: $(this).serialize()
});
		return false;
});
		");
?>
<div class="tray tray-center p25 va-t posr">
	<h1>Manage Academic Year</h1>
	<div class="panel">
		<div class="panel-heading">
			<span class="panel-title"> <span class="glyphicons glyphicons-table"></span>
			</span>
			<div class="pull-right"></div>
		</div>
		<div class="panel-body pn">
			<?php $this->widget('booster.widgets.TbGridView',array(
					'id'=>'year-info-grid',
					'dataProvider'=>$model->search(),
					'filter'=>$model,
					'columns'=>array(
		'year_code',
		'name',
		'start_date',
		'end_date',
		'description',
		'status',
array(
		'class'=>'booster.widgets.TbButtonColumn',
),
),
)); ?>
		</div>
	</div>
</div>

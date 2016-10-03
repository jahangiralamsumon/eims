<?php
$this->breadcrumbs=array(
	'Fee Particulars'=>array(''),
	'Manage',
);

$this->menu=array(
array('label'=>'Create Fee Particulars','url'=>array('create')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
$('.search-form').toggle();
return false;
});
$('.search-form form').submit(function(){
$.fn.yiiGridView.update('fee-particulars-grid', {
data: $(this).serialize()
});
return false;
});
");
?>
<div class="tray tray-center p20 va-t posr">

<div class="panel">
		<div class="panel-heading">
			<span class="panel-title">Manage Fee Particulars</span>
		
		</div>
		<div class="panel-body pn">
<?php $this->widget('booster.widgets.TbGridView',array(
'id'=>'fee-particulars-grid',
'dataProvider'=>$model->search(),
'filter'=>$model,
'columns'=>array(
		'id',
		'name',
		'description',
		'amount',
        array('header'=>'Fee Category',
              'name'=>'fee_category_id',
        	   'value'=>'@FeeCategories::model()->findbyPk($data->fee_category_id)->name',
        	   'filter'=>CHtml::listData(FeeCategories::Categories_array(),'id','name','group'),
               'htmlOptions'=>array('width'=>'120px'),
                                
         )         
         ,
         array(
		'header'=>'Is monthly',
		'name' => 'is_monthly',
		'value' => '$data->is_monthly',
		'filter'=>  array("0"=>"0","1"=>"1"),
        'htmlOptions'=>array('class'=>'text-right'),
        ),
		/*
		'is_all',
		'class_id',
		'created_at',
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

<?php
$this->breadcrumbs=array(
		'System Generated Template'=>array('index'),
		'Manage',
);

$this->menu=array(
		array('label'=>'Create System Generated Template','url'=>array('create')),
);


?>


<div class="tray tray-center p20 va-t posr">

	<div class="panel">
		<div class="panel-heading">
			<span class="panel-title"> System Generated Template </span>

		</div>
		<div class="panel-body pn">


			<?php $this->widget('booster.widgets.TbGroupGridView',array(
					'id'=>'sms-templates-system-grid',					
					'dataProvider'=>$model->search(),
					'template' => "{items}",
					'columns'=>array(

		'title',
		'sms_key',
		'value',
       array('name'=>'category','filter'=>array("employee"=>"employee","student"=>"student","parent"=>"parent",)),
		array(
		'class'=>'booster.widgets.TbButtonColumn',
		),

	array(
			'name' => 'firstletter',
			'value' => '$data->category',
			'headerHtmlOptions' => array('style'=>'display:none'),
			'htmlOptions' =>array('style'=>'display:none')
	)
),
					'extraRowColumns'=> array('firstletter'),
					'extraRowExpression' => '"<b style=\"font-size: 2em; color: #333;\">".$data->category."</b>"',
                   
)); ?>


		</div>
	</div>
</div>


<?php
$this->breadcrumbs=array(
	'SMS Settings'=>array('admin'),
	'Manage',
);

$this->menu=array(
array('label'=>'Create SMS Settings','url'=>array('create')),
);


?>


<div class="tray tray-center p20 va-t posr">

<div class="panel">
                        <div class="panel-heading">
                            <span class="panel-title">
                                Manage Sms Settings
                               </span> 
                           
                        </div>
                        <div class="panel-body pn">

<?php $this->widget('booster.widgets.TbGridView',array(
'id'=>'sms-settings-grid',
'dataProvider'=>$model->search(),
'filter'=>$model,
'columns'=>array(
		'id',
		'settings_key',
        array(
		'header'=>'Enabled/Disabled',
		'name' => 'is_enabled',
		'value' => '$data->is_enabled==1?"Enabled":"Disabled"',
		'filter'=>  array("0"=>"Disabled","1"=>"Enabled"),
		'htmlOptions'=>array('class'=>'text-right'),
),
array(
'class'=>'booster.widgets.TbButtonColumn',
),
),
)); ?>

</div>
</div>
</div>


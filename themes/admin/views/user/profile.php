<?php
$this->breadcrumbs=array(
	'Profile'=>array('profile'),
	$model->name,
);


$this->menu=array(
array('label'=>'Edit Profile', 'url'=>array('profileEdit')),
array('label'=>'Change Password', 'url'=>array('changePassword')),
);
?>



<div class="tray tray-center p20 va-t posr">

<div class="panel">
		<div class="panel-heading">
			<span class="panel-title">Your profile
			</span>
		</div>
		<div class="panel-body ">
<?php $this->widget('booster.widgets.TbDetailView',array(
'data'=>$model,
'attributes'=>array(
		'id',
		'username',
       	array(
		'name'=>'Role',
		'value' =>User::find_rule($model->id),
        ),
		'name',
		'short_name',
		'email',
		'reg_date',
         array(
		'name'=>'Status',
		'value' =>$model->status==1?'Active':'Inactive',
),
),
)); ?>
</div>
</div>
</div>
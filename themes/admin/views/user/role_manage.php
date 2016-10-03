<?php
$this->breadcrumbs=array(
		'Users'=>array('index'),
		'Role Assignment',
);

$this->menu=array(
		array('label'=>'Add New Role','url'=>array('rolesetting')),
);
?>
<div class="tray tray-center p20 va-t posr">
	<div class="panel">
		<div class="panel-heading">
			<span class="panel-title">Role Assignment </span>
			
		</div>
		<div class="panel-body ">
		   <?php if(count($roles)>0) {?>
		  <table class="items table table-striped table-bordered">
					<tr>
						<th>Role</th>
						<th>Action</th>			
					
					</tr>
					<?php foreach ($roles as $key=> $role):	 ?>
					
					 <tr>
						<td><?php echo $role->name ?></td>
						<td><?php  
						 $this->widget(
                'booster.widgets.TbButton',
                array(
                    'context' => 'link',
                     'label'=>'Edit',
                	'buttonType' =>'link',
                    'size' => 'mini',
                    'icon' => 'edit',
                    'url' => array('roleedit', 'name' => $role->name,),
                    'htmlOptions' => array('rel' => 'tooltip', 'title' => Yii::t('AuthModule.main', 'Revoke')),
                )) ; ?></td>			
					
					 </tr>
					
					<?php endforeach;?>
			</table>
			<?php }
			?>	
		</div>
	</div>


</div>

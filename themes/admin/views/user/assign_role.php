<?php
$this->breadcrumbs=array(
		'Users'=>array('index'),
		'Role Assignment',
);

$this->menu=array(
		array('label'=>'Manage User','url'=>array('admin')),
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
                     'label'=>'Revoke',
                	'buttonType' =>'link',
                    'size' => 'mini',
                    'icon' => 'remove',
                    'url' => array('revoke', 'item_name' => $role->name, 'user_id' => $user_id),
                    'htmlOptions' => array('rel' => 'tooltip', 'title' => Yii::t('AuthModule.main', 'Revoke')),
                )) ; ?></td>			
					
					 </tr>
					
					<?php endforeach;?>
			</table>
			<?php }
			else{
			?>
			
			  <?php $form = $this->beginWidget('booster.widgets.TbActiveForm', array(
                'type' => 'horizontal',
            )); ?>

            <?php //echo $form->dropDownListGroup($formModel, 'items', $assignmentOptions, array('label' => false)); ?>
          
       
            <?php echo $form->dropDownListGroup(
								$formModel,
								'items',
								array(
						'wrapperHtmlOptions' => array(
						'class' => 'col-sm-5',
						),
						'widgetOptions' => array(
						'data' =>$assignmentOptions,
						'htmlOptions' =>array('style'=>'width:100%' ),

						)
					)
						);
						?>	
             
             
            <?php $this->widget('booster.widgets.TbButton', array(
              'buttonType' => 'submit',
               'context' => 'primary',
              'label' => Yii::t('AuthModule.main', 'Assign'),
            )); ?>

            <?php $this->endWidget(); ?>	
            
            <?php } ?>	
		</div>
	</div>


</div>

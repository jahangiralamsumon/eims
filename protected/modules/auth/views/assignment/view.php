<?php
/* @var $this AssignmentController */
/* @var $model User */
/* @var $authItemDp AuthItemDataProvider */
/* @var $formModel AddAuthItemForm */
/* @var $form TbActiveForm */
/* @var $assignmentOptions array */

$this->breadcrumbs = array(
    Yii::t('AuthModule.main', 'Assignments') => array('index'),
    CHtml::value($model, $this->module->userNameColumn),
);
?>
<div class="panel">
			<div class="panel-heading">
				<span class="panel-title"><?php echo CHtml::encode(CHtml::value($model, $this->module->userNameColumn)); ?>
    <small><?php echo Yii::t('AuthModule.main', 'Assignments'); ?></small>
</span>
			</div>
			<div class="panel-body">




    <div class="span6">

        <h3>
            <?php echo Yii::t('AuthModule.main', 'Permissions'); ?>
            <small><?php echo Yii::t('AuthModule.main', 'Items assigned to this user'); ?></small>
        </h3>

        <?php $this->widget('booster.widgets.TbGridView', array(
              'type' => 'striped condensed hover',
              'dataProvider' => $authItemDp,
              'emptyText' => Yii::t('AuthModule.main', 'This user does not have any assignments.'),
              'hideHeader' => true,
              'template' => "{items}",
              'columns' => array(
                  array(
                      'class' => 'AuthItemDescriptionColumn',
                      'active' => true,
                  ),
                  array(
                      'class' => 'AuthItemTypeColumn',
                      'active' => true,
                  ),
                  array(
                      'class' => 'AuthAssignmentRevokeColumn',
                      'userId' => $model->{$this->module->userIdColumn},
                  ),
              ),
        )); ?>

        <?php if (!empty($assignmentOptions)): ?>

            <h4><?php echo Yii::t('AuthModule.main', 'Assign permission'); ?></h4>

            <?php $form = $this->beginWidget('booster.widgets.TbActiveForm', array(
                'type' => 'inline',
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
						'htmlOptions' =>array('class'=>'span2'),

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

        <?php endif; ?>

    </div>


</div>
</div>
<?php
/* @var $this AssignmentController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs = array(
    Yii::t('AuthModule.main', 'Assignments'),
);
?>

<div class="panel">
			<div class="panel-heading">
				<span class="panel-title"><?php echo Yii::t('AuthModule.main', 'Assignments'); ?></span>
			</div>
			<div class="panel-body">


<?php $this->widget('booster.widgets.TbGridView', array(
    'type' => 'striped hover',
    'dataProvider' => $dataProvider,
	'emptyText' => Yii::t('AuthModule.main', 'No assignments found.'),
	'template'=>"{items}\n{pager}",
    'columns' => array(
        array(
            'header' => Yii::t('AuthModule.main', 'User'),
            'class' => 'AuthAssignmentNameColumn',
        ),
        array(
            'header' => Yii::t('AuthModule.main', 'Assigned items'),
            'class' => 'AuthAssignmentItemsColumn',
        ),
        array(
            'class' => 'AuthAssignmentViewColumn',
        ),
    ),
)); ?>
</div>
</div>

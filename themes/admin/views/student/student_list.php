<?php
$this->breadcrumbs=array(
		'Students'=>array('studentlist'),
		'List',
);
?>

<div class="panel">
	<div class="panel-heading">
		<span class="panel-title">Student List</span>
	
	</div>
	<div class="panel-body">
	<?php echo CHtml::link('<i class="fa fa-file pr5"></i>PDF',array('/student/studentListPDF',),array("class"=>"btn btn-primary btn-gradient","target"=>"_blank")); ?>
<?php

 $this->widget('booster.widgets.TbGridView', array(
    'type'=>'striped bordered condensed',
	'dataProvider' =>$dataProvider,
	'filter'=>$filtersForm,
	'columns' => array(
	
			array(
					'header'=>'Student ID ',
					'name' => 'id',
					'type' => 'raw',
					'value' => 'CHtml::encode($data["id"])'
			),
			array(
					'header'=>'Student Name',
					'name' => 'name',
					'type' => 'raw',
					'value' => 'CHtml::encode($data["name"])'
			),
				
			array(
					'header'=>'Class',
					'name' => 'class_id',
					'value' => 'Classes::item($data["class_id"])',
					'filter'=>  Classes::items(),
			),
			array(
					'header'=>'Group',
					'name' => 'group',
					'value' => 'CHtml::encode($data["group"])',
					'filter'=>  Classes::group_option(),
			),
			array(
					'header'=>'Section',
					'name' => 'section_id',
					'value' => 'Section::item($data["section_id"])',
					'filter'=>  Section::items(),
			),
			array(
					'header'=>'Class Roll ',
					'name' => 'roll_no',
					'type' => 'raw',
					'value' => 'CHtml::encode($data["roll_no"])'
			),
			array(
					'header' => 'Operation',
					'type' => 'raw',
					'value' => 'CHtml::link("<i class=\'glyphicon glyphicon-eye-open\' ></i>Details",array("/student/view","id"=>$data["id"]),array("class"=>"view","data-toggle"=>"tooltip","data-original-title"=>"View"))." ".CHtml::link("<i class=\'glyphicon glyphicon-pencil\' ></i>Edit",array("/student/update","id"=>$data["id"]),array("class"=>"update","data-toggle"=>"tooltip","data-original-title"=>"Edit"))',
		
			)),
 		
 		
 		
			));

			?>
			
	</div>
	</div>
		
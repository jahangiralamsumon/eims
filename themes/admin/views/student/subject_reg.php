<?php echo $this->renderPartial('_subject_reg',array('student_obj'=>$student_obj,'action'=>$action)) ?>

<p class="help-block">
	<?php Yii::app()->clientScript->registerScript('someScript', "
		validate = function(){
			
		var x=0;
		var objarray = document.getElementsByName('sub[]');
		var radios = document.getElementsByName('elective_sub');
        var elective_sub=null;
		for (var i = 0, length = radios.length; i < length; i++) {
		    if (radios[i].checked) {
		        // do whatever you want with the checked radio		        
		       elective_sub=radios[i].value
		        // only one radio can be logically checked, don't check the rest
		        break;
		    }
		}	
		
		var count=0;
		var is_unique=0	
		for( x=0;x<objarray.length;x++){
			if (objarray[x].checked==true) {
			 if(objarray[x].value==elective_sub){
			  is_unique=1;
			 }
			 count++;
			}
			
		}
	  
	
	  if(elective_sub==null){
		alert('Please select Elective Subject');
		return false;
       }	
	   else  if(is_unique==1){
		alert('Group Subject and Elective Subject must not be same');
		return false;
       }
		
		else{		
		return true;
		}		
	    		
        
	}

	");
?>
<?php
	$this->widget('booster.widgets.TbAlert', array(
    'alerts'=>array( // configurations per alert type
        'fade'=>true, // use transitions?
		'closeText'=>'&times;',
        'error'=>array('block'=>true, 'fade'=>true, 'closeText'=>'&times;'), // success, info, warning, error or danger,
    ),
));
?>

</p>

<div class="row">
	<div class="col-md-12">
	
		<?php $form=$this->beginWidget('booster.widgets.TbActiveForm',array(
		'id'=>'sub-reg-form',	
		'type' => 'horizontal',
		'htmlOptions'=> array(
			'onsubmit'=>"return validate();",
            'name'=>'sub-reg-form',
				),
	)); ?>
	     <div class="panel">
	<div class="panel-heading">
		<span class="panel-title">Course Registration</span>
	</div>
	<div class="panel-body">
	<div class="col-md-6">
	<table class="table table-hover table-bordered  table-striped ">
							<tr>
								<th>Student Name</th>
								<td><?php  echo $student_obj->name; ?></td>
							</tr>
							<tr>
								<th>ID</th>
								<td><?php echo $student_obj->student_id;?></td>
							</tr>
							<tr>
							   <th>Class</th>
							   <td><?php echo $student_obj->class_name ?></td>
							</tr>
					
						<tr>	
							<th>Group</th>
							<td><?php echo ucfirst($student_obj->group); ?></td>
							
						</tr>
							<tr>	
							<th>Section</th>
							<td><?php echo $student_obj->section_name ?></td>
							
						</tr>
						<tr>	
							<th>Roll No</th>
							<td><?php echo $student_obj->roll_no ?></td>
							
						</tr>
						<tr>	
							<th>Year</th>
							<td><?php echo $student_obj->year_name ?></td>
							
						</tr>
					</table>	
	</div>
	<div class="col-md-6">
	<h2>Compulsory Subject</h2>
    	<?php foreach(Subjects::sub_list($student_obj->class_id,$student_obj->group) as $key=>$sub): ?>
    	<div class="checkbox-custom checkbox-primary  mb5">
	   <?php 

		echo CHtml::checkbox('sub[]',true,array('id'=>$key,'value'=>$key,'onclick'=>"return false"));
		echo CHtml::label($sub.'('.Subjects::sub_code($key).')',$key);
		?>
		</div>
		<?php endforeach; ?>
	
	 <h2>Group Subject</h2>	
	<?php foreach(Subjects::sub_list($student_obj->class_id,$student_obj->group,1) as $key=>$sub): ?>
    	<div class="checkbox-custom checkbox-primary mb5">
	   <?php 

		echo CHtml::checkbox('sub[]',isset($student_sub_arr[$key])?(strlen($student_sub_arr[$key])>0?true:false):false,array('id'=>$key,'value'=>$key,/*'class'=>'checkbox_class'*/));
		echo CHtml::label($sub.'('.Subjects::sub_code($key).')',$key);
		?>
		</div>
		<?php endforeach; ?>   
     <h2>Elective Subject</h2>
    <div class="col-md-12">
     <?php foreach(Subjects::sub_list($student_obj->class_id,$student_obj->group,2) as $key=>$sub): ?>
      <div class="col-md-4">
    	<div class="radio-custom radio-primary mb5">
	   <?php 

		echo CHtml::radioButton('elective_sub',isset($student_elec_sub_arr[$key])?(strlen($student_elec_sub_arr[$key])>0?true:false):false,array('id'=>$key.'2','value'=>$key,/*'class'=>'checkbox_class'*/));
		//echo CHtml::label($sub,$key.'2');
		echo CHtml::label($sub.'('.Subjects::sub_code($key).')',$key.'2');
		?>
		</div>
			</div>
		<?php endforeach; ?>
	</div>
		<div class="form-actions">
			<?php $this->widget('booster.widgets.TbButton', array(
					'buttonType'=>'submit',
					'context'=>'primary',
					'label'=>'Submit',
		)); ?>
		</div>
	</div>
</div>
</div>
	     
		<?php $this->endWidget(); ?>
	</div>
</div>
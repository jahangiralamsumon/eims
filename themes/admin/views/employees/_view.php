<div class="view">

		<b><?php echo CHtml::encode($data->getAttributeLabel('id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->id),array('view','id'=>$data->id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('emp_number')); ?>:</b>
	<?php echo CHtml::encode($data->emp_number); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('emp_attendance_card_id')); ?>:</b>
	<?php echo CHtml::encode($data->emp_attendance_card_id); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('joining_date')); ?>:</b>
	<?php echo CHtml::encode($data->joining_date); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('name')); ?>:</b>
	<?php echo CHtml::encode($data->name); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('name_bn')); ?>:</b>
	<?php echo CHtml::encode($data->name_bn); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('gender')); ?>:</b>
	<?php echo CHtml::encode($data->gender); ?>
	<br />

	<?php /*
	<b><?php echo CHtml::encode($data->getAttributeLabel('blood_group')); ?>:</b>
	<?php echo CHtml::encode($data->blood_group); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('religion')); ?>:</b>
	<?php echo CHtml::encode($data->religion); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('job_title')); ?>:</b>
	<?php echo CHtml::encode($data->job_title); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('emp_designation_id')); ?>:</b>
	<?php echo CHtml::encode($data->emp_designation_id); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('emp_department_id')); ?>:</b>
	<?php echo CHtml::encode($data->emp_department_id); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('employee_category_id')); ?>:</b>
	<?php echo CHtml::encode($data->employee_category_id); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('employee_grade_id')); ?>:</b>
	<?php echo CHtml::encode($data->employee_grade_id); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('qualification')); ?>:</b>
	<?php echo CHtml::encode($data->qualification); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('experience_detail')); ?>:</b>
	<?php echo CHtml::encode($data->experience_detail); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('experience_year')); ?>:</b>
	<?php echo CHtml::encode($data->experience_year); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('experience_month')); ?>:</b>
	<?php echo CHtml::encode($data->experience_month); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('status_description')); ?>:</b>
	<?php echo CHtml::encode($data->status_description); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('date_of_birth')); ?>:</b>
	<?php echo CHtml::encode($data->date_of_birth); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('marital_status')); ?>:</b>
	<?php echo CHtml::encode($data->marital_status); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('children_count')); ?>:</b>
	<?php echo CHtml::encode($data->children_count); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('father_name')); ?>:</b>
	<?php echo CHtml::encode($data->father_name); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('mother_name')); ?>:</b>
	<?php echo CHtml::encode($data->mother_name); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('husband_name')); ?>:</b>
	<?php echo CHtml::encode($data->husband_name); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('nationality_id')); ?>:</b>
	<?php echo CHtml::encode($data->nationality_id); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('home_address_line1')); ?>:</b>
	<?php echo CHtml::encode($data->home_address_line1); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('home_address_line2')); ?>:</b>
	<?php echo CHtml::encode($data->home_address_line2); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('home_city')); ?>:</b>
	<?php echo CHtml::encode($data->home_city); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('country_id')); ?>:</b>
	<?php echo CHtml::encode($data->country_id); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('office_address_line1')); ?>:</b>
	<?php echo CHtml::encode($data->office_address_line1); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('office_address_line2')); ?>:</b>
	<?php echo CHtml::encode($data->office_address_line2); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('office_phone')); ?>:</b>
	<?php echo CHtml::encode($data->office_phone); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('mobile_phone')); ?>:</b>
	<?php echo CHtml::encode($data->mobile_phone); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('home_phone')); ?>:</b>
	<?php echo CHtml::encode($data->home_phone); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('email')); ?>:</b>
	<?php echo CHtml::encode($data->email); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('fax')); ?>:</b>
	<?php echo CHtml::encode($data->fax); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('photo_file_name')); ?>:</b>
	<?php echo CHtml::encode($data->photo_file_name); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('created_at')); ?>:</b>
	<?php echo CHtml::encode($data->created_at); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('updated_at')); ?>:</b>
	<?php echo CHtml::encode($data->updated_at); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('user_id')); ?>:</b>
	<?php echo CHtml::encode($data->user_id); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('is_deleted')); ?>:</b>
	<?php echo CHtml::encode($data->is_deleted); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('status')); ?>:</b>
	<?php echo CHtml::encode($data->status); ?>
	<br />

	*/ ?>

</div>
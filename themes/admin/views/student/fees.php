<?php
$this->breadcrumbs=array(
		'Students'=>array('index'),
		$model->name,
);

$this->menu=array(
		array('label'=>'List Student','url'=>array('studentlist')),
		array('label'=>'Update Student','url'=>array('update','id'=>$model->student_id)),
);
?>
<div class="tray tray-center p20 va-t posr">

<div class="tab-block">


			<ul
				class="nav nav-tabs tabs-bg tabs-border">
				<li><?php  echo CHtml::link('<i class="fa fa-floppy-o pr5"></i>Profile',array('/student/view','id'=>$model->student_id),array()); ?>
				</li>
				<li><?php echo CHtml::link('<i class="glyphicons glyphicons-book"></i>Courses',array('/student/courses','id'=>$model->student_id),array()); ?>
				</li>
				<li><?php echo CHtml::link('<i class="glyphicons glyphicons-calendar"></i>Attendance',array('/student/attendance','id'=>$model->student_id),array()); ?>
				</li>
				<li class="active"><?php echo CHtml::link('<i class="glyphicons glyphicons-usd"></i>Fees',array('/student/fees','id'=>$model->student_id),array()); ?>
				</li>
				<li><?php //echo CHtml::link('<i class="glyphicons glyphicons-gift"></i>Result',array('/student/result','id'=>$model->student_id),array()); ?>
				</li>
			</ul>
	
		<div class="tab-content">

			<div class="col-md-4">
				<?php if(empty($model->img_file_name)) {?>
				<div class="fileupload fileupload-new admin-form"
					data-provides="fileupload">
					<div class="fileupload-preview thumbnail mb20">
						<img data-src="holder.js/100%x140" alt="100%x140"
							style="height: 220px; width: 100%; display: block;" src=""
							data-holder-rendered="true">
					</div>
				</div>
				<?php } else {?>
				<div class="fileupload fileupload-new admin-form"
					data-provides="fileupload">
					<div class="fileupload-preview thumbnail mb20">
						<img style="height: 220px; width: 100%; display: block;"
							src="<?php echo Yii::app()->baseUrl.'/uploadedfiles/student/'.$model->student_id.'/'.$model->img_file_name?>"
							data-holder-rendered="true">
					</div>
				</div>

				<?php } ?>
			</div>
			<div class="col-md-8">
				<h2>
					<?php echo $model->name ?>
					<small>Profile</small>
				</h2>

			</div>

			<div class="col-md-12">
				<h2 class="page-header mtn">Pending Fees</h2>
				<table class="table table-hover table-bordered ">


					<?php 
					foreach ($data as $key=> $row):

					if($row['balance']>0 )
					{

						?>
					<tr>
						<th>Amount</th>
						<td><?php echo number_format($row['balance'],2,'.','') ; ?>
						</td>

					</tr>
					<?php												
					}
					else{

                            ?>
					<tr>
						<th colspan="2">No Pending Fees</th>

					

					</tr>
					<?php } endforeach;
					?>



				</table>
				<br>

				<h2 class="page-header mtn">Payment History</h2>

				<?php 
				$colection_record=FeeCollection::std_collection_history($model->student_id);
				?>
				<table class="table table-hover table-bordered ">
					<tr class="header">
						<th>SI.No</th>
						<th>Recepit No</th>
						<th>Date</th>
						<th>Payment mode</th>

						<th>Amount</th>
					</tr>


					<?php foreach($colection_record as $key=>$row) {
						echo '<tr>';
						echo '<td>'.($key+1).'</td>';
						echo '<td>'.$row->receipt_no.'</td>';
						echo '<td>'.date("d-M-Y",strtotime( $row->payment_date)).'</td>';
						echo '<td>'.(($row->payment_mode==1) ? "Cash" : "Bank").'</td>';
						echo '<td>'.$row->amount.'</td>';
						echo '</tr>';
		      } ?>



				</table>
			</div>


		</div>
	</div>
</div>

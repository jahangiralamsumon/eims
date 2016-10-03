
<section id="content">

	<div class="admin-form theme-info" id="login1">


       <?php $form=$this->beginWidget('booster.widgets.TbActiveForm',array(
					'id'=>'contact',
					'enableAjaxValidation'=>false,
       				'type' => 'horizontal'
			)); ?>

		<div class="panel panel-info mt10 br-n">

			<div class="panel-heading heading-border bg-white">
			<div class="section row mn">
					<div class="col-sm-4">
			 <img src="<?php echo InstitutionConfigurations::ins_logo() ?>"  class="img-responsive w80 h60 center-block ">
			 </div>
			 <div class="col-sm-8">
			   <h2 class="lh40 mt25"><?php echo InstitutionConfigurations::model()->findByAttributes(array('id'=>1))->config_value; ?></h2>
			</div>
			<?php echo $form->errorSummary($model); ?>
			</div>
			</div>

			<!-- end .form-header section -->

			
			<div class="panel-body bg-light p30">
				<div class="row">
					<div class="col-sm-7 pr30">
					
						<div class="section">
							<label for="username" class="field-label text-muted fs18 mb10">Username</label>
							<label for="username" class="field prepend-icon">
							 <?php echo $form->textField($model,'username',array('class'=>'gui-input')); ?>
							   <label for="username" class="field-icon"><i class="fa fa-user"></i> </label>
							</label>
						</div>
						<!-- end section -->

						<div class="section">
							<label for="username" class="field-label text-muted fs18 mb10">Password</label>
							<label for="password" class="field prepend-icon"> 
							<?php echo $form->passwordField($model,'password',array('class'=>'gui-input')); ?>
							<label for="password" class="field-icon"><i class="fa fa-lock"></i> </label>
							</label>
						</div>
						<!-- end section -->

					</div>
					
				</div>
			</div>
			<!-- end .form-body section -->
			<div class="panel-footer clearfix p10 ph15">
				<button type="submit" class="button btn-primary mr10 pull-right">Login</button>
				<label
					class="switch block switch-primary pull-left input-align mt10"> <input
					type="checkbox" name="LoginForm['remember']" id="remember" checked> <label
					for="remember" data-on="YES" data-off="NO"></label> <span>Remember
						me</span>
				</label>
			</div>
			<!-- end .form-footer section -->
			
		</div>
		<?php $this->endWidget(); ?>
	</div>

</section>

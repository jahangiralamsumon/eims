<?php
$this->breadcrumbs=array(
		'Dashboard'=>array('site/index'),

);
?>


              <div class="row mb20">
                    <div class="topbar-menu">
                    <div class="col-xs-4 col-sm-2">
                        <?php echo CHtml::link('<span class="metro-icon  fa fa-group "></span>
                            <p class="metro-title">Student</p>',array('/student/create'),array('class'=>'metro-tile bg-white animated animated-short fadeInDown')); ?>
                    </div>
                    <div class="col-xs-4 col-sm-2">
                          <?php echo CHtml::link('<span class="metro-icon  glyphicon glyphicon-tasks "></span>
                            <p class="metro-title">Course Registration</p>',array('/student/subjectregistration'),array('class'=>'metro-tile bg-white animated animated-short fadeInDown')); ?>
                    </div>
                    <div class="col-xs-4 col-sm-2">
                        <a href="#" class="metro-tile bg-white animated animated-short fadeInDown" >
                            <span class="metro-icon  glyphicon glyphicon-check"></span>
                            <p class="metro-title">Attendance</p>
                        </a>
                    </div>
                    
                     <div class="col-xs-4 col-sm-2">                       
                        <?php echo CHtml::link('<span class="metro-icon  glyphicons glyphicons-edit"></span>
                            <p class="metro-title">Exam</p>',array('/exam/create'),array('class'=>'metro-tile bg-white animated animated-short fadeInDown')); ?> 
                    </div>
                     <div class="col-xs-4 col-sm-2">                      
                        <?php echo CHtml::link('<span class="metro-icon  glyphicons glyphicons-gift"></span>
                            <p class="metro-title">Result</p>',array('/marks/manage'),array('class'=>'metro-tile bg-white animated animated-short fadeInDown')); ?>
                    </div>
                     <div class="col-xs-4 col-sm-2">
                        <?php echo CHtml::link('<span class="metro-icon  glyphicons glyphicons-usd"></span>
                            <p class="metro-title">Payment</p>',array('/fees/feescollection'),array('class'=>'metro-tile bg-white animated animated-short fadeInDown')); ?>
                  
                    </div>
                    
                     <div class="col-xs-4 col-sm-2">                       
                             <?php echo CHtml::link('<span class="metro-icon  glyphicons glyphicons-euro"></span>
                            <p class="metro-title">Accounts</p>',array('/accounts/voucherentry'),array('class'=>'metro-tile bg-white animated animated-short fadeInDown')); ?>
                   
                    </div>
                    <div class="col-xs-4 col-sm-2">
                        <a href="#" class="metro-tile bg-white animated animated-short fadeInDown" >
                            <span class="metro-icon  glyphicons glyphicons-group"></span>
                            <p class="metro-title">Human Resource</p>
                        </a>
                    </div>
                    <div class="col-xs-4 col-sm-2">
                        <a href="#" class="metro-tile bg-white animated animated-short fadeInDown" >
                            <span class="metro-icon  glyphicons glyphicons-book"></span>
                            <p class="metro-title">Library</p>
                        </a>
                    </div>
                    <div class="col-xs-4 col-sm-2">
                        <a href="#" class="metro-tile bg-white animated animated-short fadeInDown" >
                            <span class="metro-icon  glyphicons glyphicons-building"></span>
                            <p class="metro-title">Hostel</p>
                        </a>
                    </div>
                    <div class="col-xs-4 col-sm-2">                   
                          <?php echo CHtml::link('<span class="metro-icon glyphicons  glyphicons-parents"></span>
                            <p class="metro-title">Users</p>',array('/user/create'),array('class'=>'metro-tile bg-white animated animated-short fadeInDown')); ?>                                          
                    </div>
                 
                    <div class="col-xs-4 col-sm-2">
               
                          <?php echo CHtml::link('<span class="metro-icon  glyphicons glyphicons-cogwheels"></span>
                            <p class="metro-title">Settings</p>',array('/institutionconfigurations/setup'),array('class'=>'metro-tile bg-white animated animated-short fadeInDown')); ?>
                   
                    </div>
                   
                </div>
              </div>
     
               
                <!-- Dashboard Tiles -->
                <div class="row mb10">
                    
                    <div class="col-md-3">
                        <div class="panel panel-tile text-primary br-b bw5 br-primary-light of-h mb10">
                            <div class="panel-body pl20 p5">
                                <div class="icon-bg">
                                    <i class="fa  fa-group"></i>
                                </div>
                                <h2 class="mt15 lh15">
                                        <b><?php echo Student::total_student();?></b>
                                    </h2>
                                 <h5 class="text-muted">Total Student</h5>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="panel panel-tile text-primary br-b bw5 br-primary-light of-h mb10">
                            <div class="panel-body pl20 p5">
                                <div class="icon-bg">
                                    <i class="fa  fa-user"></i>
                                </div>
                                <h2 class="mt15 lh15">
                                       <b><?php echo Employees::total_employee();?></b>
                                    </h2>
                                 <h5 class="text-muted">Teacher</h5>
                            </div>
                        </div>
                    </div>
                    
                    <div class="col-md-3">
                        <div class="panel panel-tile text-primary br-b bw5 br-primary-light of-h mb10">
                            <div class="panel-body pl20 p5">
                                <div class="icon-bg">
                                    <i class="fa  fa-user"></i>
                                </div>
                                <h2 class="mt15 lh15">
                                        <b><?php echo Employees::total_employee();?></b>
                                    </h2>
                                 <h5 class="text-muted">Employee</h5>
                            </div>
                        </div>
                    </div>
                    
                    
                    <div class="col-md-3">
                        <div class="panel panel-tile text-primary br-b bw5 br-primary-light of-h mb10">
                            <div class="panel-body pl20 p5">
                                <div class="icon-bg">
                                    <i class="fa  fa-desktop"></i>
                                </div>
                                <h2 class="mt15 lh15">
                                        <b>523</b>
                                    </h2>
                                 <h5 class="text-muted">Toatl attendance</h5>
                            </div>
                        </div>
                    </div>
                </div>
  
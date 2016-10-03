<?php
$this->breadcrumbs=array(
		'Accounts'=>array('index'),
		'Settings'=>array('manageacchead'),
		'Manage Acc Head',
);
?>
<div class="row">

	<div class="col-md-12">
		<div class="panel">
			<div class="panel-heading">
				<span class="panel-title">Manage Account Head</span>
			</div>
			<div class="panel-body">

				<div class="row">
					<div class="col-md-6">
						<h2>ASSETS</h2>
						<p>
							<?php  
							$this->widget(
									'booster.widgets.TbButton',
									array(
											'context' => 'primary',
											'label'=>'Add Ledger',
											'buttonType' =>'link',
											'size' => 'extra_small',
                    	'icon' => 'plus',
                    	'url' => array('createacchead', 'parent' =>0,'top_parent'=>0,'depth'=>0,'category'=>'A','lr'=>'L'),
                  	  'htmlOptions' => array('rel' => 'tooltip', 'title' =>''),
                	)) ; ?>
							<?php
							$this->widget(
               	 'booster.widgets.TbButton',
              	  array(
                    'context' => 'primary',
                    'label'=>'Add Subgroup',
                	'buttonType' =>'link',
                    'size' => 'extra_small',
                    'icon' => 'plus',
                  	'url' => array('createacchead', 'parent' =>0,'top_parent'=>0,'depth'=>0,'category'=>'A','lr'=>'R'),
                    'htmlOptions' => array('rel' => 'tooltip', 'title' =>''),
                )) ; ?>

						</p>
						<table class="items table  table-bordered">
							<tr>
								<th colspan="3">Account</th>
								<th>Action</th>

							</tr>

							<?php 

							foreach ($data as $key=> $row):

							if( $row['depth']=='0' && $row['category']=='A')
							{
							if($row['lr']=='L'){ ?>
							<tr>
								<td colspan="3"><?php echo $row['name']?></td>
								<td>
									<?php
							$this->widget(
               	 'booster.widgets.TbButton',
              	  array(
                    'context' => 'link',
                    'label'=>'',
                	'buttonType' =>'link',
                    'size' => 'extra_small',
                    'icon' => 'trash',
                  	'url' =>"#",
                    'htmlOptions' => array("submit"=>array('accheaddelete', 'id'=>$row['acc_id']), 'confirm' => 'Are you sure?','data-toggle' => 'tooltip', 'title' =>'Delete'),
                )) ; 

                      $this->widget(
		'booster.widgets.TbButton',
		array(
				'context' => 'link',
				'label'=>'',
				'buttonType' =>'link',
				'size' => 'extra_small',
				'icon' => 'edit',
				'url' =>array('accheadedit','id'=>$row['acc_id']),
				'htmlOptions' => array('data-toggle' => 'tooltip', 'title' =>'Edit',),
                )) ; ?>
                       
						</td>	
							</tr>
							<?php
						 }

						else{ ?>
							<tr>
								<td colspan="3"><b><?php echo $row['name']?> </b></td>
								<td><?php  
								$this->widget(
                		'booster.widgets.TbButton',
               			 array(
                    	'context' => 'primary',
                     	'label'=>'Add Ledger',
                		'buttonType' =>'link',
                   	 	'size' => 'extra_small',
                    	'icon' => 'plus',
                    	'url' => array('createacchead', 'parent' =>$row['acc_id'],'top_parent'=>$row['acc_id'],'depth'=>1,'category'=>'A','lr'=>'L'),
                  	  'htmlOptions' => array(),
                	)) ; ?> 
                	<?php
						$this->widget(
               	 'booster.widgets.TbButton',
              	  array(
                    'context' => 'primary',
                    'label'=>'Add Subgroup',
                	'buttonType' =>'link',
                    'size' => 'extra_small',
                    'icon' => 'plus',
                  	'url' => array('createacchead', 'parent' =>$row['acc_id'],'top_parent'=>$row['acc_id'],'depth'=>1,'category'=>'A','lr'=>'R'),
                    'htmlOptions' => array('rel' => 'tooltip', 'title' =>''),
                )) ; ?>
								
								
								
					<?php
							$this->widget(
               	 'booster.widgets.TbButton',
              	  array(
                    'context' => 'link',
                    'label'=>'',
                	'buttonType' =>'link',
                    'size' => 'extra_small',
                    'icon' => 'trash',
                  	'url' =>"#",
                    'htmlOptions' => array("submit"=>array('accheaddelete', 'id'=>$row['acc_id']), 'confirm' => 'Are you sure?','data-toggle' => 'tooltip', 'title' =>'Delete'),
                )) ; 

                      $this->widget(
		'booster.widgets.TbButton',
		array(
				'context' => 'link',
				'label'=>'',
				'buttonType' =>'link',
				'size' => 'extra_small',
				'icon' => 'edit',
				'url' =>array('accheadedit','id'=>$row['acc_id']),
				'htmlOptions' => array('data-toggle' => 'tooltip', 'title' =>'Edit',),
                )) ; ?>
								
								
								
								</td>

								<?php 	
								for($i=$key-1;$i>=0;$i--):
								if($row['acc_id']== $data[$i]['parent']){
                            if($data[$i]['lr']=='L'){
							 ?>
							
							
							<tr>
								<td></td>
								<td colspan="2"><?php echo $data[$i]['name']?></td>

								<td>
								  <?php
							$this->widget(
               	 'booster.widgets.TbButton',
              	  array(
                    'context' => 'link',
                    'label'=>'',
                	'buttonType' =>'link',
                    'size' => 'extra_small',
                    'icon' => 'trash',
                  	'url' =>"#",
                    'htmlOptions' => array("submit"=>array('accheaddelete', 'id'=>$data[$i]['acc_id']), 'confirm' => 'Are you sure?','data-toggle' => 'tooltip', 'title' =>'Delete'),
                )) ; 

                      $this->widget(
		'booster.widgets.TbButton',
		array(
				'context' => 'link',
				'label'=>'',
				'buttonType' =>'link',
				'size' => 'extra_small',
				'icon' => 'edit',
				'url' =>array('accheadedit','id'=>$data[$i]['acc_id']),
				'htmlOptions' => array('data-toggle' => 'tooltip', 'title' =>'Edit',),
                )) ; ?>
								</td>

							</tr>

							<?php
							}
							else{
							 ?>
							<tr>
								<td></td>
								<td colspan="2"><b><?php echo $data[$i]['name']?> </b></td>

								<td><?php  
								$this->widget(
                		'booster.widgets.TbButton',
               			 array(
                    	'context' => 'primary',
                     	'label'=>'Add Ledger',
                		'buttonType' =>'link',
                   	 	'size' => 'extra_small',
                    	'icon' => 'plus',
                    	'url' => array('createacchead', 'parent' =>$data[$i]['acc_id'],'top_parent'=>$row['acc_id'],'depth'=>2,'category'=>'A','lr'=>'L'),
                  	  'htmlOptions' => array('rel' => 'tooltip', 'title' =>''),
                	)) ; ?>
								
						
								<?php
							$this->widget(
               	 'booster.widgets.TbButton',
              	  array(
                    'context' => 'link',
                    'label'=>'',
                	'buttonType' =>'link',
                    'size' => 'extra_small',
                    'icon' => 'trash',
                  	'url' =>"#",
                    'htmlOptions' => array("submit"=>array('accheaddelete', 'id'=>$data[$i]['acc_id']), 'confirm' => 'Are you sure?','data-toggle' => 'tooltip', 'title' =>'Delete'),
                )) ; 

                      $this->widget(
		'booster.widgets.TbButton',
		array(
				'context' => 'link',
				'label'=>'',
				'buttonType' =>'link',
				'size' => 'extra_small',
				'icon' => 'edit',
				'url' =>array('accheadedit','id'=>$data[$i]['acc_id']),
				'htmlOptions' => array('data-toggle' => 'tooltip', 'title' =>'Edit',),
                )) ; ?>
								
								
								</td>

							</tr>


							<?php
							for($j=$i-1;$j>=0;$j--):
							if($data[$i]['acc_id']== $data[$j]['parent']){
							?>
							<tr>
								<td></td>
								<td></td>
								<td colspan="1"><?php echo $data[$j]['name']?></td>

								<td>
								<?php
							$this->widget(
               	 'booster.widgets.TbButton',
              	  array(
                    'context' => 'link',
                    'label'=>'',
                	'buttonType' =>'link',
                    'size' => 'extra_small',
                    'icon' => 'trash',
                  	'url' =>"#",
                    'htmlOptions' => array("submit"=>array('accheaddelete', 'id'=>$data[$j]['acc_id']), 'confirm' => 'Are you sure?','data-toggle' => 'tooltip', 'title' =>'Delete'),
                )) ; 

                      $this->widget(
		'booster.widgets.TbButton',
		array(
				'context' => 'link',
				'label'=>'',
				'buttonType' =>'link',
				'size' => 'extra_small',
				'icon' => 'edit',
				'url' =>array('accheadedit','id'=>$data[$j]['acc_id']),
				'htmlOptions' => array('data-toggle' => 'tooltip', 'title' =>'Edit',),
                )) ; ?>
								</td>

							</tr>

							<?php

							  }
							  endfor;
							}

                          }
                          endfor;
						}
							}
							endforeach;
						?>

						</table>
					</div>

                   
                   <div class="col-md-6">
						<h2>LIABILITIES</h2>
						<p>
							<?php  
							$this->widget(
									'booster.widgets.TbButton',
									array(
											'context' => 'primary',
											'label'=>'Add Ledger',
											'buttonType' =>'link',
											'size' => 'extra_small',
                    	'icon' => 'plus',
                    	'url' => array('createacchead', 'parent' =>0,'top_parent'=>0,'depth'=>0,'category'=>'L','lr'=>'L'),
                  	  'htmlOptions' => array('rel' => 'tooltip', 'title' =>''),
                	)) ; ?>
							<?php
							$this->widget(
               	 'booster.widgets.TbButton',
              	  array(
                    'context' => 'primary',
                    'label'=>'Add Subgroup',
                	'buttonType' =>'link',
                    'size' => 'extra_small',
                    'icon' => 'plus',
                  	'url' => array('createacchead', 'parent' =>0,'top_parent'=>0,'depth'=>0,'category'=>'L','lr'=>'R'),
                    'htmlOptions' => array('rel' => 'tooltip', 'title' =>''),
                )) ; ?>

						</p>
						<table class="items table  table-bordered">
							<tr>
								<th colspan="3">Account</th>
								<th>Action</th>

							</tr>

							<?php 

							foreach ($data as $key=> $row):

							if( $row['depth']=='0' && $row['category']=='L')
							{
							if($row['lr']=='L'){ ?>
							<tr>
								<td colspan="3"><?php echo $row['name']?></td>
								<td>
									<?php
							$this->widget(
               	 'booster.widgets.TbButton',
              	  array(
                    'context' => 'link',
                    'label'=>'',
                	'buttonType' =>'link',
                    'size' => 'extra_small',
                    'icon' => 'trash',
                  	'url' =>"#",
                    'htmlOptions' => array("submit"=>array('accheaddelete', 'id'=>$row['acc_id']), 'confirm' => 'Are you sure?','data-toggle' => 'tooltip', 'title' =>'Delete'),
                )) ; 

                      $this->widget(
		'booster.widgets.TbButton',
		array(
				'context' => 'link',
				'label'=>'',
				'buttonType' =>'link',
				'size' => 'extra_small',
				'icon' => 'edit',
				'url' =>array('accheadedit','id'=>$row['acc_id']),
				'htmlOptions' => array('data-toggle' => 'tooltip', 'title' =>'Edit',),
                )) ; ?>
                       
						</td>	
							</tr>
							<?php
						 }

						else{ ?>
							<tr>
								<td colspan="3"><b><?php echo $row['name']?> </b></td>
								<td><?php  
								$this->widget(
                		'booster.widgets.TbButton',
               			 array(
                    	'context' => 'primary',
                     	'label'=>'Add Ledger',
                		'buttonType' =>'link',
                   	 	'size' => 'extra_small',
                    	'icon' => 'plus',
                    	'url' => array('createacchead', 'parent' =>$row['acc_id'],'top_parent'=>$row['acc_id'],'depth'=>1,'category'=>'L','lr'=>'L'),
                  	  'htmlOptions' => array(),
                	)) ; ?> 
                	<?php
						$this->widget(
               	 'booster.widgets.TbButton',
              	  array(
                    'context' => 'primary',
                    'label'=>'Add Subgroup',
                	'buttonType' =>'link',
                    'size' => 'extra_small',
                    'icon' => 'plus',
                  	'url' => array('createacchead', 'parent' =>$row['acc_id'],'top_parent'=>$row['acc_id'],'depth'=>1,'category'=>'L','lr'=>'R'),
                    'htmlOptions' => array('rel' => 'tooltip', 'title' =>''),
                )) ; ?>
								
								
								
					<?php
							$this->widget(
               	 'booster.widgets.TbButton',
              	  array(
                    'context' => 'link',
                    'label'=>'',
                	'buttonType' =>'link',
                    'size' => 'extra_small',
                    'icon' => 'trash',
                  	'url' =>"#",
                    'htmlOptions' => array("submit"=>array('accheaddelete', 'id'=>$row['acc_id']), 'confirm' => 'Are you sure?','data-toggle' => 'tooltip', 'title' =>'Delete'),
                )) ; 

                      $this->widget(
		'booster.widgets.TbButton',
		array(
				'context' => 'link',
				'label'=>'',
				'buttonType' =>'link',
				'size' => 'extra_small',
				'icon' => 'edit',
				'url' =>array('accheadedit','id'=>$row['acc_id']),
				'htmlOptions' => array('data-toggle' => 'tooltip', 'title' =>'Edit',),
                )) ; ?>
								
								
								
								</td>

								<?php 	
								for($i=$key-1;$i>=0;$i--):
								if($row['acc_id']== $data[$i]['parent']){
                            if($data[$i]['lr']=='L'){
							 ?>
							
							
							<tr>
								<td></td>
								<td colspan="2"><?php echo $data[$i]['name']?></td>

								<td>
								  <?php
							$this->widget(
               	 'booster.widgets.TbButton',
              	  array(
                    'context' => 'link',
                    'label'=>'',
                	'buttonType' =>'link',
                    'size' => 'extra_small',
                    'icon' => 'trash',
                  	'url' =>"#",
                    'htmlOptions' => array("submit"=>array('accheaddelete', 'id'=>$data[$i]['acc_id']), 'confirm' => 'Are you sure?','data-toggle' => 'tooltip', 'title' =>'Delete'),
                )) ; 

                      $this->widget(
		'booster.widgets.TbButton',
		array(
				'context' => 'link',
				'label'=>'',
				'buttonType' =>'link',
				'size' => 'extra_small',
				'icon' => 'edit',
				'url' =>array('accheadedit','id'=>$data[$i]['acc_id']),
				'htmlOptions' => array('data-toggle' => 'tooltip', 'title' =>'Edit',),
                )) ; ?>
								</td>

							</tr>

							<?php
							}
							else{
							 ?>
							<tr>
								<td></td>
								<td colspan="2"><b><?php echo $data[$i]['name']?> </b></td>

								<td><?php  
								$this->widget(
                		'booster.widgets.TbButton',
               			 array(
                    	'context' => 'primary',
                     	'label'=>'Add Ledger',
                		'buttonType' =>'link',
                   	 	'size' => 'extra_small',
                    	'icon' => 'plus',
                    	'url' => array('createacchead', 'parent' =>$data[$i]['acc_id'],'top_parent'=>$row['acc_id'],'depth'=>2,'category'=>'L','lr'=>'L'),
                  	  'htmlOptions' => array('rel' => 'tooltip', 'title' =>''),
                	)) ; ?>
								
						
								<?php
							$this->widget(
               	 'booster.widgets.TbButton',
              	  array(
                    'context' => 'link',
                    'label'=>'',
                	'buttonType' =>'link',
                    'size' => 'extra_small',
                    'icon' => 'trash',
                  	'url' =>"#",
                    'htmlOptions' => array("submit"=>array('accheaddelete', 'id'=>$data[$i]['acc_id']), 'confirm' => 'Are you sure?','data-toggle' => 'tooltip', 'title' =>'Delete'),
                )) ; 

                      $this->widget(
		'booster.widgets.TbButton',
		array(
				'context' => 'link',
				'label'=>'',
				'buttonType' =>'link',
				'size' => 'extra_small',
				'icon' => 'edit',
				'url' =>array('accheadedit','id'=>$data[$i]['acc_id']),
				'htmlOptions' => array('data-toggle' => 'tooltip', 'title' =>'Edit',),
                )) ; ?>
								
								
								</td>

							</tr>


							<?php
							for($j=$i-1;$j>=0;$j--):
							if($data[$i]['acc_id']== $data[$j]['parent']){
							?>
							<tr>
								<td></td>
								<td></td>
								<td colspan="1"><?php echo $data[$j]['name']?></td>

								<td>
								<?php
							$this->widget(
               	 'booster.widgets.TbButton',
              	  array(
                    'context' => 'link',
                    'label'=>'',
                	'buttonType' =>'link',
                    'size' => 'extra_small',
                    'icon' => 'trash',
                  	'url' =>"#",
                    'htmlOptions' => array("submit"=>array('accheaddelete', 'id'=>$data[$j]['acc_id']), 'confirm' => 'Are you sure?','data-toggle' => 'tooltip', 'title' =>'Delete'),
                )) ; 

                      $this->widget(
		'booster.widgets.TbButton',
		array(
				'context' => 'link',
				'label'=>'',
				'buttonType' =>'link',
				'size' => 'extra_small',
				'icon' => 'edit',
				'url' =>array('accheadedit','id'=>$data[$j]['acc_id']),
				'htmlOptions' => array('data-toggle' => 'tooltip', 'title' =>'Edit',),
                )) ; ?>
								</td>

							</tr>

							<?php

							  }
							  endfor;
							}

                          }
                          endfor;
						}
							}
							endforeach;
						?>

						</table>
					</div>
					
                   
				</div>
				
				<div class="row">
					<div class="col-md-6">
						<h2>EXPENSES</h2>
						<p>
							<?php  
							$this->widget(
									'booster.widgets.TbButton',
									array(
											'context' => 'primary',
											'label'=>'Add Ledger',
											'buttonType' =>'link',
											'size' => 'extra_small',
                    	'icon' => 'plus',
                    	'url' => array('createacchead', 'parent' =>0,'top_parent'=>0,'depth'=>0,'category'=>'E','lr'=>'L'),
                  	  'htmlOptions' => array('rel' => 'tooltip', 'title' =>''),
                	)) ; ?>
							<?php
							$this->widget(
               	 'booster.widgets.TbButton',
              	  array(
                    'context' => 'primary',
                    'label'=>'Add Subgroup',
                	'buttonType' =>'link',
                    'size' => 'extra_small',
                    'icon' => 'plus',
                  	'url' => array('createacchead', 'parent' =>0,'top_parent'=>0,'depth'=>0,'category'=>'E','lr'=>'R'),
                    'htmlOptions' => array('rel' => 'tooltip', 'title' =>''),
                )) ; ?>

						</p>
						<table class="items table  table-bordered">
							<tr>
								<th colspan="3">Account</th>
								<th>Action</th>

							</tr>

							<?php 

							foreach ($data as $key=> $row):

							if( $row['depth']=='0' && $row['category']=='E')
							{
							if($row['lr']=='L'){ ?>
							<tr>
								<td colspan="3"><?php echo $row['name']?></td>
								<td>
									<?php
							$this->widget(
               	 'booster.widgets.TbButton',
              	  array(
                    'context' => 'link',
                    'label'=>'',
                	'buttonType' =>'link',
                    'size' => 'extra_small',
                    'icon' => 'trash',
                  	'url' =>"#",
                    'htmlOptions' => array("submit"=>array('accheaddelete', 'id'=>$row['acc_id']), 'confirm' => 'Are you sure?','data-toggle' => 'tooltip', 'title' =>'Delete'),
                )) ; 

                      $this->widget(
		'booster.widgets.TbButton',
		array(
				'context' => 'link',
				'label'=>'',
				'buttonType' =>'link',
				'size' => 'extra_small',
				'icon' => 'edit',
				'url' =>array('accheadedit','id'=>$row['acc_id']),
				'htmlOptions' => array('data-toggle' => 'tooltip', 'title' =>'Edit',),
                )) ; ?>
                       
						</td>	
							</tr>
							<?php
						 }

						else{ ?>
							<tr>
								<td colspan="3"><b><?php echo $row['name']?> </b></td>
								<td><?php  
								$this->widget(
                		'booster.widgets.TbButton',
               			 array(
                    	'context' => 'primary',
                     	'label'=>'Add Ledger',
                		'buttonType' =>'link',
                   	 	'size' => 'extra_small',
                    	'icon' => 'plus',
                    	'url' => array('createacchead', 'parent' =>$row['acc_id'],'top_parent'=>$row['acc_id'],'depth'=>1,'category'=>'E','lr'=>'L'),
                  	  'htmlOptions' => array(),
                	)) ; ?> 
                	<?php
						$this->widget(
               	 'booster.widgets.TbButton',
              	  array(
                    'context' => 'primary',
                    'label'=>'Add Subgroup',
                	'buttonType' =>'link',
                    'size' => 'extra_small',
                    'icon' => 'plus',
                  	'url' => array('createacchead', 'parent' =>$row['acc_id'],'top_parent'=>$row['acc_id'],'depth'=>1,'category'=>'E','lr'=>'R'),
                    'htmlOptions' => array('rel' => 'tooltip', 'title' =>''),
                )) ; ?>
								
								
								
					<?php
							$this->widget(
               	 'booster.widgets.TbButton',
              	  array(
                    'context' => 'link',
                    'label'=>'',
                	'buttonType' =>'link',
                    'size' => 'extra_small',
                    'icon' => 'trash',
                  	'url' =>"#",
                    'htmlOptions' => array("submit"=>array('accheaddelete', 'id'=>$row['acc_id']), 'confirm' => 'Are you sure?','data-toggle' => 'tooltip', 'title' =>'Delete'),
                )) ; 

                      $this->widget(
		'booster.widgets.TbButton',
		array(
				'context' => 'link',
				'label'=>'',
				'buttonType' =>'link',
				'size' => 'extra_small',
				'icon' => 'edit',
				'url' =>array('accheadedit','id'=>$row['acc_id']),
				'htmlOptions' => array('data-toggle' => 'tooltip', 'title' =>'Edit',),
                )) ; ?>
								
								
								
								</td>

								<?php 	
								for($i=$key-1;$i>=0;$i--):
								if($row['acc_id']== $data[$i]['parent']){
                            if($data[$i]['lr']=='L'){
							 ?>
							
							
							<tr>
								<td></td>
								<td colspan="2"><?php echo $data[$i]['name']?></td>

								<td>
								  <?php
							$this->widget(
               	 'booster.widgets.TbButton',
              	  array(
                    'context' => 'link',
                    'label'=>'',
                	'buttonType' =>'link',
                    'size' => 'extra_small',
                    'icon' => 'trash',
                  	'url' =>"#",
                    'htmlOptions' => array("submit"=>array('accheaddelete', 'id'=>$data[$i]['acc_id']), 'confirm' => 'Are you sure?','data-toggle' => 'tooltip', 'title' =>'Delete'),
                )) ; 

                      $this->widget(
		'booster.widgets.TbButton',
		array(
				'context' => 'link',
				'label'=>'',
				'buttonType' =>'link',
				'size' => 'extra_small',
				'icon' => 'edit',
				'url' =>array('accheadedit','id'=>$data[$i]['acc_id']),
				'htmlOptions' => array('data-toggle' => 'tooltip', 'title' =>'Edit',),
                )) ; ?>
								</td>

							</tr>

							<?php
							}
							else{
							 ?>
							<tr>
								<td></td>
								<td colspan="2"><b><?php echo $data[$i]['name']?> </b></td>

								<td><?php  
								$this->widget(
                		'booster.widgets.TbButton',
               			 array(
                    	'context' => 'primary',
                     	'label'=>'Add Ledger',
                		'buttonType' =>'link',
                   	 	'size' => 'extra_small',
                    	'icon' => 'plus',
                    	'url' => array('createacchead', 'parent' =>$data[$i]['acc_id'],'top_parent'=>$row['acc_id'],'depth'=>2,'category'=>'E','lr'=>'L'),
                  	  'htmlOptions' => array('rel' => 'tooltip', 'title' =>''),
                	)) ; ?>
								
						
								<?php
							$this->widget(
               	 'booster.widgets.TbButton',
              	  array(
                    'context' => 'link',
                    'label'=>'',
                	'buttonType' =>'link',
                    'size' => 'extra_small',
                    'icon' => 'trash',
                  	'url' =>"#",
                    'htmlOptions' => array("submit"=>array('accheaddelete', 'id'=>$data[$i]['acc_id']), 'confirm' => 'Are you sure?','data-toggle' => 'tooltip', 'title' =>'Delete'),
                )) ; 

                      $this->widget(
		'booster.widgets.TbButton',
		array(
				'context' => 'link',
				'label'=>'',
				'buttonType' =>'link',
				'size' => 'extra_small',
				'icon' => 'edit',
				'url' =>array('accheadedit','id'=>$data[$i]['acc_id']),
				'htmlOptions' => array('data-toggle' => 'tooltip', 'title' =>'Edit',),
                )) ; ?>
								
								
								</td>

							</tr>


							<?php
							for($j=$i-1;$j>=0;$j--):
							if($data[$i]['acc_id']== $data[$j]['parent']){
							?>
							<tr>
								<td></td>
								<td></td>
								<td colspan="1"><?php echo $data[$j]['name']?></td>

								<td>
								<?php
							$this->widget(
               	 'booster.widgets.TbButton',
              	  array(
                    'context' => 'link',
                    'label'=>'',
                	'buttonType' =>'link',
                    'size' => 'extra_small',
                    'icon' => 'trash',
                  	'url' =>"#",
                    'htmlOptions' => array("submit"=>array('accheaddelete', 'id'=>$data[$j]['acc_id']), 'confirm' => 'Are you sure?','data-toggle' => 'tooltip', 'title' =>'Delete'),
                )) ; 

                      $this->widget(
		'booster.widgets.TbButton',
		array(
				'context' => 'link',
				'label'=>'',
				'buttonType' =>'link',
				'size' => 'extra_small',
				'icon' => 'edit',
				'url' =>array('accheadedit','id'=>$data[$j]['acc_id']),
				'htmlOptions' => array('data-toggle' => 'tooltip', 'title' =>'Edit',),
                )) ; ?>
								</td>

							</tr>

							<?php

							  }
							  endfor;
							}

                          }
                          endfor;
						}
							}
							endforeach;
						?>

						</table>
					</div>

                   
                   <div class="col-md-6">
						<h2>INCOMES</h2>
						<p>
							<?php  
							$this->widget(
									'booster.widgets.TbButton',
									array(
											'context' => 'primary',
											'label'=>'Add Ledger',
											'buttonType' =>'link',
											'size' => 'extra_small',
                    	'icon' => 'plus',
                    	'url' => array('createacchead', 'parent' =>0,'top_parent'=>0,'depth'=>0,'category'=>'R','lr'=>'L'),
                  	  'htmlOptions' => array('rel' => 'tooltip', 'title' =>''),
                	)) ; ?>
							<?php
							$this->widget(
               	 'booster.widgets.TbButton',
              	  array(
                    'context' => 'primary',
                    'label'=>'Add Subgroup',
                	'buttonType' =>'link',
                    'size' => 'extra_small',
                    'icon' => 'plus',
                  	'url' => array('createacchead', 'parent' =>0,'top_parent'=>0,'depth'=>0,'category'=>'R','lr'=>'R'),
                    'htmlOptions' => array('rel' => 'tooltip', 'title' =>''),
                )) ; ?>

						</p>
						<table class="items table  table-bordered">
							<tr>
								<th colspan="3">Account</th>
								<th>Action</th>

							</tr>

							<?php 

							foreach ($data as $key=> $row):

							if( $row['depth']=='0' && $row['category']=='R')
							{
							if($row['lr']=='L'){ ?>
							<tr>
								<td colspan="3"><?php echo $row['name']?></td>
								<td>
									<?php
							$this->widget(
               	 'booster.widgets.TbButton',
              	  array(
                    'context' => 'link',
                    'label'=>'',
                	'buttonType' =>'link',
                    'size' => 'extra_small',
                    'icon' => 'trash',
                  	'url' =>"#",
                    'htmlOptions' => array("submit"=>array('accheaddelete', 'id'=>$row['acc_id']), 'confirm' => 'Are you sure?','data-toggle' => 'tooltip', 'title' =>'Delete'),
                )) ; 

                      $this->widget(
		'booster.widgets.TbButton',
		array(
				'context' => 'link',
				'label'=>'',
				'buttonType' =>'link',
				'size' => 'extra_small',
				'icon' => 'edit',
				'url' =>array('accheadedit','id'=>$row['acc_id']),
				'htmlOptions' => array('data-toggle' => 'tooltip', 'title' =>'Edit',),
                )) ; ?>
                       
						</td>	
							</tr>
							<?php
						 }

						else{ ?>
							<tr>
								<td colspan="3"><b><?php echo $row['name']?> </b></td>
								<td><?php  
								$this->widget(
                		'booster.widgets.TbButton',
               			 array(
                    	'context' => 'primary',
                     	'label'=>'Add Ledger',
                		'buttonType' =>'link',
                   	 	'size' => 'extra_small',
                    	'icon' => 'plus',
                    	'url' => array('createacchead', 'parent' =>$row['acc_id'],'top_parent'=>$row['acc_id'],'depth'=>1,'category'=>'R','lr'=>'L'),
                  	  'htmlOptions' => array(),
                	)) ; ?> 
                	<?php
						$this->widget(
               	 'booster.widgets.TbButton',
              	  array(
                    'context' => 'primary',
                    'label'=>'Add Subgroup',
                	'buttonType' =>'link',
                    'size' => 'extra_small',
                    'icon' => 'plus',
                  	'url' => array('createacchead', 'parent' =>$row['acc_id'],'top_parent'=>$row['acc_id'],'depth'=>1,'category'=>'R','lr'=>'R'),
                    'htmlOptions' => array('rel' => 'tooltip', 'title' =>''),
                )) ; ?>
								
								
								
					<?php
							$this->widget(
               	 'booster.widgets.TbButton',
              	  array(
                    'context' => 'link',
                    'label'=>'',
                	'buttonType' =>'link',
                    'size' => 'extra_small',
                    'icon' => 'trash',
                  	'url' =>"#",
                    'htmlOptions' => array("submit"=>array('accheaddelete', 'id'=>$row['acc_id']), 'confirm' => 'Are you sure?','data-toggle' => 'tooltip', 'title' =>'Delete'),
                )) ; 

                      $this->widget(
		'booster.widgets.TbButton',
		array(
				'context' => 'link',
				'label'=>'',
				'buttonType' =>'link',
				'size' => 'extra_small',
				'icon' => 'edit',
				'url' =>array('accheadedit','id'=>$row['acc_id']),
				'htmlOptions' => array('data-toggle' => 'tooltip', 'title' =>'Edit',),
                )) ; ?>
								
								
								
								</td>

								<?php 	
								for($i=$key-1;$i>=0;$i--):
								if($row['acc_id']== $data[$i]['parent']){
                            if($data[$i]['lr']=='L'){
							 ?>
							
							
							<tr>
								<td></td>
								<td colspan="2"><?php echo $data[$i]['name']?></td>

								<td>
								  <?php
							$this->widget(
               	 'booster.widgets.TbButton',
              	  array(
                    'context' => 'link',
                    'label'=>'',
                	'buttonType' =>'link',
                    'size' => 'extra_small',
                    'icon' => 'trash',
                  	'url' =>"#",
                    'htmlOptions' => array("submit"=>array('accheaddelete', 'id'=>$data[$i]['acc_id']), 'confirm' => 'Are you sure?','data-toggle' => 'tooltip', 'title' =>'Delete'),
                )) ; 

                      $this->widget(
		'booster.widgets.TbButton',
		array(
				'context' => 'link',
				'label'=>'',
				'buttonType' =>'link',
				'size' => 'extra_small',
				'icon' => 'edit',
				'url' =>array('accheadedit','id'=>$data[$i]['acc_id']),
				'htmlOptions' => array('data-toggle' => 'tooltip', 'title' =>'Edit',),
                )) ; ?>
								</td>

							</tr>

							<?php
							}
							else{
							 ?>
							<tr>
								<td></td>
								<td colspan="2"><b><?php echo $data[$i]['name']?> </b></td>

								<td><?php  
								$this->widget(
                		'booster.widgets.TbButton',
               			 array(
                    	'context' => 'primary',
                     	'label'=>'Add Ledger',
                		'buttonType' =>'link',
                   	 	'size' => 'extra_small',
                    	'icon' => 'plus',
                    	'url' => array('createacchead', 'parent' =>$data[$i]['acc_id'],'top_parent'=>$row['acc_id'],'depth'=>2,'category'=>'R','lr'=>'L'),
                  	  'htmlOptions' => array('rel' => 'tooltip', 'title' =>''),
                	)) ; ?>
								
						
								<?php
							$this->widget(
               	 'booster.widgets.TbButton',
              	  array(
                    'context' => 'link',
                    'label'=>'',
                	'buttonType' =>'link',
                    'size' => 'extra_small',
                    'icon' => 'trash',
                  	'url' =>"#",
                    'htmlOptions' => array("submit"=>array('accheaddelete', 'id'=>$data[$i]['acc_id']), 'confirm' => 'Are you sure?','data-toggle' => 'tooltip', 'title' =>'Delete'),
                )) ; 

                      $this->widget(
		'booster.widgets.TbButton',
		array(
				'context' => 'link',
				'label'=>'',
				'buttonType' =>'link',
				'size' => 'extra_small',
				'icon' => 'edit',
				'url' =>array('accheadedit','id'=>$data[$i]['acc_id']),
				'htmlOptions' => array('data-toggle' => 'tooltip', 'title' =>'Edit',),
                )) ; ?>
								
								
								</td>

							</tr>


							<?php
							for($j=$i-1;$j>=0;$j--):
							if($data[$i]['acc_id']== $data[$j]['parent']){
							?>
							<tr>
								<td></td>
								<td></td>
								<td colspan="1"><?php echo $data[$j]['name']?></td>

								<td>
								<?php
							$this->widget(
               	 'booster.widgets.TbButton',
              	  array(
                    'context' => 'link',
                    'label'=>'',
                	'buttonType' =>'link',
                    'size' => 'extra_small',
                    'icon' => 'trash',
                  	'url' =>"#",
                    'htmlOptions' => array("submit"=>array('accheaddelete', 'id'=>$data[$j]['acc_id']), 'confirm' => 'Are you sure?','data-toggle' => 'tooltip', 'title' =>'Delete'),
                )) ; 

                      $this->widget(
		'booster.widgets.TbButton',
		array(
				'context' => 'link',
				'label'=>'',
				'buttonType' =>'link',
				'size' => 'extra_small',
				'icon' => 'edit',
				'url' =>array('accheadedit','id'=>$data[$j]['acc_id']),
				'htmlOptions' => array('data-toggle' => 'tooltip', 'title' =>'Edit',),
                )) ; ?>
								</td>

							</tr>

							<?php

							  }
							  endfor;
							}

                          }
                          endfor;
						}
							}
							endforeach;
						?>

						</table>
					</div>
					
                   
				</div>
			</div>
		</div>
	</div>

</div>


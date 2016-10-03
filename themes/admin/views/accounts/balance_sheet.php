<?php
$this->breadcrumbs=array(
		'Accounts'=>array('index'),
		'Report'=>array(''),
		'Balance Sheet',
);
?>
<div class="row">
	
	<?php 
	if(isset($data)):
	$a_total_debit_balance=0;
	$a_total_crebit_balance=0;
	$l_total_debit_balance=0;
	$l_total_crebit_balance=0;
	$e_total_debit_balance=0;
	$e_total_crebit_balance=0;
	$r_total_debit_balance=0;
	$r_total_crebit_balance=0;
	
	
	foreach ($data as $key=> $row):
	if($row['balance']!=0 && $row['lr']=='L' && $row['category']=='A')
	{
		if($row['balance']>0)
			$a_total_debit_balance=$a_total_debit_balance+$row['balance'];
		else
			$a_total_crebit_balance=$a_total_crebit_balance+$row['balance'];
	
	}
	if($row['balance']!=0 && $row['lr']=='L' && $row['category']=='L')
	{
		if($row['balance']>0)
			$l_total_debit_balance=$l_total_debit_balance+$row['balance'];
		else
			$l_total_crebit_balance=$l_total_crebit_balance+$row['balance'];
	
	}
	
	if($row['balance']!=0 && $row['lr']=='L' && $row['category']=='E')
	{
		if($row['balance']>0)
			$e_total_debit_balance=$e_total_debit_balance+$row['balance'];
		else
			$e_total_crebit_balance=$e_total_crebit_balance+$row['balance'];
	
	}
	if($row['balance']!=0 && $row['lr']=='L' && $row['category']=='R')
	{
		if($row['balance']>0)
			$r_total_debit_balance=$r_total_debit_balance+$row['balance'];
		else
			$r_total_crebit_balance=$r_total_crebit_balance+$row['balance'];
	
	}
	
	endforeach;
	$a_total_balance=$a_total_debit_balance+$a_total_crebit_balance;
	$l_total_balance=$l_total_debit_balance+$l_total_crebit_balance;
	$e_total_balance=$e_total_debit_balance+$e_total_crebit_balance;
	$r_total_balance=$r_total_debit_balance+$r_total_crebit_balance;
	$net_profit_loss=$r_total_balance+$e_total_balance;
	
	?>
	<div class="col-md-12">
		<div class="panel">
		   <div class="panel-heading">
						<span class="panel-title"> Income Statement</span>
			</div>
			<div class="panel-body">
			     <div class="invoice-buttons">
				    <a href="javascript:window.print()" class="btn btn-default mr10"><i
						class="fa fa-print pr5"></i> Print</a>
				 </div>
			    <h2 style="text-align: center;">Balance Sheet <small>(<?php echo date("d-M-Y",strtotime($from_date)).' to '.date("d-M-Y",strtotime($to_date))  ?> )</small></h2>
				
			   <div class="row">
			    <div class="col-md-6">
				<h2>LIABILITIES</h2>
				<h3>
					<small> <?php //echo date("d-M-Y",strtotime($model->from_date)).' to '.date("d-M-Y",strtotime($model->to_date))  ?>
					</small>
				</h3>
				  		<table class="items table table-striped table-bordered">
					<tr>
						<th>Particulars</th>
						<th>Amount</th>
						<th>Total</th>
					
					</tr>

					<?php 

					foreach ($data as $key=> $row):		
					
					if($row['balance']!=0 && $row['depth']=='0' && $row['category']=='L')
					{
						if($row['lr']=='L'){ ?>
                        <tr>
						<td><?php echo $row['name']?></td>
						<td><?php echo $row['balance']>0?number_format($row['balance'],2,'.','').' Dr' :number_format(-1*$row['balance'],2,'.','').' Cr';?></td>
					   <td><?php echo $row['balance']>0?number_format($row['balance'],2,'.','').' Dr' :number_format(-1*$row['balance'],2,'.','').' Cr' ; ?></td>
					
					  </tr>
						<?php
						 }
						
						else{ ?>
                            <tr>
						<td><b><?php echo $row['name']?></b></td>
						<td></td>
					   <td><?php echo $row['balance']>0?number_format($row['balance'],2,'.','').' Dr' :number_format(-1*$row['balance'],2,'.','').' Cr' ; ?></td>
					
						<?php 	
                           for($i=$key-1;$i>=0;$i--){
                           	if($row['acc_id']== $data[$i]['parent']){?>
                           	 <tr>
							<td><?php echo $data[$i]['name']?></td>
							<td><?php echo $data[$i]['balance']>0?number_format($data[$i]['balance'],2,'.','').' Dr' :number_format(-1*$data[$i]['balance'],2,'.','').' Cr';?></td>
					   		<td> </td>
					 		</tr>	
                           		
                           	<?php }
                           }
						}
					}	
					?>		
				
										
					<?php 
					
					 endforeach; 
					 if($net_profit_loss<0){
                     $l_total_balance=$l_total_balance+($net_profit_loss);
					 ?>
					 
					 <tr>
					   <td> 
					    <?php echo 'Net Profit'  ?>
					   </td>
					   <td></td>
					   <td>
					   <?php echo number_format(-1*$net_profit_loss,2,'.','').' Cr'   ?>
					   </td>
					</tr>
					 <?php
                       } ?>
					 <tr>
						<th>Total</th>
						<th colspan="2">
						<?php
						
						echo $l_total_balance<0?number_format(-1*$l_total_balance,2,'.','').' Cr':number_format($l_total_balance,2,'.','').' Dr';?>
						</th>
						
					
					</tr>
					 
				</table>
				</div>
				
				 <div class="col-md-6">
				<h2>ASSETS</h2>
				<h3>
					<small> <?php //echo date("d-M-Y",strtotime($model->from_date)).' to '.date("d-M-Y",strtotime($model->to_date))  ?>
					</small>
				</h3>
				<table class="items table table-striped table-bordered">
					<tr>
						<th>Particulars</th>
						<th>Amount</th>
						<th>Total</th>
					
					</tr>

					<?php 					
					foreach ($data as $key=> $row):										
					if($row['balance']!=0 && $row['depth']=='0' && $row['category']=='A')
					{
						if($row['lr']=='L'){ ?>
                        <tr>
						<td><?php echo $row['name']?></td>
						<td><?php echo $row['balance']>0?number_format($row['balance'],2,'.','').' Dr' :number_format(-1*$row['balance'],2,'.','').' Cr';?></td>
					   <td><?php echo $row['balance']>0?number_format($row['balance'],2,'.','').' Dr' :number_format(-1*$row['balance'],2,'.','').' Cr' ; ?></td>
					
					  </tr>
						<?php
						 }
						
						else{ ?>
                            <tr>
						<td><b><?php echo $row['name']?></b></td>
						<td></td>
					   <td><?php echo $row['balance']>0?number_format($row['balance'],2,'.','').' Dr' :number_format(-1*$row['balance'],2,'.','').' Cr' ; ?></td>
					
						<?php 	
                           for($i=$key-1;$i>=0;$i--){
                           	if($row['acc_id']== $data[$i]['parent']){?>
                           	 <tr>
							<td><?php echo $data[$i]['name']?></td>
							<td><?php echo $data[$i]['balance']>0?number_format($data[$i]['balance'],2,'.','').' Dr' :number_format(-1*$data[$i]['balance'],2,'.','').' Cr';?></td>
					   		<td> </td>
					 		</tr>	
                           		
                           	<?php }
                           }
						}
					}	
					?>		
				
										
					<?php 
					
					 endforeach; 
					 if($net_profit_loss>0){
                     $a_total_balance=$a_total_balance+($net_profit_loss);
					 ?>
					 
					 <tr>
					   <td> 
					    <?php echo 'Net Loss'  ?>
					   </td>
					   <td></td>
					   <td>
					   <?php echo number_format($net_profit_loss,2,'.','').' Dr'   ?>
					   </td>
					</tr>
					 <?php
                       } ?>
					 
					 <tr>
						<th>Total</th>
						<th colspan="2">
						<?php
						
						echo $a_total_balance>0?number_format($a_total_balance,2,'.','').' Dr' :number_format(-1*$a_total_balance,2,'.','').' Cr';?>
						</th>
						
					
					</tr>
					 
				</table>
				
				</div>
              </div>
			</div>
		</div>
	</div>
	<?php endif;?>
</div>


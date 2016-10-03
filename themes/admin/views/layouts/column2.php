<?php $this->beginContent('//layouts/main'); ?>
<!-- Start: Topbar -->
			<header id="topbar">
				<div class="topbar-left">
				<?php if(isset($this->breadcrumbs)):?>
					<?php 
					$this->widget(
							'booster.widgets.TbBreadcrumbs',
							array(
									'links' =>$this->breadcrumbs,
							)
					);
					?>
				<?php endif?>	
				</div>
			
			</header>
			<!-- End: Topbar -->
			<!-- Begin: Content -->
			<section id="content" class="table-layout">
				<?php echo $content; ?>
				<aside class="tray tray-right tray290 va-t pn"
					data-tray-height="match">

					<!-- menu quick links -->
				

						<?php 
						$this->widget(
                    		'booster.widgets.TbMenu',
                    		array(
                    				'type' => 'list',
                    				'items' => $this->menu
							)
                    );
                    ?>

				</aside>
			</section>

			<!-- End: Content -->
<?php $this->endContent(); ?>			
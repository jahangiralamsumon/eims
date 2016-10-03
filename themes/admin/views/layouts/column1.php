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
			<section id="content" >
			<?php echo $content; ?>
			</section>
			<!-- End: Content -->
<?php $this->endContent(); ?>			
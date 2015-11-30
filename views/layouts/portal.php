	  <script>		
	  	var isAjax= <?php echo ($this->isAjax)? 1:0;?>;
	  	console.log("isAjax :", isAjax, "<?php echo $this->isAjax;?>");
	  </script>
<?php if(!$this->isAjax) :?>
			<? include( PIMCORE_LAYOUTS_DIRECTORY ."/inc_head.php") ; ?>
	<!-- start: BODY -->
	<body class="single-page" >
			<? include( PIMCORE_LAYOUTS_DIRECTORY ."/inc_slidingbar.php") ; ?>

		<div class="main-wrapper">
			<? include( PIMCORE_LAYOUTS_DIRECTORY ."/inc_topbar.php") ; ?>
			<? include( PIMCORE_LAYOUTS_DIRECTORY ."/inc_pageslide_left_full.php") ; ?>
			<? // include( PIMCORE_LAYOUTS_DIRECTORY ."/inc_pageslide_right.php") ; ?>

			<!-- start: MAIN CONTAINER -->
			<div class="main-container inner">
				<!-- start: PAGE -->
				<div class="main-content">
					<? include( PIMCORE_LAYOUTS_DIRECTORY ."/inc_panel_configuration_modal_form.php") ; ?>

					<div class="container">
						<? include( PIMCORE_LAYOUTS_DIRECTORY ."/inc_toolbar_subview.php") ; ?>
						<!-- start: PAGE CONTENT -->
						<div class="row">
							<div id="ajax-content" class="col-md-12">
								<?= $this->layout()->content; ?>
							</div>
						</div>
						<!-- end: PAGE CONTENT-->
					</div>

					<div class="subviews">
						<div class="subviews-container"></div>
					</div>
				</div>
				<!-- end: PAGE -->
			</div>
			<!-- end: MAIN CONTAINER -->
			<? include( PIMCORE_LAYOUTS_DIRECTORY ."/inc_footer.php") ; ?>
			<? include( PIMCORE_LAYOUTS_DIRECTORY ."/inc_subview_calendar_page.php") ; ?>
			<? include( PIMCORE_LAYOUTS_DIRECTORY ."/inc_subview_person.php") ; ?>
			<? include( PIMCORE_LAYOUTS_DIRECTORY ."/inc_subview_sample_contents.php") ; ?>
			
			
			</div>
			<? include( PIMCORE_LAYOUTS_DIRECTORY ."/inc_footer_js.php") ; ?>
		
	</body>
	<!-- end: BODY -->
</html>
<?php else :?>
	<?= $this->layout()->content; ?>
	<? include( PIMCORE_LAYOUTS_DIRECTORY ."/inc_footer_js_ajax.php") ; ?>
<?php endif;?>
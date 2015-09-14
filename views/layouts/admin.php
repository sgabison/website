			<? include( PIMCORE_LAYOUTS_DIRECTORY ."/inc_head.php") ; ?>
	<!-- start: BODY -->
	<body >
			<? // include( PIMCORE_LAYOUTS_DIRECTORY ."/inc_slidingbar.php") ; ?>

		<div class="main-wrapper">
			<!-- start: MAIN CONTAINER -->
			
				<!-- start: PAGE -->
				<div class="main-content">
					<? include( PIMCORE_LAYOUTS_DIRECTORY ."/inc_panel_configuration_modal_form.php") ; ?>

					<div class="container">
						<!-- start: PAGE HEADER -->
						<!-- start: PAGE CONTENT -->
						<div class="row">
							<div id="" class="col-md-12">
								<?= $this->layout()->content; ?>
							</div>
						</div>
						<!-- end: PAGE CONTENT-->
					</div>

				
				
				<!-- end: PAGE -->
			</div>
			<!-- end: MAIN CONTAINER -->
			</div>
			<? include( PIMCORE_LAYOUTS_DIRECTORY ."/inc_footer_js.php") ; ?>
		
	</body>
	<!-- end: BODY -->
</html>
			<? include( PIMCORE_LAYOUTS_DIRECTORY ."/inc_head.php") ; ?>
	<!-- start: BODY -->
	<body>
			<? include( PIMCORE_LAYOUTS_DIRECTORY ."/inc_slidingbar.php") ; ?>

		<div class="main-wrapper">
			<? //include( PIMCORE_LAYOUTS_DIRECTORY ."/inc_topbar_resa.php") ; ?>
			<? include( PIMCORE_LAYOUTS_DIRECTORY ."/inc_pageslide_intro_left.php") ; ?>
			<? //include( PIMCORE_LAYOUTS_DIRECTORY ."/inc_pageslide_right.php") ; ?>

			<!-- start: MAIN CONTAINER -->
			<div class="main-container inner">
				<!-- start: PAGE -->
				<div class="main-content" style="background-color:transparent">
					<? // include( PIMCORE_LAYOUTS_DIRECTORY ."/inc_panel_configuration_modal_form.php") ; ?>

					<div class="container">
						<!-- start: PAGE HEADER -->
					<? // include( PIMCORE_LAYOUTS_DIRECTORY ."/inc_toolbar.php") ; ?>
						<!-- end: PAGE HEADER -->
					<? // include( PIMCORE_LAYOUTS_DIRECTORY ."/inc_breadcrumb.php") ; ?>
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
			<? include( PIMCORE_LAYOUTS_DIRECTORY ."/inc_footer_js.php") ; ?>
			<? include( PIMCORE_LAYOUTS_DIRECTORY ."/inc_subview_calendar_page.php") ; ?>
			<? include( PIMCORE_LAYOUTS_DIRECTORY ."/inc_subview_sample_contents.php") ; ?>
		</div>
		<!-- start: MAIN JAVASCRIPTS -->
		<?php echo $this->headScript(); ?>
		<script>jQuery(document).ready(function() { Main.init(); } );</script>
		<!-- end: CORE JAVASCRIPTS  -->
	</body>
	<!-- end: BODY -->
</html>
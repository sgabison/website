			<? include( PIMCORE_LAYOUTS_DIRECTORY ."/inc_head.php") ; ?>
	<!-- start: BODY -->
	<body>
			<? include( PIMCORE_LAYOUTS_DIRECTORY ."/inc_slidingbar_resa.php") ; ?>

		<div class="main-wrapper">
			<? //include( PIMCORE_LAYOUTS_DIRECTORY ."/inc_topbar_resa.php") ; ?>
			<? include( PIMCORE_LAYOUTS_DIRECTORY ."/inc_pageslide_left.php") ; ?>
			<? //include( PIMCORE_LAYOUTS_DIRECTORY ."/inc_pageslide_right.php") ; ?>

			<!-- start: MAIN CONTAINER -->
			<div class="main-container inner">
				<!-- start: PAGE -->
				<div class="main-content" style="background-color:#FFFFFF">
			<? //include( PIMCORE_LAYOUTS_DIRECTORY ."/inc_panel_configuration_modal_form.php") ; ?>

			<?= $this->layout()->content; ?>
<!--
					<div class="subviews">
						<div class="subviews-container">		
						</div>
					</div>
-->
				</div>
				<!-- end: PAGE -->
			</div>
			<!-- end: MAIN CONTAINER -->
			<? include( PIMCORE_LAYOUTS_DIRECTORY ."/inc_footer_js.php") ; ?>
			<? //include( PIMCORE_LAYOUTS_DIRECTORY ."/inc_subview_calendar_page.php") ; ?>
			<? //include( PIMCORE_LAYOUTS_DIRECTORY ."/inc_subview_sample_contents.php") ; ?>
		</div>
		<!-- start: MAIN JAVASCRIPTS -->
		<script src="<?= PIMCORE_WEBSITE_LAYOUTS?>/assets/js/userreservationform-validation.js"></script>
		<script src="<?= PIMCORE_WEBSITE_LAYOUTS?>/assets/js/userreservationform-validation-1.js"></script>
		<script src="<?= PIMCORE_WEBSITE_LAYOUTS?>/assets/plugins/jQuery-Tags-Input/jquery.tagsinput.js">
		<script src="<?= PIMCORE_WEBSITE_LAYOUTS?>/assets/js/form-elements.js"></script>
                <!-- end: JAVASCRIPTS REQUIRED FOR THIS PAGE ONLY -->
		<!-- start: CORE JAVASCRIPTS  -->
		<?php echo $this->headScript(); ?>
		<!-- end: CORE JAVASCRIPTS  -->
	</body>
	<!-- end: BODY -->
</html>
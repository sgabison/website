			<? include( PIMCORE_LAYOUTS_DIRECTORY ."/inc_head.php") ; ?>
	<!-- start: BODY -->
	<body>
			<? include( PIMCORE_LAYOUTS_DIRECTORY ."/inc_slidingbar.php") ; ?>

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
		</div>
		<!-- start: MAIN JAVASCRIPTS -->
		<?php echo $this->headScript(); ?>
		<!-- end: CORE JAVASCRIPTS  -->
	</body>
	<!-- end: BODY -->
</html>
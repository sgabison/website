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
			<? include( PIMCORE_LAYOUTS_DIRECTORY ."/inc_subview_calendar_page.php") ; ?>
			<? include( PIMCORE_LAYOUTS_DIRECTORY ."/inc_subview_sample_contents.php") ; ?>
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
<script>
jQuery(document).ready(function() {
	Main.init();
	ReservationFormValidator.init();
	var newresa="newresa";
	var	today=new Date();
	var getMonth2=function(date) {
	   var month = date.getMonth() + 1;
	   return month < 10 ? "0" + month : "" + month;
	}
	var getDate2=function(date) {
	   var day = date.getDate();
	   return day < 10 ? "0" + day : "" + day;
	} 
	$("body").on("click", ".locationlinkfinal", function(){
		$('.registergroup').addClass('no-display');
		$('.registergroup1').addClass('no-display');
		$('.registergroup2').addClass('no-display');
		$('.selectgroup').addClass('no-display');
		$('.slotgroup').addClass('no-display');
		$('#calendarbox').removeClass('no-display');
		newdate=$(".mycalendar").datepicker("getDate");
		$.formattednewDate=function(exampledate, today){
			if(exampledate==null || exampledate===false){
				return getDate2(today)+'-'+getMonth2(today)+'-'+today.getFullYear();
			}else{
				return getDate2(exampledate)+'-'+getMonth2(exampledate)+'-'+exampledate.getFullYear();	
			}
		}
		$.ajax({url: "/fr/booking/userselectiongroup?locationid="+$("#select_location").val()+"&resadate="+$.formattednewDate(newdate, today)+"&method=CHANGE", success: function(result){
			$(".selectiongroup").html(result);
			ReservationFormValidator1.init();
			$('#calendarlinkdata').text( getDate2(today)+'-'+getMonth2(today)+'-'+today.getFullYear() );
			$('.locationlinkfinal').css( 'cursor', 'pointer' );
			$('#mycalendar').datepicker().on('changeDate', function (ev) {
			    $('#calendarlinkdata').text( $.formattedDate( $('#mycalendar').datepicker("getDate"), today ) );
			});
		}});
	});
});
</script>
	</body>
	<!-- end: BODY -->
</html>
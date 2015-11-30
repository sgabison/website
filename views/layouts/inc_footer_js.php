		<!-- start: MAIN JAVASCRIPTS -->
		<!--[if lt IE 9]>
			<script type="text/javascript"  src="<?= PIMCORE_WEBSITE_LAYOUTS?>/assets/plugins/respond.min.js"></script>
			<script type="text/javascript"  src="<?= PIMCORE_WEBSITE_LAYOUTS?>/assets/plugins/excanvas.min.js"></script>
			<script type="text/javascript" src="http://code.jquery.com/ui/1.11.1/jquery-ui.min.js"></script>
		<![endif]-->
		<!--[if gte IE 9]><!-->
			<script  type="text/javascript" src="http://code.jquery.com/jquery-2.1.1.min.js"></script>
		<!--<![endif]-->
		<script  type="text/javascript" src="//cdnjs.cloudflare.com/ajax/libs/i18next/1.6.3/i18next-1.6.3.min.js"></script>
		<script>		
	    	var language='fr'; //default
		
			var runTranslate=function(){
				var option = { 
						useLocalStorage: true ,
						localStorageExpirationTime: 864000000,
					    lang: '<?php echo $this->language ?>',
					    lng:'<?php echo $this->language ?>',
					    debug: true,
					    fallbackLng: false,
					    useCookie: false ,
					    load:'unspecific',
					    language : '<?php echo $this->language ?>',
					    resGetPath: "/website/var/tmp/traduction/<?php echo $this->language ?>/trad.json",
					    fallbackLng: ['fr', 'en']
			
					};
					i18n.locale = "fr_FR";
					i18n.init(option);
					language = '<?php echo $this->language ?>';
					console.log( 'translate json ', language, i18n.t("display_cancelled"),  i18n.t("display_cancelled") );
			};
			var runTranslate2=function(){
				$.holdReady( true );
				$.getJSON('/data/default/trad', function(data){ 
					var option={    resStore: data, lng: data.lng , 
									useLocalStorage: true  ,
									localStorageExpirationTime: 8640000000  // in ms, default 1 week
								};
					i18n.init(option);
					console.log( 'translate php ', data.lng, i18n.t("offsite") );		
					language = data.lng;
					$.holdReady( false );			
				});			
			};
			$(document).ready(function() {	
				console.log( 'Offsite 2 ', language, i18n.t("offsite"),  t("Offsite") );
			});
			<?php $filename= PIMCORE_TMP_DIRECTORY.'/traduction/'.$this->language.'/trad.json';?>
			<?php if ( !file_exists($filename) ) :?>			
			runTranslate2();
			<?php else: ?>
			runTranslate();
			<?php endif;?>
		</script>
				
		<script  type="text/javascript"  src="<?= PIMCORE_WEBSITE_LAYOUTS?>/assets/plugins/jquery-ui/jquery-ui-1.10.2.custom.min.js"></script>
		<script  type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.5/js/bootstrap.min.js"></script>		
		<script  type="text/javascript" src="<?= PIMCORE_WEBSITE_LAYOUTS?>/assets/plugins/bootstrap-timepicker/js/bootstrap-timepicker.min.js"></script>
		<script  type="text/javascript" src="<?= PIMCORE_WEBSITE_LAYOUTS?>/assets/plugins/blockUI/jquery.blockUI.js"></script>
		<script  type="text/javascript" src="<?= PIMCORE_WEBSITE_LAYOUTS?>/assets/plugins/iCheck/jquery.icheck.min.js"></script>
		<script type="text/javascript"  src="<?= PIMCORE_WEBSITE_LAYOUTS?>/assets/plugins/moment/min/moment.min.js"></script>
		<script type="text/javascript"  src="<?= PIMCORE_WEBSITE_LAYOUTS?>/assets/plugins/perfect-scrollbar/src/jquery.mousewheel.js"></script>
		<script  type="text/javascript" src="<?= PIMCORE_WEBSITE_LAYOUTS?>/assets/plugins/perfect-scrollbar/src/perfect-scrollbar.js"></script>
		<script  type="text/javascript" src="<?= PIMCORE_WEBSITE_LAYOUTS?>/assets/plugins/bootbox/bootbox.min.js"></script>
		<script  type="text/javascript" src="<?= PIMCORE_WEBSITE_LAYOUTS?>/assets/plugins/jquery.scrollTo/jquery.scrollTo.min.js"></script>
		<script type="text/javascript"  src="<?= PIMCORE_WEBSITE_LAYOUTS?>/assets/plugins/ScrollToFixed/jquery-scrolltofixed-min.js"></script>
		<script  type="text/javascript" src="<?= PIMCORE_WEBSITE_LAYOUTS?>/assets/plugins/jquery.appear/jquery.appear.js"></script>
		<script type="text/javascript" src="<?= PIMCORE_WEBSITE_LAYOUTS?>/assets/plugins/jquery-cookie/jquery.cookie.js"></script>
		<script  type="text/javascript" src="<?= PIMCORE_WEBSITE_LAYOUTS?>/assets/plugins/velocity/jquery.velocity.min.js"></script>
		<script type="text/javascript"  src="<?= PIMCORE_WEBSITE_LAYOUTS?>/assets/plugins/TouchSwipe/jquery.touchSwipe.min.js"></script>
		<script  type="text/javascript" src="<?= PIMCORE_WEBSITE_LAYOUTS?>/assets/plugins/ckeditor/ckeditor.js"></script>
		<script  type="text/javascript"  src="<?= PIMCORE_WEBSITE_LAYOUTS?>/assets/plugins/ckeditor/adapters/jquery.js"></script>
		<!-- end: MAIN JAVASCRIPTS -->
		<!-- start: JAVASCRIPTS REQUIRED FOR SUBVIEW CONTENTS -->
		<script  type="text/javascript"  src="<?= PIMCORE_WEBSITE_LAYOUTS?>/assets/plugins/owl-carousel/owl-carousel/owl.carousel.js"></script>
		<script type="text/javascript"  src="<?= PIMCORE_WEBSITE_LAYOUTS?>/assets/plugins/jquery-mockjax/jquery.mockjax.js"></script>
		<script type="text/javascript"  src="<?= PIMCORE_WEBSITE_LAYOUTS?>/assets/plugins/toastr/toastr.js"></script>
		<script type="text/javascript"  src="<?= PIMCORE_WEBSITE_LAYOUTS?>/assets/plugins/bootstrap-modal/js/bootstrap-modal.js"></script>
		<script type="text/javascript"  src="<?= PIMCORE_WEBSITE_LAYOUTS?>/assets/plugins/bootstrap-modal/js/bootstrap-modalmanager.js"></script>
		<script type="text/javascript"  src="<?= PIMCORE_WEBSITE_LAYOUTS?>/assets/plugins/fullcalendar/fullcalendar/fullcalendar.min.js"></script>
		<script type="text/javascript"  src="<?= PIMCORE_WEBSITE_LAYOUTS?>/assets/plugins/fullcalendar/fullcalendar/lang-all.js"></script>		
		<script type="text/javascript"  src="<?= PIMCORE_WEBSITE_LAYOUTS?>/assets/plugins/bootstrap-switch/dist/js/bootstrap-switch.min.js"></script>
		<script type="text/javascript" src="<?= PIMCORE_WEBSITE_LAYOUTS?>/assets/plugins/bootstrap-select/bootstrap-select.min.js"></script>
		<script  type="text/javascript" src="<?= PIMCORE_WEBSITE_LAYOUTS?>/assets/plugins/bootstrap-switch/dist/js/bootstrap-switch.min.js"></script>
		<script type="text/javascript"  src="<?= PIMCORE_WEBSITE_LAYOUTS?>/assets/plugins/jquery-validation/dist/jquery.validate.min.js"></script>		
		<script type="text/javascript"  src="<?= PIMCORE_WEBSITE_LAYOUTS?>/assets/plugins/bootstrap-fileupload/bootstrap-fileupload.min.js"></script>

		<script type="text/javascript"  src="<?= PIMCORE_WEBSITE_LAYOUTS?>/assets/js/subview.js"></script>
		<script type="text/javascript"  src="<?= PIMCORE_WEBSITE_LAYOUTS?>/assets/plugins/jquery.pulsate/jquery.pulsate.min.js"></script>
		<script type="text/javascript"  src="<?= PIMCORE_WEBSITE_LAYOUTS?>/assets/js/pages-user-profile.js"></script>
		<script type="text/javascript"  src="<?= PIMCORE_WEBSITE_LAYOUTS?>/assets/js/subview-examples2.js"></script>
		<script type="text/javascript"  src="<?= PIMCORE_WEBSITE_LAYOUTS?>/assets/plugins/jquery-ui-touch-punch/jquery.ui.touch-punch.min.js"></script>
		
<<<<<<< Updated upstream
		<script type="text/javascript"  src="<?= PIMCORE_WEBSITE_LAYOUTS?>/assets/plugins/bootstrap-typeahead/bootstrap-typeahead.js"></script>
		
		<script type="text/javascript"  src="<?= PIMCORE_WEBSITE_LAYOUTS?>/assets/plugins/truncate/jquery.truncate.js"></script>
		<script type="text/javascript"  src="<?= PIMCORE_WEBSITE_LAYOUTS?>/assets/plugins/summernote/dist/summernote.min.js"></script>
		<script type="text/javascript"  src="<?= PIMCORE_WEBSITE_LAYOUTS?>/assets/plugins/bootstrap-daterangepicker/daterangepicker.js"></script>
		<script type="text/javascript"  src="<?= PIMCORE_WEBSITE_LAYOUTS?>/assets/plugins/bootstrap-datepicker/js/bootstrap-datepicker.js"></script>
		<script type="text/javascript"  src="<?= PIMCORE_WEBSITE_LAYOUTS?>/assets/plugins/jquery.jsonify/jquery.jsonify-0.3.min.js"></script>
		<script type="text/javascript"  src="<?= PIMCORE_WEBSITE_LAYOUTS?>/assets/plugins/jquery-inputlimiter/jquery.inputlimiter.1.3.1.min.js"></script>
		<script  type="text/javascript" src="<?= PIMCORE_WEBSITE_LAYOUTS?>/assets/plugins/iCheck/jquery.icheck.min.js"></script>
=======
		<script src="<?= PIMCORE_WEBSITE_LAYOUTS?>/assets/plugins/bootstrap-typeahead/bootstrap-typeahead.js"></script>
		<!--<script src="<?= PIMCORE_WEBSITE_LAYOUTS?>/assets/plugins/typeaheadbundle/typeahead.bundle.js"></script>-->
		<script src="<?= PIMCORE_WEBSITE_LAYOUTS?>/assets/plugins/truncate/jquery.truncate.js"></script>
		<script src="<?= PIMCORE_WEBSITE_LAYOUTS?>/assets/plugins/summernote/dist/summernote.min.js"></script>
		<script src="<?= PIMCORE_WEBSITE_LAYOUTS?>/assets/plugins/bootstrap-daterangepicker/daterangepicker.js"></script>
		<script src="<?= PIMCORE_WEBSITE_LAYOUTS?>/assets/plugins/bootstrap-datepicker/js/bootstrap-datepicker.js"></script>
		<script src="<?= PIMCORE_WEBSITE_LAYOUTS?>/assets/plugins/jquery.jsonify/jquery.jsonify-0.3.min.js"></script>
		<script src="<?= PIMCORE_WEBSITE_LAYOUTS?>/assets/plugins/jquery-inputlimiter/jquery.inputlimiter.1.3.1.min.js"></script>
		<script src="<?= PIMCORE_WEBSITE_LAYOUTS?>/assets/plugins/iCheck/jquery.icheck.min.js"></script>
>>>>>>> Stashed changes
		<!-- end: JAVASCRIPTS REQUIRED FOR SUBVIEW CONTENTS -->
		<!-- start: JAVASCRIPTS REQUIRED FOR THIS DATATABLE ONLY -->
		
		<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jszip/2.5.0/jszip.min.js"></script>
		<script type="text/javascript" src="https://cdn.rawgit.com/bpampuch/pdfmake/0.1.18/build/pdfmake.min.js"></script>
		<script type="text/javascript" src="https://cdn.rawgit.com/bpampuch/pdfmake/0.1.18/build/vfs_fonts.js"></script>
		<script type="text/javascript" src="https://cdn.datatables.net/1.10.9/js/jquery.dataTables.min.js"></script>
		<script type="text/javascript" src="https://cdn.datatables.net/1.10.9/js/dataTables.bootstrap.min.js"></script>
		<script type="text/javascript" src="https://cdn.datatables.net/autofill/2.0.0/js/dataTables.autoFill.min.js"></script>
		<script type="text/javascript" src="https://cdn.datatables.net/autofill/2.0.0/js/autoFill.bootstrap.min.js"></script>
		<script type="text/javascript" src="https://cdn.datatables.net/buttons/1.0.3/js/dataTables.buttons.min.js"></script>
		<script type="text/javascript" src="https://cdn.datatables.net/buttons/1.0.3/js/buttons.bootstrap.min.js"></script>
		<script type="text/javascript" src="https://cdn.datatables.net/buttons/1.0.3/js/buttons.colVis.min.js"></script>
		<script type="text/javascript" src="https://cdn.datatables.net/buttons/1.0.3/js/buttons.flash.min.js"></script>
		<script type="text/javascript" src="https://cdn.datatables.net/buttons/1.0.3/js/buttons.html5.min.js"></script>
		<script type="text/javascript" src="https://cdn.datatables.net/buttons/1.0.3/js/buttons.print.min.js"></script>
		<script type="text/javascript" src="https://cdn.datatables.net/colreorder/1.2.0/js/dataTables.colReorder.min.js"></script>
		<script type="text/javascript" src="https://cdn.datatables.net/fixedcolumns/3.1.0/js/dataTables.fixedColumns.min.js"></script>
		<script type="text/javascript" src="https://cdn.datatables.net/fixedheader/3.0.0/js/dataTables.fixedHeader.min.js"></script>
		<script type="text/javascript" src="https://cdn.datatables.net/keytable/2.0.0/js/dataTables.keyTable.min.js"></script>
		<script type="text/javascript" src="https://cdn.datatables.net/responsive/1.0.7/js/dataTables.responsive.min.js"></script>
		<script type="text/javascript" src="https://cdn.datatables.net/rowreorder/1.0.0/js/dataTables.rowReorder.min.js"></script>
		<script type="text/javascript" src="https://cdn.datatables.net/scroller/1.3.0/js/dataTables.scroller.min.js"></script>
		<script type="text/javascript" src="https://cdn.datatables.net/select/1.0.1/js/dataTables.select.min.js"></script>
		<script src="<?= PIMCORE_WEBSITE_LAYOUTS?>/assets/plugins/DataTables/extensions/Editor/js/dataTables.editor.min.js"></script>
		<!-- end: JAVASCRIPTS REQUIRED FOR THIS  Table export ONLY -->
		<!-- start: JAVASCRIPTS REQUIRED FOR THIS PAGE ONLY -->
		
		<script src="http://maps.google.com/maps/api/js?sensor=true"></script>
		
		<?php echo $this->headScript();?>
		
        <!-- end: JAVASCRIPTS REQUIRED FOR THIS PAGE ONLY -->
		<!-- start: CORE JAVASCRIPTS  -->
		<script src="<?= PIMCORE_WEBSITE_LAYOUTS?>/assets/js/main.js"></script>
		<!-- end: CORE JAVASCRIPTS  -->

		<?php echo $this->inlineScript(); ?>
		
		  
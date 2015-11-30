	  <script>		
	  	var isAjax= <?php echo ($this->isAjax)? 1:0;?>;
	  	console.log("isAjax :", isAjax, "<?php echo $this->isAjax;?>");
	  </script>
		<?php  echo $this->headScript();?>


		<?php  echo $this->inlineScript(); ?>
		
		 <script>	
		 $(document).ready(function() {	
				console.log( 'Offsite 4 ', language, i18n.t("offsite"),  t("Offsite") );
			});  
		var runAjaxSettings = function(){
	    	$( document ).one('ajaxComplete', function() {
	    		// toastr.success("Ajax completed");
	    	});
    	};
		 </script>	
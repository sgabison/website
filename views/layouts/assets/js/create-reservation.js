(function() {
// Localize jQuery variable
var jQuery;

/******** Load jQuery if not present *********/
if (window.jQuery === undefined || window.jQuery.fn.jquery !== '2.1.1') {
    var script_tag = document.createElement('script');
    script_tag.setAttribute("type","text/javascript");
    script_tag.setAttribute("src","http://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js");
    if (script_tag.readyState) {
      script_tag.onreadystatechange = function () { // For old versions of IE
          if (this.readyState == 'complete' || this.readyState == 'loaded') {
              scriptLoadHandler();
          }
      };
    } else { // Other browsers	
      script_tag.onload = function(){
      	scriptLoadHandler();
      }
    }
    // Try to find the head, otherwise default to the documentElement
    (document.getElementsByTagName("head")[0] || document.documentElement).appendChild(script_tag);
} else {
    // The jQuery version on the window is the one we want to use
    jQuery = window.jQuery;
    main();
}
/******** Called once jQuery has loaded ******/
function scriptLoadHandler() {
    // Restore $ and window.jQuery to their previous values and store the
    // new jQuery in our local jQuery variable
    jQuery = window.jQuery;
   	// Call our main function
   	main(); 
}

/******** Our main function ********/
function main() { 
	if( jQuery ){ console.log( 'success' );}else{console.log( 'failure' );}
    jQuery(document).ready(function($) {
/*
    	var result_link = $("<link>", { rel: "stylesheet", type: "text/css",  href: "http://demo.gabison.com/website/views/layouts/assets/css/result.css" });
    	result_link.appendTo('head');
*/
/*
    	var bootstrap_link = $("<link>", { rel: "stylesheet", type: "text/css",  href: "http://demo.gabison.com/website/views/layouts/assets/css/bootstrap.css" });
    	bootstrap_link.appendTo('head');
*/
    	var bootstrapmin_link = $("<link>", { rel: "stylesheet", type: "text/css",  href: "http://demo.gabison.com/website/views/layouts/assets/plugins/bootstrap/css/_bootstrapmin.css" });
    	var styles_link = $("<link>", { rel: "stylesheet", type: "text/css",  href: "http://demo.gabison.com/website/views/layouts/assets/css/_styles.css" });
    	var tagsinput_link = $("<link>", { rel: "stylesheet", type: "text/css",  href: "http://demo.gabison.com/website/views/layouts/assets/plugins/jQuery-Tags-Input/jquery.tagsinput.css" });
    	var toastr_link = $("<link>", { rel: "stylesheet", type: "text/css",  href: "http://demo.gabison.com/website/views/layouts/assets/plugins/bootstrap-daterangepicker/daterangepicker-bs3.css" });
		var daterangepicker_link = $("<link>", { rel: "stylesheet", type: "text/css",  href: "http://demo.gabison.com/website/views/layouts/assets/plugins/toastr/toastr.min.css" });
		var fontawesome_link = $("<link>", { rel: "stylesheet", type: "text/css",  href: "//maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css" });
		var plugins_link = $("<link>", { rel: "stylesheet", type: "text/css",  href: "http://demo.gabison.com/website/views/layouts/assets/css/_plugins.css" });
		bootstrapmin_link.appendTo('head');
		styles_link.appendTo('head');
		tagsinput_link.appendTo('head');
		daterangepicker_link.appendTo('head');
		toastr_link.appendTo('head');
		fontawesome_link.appendTo('head');
		plugins_link.appendTo('head');
        var jsonp_url = "http://demo.gabison.com/data/userreservation/userreservation?callback=?";
		var bootstrap_js = "http://demo.gabison.com/website/views/layouts/assets/plugins/bootstrap/js/bootstrap.min.js";
		var datepicker_js = "http://demo.gabison.com/website/views/layouts/assets/plugins/bootstrap-datepicker/js/bootstrap-datepicker.js";
		var formvalidator_js = "http://demo.gabison.com/website/views/layouts/assets/js/userreservationform-validation.js";
		var formvalidator1_js = "http://demo.gabison.com/website/views/layouts/assets/js/userreservationform-validation-1.js";
		var formelements_js = "http://demo.gabison.com/website/views/layouts/assets/js/form-elements.js";
		var validator_js = "http://demo.gabison.com/website/views/layouts/assets/plugins/jquery-validation/dist/jquery.validate.min.js";
		var tagsinput_js = "http://demo.gabison.com/website/views/layouts/assets/plugins/jQuery-Tags-Input/jquery.tagsinput.js";
		var blockui_js="http://demo.gabison.com/website/views/layouts/assets/plugins/blockUI/jquery.blockUI.js";
		var toastr_js="http://demo.gabison.com/website/views/layouts/assets/plugins/toastr/toastr.js";
		var compiled_js="http://demo.gabison.com/website/views/layouts/assets/js/compiled.js";
		var main_js="http://demo.gabison.com/website/views/layouts/assets/js/main.js";
        $('#example-widget-container').load("http://demo.gabison.com/data/userreservation/userreservation", function(){ 
			$.getScript(formvalidator1_js, function(){});
	        $.getScript(blockui_js, function(){});
	        $.getScript(tagsinput_js, function(){});
	        $.getScript(toastr_js, function(){});
	        $.getScript(bootstrap_js, function(){});
	        $.getScript(validator_js, function(){});
	        $.getScript(datepicker_js, function(){});
	        $.getScript(main_js, function(){});
			$.getScript(formelements_js, function(){
				$.getScript(formvalidator_js, function(){
 					Main.init();
 					ReservationFormValidator.init();
					var getMonth2=function(date) {
					   var month = date.getMonth() + 1;
					   return month < 10 ? "0" + month : "" + month;
					}
					var getDate2=function(date) {
					   var day = date.getDate();
					   return day < 10 ? "0" + day : "" + day;
					}  
					var	today=new Date();
					var thisDay=today.getDay();
					var days = ["Sunday","Monday","Tuesday","Wednesday","Thursday","Friday","Saturday"];
					var offdays = $("#offdays").val().split(",");
					console.log( offdays );
					console.log( days );
					$(".input-group.date").datepicker({ 
					startDate: "0d", 
					todayBtn: "linked", 
					todayHighlight: true, 
					defaultDate: new Date(), 
					autoclose: true, 
					//datesDisabled: offdays, 
					format: "dd-mm-yyyy",
					beforeShowDay: function (date){
						if( $.inArray(getDate2(date)+"-"+getMonth2(date)+"-"+date.getFullYear(), offdays)>=0){
							console.log( getDate2(date)+"-"+getMonth2(date)+"-"+date.getFullYear() );
							return {
								tooltip: "Restaurant is closed",
					                  classes: "today",
					                  enabled: false
							}
						}
					}
					});
					$("body").on("click", ".locationlinkfinal", function(){
						var newresa="newresa";
						newdate=$(".mycalendar").datepicker("getDate");
						formattednewdate=getDate2(newdate)+"-"+getMonth2(newdate)+"-"+newdate.getFullYear()
						$.ajax({url: "http://demo.gabison.com/fr/booking/userselectiongroup?locationid="+$("#select_location").val()+"&resadate="+formattednewdate+"&method=CHANGE", success: function(result){
							$(".selectiongroup").html(result);
							ReservationFormValidator1.init();
						}});
					});
 				});
			});
	    });
    });
}
})();
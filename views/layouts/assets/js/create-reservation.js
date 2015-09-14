(function() {
// Localize jQuery variable
var jQuery;
var URL = "http://www.resaexpress.com";
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
   	
    	var compiled_link = $("<link>", { rel: "stylesheet", type: "text/css",  href: URL+"/website/views/layouts/assets/css/compiled.css" });
    	compiled_link.appendTo('head');
		var fontawesome_link = $("<link>", { rel: "stylesheet", type: "text/css",  href: "//maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css" });
		fontawesome_link.appendTo('head');
        var jsonp_url = URL+"/data/userreservation/userreservation?callback=?";
		var bootstrap_js = URL+"/website/views/layouts/assets/plugins/bootstrap/js/bootstrap.min.js";
		var datepicker_js = URL+"/website/views/layouts/assets/plugins/bootstrap-datepicker/js/bootstrap-datepicker.js";
		var formvalidator_js = URL+"/website/views/layouts/assets/js/userreservationform-validation.js";
		var formvalidator1_js = URL+"/website/views/layouts/assets/js/userreservationform-validation-1.js";
		var formelements_js = URL+"/website/views/layouts/assets/js/form-elements.js";
		var validator_js = URL+"/website/views/layouts/assets/plugins/jquery-validation/dist/jquery.validate.min.js";
		var tagsinput_js = URL+"/website/views/layouts/assets/plugins/jQuery-Tags-Input/userjquery.tagsinput.js";
		var blockui_js = URL+"/website/views/layouts/assets/plugins/blockUI/jquery.blockUI.js";
		var toastr_js = URL+"/website/views/layouts/assets/plugins/toastr/toastr.js";
		var main_js = URL+"/website/views/layouts/assets/js/main.js";
		var select_js = URL+"/website/views/layouts/assets/plugins/bootstrap-select/bootstrap-select.min.js";
		var select2_js = URL+"/website/views/layouts/assets/plugins/select2/select2.min.js";
        $('#example-widget-container').load(URL+"/data/userreservation/userreservation", function(){ 
			$.getScript(formvalidator1_js, function(){});
	        $.getScript(blockui_js, function(){});
	        $.getScript(tagsinput_js, function(){});
	        $.getScript(toastr_js, function(){});
	        $.getScript(bootstrap_js, function(){});
	        $.getScript(validator_js, function(){});
	        $.getScript(datepicker_js, function(){});
	        $.getScript(main_js, function(){});
	        $.getScript(select_js, function(){});
	        $.getScript(select2_js, function(){});
			$.getScript(formelements_js, function(){
				$.getScript(formvalidator_js, function(){
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
						}});
					});
				});
			});
	    });
    });
}
})();
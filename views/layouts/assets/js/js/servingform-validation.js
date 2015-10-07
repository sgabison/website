var ServingFormValidator = function () {
	"use strict";
	$.urlParam = function(name){
	    var results = new RegExp('[\?&]' + name + '=([^&#]*)').exec(window.location.href);
	    if (results==null){
	       return null;
	    }
	    else{
	       return results[1] || 0;
	    }
	};
	$("input[type='checkbox'].make-switch").bootstrapSwitch();
	
	$('.initiate').timepicker({showMeridian: false});
	
	$('#copytimeslot').click( function(e){
		e.preventDefault();
		$('#initiateserving').addClass("no-display");
		$('#noserving').removeClass("no-display");
		$(".copystartinitiate").val( $('#startday').val() );
		$(".copyendinitiate").val( $('#endday').val() );
		$(".maxtables").val( $('#maxtables').val() );
		$(".maxseats").val( $('#maxseats').val() );
	});
	
	$.each([ 'monday', 'tuesday', 'wednesday', 'thursday', 'friday', 'saturday', 'sunday' ], function( index, value ) {
		$('#timestart'+value).timepicker({showMeridian: false});
		$('#timeend'+value).timepicker({showMeridian: false});
		$('input[name="closed'+value+'"]').on('switchChange.bootstrapSwitch', function(event, state) {
			if( state ){
				$('#timestart'+value).prop( "disabled", false );
				$('#timeend'+value).prop( "disabled", false );
				$('#maxseats'+value).prop( "disabled", false );
				$('#maxtables'+value).prop( "disabled", false );				
			}else{
				$('#timestart'+value).timepicker('setTime', '00:00 PM');
				$('#timestart'+value).prop( "disabled", true );
				$('#timeend'+value).timepicker('setTime', '00:00 PM');
				$('#timeend'+value).prop( "disabled", true );
				$('#maxseats'+value).prop( "disabled", true );
				$('#maxtables'+value).prop( "disabled", true );
			}
		});
	});
	var servingDataLoad = function () {
//		$('#formsubmit').click( function(){
			$.each([ 'monday', 'tuesday', 'wednesday', 'thursday', 'friday', 'saturday', 'sunday' ], function( index, value ) {
				if( $('input[name="closed'+value+'"]').is(':checked') ){ $('#closed'+value).val(0);}else{ $('#closed'+value).val(1);}
			});
			var serving = new Object;
			  serving.id= $("#servingid").val() 
			, serving.title = $("#title").val()
			, serving.maxseats = $("#maxseats").val()  
			, serving.maxtables = $("#maxtables").val()  
			, serving.closedmonday = $("#closedmonday").val()  
			, serving.mealduration = $("#mealduration").val()  
			, serving.closedmonday = $("#closedmonday").val()  
			, serving.timestartmonday = $("#timestartmonday").val()
			, serving.timeendmonday = $("#timeendmonday").val()
			, serving.maxseatsmonday = $("#maxseatsmonday").val()
			, serving.maxtablesmonday = $("#maxtablesmonday").val()
			, serving.closedtuesday = $("#closedtuesday").val()
			, serving.timestarttuesday = $("#timestarttuesday").val()
			, serving.timeendtuesday = $("#timeendtuesday").val()
			, serving.maxseatstuesday = $("#maxseatstuesday").val()
			, serving.maxtablestuesday = $("#maxtablestuesday").val()
			, serving.closedwednesday = $("#closedwednesday").val()
			, serving.timestartwednesday = $("#timestartwednesday").val()
			, serving.timeendwednesday = $("#timeendwednesday").val()
			, serving.maxseatswednesday = $("#maxseatswednesday").val()
			, serving.maxtableswednesday = $("#maxtableswednesday").val()
			, serving.closedthursday = $("#closedthursday").val()
			, serving.timestartthursday = $("#timestartthursday").val()
			, serving.timeendthursday = $("#timeendthursday").val()
			, serving.maxseatsthursday = $("#maxseatsthursday").val()
			, serving.maxtablesthursday = $("#maxtablesthursday").val()
			, serving.closedfriday = $("#closedfriday").val()
			, serving.timestartfriday = $("#timestartfriday").val()
			, serving.timeendfriday = $("#timeendfriday").val()
			, serving.maxseatsfriday = $("#maxseatsfriday").val()
			, serving.maxtablesfriday = $("#maxtablesfriday").val()
			, serving.closedsaturday = $("#closedsaturday").val()
			, serving.timestartsaturday = $("#timestartsaturday").val()
			, serving.timeendsaturday = $("#timeendsaturday").val()
			, serving.maxseatssaturday= $("#maxseatssaturday").val()
			, serving.maxtablessaturday = $("#maxtablessaturday").val()
			, serving.closedsunday = $("#closedsunday").val()
			, serving.timestartsunday = $("#timestartsunday").val()
			, serving.timeendsunday = $("#timeendsunday").val()
			, serving.maxseatssunday= $("#maxseatssunday").val()
			, serving.maxtablessunday = $("#maxtablessunday").val()
			, serving.METHOD = 'PUT';
			$.blockUI({
				message: '<i class="fa fa-spinner fa-spin"></i> Please wait...'
			});
			var reponse= new Object; // object(id,METHOD =(PUT,GET,POST,DELETE),data)
			reponse.data=serving;
			reponse.id = serving.id;
			reponse.METHOD = serving.METHOD; 
			$.ajax({
				url: '/data/advanceddid/get-data',
				dataType: 'json',
				type:'POST', //obligatoire
				data: JSON.stringify(reponse),
				contentType: "application/json; charset=utf-8",
				success: function(json) {
					$.unblockUI();
					if (json.success || json.success == 'true') {
						//var i = $("#reservation-id").val();
						//reservation[i] = json.data;
						toastr.success(serving.title + ' '+ json.message);
					}
				},
				error: function (request, status, error) {
					alert(error);
					//alert(JSON.stringify(request));
				}        
			});
//		});
	};
	var validateCheckRadio = function (val) {
        $("input[type='radio'], input[type='checkbox']").on('ifChecked', function(event) {
			$(this).parent().closest(".has-error").removeClass("has-error").addClass("has-success").find(".help-block").hide().end().find('.symbol').addClass('ok');
		});
    }; 
    // function to initiate Validation Sample 1
    var runValidator1 = function () {
        var form1 = $('#servingform');
        var errorHandler1 = $('.errorHandler', form1);
        var successHandler1 = $('.successHandler', form1);
        $('#servingform').validate({
            errorElement: "span", // contain the error msg in a span tag
            errorClass: 'help-block',
            errorPlacement: function (error, element) { // render error placement for each input type
                if (element.attr("type") == "radio" || element.attr("type") == "checkbox") { // for chosen elements, need to insert the error after the chosen container
                    error.insertAfter($(element).closest('.form-group').children('div').children().last());
                } else if (element.attr("name") == "dd" || element.attr("name") == "mm" || element.attr("name") == "yyyy") {
                    error.insertAfter($(element).closest('.form-group').children('div'));
                } else {
                    error.insertAfter(element);
                    // for other inputs, just perform default behavior
                }
            },
            ignore: "",
            rules: {
                maxseatsmonday: {
                    required: true,
                    number: true
                },
                maxseatstuesday: {
                    required: true,
                    number: true
                },
                maxseatswednesday: {
                    required: true,
                    number: true
                },
                maxseatsthursday: {
                    required: true,
                    number: true
                },
                maxseatsfriday: {
                    required: true,
                    number: true
                },
                maxseatssaturday: {
                    required: true,
                    number: true
                },
                maxseatssunday: {
                    required: true,
                    number: true
                },
                maxtablesmonday: {
                    required: true,
                    number: true
                },
                maxtablestuesday: {
                    required: true,
                    number: true
                },
                maxtableswednesday: {
                    required: true,
                    number: true
                },
                maxtablesthursday: {
                    required: true,
                    number: true
                },
                maxtablesfriday: {
                    required: true,
                    number: true
                },
                maxtablessaturday: {
                    required: true,
                    number: true
                },
                maxtablessunday: {
                    required: true,
                    number: true
                }
            },
            messages: {
                maxseatsmonday: "Please enter a maximum seats value, a numeric value",
                maxseatstuesday: "Please enter a maximum seats value, a numeric value",
                maxseatswednesday: "Please enter a maximum seats value, a numeric value",
                maxseatsthursday: "Please enter a maximum seats value, a numeric value",
                maxseatsfriday: "Please enter a maximum seats value, a numeric value",
                maxseatssaturday: "Please enter a maximum seats value, a numeric value",
                maxseatssunday: "Please enter a maximum seats value, a numeric value",
                maxtablesmonday: "Please enter a maximum tables value, a numeric value",
                maxtablestuesday: "Please enter a maximum tables value, a numeric value",
                maxtableswednesday: "Please enter a maximum tables value, a numeric value",
                maxtablesthursday: "Please enter a maximum tables value, a numeric value",
                maxtablesfriday: "Please enter a maximum tables value, a numeric value",
                maxtablessaturday: "Please enter a maximum tables value, a numeric value",
                maxtablessunday: "Please enter a maximum tables value, a numeric value"
            },
            invalidHandler: function (event, validator) { //display error alert on form submit
                successHandler1.hide();
                errorHandler1.show();
            },
            highlight: function (element) {
                $(element).closest('.help-block').removeClass('valid');
                // display OK icon
                $(element).closest('.form-group').removeClass('has-success').addClass('has-error').find('.symbol').removeClass('ok').addClass('required');
                // add the Bootstrap error class to the control group
            },
            unhighlight: function (element) { // revert the change done by hightlight
                $(element).closest('.form-group').removeClass('has-error');
                // set error class to the control group
            },
            success: function (label, element) {
                label.addClass('help-block valid');
                // mark the current input as valid and display OK icon
                $(element).closest('.form-group').removeClass('has-error').addClass('has-success').find('.symbol').removeClass('required').addClass('ok');
            },
            submitHandler: function (form) {
                successHandler1.show();
                errorHandler1.hide();
                //submit form
                servingDataLoad();
                //alert('submitform');
            }
        });
    };
    return {
        //main function to initiate template pages
        init: function () {
            runValidator1();
            
        }
    };
}();
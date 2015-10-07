var ReservationFormValidator2 = function () {
	"use strict";
	var backdrop = $('.ajax-white-backdrop2');
	backdrop.remove();
	$.urlParam = function(name){
	    var results = new RegExp('[\?&]' + name + '=([^&#]*)').exec(window.location.href);
	    if (results==null){
	       return null;
	    }
	    else{
	       return results[1] || 0;
	    }
	}
	$.reformatDate=function(dateStr){
	  var dArr = dateStr.split("-");  // ex input "2010-01-18"
	  return dArr[2]+ "-" +dArr[1]+ "-" +dArr[0]; //ex out: "18/01/10"
	}
//	$('#firslastname').change( function(){ updatelink(); });
//	$('#email').change(function(){ updatelink(); });
//	$('#tel').change(function(){ updatelink(); });
//	var updatelink=function(){
//		var locationid=$('#select_location').val();
//		var resadate=$('.mycalendar').val();
//		var tellink=$('#tel').val();
//		var emaillink=$('#email').val();
//		var namelink=$('#firstlastname').val();
//		var linkhref='/fr/booking/reservation?locationid='+locationid+'&resadate='+resadate+'&reservationid='+reservationid+'&method=CHANGE&firstlastname='+namelink+'&tel='+tellink+'&email='+emaillink;
//		$('.linkhref').attr('href',linkhref);		
//	}
	var reservationDataLoad = function () {
		var form1 = $('#bookingform');
		var	today=new Date();
		var thisDay=today.getDay();
		var days = ['Sunday','Monday','Tuesday','Wednesday','Thursday','Friday','Saturday'];
		$('.mycalendar').datepicker({ startDate: '0d', todayBtn: 'linked', todayHighlight: true, defaultDate: new Date(), autoclose: true });
		var resadate=$.urlParam('resadate');
		if( $('.mycalendar').val()=='' ){
			if( resadate ){
				resadate=$.reformatDate(resadate);
				$('.mycalendar').val( moment(resadate).format('DD-MM-YYYY') );
			}else{
				$('.mycalendar').val( moment().format('DD-MM-YYYY') );
			}
		}
		$(".calendar").trigger("change");
		console.log( 'select_location'+$('#select_location').val() );
		console.log( 'mycalendar: '+$('.mycalendar').val() );
		form1.attr('action','/data/reservation/get-data'); 
		form1.attr('method','POST');
		$('#submit').click( function(){
			var newReservation = new Object;
			  newReservation.id= $("#id").val() 
			, newReservation.lastname = $("#firstlastname").val()
			, newReservation.calendar = $(".mycalendar").val()
			, newReservation.email = $("#email").val()
			, newReservation.tel = $("#tel").val()
			, newReservation.partysize = $("#party").val()
			, newReservation.start = $("#slotinput").val()
			, newReservation.servinginput = $("#servinginput").val()
			, newReservation.locationid = $("#locationinput").val()
			, newReservation.reservationid = $("#locationinput").val()
			, newReservation.bookingnotes = $("#tags_1").val()
			, newReservation.METHOD = $("#method").val();
			$.blockUI({
				message: '<i class="fa fa-spinner fa-spin"></i> Do some ajax to sync with backend...'
			});
			var reponse= new Object; // object(id,method =(PUT,GET,POST,DELETE),data)
			reponse.data=newReservation;
			reponse.id = newReservation.id;
			reponse.METHOD = newReservation.METHOD; 
			$.ajax({
				url: '/data/reservation/get-data',
				dataType: 'json',
				type:'POST', //obligatoire
				data: JSON.stringify(reponse),
				contentType: "application/json; charset=utf-8",
				success: function(json) {
					$.unblockUI();
					if (json.success || json.success == 'true') {
						//var i = $("#reservation-id").val();
						//reservation[i] = json.data;
						toastr.success(newReservation.lastname + ' '+ json.message);
					}
				},
				error: function (request, status, error) {
					alert(error);
					//alert(JSON.stringify(request));
				}        
			});
		});

	};
	var reservationid=$.urlParam('reservationid');
    // function to initiate Validation Sample 1
    var runValidator1 = function () {
        var form1 = $('#bookingform');
        var errorHandler1 = $('.errorHandler', form1);
        var successHandler1 = $('.successHandler', form1);
        $.validator.addMethod("FullDate", function () {
            //if all values are selected
            if ($("#dd").val() != "" && $("#mm").val() != "" && $("#yyyy").val() != "") {
                return true;
            } else {
                return false;
            }
        }, 'Please select a day, month, and year');
        form1.validate({
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
                firstlastname: {
                    required: true,
                    minlength: 2
                },
                email: {
                    required: true,
                    email: true
                },
                tel: {
                    required: true,
                    number: true
                }
            },
            messages: {
                firstlastname: "Please enter your name",
                email: {
                    required: "We need your email address to contact you",
                    email: "Your email address must be in the format of name@domain.com"
                },
                tel: {
                    required: "We need your telephone # to contact you",
                    number: "enter your telephone number on 10 digits only"
                }
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
                //form.submit();
                //alert('submitform');
            }
        });
    };
	var runTagsInput = function() {
		$('#tags_1').tagsInput({
			width: 'auto'
		});
		if( $.urlParam('reservationid') !== null && $.urlParam('reservationid')!='' && $.urlParam('reservationid')!='undefined'){
			$('.panel-collapse').removeClass('expand');
			$('.panel-collapse').addClass('collapses');
			$('#tagpanel').show();
			$('.panel-collapse').find("span").text("Collapses");
		}
		if( $.urlParam('reservationid') !== null && $.urlParam('reservationid')!='' ){
			$('.registergroup').removeClass('no-display');
		}
	};
	var feedTags = function() {
		$('.btn-tags').click( function(){
			$(this).addClass('btn-red');
			//$('#tags_1').val( $('#tags_1').val() + $(this).val() + ',' );
			$('#tags_1').addTag( $(this).val() );
		});
	};
    return {
        //main function to initiate template pages
        init: function () {
            //validateCheckRadio();
            runValidator1();
			reservationDataLoad();
			runTagsInput();
			feedTags();
        }
    };
}();
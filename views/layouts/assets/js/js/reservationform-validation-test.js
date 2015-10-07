var ReservationFormValidator = function () {
	"use strict";
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
	var reservationDataLoad = function () {
		var	today=new Date();
		var thisDay=today.getDay();
		var days = ['Sunday','Monday','Tuesday','Wednesday','Thursday','Friday','Saturday'];
		$('#calendar').datepicker({ startDate: '0d', todayBtn: 'linked', todayHighlight: true, defaultDate: new Date(), autoclose: true });
		if( $.urlParam('reservationid') =='' ){
			var resadate=$.urlParam('resadate');
			if( resadate ){
				resadate=$.reformatDate(resadate);
				$('#calendar').val( moment(resadate).format('DD-MM-YYYY') );
			}else{
				$('#calendar').val( moment().format('DD-MM-YYYY') );
			}
		}
		$("#calendar").trigger("change");
		console.log( $('#select_location').val() );
		console.log( $('#calendar').val() );
		$("#servingform").attr('action','/data/advancedguest/get-data'); 
		$("#servingform").attr('method','POST');
		$('#submit').click( function(){
			var newReservation = new Object;
			  newReservation.id= $("#id").val() 
			, newReservation.lastname = $("#firstlastname").val()
			, newReservation.calendar = $("#calendar").val()
			, newReservation.email = $("#email").val()
			, newReservation.tel = $("#tel").val()
			, newReservation.partysize = $("#party").val()
			, newReservation.slotinput = $("#slotinput").val()
			, newReservation.servinginput = $("#servinginput").val()
			, newReservation.locationid = $("#locationinput").val()
			, newReservation.bookingnotes = $("#tags_1").val()
			, newReservation.METHOD = $("#METHOD").val();
			$.blockUI({
				message: '<i class="fa fa-spinner fa-spin"></i> Do some ajax to sync with backend...'
			});
			var reponse= new Object; // object(id,METHOD =(PUT,GET,POST,DELETE),data)
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
						toastr.success(newReservation.firstname +' '+ newReservation.lastname + ' '+ json.message);
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
	var lauchRequest = function(reservationid){
			$('.bookbutton').addClass('no-display');
			$('#selectgroup').removeClass('no-display');
			$('#calendarbox').addClass('no-display');
			$('#locationbox').addClass('no-display');
			$('#locationlink').removeClass('no-display');
			var locationid=$('#select_location').val();
			var locationname=$('#select_location option:selected' ).text();
			var resadate=$('#calendar').val();
			var linkhref='/fr/booking/reservation?locationid='+locationid+'&resadate='+resadate;
			$('#calendarlinkdata').text(resadate);
			$('#locationlinkdata').text(locationname);
			$('.linkhref').prop('href',linkhref); 
			var i=0;
			//clear up the divs
			i++;
			console.log( $('#calendar').val() );
			console.log( i );
			$('#servings').html(function(){ return '';});
			$('#slots').html(function(){ return '';});
			$('#inputs').html(function(){ return '';});
			$.ajax({
				url: "/data/reservation/resaslot?locationid="+locationid+"&date="+$('#calendar').val()+'&reservationid='+reservationid,
				dataType: "json",
				success: function(data) {
					var $log = $( "#servings" );
					var $res = $( "#slots" );
					var $input = $( "#inputs" );
					var valuebutton;
					var key;
					var html = $.parseHTML( );
					$log.append( html );
					$res.append( html );
					$input.append( html );
					//set up input fields
					var inputs="<input id=\"slotinput\" name=\"slotinput\" style=\"display:none\"><input id=\"servinginput\" name=\"servinginput\" style=\"display:none\"><input id=\"locationinput\" name=\"locationinput\" style=\"display:none\"><input id=\"METHOD\" name=\"METHOD\" value=\"POST\" style=\"display:none\"><input id=\"id\" name=\"id\" style=\"display:none\">";
					$input.append( inputs );
					var i=0;
					$.each(data.data, function (key, value) {
						i++;
						var serv=key.split("_-_");
						var button="<button id=\"servingbutton/"+i+"\" type=\"button\" class=\"btn btn-sm buttons-widget btn-dark-orange servingbutton\" serving=\""+key+"\" value=\""+serv[1]+"\" style=\"margin:5px\">"+serv[0]+"</button>";
						$log.append( button );									
					});
					$('.servingbutton').click(function() {
						$('#slots').html(function(){ return '';});
						$('.servingbutton').removeClass('btn-dark-orange');
						$(this).addClass('btn-dark-orange');
						var valuebutton=$(this).attr("serving");
						$('#servinginput').val( $(this).attr("value") );
						$.each(data.data, function (key, value) {
							if( key==valuebutton ){
								$.each(value, function (nyckel, slot) {
									var res=nyckel.split("-");
									var classresult;
									if( res[2] != 'ok' ){
										classresult = 'disabled';
									}else if( res[3] != 'ok' ){
										classresult = 'disabled';
									}else {classresult = 'btn-dark-orange';}
									var button="<button name=\"slotbutton\" id=\"slotbutton\" type=\"button\" class=\"btn btn-sm "+classresult+" slotbutton\" value=\""+slot+"\" style=\"margin:5px\">"+slot+"</button>";
									$res.append( button );
								});
							}	
						});
						$('.slotbutton').click(function() {
							$('#slotinput').val( $(this).attr("value") );
							$('#locationinput').val( locationid );
							$('.slotbutton').removeClass('btn-dark-orange');
							$('.registergroup').removeClass('no-display');
							$(this).addClass('btn-dark-orange');
						});
					});

				},
				error: function (request, status, error) {
					alert(error);
				}
			});
		}
	var reservationSubmit= function(){
		if( $.urlParam('reservationid') =='' ){
			$('#book').click( function(){
				lauchRequest();	
			});	
		}else{
			lauchRequest(reservationid);
		}
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
        $.validator.addMethod("FullDate", function () {
            //if all values are selected
            if ($("#dd").val() != "" && $("#mm").val() != "" && $("#yyyy").val() != "") {
                return true;
            } else {
                return false;
            }
        }, 'Please select a day, month, and year');
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
			reservationSubmit();
			runTagsInput();
			feedTags();
        }
    };
}();
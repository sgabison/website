var ReservationFormValidator = function () {
	"use strict";
	var URL = window.location.protocol + "//" + window.location.host ;
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
    if ($(".tooltips").length) {
        $('.tooltips').tooltip();
    }
    $('[data-toggle="tooltip"]').tooltip();
   	$('a.locationlinkfinal').css( 'cursor', 'pointer' );
	$.formattedDate=function(exampledate, today){
		if(exampledate==null || exampledate===false){
			return getDate2(today)+'-'+getMonth2(today)+'-'+today.getFullYear();
		}else{
			return getDate2(exampledate)+'-'+getMonth2(exampledate)+'-'+exampledate.getFullYear();	
		}
	}
	var getMonth2=function(date) {
	    var month = date.getMonth() + 1;
	    return month < 10 ? '0' + month : '' + month; // ('' + month) for string result
	}
	var getDate2=function(date) {
	    var day = date.getDate();
	    return day < 10 ? '0' + day : '' + day; // ('' + month) for string result
	}
	var confirmationNavigation=function(){
		$('.displaymore').click( function(){
			$('.confirmation1').addClass('no-display');
			$('.confirmation2').removeClass('no-display');
		});
		$('.displayless').click( function(){
			$('.confirmation1').removeClass('no-display');
			$('.confirmation2').addClass('no-display');
		});
	}
	var	today=new Date();
	var formattedtoday=getDate2(today)+'-'+getMonth2(today)+'-'+today.getFullYear();
	$('#calendarlinkdata').text( getDate2(today)+'-'+getMonth2(today)+'-'+today.getFullYear() );
	var thisDay=today.getDay();
	var days = ['Sunday','Monday','Tuesday','Wednesday','Thursday','Friday','Saturday'];
	var offdays = $('#offdays').val().split(',');
	//alert( offdays );
	var closeddays = $('#closeddays').val();
	var inRange=false;
	$('body').on('click','.reg-data', function(){ $('.registergroup1').removeClass('no-display');$('.registergroup2').addClass('no-display');});
    var runSelect2 = function() {
	    $(".js-example").select2();    
	}
	var checkData = function(){
		console.log( 'reg-email', $('#reg-email').text() );
		console.log( 'reg-tel', $('#reg-tel').text() );
		console.log( 'reg-lastname', $('#reg-lastname').text() );
		if( $('#reg-email').html() =='' ){ $('#reg-email').html( "<i class='fa fa-square-o fa-lg'></i> Email mandatory" ); $('#reg-email').css("color", "#a94442" ); }else{ $('#reg-email').html( "<i class='fa fa-check-square-o fa-lg'></i> "+$('#reg-email').html().substr(0,15)+"..." ); $('#reg-email').css("color", "#777777" ); }
		if( $('#reg-tel').html() =='' ){ $('#reg-tel').html("<i class='fa fa-square-o fa-lg'></i> Tel mandatory"); $('#reg-tel').css( "color", "#a94442" );  } else { $('#reg-tel').html("<i class='fa fa-check-square-o fa-lg'></i> "+ $("#tel").intlTelInput("getNumber") ); $('#reg-tel').css( "color", "#777777" ); }
		if( $('#reg-lastname').html() =='' ){ $('#reg-lastname').html("<i class='fa fa-square-o fa-lg'></i> Name mandatory"); $('#reg-lastname').css( "color","#a94442" ); }else{ $('#reg-lastname').html("<i class='fa fa-check-square-o fa-lg'></i> "+$('#reg-lastname').html().substr(0,15)+"..." ); $('#reg-lastname').css( "color","#777777" ); console.log( $("#tel").intlTelInput("getSelectedCountryData").dialCode );}
		
	}
	$('#mycalendar').datepicker({ 
		startDate: "0d",
		language: $("#language").val(),
		todayBtn: "linked", 
		todayHighlight: true, 
		defaultDate: new Date(), 
		autoclose: true,
		datesDisabled: offdays, 
		format: "dd-mm-yyyy",
		container: '#example-widget-container',
		beforeShowDay: function (date){
			if( date > today && ($.inArray(getDate2(date)+'-'+getMonth2(date)+'-'+date.getFullYear(), offdays)>=0) ){
				console.log( getDate2(date)+'-'+getMonth2(date)+'-'+date.getFullYear() );
				return {
					tooltip: 'Le Restaurant est fermé',
                    classes: 'closedDayClass',
                    enabled: false
				}
			}
			var dateFormat = getDate2(date)+'-'+getMonth2(date)+'-'+date.getFullYear();
			var dayFormat = date.getDay();
			console.log( dayFormat );
			if( date < today ){
			  return {
			  	classes: 'disabled passedDayClass', 
			  	tooltip: 'Date passée'
			  };
			}
			if( date == today ){
			  return {
			  	classes: 'activeDayClass', 
			  	tooltip: 'Aujourd hui'
			  };
			}
			if( date>today && closeddays.search(dayFormat) >= 0){ 
			  return {
			  	classes: 'disabled closedDayClass', 
			  	tooltip: 'Aucun service ce jour'};
			}
		}
	});
	$('#mycalendar').datepicker('show');
	//INITIATE DATE SUMMARY
	$('#mycalendar').datepicker().on('changeDate', function (ev) {
	    $('#calendarlinkdata').text( $.formattedDate( $('#mycalendar').datepicker("getDate"), today ) );
	});
	var intTelData = function(){
		$("#tel").intlTelInput({ 
	        //allowExtensions: true,
	        //autoFormat: false,
	        //autoHideDialCode: false,
	        //autoPlaceholder: false,
	        defaultCountry: "fr",
	        // geoIpLookup: function(callback) {
	        //   $.get('http://ipinfo.io', function() {}, "jsonp").always(function(resp) {
	        //     var countryCode = (resp && resp.country) ? resp.country : "";
	        //     callback(countryCode);
	        //   });
	        // },
	        //nationalMode: false,
	        //numberType: "MOBILE",
	        //onlyCountries: ['us', 'gb', 'ch', 'ca', 'do'],
	        preferredCountries: ['fr', 'gb', 'de', 'be'],
	        utilsScript: "/website/views/layouts/assets/plugins/intl-tel-input-master/lib/libphonenumber/build/utils.js"
		})
	}
	var reservationDataLoad = function () {
		var form1 = $('#bookingform');
		console.log( 'select_location'+$('#select_location').val() );
		console.log( 'mycalendar: '+$.formattedDate( $('#mycalendar').datepicker("getDate"), today ) );
		form1.attr('action',URL+'/data/userreservation/get-data'); 
		form1.attr('method','POST');
		$('#submit2').click( function(event){
			event.preventDefault();
			console.log( 'submitted' );
			var newReservation = new Object;
			  newReservation.id= $("#id").val() 
			, newReservation.lastname = $("#firstlastname").val()
			, newReservation.datereservation = formattedtoday
			, newReservation.reservationdate = $("#reservationdateinput").val()
			, newReservation.email = $("#email").val()
			, newReservation.countrycode = $("#tel").intlTelInput("getSelectedCountryData").dialCode
			, newReservation.tel = $("#tel").val()
			, newReservation.partysize = $("#party").val()
			, newReservation.start = $("#slotinput").val()
			, newReservation.servinginput = $("#servinginput").val()
			, newReservation.locationid = $("#locationinput").val()
			, newReservation.reservationid = $("#locationinput").val()
			, newReservation.bookingnotes = $("#tags_1").val()
			, newReservation.METHOD = $("#method").val();
			$.blockUI({
				message: '<i class="fa fa-spinner fa-spin"></i> Please wait...'
			});
			var reponse= new Object; // object(id,method =(PUT,GET,POST,DELETE),data)
			reponse.data=newReservation;
			reponse.id = newReservation.id;
			reponse.METHOD = newReservation.METHOD; 
			console.log( JSON.stringify(reponse) );
			$.ajax({
				url: URL+'/data/userreservation/get-data',
				dataType: 'json',
				type:'POST', //obligatoire
				data: JSON.stringify(reponse),
				contentType: "application/json; charset=utf-8",
				success: function(json) {
					$.unblockUI();
					console.log( json.success );
					console.log( json.message );
					if (json.success || json.success == 'true') {
						//var i = $("#reservation-id").val();
						//reservation[i] = json.data;
						//toastr.success(newReservation.lastname + ' '+ json.message);
		                $('#reservationform').addClass('no-display');
		                $('#confirmationform').removeClass('no-display');
		                $('#finalpartysize').text( newReservation.partysize );
		                $('#finalguestname').text( newReservation.lastname );
		                $('#finalguestemail').text( newReservation.email );
		                $('#finalguesttel').text( newReservation.tel );		                
		                $('#finaldate').text( newReservation.reservationdate );
		                $('#finaltimeslot').text( newReservation.start );
		                $.cookie("email", newReservation.email, { expires: 90, path: '/' });
		                $.cookie("tel", newReservation.tel, { expires: 90, path: '/' });
		                $.cookie("guestname", newReservation.lastname, { expires: 90, path: '/' });
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
	var reservationSubmit= function(){
		if( $.urlParam('reservationid') !== null && $.urlParam('reservationid') !== 'undefined' && $.urlParam('reservationid')!='' && $('#method').val()=='PUT' && $('#method2').val()=='PUT'){
			lauchRequest(reservationid);
		}else{
			var backdrop = $('.ajax-white-backdrop');
			backdrop.remove();
			$('.book').click( function(){
				console.log( 'bookclick' );
				lauchRequest();	
			});	
		}
	};
	var myfunc=function(e){
		var elementid;
		elementid=e.currentTarget.id;
     	servingButton( e.data.data, e.data.reservationid,e.data.locationid,elementid ) ;
	}
	var myfunc2=function(e){
		var elementid;
		elementid=e.currentTarget.id;
		slotButton(e.data.locationid, elementid);
	}
	var servingButton = function(data, reservationid, locationid, elementid){
		var slot;
		var selectedid;
		var nyckel;
		var key;
		var value;
		var elementid;
		var $res = $( "#slots" );
		var html = $.parseHTML( );
		$res.append( html );
		console.log( 'elementid: '+elementid);
		console.log( 'locationid: '+locationid);
		console.log( 'reservationid: '+reservationid);
		$('#slotgroup').removeClass('no-display');
		$('#servinggroup').addClass('no-display');
		$('#servinglinkdata').text( ", for "+$('#'+elementid).text() );
		$('#servinglinkdata').css( 'cursor', 'pointer' );
		$('#slots').html(function(){ return '';});
		$('.servingbutton').removeClass('btn-light-orange');
		$('.servingbutton').removeClass('btn-dark-orange');
		$('#'+elementid).addClass('btn-dark-orange');	
		var valuebutton=$('#'+elementid).attr("serving");
		$('#servinginput').val( $('#'+elementid).attr("value") );
		$.each(data.data, function (key, value) {
			if( key==valuebutton ){
				var j=0;
				$.each(value, function (nyckel, slot) {
					j++;
					var res=nyckel.split("-");
					var classresult;
					if( res[2] != 'ok' ){
						classresult = 'disabled';
					}else if( res[3] != 'ok' ){
						classresult = 'disabled';
					}else if( res[4] != 'selected' ){
						classresult = 'btn-dark-orange';
					} else {classresult = 'btn-dark-green';
						selectedid='slotbutton'+res[1];
					}
					var button="<button name=\"slotbutton\" id=\"slotbutton"+j+"\" type=\"button\" class=\"btn btn-sm "+classresult+" slotbutton\" value=\""+slot+"\" style=\"margin:5px\">"+slot+"</button>";
					$res.append( button );
				});
			}	
		});
		if( $.urlParam('reservationid') !== null && $.urlParam('reservationid')!='' && $.urlParam('reservationid')!='undefined' && $('#method').val()=='PUT' && $('#method2').val()=='PUT'){
			$( document ).one( slotButton(locationid, selectedid) );
			$('.slotbutton').bind( 'click', {locationid: locationid}, myfunc2);
		}else{
			$('.slotbutton').bind( 'click', {locationid: locationid}, myfunc2);
			var backdrop = $('.ajax-white-backdrop');
			backdrop.remove();
		}
	}
	var slotButton = function(locationid, elementid, backdrop){
			$('#slotgroup').addClass('no-display');
			$('#slotlinkdata').text( $('#'+elementid).text() );
			$('#slotlinkdata').css( 'cursor', 'pointer' );
			$('#slotinput').val( $('#'+elementid).attr("value") );
			$('#locationinput').val( locationid );
			$('#reservationinput').val( reservationid );
			$('#reservationdateinput').val( $.formattedDate( $('#mycalendar').datepicker("getDate"), today ) );
			$('#id').val( reservationid );
			console.log( 'elementid: '+elementid);
			console.log( 'locationid: '+locationid);
			$('.slotbutton').removeClass('btn-light-orange');
			$('.slotbutton').removeClass('btn-dark-orange');
			$('.registergroup').removeClass('no-display');
			$('.registergroup1').removeClass('no-display');
			$('#'+elementid).addClass('btn-dark-orange');
			var backdrop = $('.ajax-white-backdrop');
			backdrop.remove();
	}
	var lauchRequest = function(reservationid){
		$('.bookbutton').addClass('no-display');
		$('#selectgroup').removeClass('no-display');
		$('#calendarbox').addClass('no-display');
		$('#locationlink').removeClass('no-display');
		$('#peopleselectiongroup').addClass('no-display');
		var locationid=$('#select_location').val();
		var locationname=$('#select_location option:selected' ).text();
		var resadate=$.formattedDate( $('#mycalendar').datepicker("getDate"), today );
		var persondata=$('#party').val();
		//updatelink();
		$('#calendarlinkdata').text(resadate);
		$('#personlinkdata').text( $('#party').val() );
		$('#locationlinkdata').text(locationname); 
		var i=0;
		//clear up the divs
		i++;
		console.log( $.formattedDate( $('#mycalendar').datepicker("getDate"), today ) );
		console.log( i );
		$('#servings').html(function(){ return '';});
		$('#slots').html(function(){ return '';});
		$('#inputs').html(function(){ return '';});
		if( reservationid ){ var suffix='&reservationid='+reservationid }else{ var suffix=''}
		$.ajax({
			url: URL+"/data/userreservation/resaslot?locationid="+locationid+"&date="+$.formattedDate($('#mycalendar').datepicker("getDate"), today)+suffix,
			dataType: "json",
			success: function(data) {
				var $log = $( "#servings" );
				var $res = $( "#slots" );
				var $input = $( "#inputs" );
				var valuebutton;
				var value;
				var elementid;
				var nyckel;
				var key;
				var slot;
				var classclosed;
				var classcolor;
				var html = $.parseHTML( );
				$log.append( html );
				$res.append( html );
				$input.append( html );
				//set up input fields
				var inputs="<input id=\"slotinput\" name=\"slotinput\" class=\"no-display\"><input id=\"servinginput\" name=\"servinginput\" class=\"no-display\"><input id=\"locationinput\" name=\"locationinput\" class=\"no-display\"><input id=\"id\" name=\"id\" class=\"no-display\"><input id=\"reservationinput\" name=\"reservationinput\" class=\"no-display\"><input id=\"reservationdateinput\" name=\"reservationdateinput\" class=\"no-display\">";
				$input.append( inputs );
				var i=0;
				$.each(data.data, function (key, value) {
					i++;
					var serv=key.split("_-_");
					console.log( 'closed:'+serv[2] );
					if( serv[2] == 'closed' ){ classclosed = 'disabled';classcolor='';}else{ classclosed = '';classcolor='btn-dark-orange';}
					var button="<button id=\"servingbutton"+i+"\" type=\"button\" class=\"btn btn-sm buttons-widget "+classcolor+" servingbutton\" serving=\""+key+"\" value=\""+serv[1]+"\" style=\"margin:5px\""+classclosed+">"+serv[0]+"</button>";
					$log.append( button );
					if( serv[2] == 'selected'){ elementid='servingbutton'+i;}							
				});
				if( $.urlParam('reservationid') !== null && $.urlParam('reservationid')!='' && $.urlParam('reservationid')!='undefined' && $('#method').val()=='PUT' && $('#method2').val()=='PUT'){
					$( document ).one( servingButton(data,reservationid,locationid,elementid) );
				}else{
					var backdrop = $('.ajax-white-backdrop');
					backdrop.remove();
					$('.servingbutton').bind( 'click', {data: data, reservationid: reservationid, locationid: locationid, elementid: 'no' }, myfunc);
				}
			},
			error: function (request, status, error) {
				alert(error);
			}
		});
	}
	var validateCheckRadio = function (val) {
        $("input[type='radio'], input[type='checkbox']").on('ifChecked', function(event) {
			$(this).parent().closest(".has-error").removeClass("has-error").addClass("has-success").find(".help-block").hide().end().find('.symbol').addClass('ok');
		});
    }; 
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
        $('#submit').click( function(){
	        form1.validate({
	            errorElement: "span", // contain the error msg in a span tag
	            errorClass: 'help-block',
	            errorPlacement: function (error, element) { // render error placement for each input type
	                if (element.attr("type") == "radio" || element.attr("type") == "checkbox") { // for chosen elements, need to insert the error after the chosen container
	                    error.insertAfter($(element).closest('.form-group').children('div').children().last());
	                } else if (element.attr("name") == "dd" || element.attr("name") == "mm" || element.attr("name") == "yyyy") {
	                    error.insertAfter($(element).closest('.form-group').children('div'));
	                } else {
	                    // error.insertAfter(element);
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
	                    //number: true,
	                    //minlength: 10
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
	                console.log( 'validator', validator );
	                console.log( 'event', event );
	                console.log( 'event', event );
	                //errorHandler1.show();
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
	            showErrors: function(errorMap, errorList) {
				    this.defaultShowErrors();
				    if( this.numberOfInvalids() == 0 ){
						$('.registergroup1').addClass('no-display');
						$('.registergroup2').removeClass('no-display');
						if( $('#firstlastname').val() != '' ){$('#reg-lastname').html( $('#firstlastname').val() ); }
						if( $('#tel').val() != '' ){$('#reg-tel').html( $('#tel').val() ); }
						if( $('#email').val() != '' ){ $('#reg-email').html( $('#email').val() ); }
						checkData();
						reservationDataLoad();	
				    }					
				  },
	            success: function (label, element) {
	                //label.addClass('help-block valid');
	                // mark the current input as valid and display OK icon
	                $(element).closest('.form-group').removeClass('has-error').addClass('has-success').find('.symbol').removeClass('required').addClass('ok');
	               /*
	                $('#submit').click( function(){   	
	
					});
					*/
	            },
	            submitHandler: function (form) {
	               // successHandler1.show();
	                errorHandler1.hide();
	                //submit form
	                //form.submit();
	                //alert('submitform');
	            }
	        });
        });
    };
	var runTagsInput = function() {
		$('#tags_1').tagsInput({
			width: 'auto',
			onRemoveTag: function(value){ $('a[value="'+value+'"]').removeClass('no-display'); },
			onAddTag: function(value){ console.log(value);}
		});
	};
	var feedTags = function() {
		$('.btn-tags').click( function(){
			$(this).addClass('no-display');
			$('#tags_1').addTag( $(this).attr("value") );		
		});
	};
	var cookieSet = function () {
		$.cookie('name', 'value');
		console.log( 'cookie email', $.cookie('email') );
		$('#email').val( $.cookie('email') );
		$('#tel').val( $.cookie('tel') );
		$('#firstlastname').val( $.cookie('guestname') );
	}
    return {
        //main function to initiate template pages
        init: function () {
        	confirmationNavigation();
            runValidator1();
			reservationSubmit();
			runTagsInput();
			feedTags();
			runSelect2();
			intTelData();
			cookieSet();
        }
    };
}();
var ReservationFormValidator = function () {
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
    if ($(".tooltips").length) {
        $('.tooltips').tooltip();
    }
    var runSelect2 = function() {
	    $(".js-example").select2();    
	}
	$('a.locationlinkfinal').css( 'cursor', 'pointer' );
	$('[data-toggle="tooltip"]').tooltip();
	$.reformatDate=function(dateStr){
	  var dArr = dateStr.split("-");  // ex input "2010-01-18"
	  return dArr[2]+ "-" +dArr[1]+ "-" +dArr[0]; //ex out: "18/01/10"
	}
	var getMonth2=function(date) {
	    var month = date.getMonth() + 1;
	    return month < 10 ? '0' + month : '' + month; // ('' + month) for string result
	}
	var getDate2=function(date) {
	    var day = date.getDate();
	    return day < 10 ? '0' + day : '' + day; // ('' + month) for string result
	}  
	var	today=new Date();
	var thisDay=today.getDay();
	var days = ['Sunday','Monday','Tuesday','Wednesday','Thursday','Friday','Saturday'];
	var offdays = $('#offdays').val().split(',');
	var closeddays = $('#closeddays').val().split(',');
	console.log( moment( $('#mycalendar').val(), 'DD-MM-YYYY' ) );
	var inRange=false;
	var managePartySize = function(){
		$('#lessthansevenbutton').click( function(){
			$('.morethanseven').addClass('no-display');
			$('.lessthanseven').removeClass('no-display');
		});
		$('#morethansevenbutton').click( function(){
			$('.morethanseven').removeClass('no-display');
			$('.lessthanseven').addClass('no-display');
		});
		$('.partybutton').click( function(){
			$('#party').val( $(this).val() );
			$('#personlinkdata').text( $(this).val() );
			$('.partybutton').removeClass('btn-default');
			$('.partybutton').removeClass('btn-dark-orange');
			$(this).addClass('btn-dark-orange');
		});
		$('#partyselect').on('change', function(){
			$('#party').val( $('#partyselect').val() );
			$('#personlinkdata').text( $('#partyselect').val() );
		});
	}
	var loadFullCalendar = function(){
		$("#fullcalendar").fullCalendar({
			lang: language,
			height: 400,
			weekends: true,
			selectable: true,
	        selectHelper: false,
	        defaultDate: moment( $('#mycalendar').val(), 'DD-MM-YYYY' ),
	        dayClick: function(date, jsEvent, view) {
	        	if( date >= moment().subtract(1, 'days' ) && date.day() != closeddays[0] && date.day() != closeddays[1] && date.day() != closeddays[2] && date.day() != closeddays[3] && date.day() != closeddays[4] && date.day() != closeddays[5] && date.day() != closeddays[6] && $.inArray(date.format("DD-MM-YYYY"), offdays)==-1 ){
		        	console.log('works');
		        	$('tbody td').removeClass('currentDayClass');
		        	$(this).addClass('currentDayClass');
	        	}else{
	        		console.log('don t works');
	        		//console.log(view);
	        		//console.log(this);
		        	$(this).removeClass('fc-highlight');
		        	//$(this).attr('class', '');
	        	}
	        },
	        dayRender: function (date, cell) {
	        	console.log( date.day() );
				if ( date.format("DD-MM-YYYY") == moment().format("DD-MM-YYYY") ){
				   cell.removeClass("fc-state-highlight");
				   cell.removeClass("fc-today");
				}
	        	if( $.inArray( date.format( "DD-MM-YYYY" ), offdays ) >=0 ){
			       cell.css("background-color", "#DDDDDD");
			       cell.css("cursor", "not-allowed");
			       cell.prop('data-toggle', 'tooltip');
			       cell.prop('title', t('js_no_serving'));
	        	}
	        	if( date.day() == closeddays[0] || date.day() == closeddays[1] || date.day() == closeddays[2] || date.day() == closeddays[3] || date.day() == closeddays[4] || date.day() == closeddays[5] || date.day() == closeddays[6] ){
			       cell.css("background-color", "#BBBBBB");
			       cell.css("cursor", "not-allowed");
			       cell.prop('title', t('js_restaurant_closed'));	        		
	        	}
	        	if( date < moment().subtract(1, 'days' ) ){
			       cell.css("background-color", "#EEEEEE");
			       cell.css("cursor", "not-allowed");
			       cell.prop('title', t('js_passed_date'));	        		
	        	}
		    },
	        select: function(start, end, allDay) {
	        	console.log( start.format("DD-MM-YYYY") );
	        	if( start >= moment().subtract(1, 'days' ) && start.day() != closeddays[0] && start.day() != closeddays[1] && start.day() != closeddays[2] && start.day() != closeddays[3] && start.day() != closeddays[4] && start.day() != closeddays[5] && start.day() != closeddays[6] && $.inArray(start.format("DD-MM-YYYY"), offdays)==-1 ){
					$('#mycalendar').val( start.format("DD-MM-YYYY") );
					$('#calendarlinkdata').text( start.format("DD-MM-YYYY") );
	        	}
	        }
		});
	}
/*
	var loadCalendar = function(){
		$('#mycalendar').datepicker({ 
			startDate: "0d",
			language: $("#language").val(),
			todayBtn: "linked", 
			todayHighlight: false, 
			defaultDate: new Date(), 
			autoclose: false,
			datesDisabled: offdays, 
			format: "dd-mm-yyyy",
			orientation: "bottom-left",
			container: '#calendarcontainer',
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
	}
*/
	var reservationDataLoad = function () {
		var form1 = $('#bookingform');
		console.log( 'select_location'+$('#select_location').val() );
		console.log( 'mycalendar: '+$('#mycalendar').val() );
		form1.attr('action','/data/reservation/get-data'); 
		form1.attr('method','POST');
//		$('#submit').click( function(){
			var newReservation = new Object;
			  newReservation.id= $("#id").val() 
			, newReservation.lastname = $("#firstlastname").val()
			, newReservation.datereservation = moment().format('DD-MM-YYYY')
			, newReservation.reservationdate = $("#reservationdateinput").val()
			, newReservation.email = $("#email").val()
			, newReservation.tel = $("#tel").val()
			, newReservation.countrycode = $("#countrycode").val()
			, newReservation.partysize = $("#party").val()
			, newReservation.start = $("#slotinput").val()
			, newReservation.servinginput = $("#servinginput").val()
			, newReservation.locationid = $("#locationinput").val()
			, newReservation.reservationid = $("#locationinput").val()
			, newReservation.bookingnotes = $("#tags_1").val()
			, newReservation.METHOD = $("#method").val();
			$.blockUI({
				message: '<i class="fa fa-spinner fa-spin"></i> Veuillez patienter...'
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
		                $('#reservationform').addClass('no-display');
		                $('#confirmationform').removeClass('no-display');
		                $('#finalpartysize').text( newReservation.partysize );
		                $('#finalguestname').text( newReservation.lastname );
		                $('#finalguestemail').text( newReservation.email );
		                $('#finalguesttel').text( newReservation.tel );		                
		                $('#finaldate').text( newReservation.reservationdate );
		                $('#finaltimeslot').text( newReservation.start );
					}
				},
				error: function (request, status, error) {
					alert(error);
					//alert(JSON.stringify(request));
					console.log( $("#slotinput").val() );
					console.log( $("#servinginput").val() );
				}        
			});
//		});
	};
	var reservationid=$.urlParam('reservationid');
	var reservationSubmit= function(){
		if( $.urlParam('reservationid') !== null && $.urlParam('reservationid') !== 'undefined' && $.urlParam('reservationid')!='' && $('#method').val()=='PUT' && $('#method2').val()=='PUT'){
			lauchRequest(reservationid);
			$('#partybox').addClass('no-display');
		}else{
			var backdrop = $('.ajax-white-backdrop');
			backdrop.remove();
			$('.book').click( function(){
				lauchRequest();
				$('#partybox').addClass('no-display');	
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
					if( res[2] == 'ok' ){
						classresult = 'disabled';
					}else if( res[3] == 'ok' ){
						classresult = 'disabled';
					}else if( res[4] != 'selected' ){
						classresult = 'btn-light-orange';
					} else {classresult = 'btn-dark-green';
						selectedid='slotbutton'+res[1];
					}
					var button="<button name=\"slotbutton\" id=\"slotbutton"+j+"\" type=\"button\" class=\"btn btn-sm "+classresult+" slotbutton\" value=\""+slot+"\" style=\"margin:5px\"><span class='badge badge-success'> "+res[2]+" </span><span class='badge badge-danger'> "+res[3]+" </span><br>"+slot+"</button>";
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
			$('#slotinput').val( $('#'+elementid).attr("value") );
			$('#slotlinkdata').text( $('#'+elementid).attr("value") );
			$('#locationinput').val( locationid );
			$('#reservationinput').val( reservationid );
			$('#reservationdateinput').val($('#mycalendar').val());
			$('#id').val( reservationid );
			console.log( 'elementid: '+elementid);
			console.log( 'locationid: '+locationid);
			$('.slotbutton').removeClass('btn-light-orange');
			$('.slotbutton').removeClass('btn-dark-orange');
			$('.registergroup').removeClass('no-display');
			$('#'+elementid).addClass('btn-dark-orange');
			var backdrop = $('.ajax-white-backdrop');
			backdrop.remove();
	}
	var lauchRequest = function(reservationid){
		$('.bookbutton').addClass('no-display');
		$('#selectgroup').removeClass('no-display');
		$('#calendarbox').addClass('no-display');
		$('#locationlink').removeClass('no-display');
		var locationid=$('#select_location').val();
		var locationname=$('#select_location option:selected' ).text();
		var resadate=$('#mycalendar').val();
		//updatelink();
		$('#calendarlinkdata').text(resadate);
		$('#locationlinkdata').text(locationname); 
		var i=0;
		//clear up the divs
		i++;
		console.log( $('.mycalendar').val() );
		console.log( i );
		$('#servings').html(function(){ return '';});
		$('#slots').html(function(){ return '';});
		$('#inputs').html(function(){ return '';});
		if( reservationid ){ var suffix='&reservationid='+reservationid }else{ var suffix=''}
		$.ajax({
			url: "/data/reservation/resaslot?locationid="+locationid+"&date="+$('.mycalendar').val()+suffix,
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
					if( serv[2] == 'closed' ){ classclosed = 'disabled';classcolor='';}else{ classclosed = '';classcolor='btn-light-orange';}
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
            if ($("#dd").val() != "" && $("#mm").val() != "" && $("#yyyy").val() != "") { return true; } else { return false; }
        }, 'Please select a day, month, and year');
        $.validator.addMethod("fulltel", function () {
		    return /^(\d{10})( - )(.*)$/.test(value); 
		}, 'Please enter a valid telephone number on 10 digits.');
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
                    number: true,
                    minlength: 10
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
                reservationDataLoad();
            }
        });
    };
	var runTagsInput = function() {
		$('#tags_1').tagsInput({
			width: 'auto',
			onRemoveTag: function(value){ $('a[value="'+value+'"]').removeClass('no-display'); },
			onAddTag: function(value){ console.log(value);}
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
			$(this).addClass('no-display');
			$('#tags_1').addTag( $(this).attr("value") );		
		});
	};
	$('input.typeahead').typeahead({
		onSelect: function(item) {
           	$('.telephone').removeClass('fa-refresh fa-spin');
           	$('.telephone').addClass('fa-phone');
	        console.log('selecteditem',item.value);
	        var completeset=item.value.split("----");
	        console.log( 'tel', completeset[0] );
	        $('#tags_1').importTags('');
	        $('#tel').val( completeset[0] );
	        $( "#tel" ).focus();     
			$('#firstlastname').val( completeset[1] );
			$( "#firstlastname" ).focus();
			$('#email').val( completeset[2] );
			$( "#email" ).focus();
			$( ".panel-collapse" ).focus();
			if( completeset[3] != ""){
				$('.panel-collapse').removeClass('expand');
				$('.panel-collapse').addClass('collapses');
				$('#tagpanel').show();
				$('.panel-collapse').find("span").text("Collapses");
				$('#tagpanel').focus();
				var $custtags=completeset[3].split(',');
				$.each( $custtags, function( key, value ) {
				  	$('#tags_1').addTag( value );
				});
			}else{
				$('.panel-collapse').addClass('expand');
				$('.panel-collapse').removeClass('collapses');				
				$('#tagpanel').hide();
				$('.panel-collapse').find("span").text("Expand");
				$('#tags_1').importTags('');
			}
	    },
	    ajax: {
	        url: "/data/guest/get-guest-tel",
	        timeout: 0,
	        displayField: "tel",
	        valueField: "complete",
	        triggerLength: 3,
	        method: "get",
	        loadingClass: "loading-circle",
	        preDispatch: function (query) {
	            //showLoadingMask(true);
	            $('.telephone').addClass('fa-refresh fa-spin');
	            $('.telephone').removeClass('fa-phone');
	            return {
	                search: query
	            }
	        },
	        preProcess: function (data) {
	            //showLoadingMask(false);
	            if (data.success === false) {
	            	$('.telephone').removeClass('fa-refresh fa-spin');
	            	$('.telephone').addClass('fa-phone');
					$('#firstlastname').val('');
					$('#email').val('');
	                return false;
	            }
	            // We good!
	            return data.data;
	        }
	    }
	});
	
    return {
        //main function to initiate template pages
        init: function () {
            managePartySize();
            runValidator1();
			loadFullCalendar();
			reservationSubmit();
			runTagsInput();
			feedTags();
			runSelect2();
        }
    };
}();
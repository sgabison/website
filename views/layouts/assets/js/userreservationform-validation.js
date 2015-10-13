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
    if ($(".tooltips").length) {
        $('.tooltips').tooltip();
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
	$.reformatDate=function(dateStr){
	  var dArr = dateStr.split("-");  // ex input "2010-01-18"
	  return dArr[2]+ "-" +dArr[1]+ "-" +dArr[0]; //ex out: "18/01/10"
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
	var timenow=today.getHours()+':'+today.getMinutes();
	console.log( 'timenow'+timenow );
	var todaydate=getDate2(today)+'-'+getMonth2(today)+'-'+today.getFullYear(); 
	var thisDay=today.getDay();
	var days = ['Sunday','Monday','Tuesday','Wednesday','Thursday','Friday','Saturday'];
	var offdays = $('#offdays').val().split(',');
	var closeddays = $('#closeddays').val().split(',');
	console.log( 'mycalendar', $('#mycalendar').val() );
	console.log( moment( $('#mycalendar').val(), 'DD-MM-YYYY' ) );
	var inRange=false;
	var manageNewsletter = function(){
		console.log( 'initiate manageNesletter' );
	    $('input[name="newsletter"]').on('ifClicked', function (event) {
	        console.log( $(this).val() );
	        $('#newsletterinput').val( $(this).val() );
	    });
	}
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
			$("html, body").animate({ scrollTop: 0 }, "slow");
		});
		$('#partyselect').on('change', function(){
			$('#party').val( $('#partyselect').val() );
			$('#personlinkdata').text( $('#partyselect').val() );
		});
	}
	var formattedtoday=getDate2(today)+'-'+getMonth2(today)+'-'+today.getFullYear();
	//$('#calendarlinkdata').text( getDate2(today)+'-'+getMonth2(today)+'-'+today.getFullYear() );
	$('body').on('click','.reg-data', function(){ $('.registergroup1').removeClass('no-display');$('.registergroup2').addClass('no-display');});
	$('.backbutton').css( 'cursor', 'pointer' );
    var runSelect2 = function() {
	    $(".js-example").select2();    
	}
	var checkData = function(){
		var regemail, reglastname;
		console.log( 'reg-email', $('#reg-email').text() );
		console.log( 'reg-tel', $('#reg-tel').text() );
		console.log( 'reg-lastname', $('#reg-lastname').text() );
		if( $('#reg-email').html().length >20 ){ regemail=$('#reg-email').html().substr(0,20)+'...' ;}else{regemail=$('#reg-email').html();}
		if( $('#reg-lastname').html().length >20 ){ reglastname=$('#reg-lastname').html().substr(0,20)+'...' ;}else{reglastname=$('#reg-lastname').html();}
		if( $('#reg-email').html() =='' ){ 
			$('#reg-email').html( "<i class='fa fa-square-o fa-lg'></i> Email mandatory" ); $('#reg-email').css("color", "#a94442" ); 
		}else{ 
			$('#reg-email').html( "<span class='btn dropdown-toggle btn-transparent-grey'><i class='fa fa-angle-double-left backbutton'></i></span> <a><span class='text-bold'>"+regemail+"</span></a>" ); $('#reg-email').css("color", "#777777" ); }
		if( $('#reg-tel').html() =='' ){ 
			$('#reg-tel').html("<i class='fa fa-square-o fa-lg'></i> Tel mandatory"); $('#reg-tel').css( "color", "#a94442" );  
		}else{ 
			$('#reg-tel').html("<span class='btn dropdown-toggle btn-transparent-grey'><i class='fa fa-angle-double-left backbutton'></i></span> <a><span class='text-bold'>"+ $("#tel").intlTelInput("getNumber")+'</span></a>' ); $('#reg-tel').css( "color", "#777777" ); 
		}
		if( $('#reg-lastname').html() =='' ){ 
			$('#reg-lastname').html("<i class='fa fa-square-o fa-lg'></i> Name mandatory"); $('#reg-lastname').css( "color","#a94442" ); 
		}else{ 
			$('#reg-lastname').html("<span class='btn dropdown-toggle btn-transparent-grey'><i class='fa fa-angle-double-left backbutton'></i></span> <a><span class='text-bold'>"+reglastname+"</span></a>" ); $('#reg-lastname').css( "color","#777777" ); console.log( $("#tel").intlTelInput("getSelectedCountryData").dialCode );
		}	
	}
/*
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
				return {
					tooltip: 'Le Restaurant est fermé',
                    classes: 'closedDayClass',
                    enabled: false
				}
			}
			var dateFormat = getDate2(date)+'-'+getMonth2(date)+'-'+date.getFullYear();
			var dayFormat = date.getDay();
			if( date.setHours(0,0,0,0) < today.setHours(0,0,0,0) ){
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
*/
	var loadFullCalendar = function(){
		$("#fullcalendar").fullCalendar({
			lang: language,
			header: {
			    left:   'title',
			    center: '',
			    right:  'prev,next'
			},
			weekends: true,
			selectable: true,
	        selectHelper: false,
	        defaultDate: moment( $('#mycalendar').val(), 'DD-MM-YYYY' ),
	        dayClick: function(date, jsEvent, view) {
	        	if( ( date >= moment().subtract(1, 'days' ) && date.day() != closeddays[0] && date.day() != closeddays[1] && date.day() != closeddays[2] && date.day() != closeddays[3] && date.day() != closeddays[4] && date.day() != closeddays[5] && date.day() != closeddays[6] && $.inArray(date.format("DD-MM-YYYY"), offdays)==-1 ) || ( closeddays == "" ) ){
		        	console.log('works');
		        	$('tbody td').removeClass('currentDayClass');
		        	$(this).addClass('currentDayClass');
	        	}else{
	        		console.log('don t works');
		        	$(this).removeClass('fc-highlight');
	        	}
	        },
	        dayRender: function (date, cell) {
				if ( date.format("DD-MM-YYYY") == moment().format("DD-MM-YYYY") ){
				   cell.removeClass("fc-state-highlight");
				   cell.removeClass("fc-today");
				   cell.addClass('currentDayClass');
				}
	        	if( $.inArray( date.format( "DD-MM-YYYY" ), offdays ) >=0 ){
			       cell.css("background-color", "#DDDDDD");
			       cell.css("cursor", "not-allowed");
			       cell.prop('data-toggle', 'tooltip');
			       cell.prop('title', t('js_restaurant_closed'));
	        	}
	        	if( date.day() == closeddays[0] || date.day() == closeddays[1] || date.day() == closeddays[2] || date.day() == closeddays[3] || date.day() == closeddays[4] || date.day() == closeddays[5] || date.day() == closeddays[6] ){
				   if( closeddays != "" ){
				       cell.css("background-color", "#BBBBBB");
				       cell.css("cursor", "not-allowed");
				       cell.prop('title', t('js_no_serving'));	        		
				   }
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
	        	if( start.format("DD-MM-YYYY") == moment().format("DD-MM-YYYY") ){
					$('#mycalendar').val( start.format("DD-MM-YYYY") );
					$('#calendarlinkdata').text( start.format("DD-MM-YYYY") );	        	
	        	}
	        }
		});
	}
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
	$('#submit2').click( function(event){ reservationDataLoad();});
	var reservationDataLoad = function () {
		var form1 = $('#bookingform');
		console.log( 'select_location'+$('#select_location').val() );
		console.log( 'mycalendar: '+ $('#mycalendar').val() );
		form1.attr('action',URL+'/data/userreservation/get-data'); 
		form1.attr('method','POST');
		//$('#submit2').click( function(event){
			console.log( event.type );
			manageNewsletter();
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
			, newReservation.newsletter = $("#newsletterinput").val()
			, newReservation.bookingnotes = $("#tags_1").val()
			, newReservation.METHOD = $("#method").val();
			$.blockUI({
				message: '<i class="fa fa-spinner fa-spin"></i> '+t('js_please_wait')
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
						console.log( 'json.data'+json.data );
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
		                $('#finalid').text( json.data.id );
					}
				},
				error: function (request, status, error) {
					alert(error);
					//alert(JSON.stringify(request));
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
			$('.partyselection').click( function(){
				lauchRequest();
				$('#partybox').addClass('no-display');					
			});
			$('.selectpartyselection').change( function(){
				lauchRequest();
				$('#partybox').addClass('no-display');					
			});
//			$('.book').click( function(){
//				console.log( 'bookclick' );
//				lauchRequest();	
//			});	
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
		//$('#servinggroup').addClass('no-display');
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
					var button="<button name=\"slotbutton\" id=\"slotbutton"+j+"\" type=\"button\" class=\"btn "+classresult+" slotbutton\" value=\""+slot+"\" style=\"margin:5px\">"+slot+"</button>";
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
			$('#clockspan').addClass('badge-success');
			$('#servinggroup').addClass('no-display');
			$('#slotlinkdata').text( $('#'+elementid).text() );
			$('#slotlinkdata').css( 'cursor', 'pointer' );
			$('#slotinput').val( $('#'+elementid).attr("value") );
			$('#locationinput').val( locationid );
			$('#reservationinput').val( reservationid );
			$('#reservationdateinput').val( $('#mycalendar').val() );
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
		$('#personspan').addClass('badge-success');
		$('#selectgroup').removeClass('no-display');
		$('#calendarbox').addClass('no-display');
		$('#locationlink').removeClass('no-display');
		//$('#peopleselectiongroup').addClass('no-display');
		var locationid=$('#select_location').val();
		var locationname=$('#select_location option:selected' ).text();
		var resadate=$('#mycalendar').val();
		var persondata=$('#party').val();
		//updatelink();
		$('#calendarlinkdata').text(resadate);
		$('#personlinkdata').text( $('#party').val() );
		$('#locationlinkdata').text(locationname); 
		var i=0;
		//clear up the divs
		i++;
		console.log( $('#mycalendar').val() );
		console.log( i );
		$('#servings').html(function(){ return '';});
		$('#slots').html(function(){ return '';});
		$('#inputs').html(function(){ return '';});
		$.ajax({
			url: URL+"/data/userreservation/resaslot?locationid="+locationid+"&date="+$('#mycalendar').val(),
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
				var inputs="<input id=\"slotinput\" name=\"slotinput\" class=\"no-display\"><input id=\"servinginput\" name=\"servinginput\" class=\"no-display\"><input id=\"locationinput\" name=\"locationinput\" class=\"no-display\"><input id=\"id\" name=\"id\" class=\"no-display\"><input id=\"reservationinput\" name=\"reservationinput\" class=\"no-display\"><input id=\"reservationdateinput\" name=\"reservationdateinput\" class=\"no-display\"><input id=\"newsletterinput\" name=\"newsletterinput\" class=\"no-display\">";
				$input.append( inputs );
				var i=0;
				$.each(data.data, function (key, value) {
					i++;
					var serv=key.split("_-_");
					console.log( 'serv[4]:'+serv[4] );
					console.log( formattedtoday );
					console.log( $('#mycalendar').val() );
					if( serv[2] == 'closed' ){ classclosed = 'disabled';classcolor='';}else{ classclosed = '';classcolor='btn-dark-orange';}
					if( ( formattedtoday == $.formattedDate( $('#mycalendar').datepicker("getDate"), today ) )  && ( moment(timenow,'HH:mm') > moment(serv[4],'HH:mm') ) ){
						classclosed = 'disabled';
					}
					var button="<button id=\"servingbutton"+i+"\" type=\"button\" class=\"btn buttons-widget "+classcolor+" servingbutton\" serving=\""+key+"\" value=\""+serv[1]+"\" style=\"margin:5px\""+classclosed+">"+serv[0]+"</button>";
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
        $('#subit').click( function(){
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
			loadFullCalendar();
			managePartySize();
			manageNewsletter();
        }
    };
}();
var ReservationFormValidator1 = function () {
	"use strict";
	var URL = window.location.protocol + "//" + window.location.host ;
	var backdrop = $('.ajax-white-backdrop2');
	var	today=new Date();
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
	$.formattedDate=function(exampledate, today){
		if(exampledate==null || exampledate===false){
			return getDate2(today)+'-'+getMonth2(today)+'-'+today.getFullYear();
		}else{
			return getDate2(exampledate)+'-'+getMonth2(exampledate)+'-'+exampledate.getFullYear();	
		}
	}
	var reservationid=$.urlParam('reservationid');
	var getMonth2=function(date) {
	    var month = date.getMonth() + 1;
	    return month < 10 ? '0' + month : '' + month; // ('' + month) for string result
	}
	var getDate2=function(date) {
	    var day = date.getDate();
	    return day < 10 ? '0' + day : '' + day; // ('' + month) for string result
	}
	var manageNewsletter = function(){
	    $('input[name="newsletter"]').on('ifClicked', function (event) {
	        console.log( $(this).val() );
	        $('#newsletterinput').val( $(this).val() );
	    });
	} 
	var	today=new Date();
	var timenow=today.getHours()+':'+today.getMinutes();
	console.log( 'timenow'+timenow );
	var todaydate=getDate2(today)+'-'+getMonth2(today)+'-'+today.getFullYear();
	var offdays = $('#offdays').val().split(',');
	var closeddays = $('#closeddays').val().split(',');
	//var resadate=$('#mycalendar').val();
	var formattedtoday=getDate2(today)+'-'+getMonth2(today)+'-'+today.getFullYear();
	//$('#calendarlinkdata').text( getDate2(today)+'-'+getMonth2(today)+'-'+today.getFullYear() );
	$('.calendarhref').css( 'cursor', 'pointer' );
	$('.backbutton').css( 'cursor', 'pointer' );
	$('body').on('click','.reg-data', function(){ $('.registergroup1').removeClass('no-display');$('.registergroup2').addClass('no-display');});
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
			       cell.prop('title', t('js_no_serving'));
	        	}
	        	if( date.day() == closeddays[0] || date.day() == closeddays[1] || date.day() == closeddays[2] || date.day() == closeddays[3] || date.day() == closeddays[4] || date.day() == closeddays[5] || date.day() == closeddays[6] ){
	        	   if( closeddays != "" ){
				       cell.css("background-color", "#BBBBBB");
				       cell.css("cursor", "not-allowed");
				       cell.prop('title', t('js_restaurant_closed'));
	        		}        		
	        	}
	        	if( date.format("DD-MM-YYYY") == $('#calendarlinkdata').text() ){
	        		$('tbody td').removeClass('currentDayClass');
	        		console.log(date);
	        		console.log(cell);
	        		console.log( $('#calendarlinkdata').text() );
		        	cell.addClass('currentDayClass');	        		
	        	}
	        	if( date < moment().subtract(1, 'days' ) ){
			       cell.css("background-color", "#EEEEEE");
			       cell.css("cursor", "not-allowed");
			       cell.prop('title', t('js_passed_date'));	        		
	        	}
		    },
	        select: function(start, end, allDay) {
	        	console.log( start.format("DD-MM-YYYY") );
	        	if( start >= moment() && start.day() != closeddays[0] && start.day() != closeddays[1] && start.day() != closeddays[2] && start.day() != closeddays[3] && start.day() != closeddays[4] && start.day() != closeddays[5] && start.day() != closeddays[6] && $.inArray(start.format("DD-MM-YYYY"), offdays)==-1 ){
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
	var reservationSubmit= function(){
		var thisDay=today.getDay();
		var days = ['Sunday','Monday','Tuesday','Wednesday','Thursday','Friday','Saturday'];
		var offdays = $('#offdays').val().split(',');
		var closeddays = $('#closeddays').val();
		var inRange=false;
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
*/
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
					}else {classresult = 'btn-dark-green';
						selectedid='slotbutton'+res[1];
					}
					var button="<button name=\"slotbutton\" id=\"slotbutton"+j+"\" type=\"button\" class=\"btn "+classresult+" slotbutton\" value=\""+slot+"\" style=\"margin:5px\">"+slot+"</button>";
					$res.append( button );
					console.log('roulante',j);
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
		$('#locationbox').addClass('no-display');
		$('#locationlink').removeClass('no-display');
		//$('#peopleselectiongroup').addClass('no-display');
		var locationid=$('#select_location').val();
		var locationname=$('#select_location option:selected' ).text();
		var resadate=$('#mycalendar').val();
		var persondata=$('#party').val();
		//updatelink();
		$('#calendarlinkdata').text( $('#mycalendar').val() );
		$('#personlinkdata').text(persondata);
		$('#locationlinkdata').text(locationname);  
		var i=0;
		//clear up the divs
		i++;
		console.log( $('.mycalendar').val() );
		console.log( i );
		$('#servings').html(function(){ return '';});
		$('#slots').html(function(){ return '';});
		$('#inputs').html(function(){ return '';});
		$.ajax({
			url: URL+"/data/userreservation/resaslot?locationid="+locationid+"&date="+$('.mycalendar').val(),
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
					console.log( 'closed:'+serv[2] );
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
    return {
        //main function to initiate template pages
        init: function () {
        	managePartySize();
			reservationSubmit();
			loadFullCalendar();
			manageNewsletter();
        }
    };
}();
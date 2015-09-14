var ReservationFormValidator1 = function () {
	"use strict";
	var URL = "http://demo.gabison.com";
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
	var	today=new Date();
	var formattedtoday=getDate2(today)+'-'+getMonth2(today)+'-'+today.getFullYear();
	$('#calendarlinkdata').click( function(){
		$('.registergroup1').addClass('no-display');
		$('.registergroup2').addClass('no-display');
		$('.registergroup').addClass('no-display');
		$('.selectgroup').addClass('no-display');
		$('.slotgroup').addClass('no-display');
		$('#calendarbox').removeClass('no-display');
	});
	$('.calendarhref').css( 'cursor', 'pointer' );
	var reservationSubmit= function(){
		var thisDay=today.getDay();
		var days = ['Sunday','Monday','Tuesday','Wednesday','Thursday','Friday','Saturday'];
		var offdays = $('#offdays').val().split(',');
		var closeddays = $('#closeddays').val();
		var inRange=false;
		$('#mycalendar').datepicker({ 
			startDate: "0d",
			language: $("#language").val(),
			todayBtn: "linked", 
			todayHighlight: false, 
			defaultDate: new Date(), 
			autoclose: true,
			datesDisabled: offdays, 
			format: "dd-mm-yyyy",
			container: '#example-widget-container',
			beforeShowDay: function (date){
				if( $.inArray(getDate2(date)+'-'+getMonth2(date)+'-'+date.getFullYear(), offdays)>=0){
					console.log( getDate2(date)+'-'+getMonth2(date)+'-'+date.getFullYear() );
					return {
						tooltip: 'Restaurant is closed',
	                    classes: 'today',
	                    enabled: false
					}
				}
				var dateFormat = getDate2(date)+'-'+getMonth2(date)+'-'+date.getFullYear();
				var dayFormat = date.getDay();
				console.log( dayFormat );
				if( date == today ){
				  return {classes: 'activeDayClass', tooltip: 'today'};
				}
				if( closeddays.search(dayFormat) >= 0){ 
				  return {classes: 'disabled today', tooltip: 'No serving this day'};
				}
			}
		});
		if( $.urlParam('reservationid') !== null && $.urlParam('reservationid') !== 'undefined' && $.urlParam('reservationid')!='' && $('#method').val()=='PUT' && $('#method2').val()=='PUT'){
			lauchRequest(reservationid);
		}else{
			var backdrop = $('.ajax-white-backdrop');
			backdrop.remove();
			$('.book').click( function(){
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
					}else {classresult = 'btn-dark-green';
						selectedid='slotbutton'+res[1];
					}
					var button="<button name=\"slotbutton\" id=\"slotbutton"+j+"\" type=\"button\" class=\"btn btn-sm "+classresult+" slotbutton\" value=\""+slot+"\" style=\"margin:5px\">"+slot+"</button>";
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
		$('#locationbox').addClass('no-display');
		$('#locationlink').removeClass('no-display');
		$('#peopleselectiongroup').addClass('no-display');
		var locationid=$('#select_location').val();
		var locationname=$('#select_location option:selected' ).text();
		var resadate=$.formattedDate( $('#mycalendar').datepicker("getDate"), today );
		var persondata=$('#party').val();
		//updatelink();
		$('#calendarlinkdata').text(resadate);
		$('#personlinkdata').text(persondata);
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
			url: URL+"/data/userreservation/resaslot?locationid="+locationid+"&date="+$.formattedDate( $('#mycalendar').datepicker("getDate"), today )+suffix,
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
    return {
        //main function to initiate template pages
        init: function () {
			reservationSubmit();
        }
    };
}();
var ReservationFormValidator1 = function () {
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
	$('a.locationlinkfinal').css( 'cursor', 'pointer' );
	var reservationid=$.urlParam('reservationid');
	//console.log( "resadate: ", resadate );
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
	var dataInitiation=function(){
		$('#calendarlinkdata').text( $('#mycalendar').val() );
	}
	var managePreferredLanguage=function(){
		$('.preferredlanguage').click( function(){
			$('#preferredlanguageinput').val( $(this).attr('language') );
			$('#preferredlanguageimage').attr("src", "/flags/" + $(this).attr('language') + "-icon.png")
		});
	}
	var todaydate=getDate2(today)+'-'+getMonth2(today)+'-'+today.getFullYear();
	var offdays = $('#offdays').val().split(',');
	var closeddays = $('#closeddays').val().split(',');
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
			$('.personlinkdata').addClass('text-success');
			$('.personlinkdata').removeClass('text-muted');
		});
		$('#partyselect').on('change', function(){
			$('#party').val( $('#partyselect').val() );
			$('#personlinkdata').text( $('#partyselect').val() );
			$('.personlinkdata').addClass('text-success');
			$('.personlinkdata').removeClass('text-muted');
		});
	}
	var loadFullCalendar = function(){
		$("#fullcalendar").fullCalendar({
			lang: language,
			height: 400,
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
				if ( date.format("DD-MM-YYYY") == $('#mycalendar').val() ){
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
	        	console.log( "select: ", start.format("DD-MM-YYYY") );
	        	if( start >= moment() && start.day() != closeddays[0] && start.day() != closeddays[1] && start.day() != closeddays[2] && start.day() != closeddays[3] && start.day() != closeddays[4] && start.day() != closeddays[5] && start.day() != closeddays[6] && $.inArray(start.format("DD-MM-YYYY"), offdays)==-1 ){
					$('#mycalendar').val( start.format("DD-MM-YYYY") );
					$('#calendarlinkdata').text( start.format("DD-MM-YYYY") );
	        		console.log("in range");
	        	}else{ 
	        		console.log("not in range");
	        	}
	        	if( start.format("DD-MM-YYYY") == moment().format("DD-MM-YYYY") ){
					$('#mycalendar').val( start.format("DD-MM-YYYY") );
					$('#calendarlinkdata').text( start.format("DD-MM-YYYY") );	        	
	        	}
				$('#calendarbox').addClass('no-display');
				$('#partybox').removeClass('no-display');
				$('#backbutton').removeClass('no-display');
				$('.calendarlinkdata').addClass('text-success');
				$('.calendarlinkdata').removeClass('text-muted');
	        }
		});
	}
	var reservationSubmit= function(){
		var	today=new Date();
		var thisDay=today.getDay();
		var days = ['Sunday','Monday','Tuesday','Wednesday','Thursday','Friday','Saturday'];
		var offdays = $('#offdays').val().split(',');
		var closeddays = $('#closeddays').val();
		var inRange=false;
		if( $.urlParam('reservationid') !== null && $.urlParam('reservationid') !== 'undefined' && $.urlParam('reservationid')!='' && $('#method').val()=='PUT' && $('#method2').val()=='PUT'){
			lauchRequest(reservationid);
		}else{
			var backdrop = $('.ajax-white-backdrop');
			backdrop.remove();
			$('.partyselection').click( function(){
				$.blockUI({
					message: '<i class="fa fa-spinner fa-spin"></i> '+t('js_please_wait')
				});
				lauchRequest();
				$('#partybox').addClass('no-display');					
			});
				$.blockUI({
					message: '<i class="fa fa-spinner fa-spin"></i> '+t('js_please_wait')
				});
			$('.selectpartyselection').change( function(){
				lauchRequest();
				$('#partybox').addClass('no-display');					
			});
			//$('.book').click( function(){
			//	lauchRequest();
			//	$('#partybox').addClass('no-display');
			//});	
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
					var button="<button name=\"slotbutton\" id=\"slotbutton"+j+"\" type=\"button\" class=\"btn btn-lg "+classresult+" slotbutton\" value=\""+slot+"\" style=\"margin:5px\"><span class='badge badge-success' style='font-size:large'> "+res[2]+" </span><span class='badge badge-danger' style='font-size:large'> "+res[3]+" </span><br>"+slot+"</button>";
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
		$('.registergroup').removeClass('hidden-sm hidden-xs');
		$('.slotlinkdata').addClass('text-success');
		$('.slotlinkdata').removeClass('text-muted');
		$('#selectgroup').addClass('hidden-sm hidden-xs');
		$('#slotinput').val( $('#'+elementid).attr("value") );
		$('#slotlinkdata').text( $('#'+elementid).attr("value") );
		$('#locationinput').val( locationid );
		$('#reservationinput').val( reservationid );
		$('#reservationdateinput').val( $('#mycalendar').val() );
		$('#id').val( reservationid );
		console.log( 'elementid: '+elementid);
		console.log( 'locationid: '+locationid);
		$('.slotbutton').removeClass('btn-dark-orange');
		$('.registergroup').removeClass('no-display');
		$('#registerbutton').removeClass('no-display');
		$('#'+elementid).addClass('btn-dark-orange');
		var backdrop = $('.ajax-white-backdrop');
		backdrop.remove();
	}
	var lauchRequest = function(reservationid){
		$.unblockUI();
		$('.bookbutton').addClass('no-display');
		$('#selectgroup').removeClass('no-display');
		$('#calendarbox').addClass('no-display');
		$('#locationbox').addClass('no-display');
		$('#locationlink').removeClass('no-display');
		var locationid=$('#select_location').val();
		var locationname=$('#select_location option:selected' ).text();
		var persondata=$('#party').val();
		//updatelink();
		//$('#calendarlinkdata').text(resadate);
		$('#personlinkdata').text(persondata);
		$('#locationlinkdata').text(locationname); 
		var i=0;
		//clear up the divs
		i++;
		console.log( 'mycalendar value: ', $('.mycalendar').val() );
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
				var inputs="<input id=\"slotinput\" name=\"slotinput\" class=\"no-display\"><input id=\"servinginput\" name=\"servinginput\" class=\"no-display\"><input id=\"locationinput\" name=\"locationinput\" class=\"no-display\"><input id=\"id\" name=\"id\" class=\"no-display\"><input id=\"reservationinput\" name=\"reservationinput\" class=\"no-display\"><input id=\"reservationdateinput\" name=\"reservationdateinput\" class=\"no-display\"><input id=\"preferredlanguage\" name=\"preferredlanguage\" class=\"no-display\">";
				$input.append( inputs );
				var i=0;
				$.each(data.data, function (key, value) {
					i++;
					var serv=key.split("_-_");
						console.log( 'closed:'+serv[2] );
						console.log( 'todaydate:'+todaydate );
						console.log( 'selecteddate:'+$('#mycalendar').val() );
						console.log( 'selecteddate:'+moment( $('#mycalendar').val(), 'DD-MM-YYYY' ) );
						console.log( 'serv[5]:'+ serv[5] );
						console.log( 'moment(serv[5]): '+moment(serv[5],'HH:mm') );
						console.log( 'moment(timenow): '+moment(timenow,'HH:mm') );
					if( serv[2] == 'closed' ){ classclosed = 'disabled';classcolor='';}else{ classclosed = '';classcolor='btn-light-orange';}
					if( ( todaydate == $('#mycalendar').val() )  && ( moment(timenow,'HH:mm') > moment(serv[5],'HH:mm') ) ){
						classclosed = 'disabled';
					}
					var button="<button id=\"servingbutton"+i+"\" type=\"button\" class=\"btn btn-lg buttons-widget "+classcolor+" servingbutton\" serving=\""+key+"\" value=\""+serv[1]+"\" style=\"margin:5px\""+classclosed+">"+serv[0]+"</button>";
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
			dataInitiation();
			managePreferredLanguage();
        }
    };
}();
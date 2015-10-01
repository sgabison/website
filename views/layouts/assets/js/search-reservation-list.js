var SearchReservationList = function () {
	"use strict";
	var guesttext='test'; 
	var locationid;
	var	today=new Date();
	$.urlParam = function(name){
	    var results = new RegExp('[\?&]' + name + '=([^&#]*)').exec(window.location.href);
	    if (results==null){
	       return null;
	    }
	    else{
	       return results[1] || 0;
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
	$('#arrived').iCheck({checkboxClass: 'icheckbox_square-orange'});
	$('#cancelled').iCheck({checkboxClass: 'icheckbox_square-orange'});
	if( $("#language").val() == 'fr' ){
		$.fn.datepicker.dates['fr'] = {
			days: ["Dimanche", "Lundi", "Mardi", "Mercredi", "Jeudi", "Vendredi", "Samedi", "Dimanche"],
			daysShort: ["Dim", "Lun", "Mar", "Mer", "Jeu", "Ven", "Sam", "Dim"],
			daysMin: ["D", "L", "Ma", "Me", "J", "V", "S", "D"],
			months: ["Janvier", "FÃ©vrier", "Mars", "Avril", "Mai", "Juin", "Juillet", "AoÃ»t", "Septembre", "Octobre", "Novembre", "DÃ©cembre"],
			monthsShort: ["Jan", "Fev", "Mar", "Avr", "Mai", "Jui", "Jul", "Aou", "Sep", "Oct", "Nov", "Dec"],
			today: "Aujourd'hui",
			clear: "Effacer",
			weekStart: 1,
			format: "dd-mm-yyyy"
		};
	}
	$('.input-group.date').datepicker({ 
		language: $("#language").val(), 
		todayBtn: 'linked', 
		todayHighlight: true, 
		defaultDate: new Date(), 
		autoclose: true, 
		format: 'dd-mm-yyyy' 
	});	
	var currentDate =  getDate2(today)+'-'+getMonth2(today)+'-'+today.getFullYear();
	if( $('.mycalendar').val() == '' ){
		$('.mycalendar').val( currentDate );
	}
	$('.servingbutton').click(function(){
		$('.servingbutton').removeClass('btn-light-orange');
		$('.servingbutton').removeClass('btn-dark-orange');
		//$('.servingbutton').addClass('btn-dark-orange');
		$(this).addClass('btn-dark-orange');
		$('#servingbutton').val( $(this).val() );
		$('#servingid').val( $(this).val() );
	});
	//INITIATION
	$('#calendar').val( currentDate );

	$('#mycalendar').change( function(){
		$('#calendar').val( $('.mycalendar').val() );
	});
	var searchDataLoad = function () {
		var form1 = $('#searchform');
		//form1.attr('action','/liste-reservations'); 
		//form1.attr('method','POST');
		//$('#submit').click( function(event){
		//	var str = $( "form" ).serialize();
		//	event.preventDefault();
	   	//	form1.submit();
		//});
	};
	return {
        //main function to initiate template pages
        init: function () {
			searchDataLoad();
        }
    };
}();
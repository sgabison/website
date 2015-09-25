var SearchReservationList = function () {
	"use strict";
	var guesttext='test'; 
	var locationid;
	$.urlParam = function(name){
	    var results = new RegExp('[\?&]' + name + '=([^&#]*)').exec(window.location.href);
	    if (results==null){
	       return null;
	    }
	    else{
	       return results[1] || 0;
	    }
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
		format: 'dd-mm-yyyy' });	
	var fullDate = new Date();
	var twoDigitMonth = ((fullDate.getMonth().length+1) === 1)? (fullDate.getMonth()+1) : '0' + (fullDate.getMonth()+1);
	var currentDate =  fullDate.getDate() + "-" + twoDigitMonth + "-" + fullDate.getFullYear();
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
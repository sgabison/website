var TimePickerFormElements = function() {"use strict";

	//function to initiate bootstrap-timepicker
	var runTimePicker = function() {
		$('.time-picker').timepicker();
	};
	var runDatePicker = function() {
		$('.date-picker').datepicker({
			autoclose: true,
			todayHighlight: true, 
			orientation: 'bottom right' 
		});
		$('.input-daterange input').each(function (){
			$(this).datepicker({
				autoclose: true,
				todayHighlight: true, 
				orientation: 'bottom right',
				format: 'dd-mm-yyyy',
			});
		});
	};
	return {
		//main function to initiate template pages
		init: function() {
			runTimePicker();
			runDatePicker();
		}
	};
}();

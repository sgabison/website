var Login = function() {
	"use strict";
	var runBoxToShow = function() {
		var el = $('.box-login');
		if (getParameterByName('box').length) {
			switch(getParameterByName('box')) {
				case "register" :
					el = $('.box-register');
					break;
				case "forgot" :
					el = $('.box-forgot');
					break;
				case "remind" :
					el = $('.box-remind');
					break;

				default :
					el = $('.box-login');
					break;
			}
		}
		el.show().addClass("animated flipInX").on('webkitAnimationEnd mozAnimationEnd MSAnimationEnd oanimationend animationend', function() {
			$(this).removeClass("animated flipInX");
		});
	};
	var runMessageToShow= function(){
			if (getParameterByName('error').length) {
				toastr.warning(getParameterByName('error'));
			}
	}
	var runLoginButtons = function() {
		$('.forgot').on('click', function() {
			$('.box-login').removeClass("animated flipInX").addClass("animated bounceOutRight").on('webkitAnimationEnd mozAnimationEnd MSAnimationEnd oanimationend animationend', function() {
				$(this).hide().removeClass("animated bounceOutRight");

			});
			$('.box-forgot').show().addClass("animated bounceInLeft").on('webkitAnimationEnd mozAnimationEnd MSAnimationEnd oanimationend animationend', function() {
				$(this).show().removeClass("animated bounceInLeft");

			});
		});
		$('.register').on('click', function() {
			$('.box-login').removeClass("animated flipInX").addClass("animated bounceOutRight").on('webkitAnimationEnd mozAnimationEnd MSAnimationEnd oanimationend animationend', function() {
				$(this).hide().removeClass("animated bounceOutRight");

			});
			$('.box-register').show().addClass("animated bounceInLeft").on('webkitAnimationEnd mozAnimationEnd MSAnimationEnd oanimationend animationend', function() {
				$(this).show().removeClass("animated bounceInLeft");

			});

		});
		$('.go-back').click(function() {
			var boxToShow;
			if ($('.box-register').is(":visible")) {
				boxToShow = $('.box-register');
			} else {
				boxToShow = $('.box-forgot');
			}
			boxToShow.addClass("animated bounceOutLeft").on('webkitAnimationEnd mozAnimationEnd MSAnimationEnd oanimationend animationend', function() {
				boxToShow.hide().removeClass("animated bounceOutLeft");

			});
			$('.box-login').show().addClass("animated bounceInRight").on('webkitAnimationEnd mozAnimationEnd MSAnimationEnd oanimationend animationend', function() {
				$(this).show().removeClass("animated bounceInRight");

			});
		});
	};
	//function to return the querystring parameter with a given name.
	var getParameterByName = function(name) {
		name = name.replace(/[\[]/, "\\\[").replace(/[\]]/, "\\\]");
		var regex = new RegExp("[\\?&]" + name + "=([^&#]*)"), results = regex.exec(location.search);
		return results == null ? "" : decodeURIComponent(results[1].replace(/\+/g, " "));
	};
	var runSetDefaultValidation = function() {
		$.validator.setDefaults({
			errorElement : "span", // contain the error msg in a small tag
			errorClass : 'help-block',
			errorPlacement : function(error, element) {// render error placement for each input type
				if (element.attr("type") == "radio" || element.attr("type") == "checkbox") {// for chosen elements, need to insert the error after the chosen container
					error.insertAfter($(element).closest('.form-group').children('div').children().last());
				} else if (element.attr("name") == "card_expiry_mm" || element.attr("name") == "card_expiry_yyyy") {
					error.appendTo($(element).closest('.form-group').children('div'));
				} else {
					error.insertAfter(element);
					// for other inputs, just perform default behavior
				}
			},
			ignore : ':hidden',
			success : function(label, element) {
				label.addClass('help-block valid');
				// mark the current input as valid and display OK icon
				$(element).closest('.form-group').removeClass('has-error');
			},
			highlight : function(element) {
				$(element).closest('.help-block').removeClass('valid');
				// display OK icon
				$(element).closest('.form-group').addClass('has-error');
				// add the Bootstrap error class to the control group
			},
			unhighlight : function(element) {// revert the change done by hightlight
				$(element).closest('.form-group').removeClass('has-error');
				// set error class to the control group
			}
		});
	};
	var runLoginValidator = function() {
		var form = $('.form-login');
		form.attr( "action", "/data/login/login" );
		var errorHandler = $('.errorHandler', form);
		form.validate({
			rules : {
				email : {
					minlength : 6,
					required : true
				},
				password : {
					minlength : 6,
					required : true
				}
			},
			submitHandler : function(form) {
				errorHandler.hide();
				form.submit();
			},
			invalidHandler : function(event, validator) {//display error alert on form submit
				errorHandler.show();
			}
		});
	};
	var runForgot2Validator = function() {
		var form2 = $('.form-forgot');
		form2.attr( "action", "/data/login/getpassforgotten" );
		var errorHandler2 = $('.errorHandler', form2);
		form2.validate({
			rules : {
				email : {
					required : true
					,email: true
				 	,remote: "/data/login/check-email"
				}
			},
			submitHandler : function(form2) {
				console.log('form submitted', errorHandler2);
				errorHandler2.hide();
				form2.submit();
			},
			invalidHandler : function(event, validator) {//display error alert on form submit
				errorHandler2.show();
			}
		});
	};

	var runRegisterValidator = function() {
		var form3 = $('.form-register');
		form3.attr( "action", "/data/login/register" );
		var errorHandler3 = $('.errorHandler', form3);
		form3.validate({
			rules : {
				firstname : {
					required : true
				},
				lastname : {
					required : true
				},
				reference: {
					required : true
					,minlength : 2
				 	,remote: "/data/login/check-reference"
				},
				address : {
					minlength : 2,
					required : true
				},
				city : {
					minlength : 2,
					required : true
				},
				gender : {
					required : true
				},
				email : {
					required : true
				},
				password : {
					minlength : 6,
					required : true
				},
				password_again : {
					required : true,
					minlength : 5,
					equalTo : "#password_register"
				},
				agree : {
					minlength : 1,
					required : true
				}
			},
			submitHandler : function(form) {
				errorHandler3.hide();
				form.submit();
			},
			invalidHandler : function(event, validator) {//display error alert on form submit
				errorHandler3.show();
			}
		});
	};
	var runRemindValidator = function() {
		var form4 = $('.form-remind');
		form4.attr( "action", "/data/login/mynewpass" );
		var errorHandler4 = $('.errorHandler', form4);
		form4.validate({
			rules : {
				email : {
					email : true
				},
				newpassword : {
					minlength : 6,
					required : true
				},
				newpassword_again : {
					required : true,
					minlength : 6,
					equalTo : "#newpassword"
				}
			},
			submitHandler : function(form) {
				errorHandler4.hide();
				form.submit();
			},
			invalidHandler : function(event, validator) {//display error alert on form submit
				errorHandler4.show();
			}
		});
	};
	return {
		//main function to initiate template pages
		init : function() {
			runBoxToShow();
			runMessageToShow();
			runLoginButtons();
			runSetDefaultValidation();
			runLoginValidator();
			runForgot2Validator();
			runRegisterValidator();
			runRemindValidator();
		}
	};
}();

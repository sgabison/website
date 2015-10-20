var FormGuestValidator = function () {
	"use strict";
	var validateCheckRadio = function (val) {
        $("input[type='radio'], input[type='checkbox']").on('ifChecked', function(event) {
			$(this).parent().closest(".has-error").removeClass("has-error").addClass("has-success").find(".help-block").hide().end().find('.symbol').addClass('ok');
		});
    }; 
    // function to initiate Validation Sample 1
    var runValidator1 = function () {
        var form1 = $('#form-guest');
        var errorHandler1 = $('.errorHandler', form1);
        var successHandler1 = $('.successHandler', form1);
    	var guestSetupSubmit= function(){
    			var newguest = new Object;
    			  newguest.id= $("input[name=id]").val() 
    			, newguest.lastname = $("input[name=lastname]").val()
    			, newguest.firstname = $("input[name=firstname]").val()
    			, newguest.title = $("input[name=title]").val()
    			, newguest.email = $("#email").val()
    			, newguest.tel = $("#tel").val()
    			, newguest.preferredlanguage = $("#preferredlanguage").val()
    			, newguest.newsLetter = $("#newsLetter").val()
    			, newguest.METHOD = 'PUT';
    			$.blockUI({
    				message: '<i class="fa fa-spinner fa-spin"></i>'+ t("Veuillez patienter")+'...'
    			});
    			var reponse= new Object; // object(id,METHOD =(PUT,GET,POST,DELETE),data)
    			reponse.data=newguest;
    			reponse.id = newguest.id;
    			reponse.METHOD = newguest.METHOD; 
    			$.ajax({
    				url: '/data/guest/get-data',
    				dataType: 'json',
    				type:'POST', //obligatoire
    				data: JSON.stringify(reponse),
    				contentType: "application/json; charset=utf-8",
    				success: function(json) {
    					$.unblockUI();
    					if (json.success || json.success == 'true') {
    						//var i = $("#reservation-id").val();
    						//reservation[i] = json.data;
    						toastr.success(json.message);
    						successHandler1.hide();
    		                errorHandler1.hide();
    					}
    				},
    				error: function (request, status, error) {
    					 errorHandler1.show();
    				}        
    			});
    	};
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
                firstname: {
                    minlength: 1
    //               , required: true
                },
                lastname: {
                    minlength: 2,
                    required: true
                },
                email: {
                    email: true
                },
                tel: {
                	minlength:10
                }
            },
            messages: {
                firstname: t ("js_first_name_please"),
                lastname: t ("js_last_name_please"),
                email: t ("js_emailformat_please"),
                tel: t('js_minimum_10_car')
                
            },
            groups: {
                DateofBirth: "dd mm yyyy"
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
                errorHandler1.hide();
                guestSetupSubmit();
            }
        });
    };
 
    return {
        //main function to initiate template pages
        init: function () {
        	validateCheckRadio();
            runValidator1();
        }
    };
}();
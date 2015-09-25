var UserProfileValidation = function () {
	"use strict";
    var runContributorsFormValidation = function(el) {
        var formContributor = $('.form-contributor');
        var errorHandler3 = $('.errorHandler', formContributor);
        var successHandler3 = $('.successHandler', formContributor);
        console.log('formprofile', t('offsite'));
        formContributor.validate({
            errorElement: "span", // contain the error msg in a span tag
            errorClass: 'help-block',
            errorPlacement: function(error, element) { // render error placement for each input type
                if (element.attr("type") == "radio" || element.attr("type") == "checkbox") { // for chosen elements, need to insert the error after the chosen container
                    error.insertBefore($(element).closest('.form-group').children('div').children().last());
                } else if (element.attr("name") == "dd" || element.attr("name") == "mm" || element.attr("name") == "yyyy") {
                    error.insertBefore($(element).closest('.form-group').children('div'));
                } else {
                    error.insertBefore(element);
                    // for other inputs, just perform default behavior
                }
            },
            ignore: "",
            rules: {
                firstname: {
                    minlength: 2,
                    required: true
                },
                lastname: {
                    minlength: 2,
                    required: true
                },
                email: {
                    required: true,
                    email: true
                }
                ,
                password: {
                    minlength: 6
                },
                password_again: {
                    minlength: 5,
                    equalTo: ".contributor-password"
                }
            },
            messages: {
                firstname: t("js_first_name_please"),
                lastname: t("js_last_name_please"),
                email: {
                    required: t("js_email_please"),
                    email: t("js_emailformat_please")
                },
                password_again: {
                    minlength: t("js_password_format"),
                    equalTo: t("js_password_check")
                }

            },
            invalidHandler: function(event, validator) { //display error alert on form submit
                successHandler3.hide();
                errorHandler3.show();
            },
            highlight: function(element) {
                $(element).closest('.help-block').removeClass('valid');
                // display OK icon
                $(element).closest('.form-group').removeClass('has-success').addClass('has-error').find('.symbol').removeClass('ok').addClass('required');
                // add the Bootstrap error class to the control group
            },
            unhighlight: function(element) { // revert the change done by hightlight
                $(element).closest('.form-group').removeClass('has-error');
                // set error class to the control group
            },
            success: function(label, element) {
                label.addClass('help-block valid');
                // mark the current input as valid and display OK icon
                $(element).closest('.form-group').removeClass('has-error').addClass('has-success').find('.symbol').removeClass('required').addClass('ok');
            },
            submitHandler: function(form) {
                errorHandler3.hide();
                var userAvatar;
                if ($(".fileupload-preview img").attr("src") == null) {
                    userAvatar = "";
                } else {
                    userAvatar = $(".fileupload-preview img").attr("src");
                }

                var newContributor = new Object;
				newContributor.id= $(".contributor-id").val() 
                , newContributor.firstname = $(".contributor-firstname").val()
				, newContributor.lastname = $(".contributor-lastname").val()
				, newContributor.email = $(".contributor-email").val()
				, newContributor.password = $(".contributor-password").val()
				, newContributor.permits = $(".contributor-permits option:selected").val()
				, newContributor.avatar = userAvatar
				, newContributor.method = $(".contributor-form-method").val();

                $.blockUI({
                    message: '<i class="fa fa-spinner fa-spin"></i> Veuillez patienter...'
                });
				var reponse= new Object; // object(id,METHOD =(PUT,GET,POST,DELETE),data)
				reponse.data=newContributor;
				reponse.id = newContributor.id;
				reponse.METHOD = newContributor.method;
                if ($(".contributor-id").val() !== "") {					 
                    $.ajax({
                        url: '/data/person/get-data',
                        dataType: 'json',
						type:'POST', //obligatoire
						data: JSON.stringify(reponse),
						contentType: "application/json; charset=utf-8",
                        success: function(json) {
                            $.unblockUI();
                            if (json.success || json.success == 'true') {
                                var i = $(".contributor-index").val();
                                contributors[i] = json.data;
                                $.hideSubview();
                                toastr.success(newContributor.firstname +' '+ newContributor.lastname + ' '+ json.message);
                            } else {
								toastr.error(newContributor.firstname +' '+ newContributor.lastname + ' '+ json.message);
							}
                        }
                    });
                } else {
                    $.ajax({
                        url: '/data/person/get-data',
                        dataType: 'json',
						type:'POST',
						contentType: "application/json; charset=utf-8",
						data: JSON.stringify(reponse),
                        success: function(json) {
                            $.unblockUI();
                            if (json.success || json.success == 'true') {
                                contributors.push(json.data);
                                $.hideSubview();
                                toastr.success(newContributor.firstname +' '+ newContributor.lastname + ' '+ json.message);
                            } else {
								toastr.error(newContributor.firstname +' '+ newContributor.lastname + ' '+ json.message);
							}
                        }
                    });
                }
            }
        });
    };

    return {
        //main function to initiate template pages
        init: function () {
            runContributorsFormValidation();
        }
    };
}();

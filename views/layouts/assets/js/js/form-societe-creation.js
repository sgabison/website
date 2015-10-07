var FormSocieteCreation = function () {
	"use strict";
	var validateCheckRadio = function (val) {
        $("input[type='radio'], input[type='checkbox']").on('ifChecked', function(event) {
			$(this).parent().closest(".has-error").removeClass("has-error").addClass("has-success").find(".help-block").hide().end().find('.symbol').addClass('ok');
		});
    }; 

    // function to initiate Validation Sample 2
    var runValidator2 = function () {
        var form2 = $('#create-society');
        var url = '/data/admin/get-data';
        form2.attr('action', url);
		form2.attr('method', 'POST');
		form2.attr('novalidate','novalidate');

        var errorHandler2 = $('.errorHandler', form2);
        var successHandler2 = $('.successHandler', form2);
        $.validator.addMethod("getEditorValue", function () {
            $("#editor1").val($('#form2 .summernote').code());
            if ($("#editor1").val() != "" && $("#editor1").val().replace(/(<([^>]+)>)/ig, "") != "") {
                $('#editor1').val('');
                return true;
            } else {
                return false;
            }
        }, 'This field is required.');
        form2.validate({
            errorElement: "span", // contain the error msg in a small tag
            errorClass: 'help-block',
            errorPlacement: function (error, element) { // render error placement for each input type
                if (element.attr("type") == "radio" || element.attr("type") == "checkbox") { // for chosen elements, need to insert the error after the chosen container
                    error.insertAfter($(element).closest('.form-group').children('div').children().last());
                } else if (element.hasClass("ckeditor")) {
                    error.appendTo($(element).closest('.form-group'));
                } else {
                    error.insertAfter(element);
                    // for other inputs, just perform default behavior
                }
            },
            ignore: "",
            rules: {
                name : {
                    minlength: 2,
                    required: true
                },
                reference: {
                    minlength: 5,
                    required: true
                }
            },
            messages: {
                name : "Please specify the society name",
                reference : "Please specify your reference min 5 chars"
            },
            invalidHandler: function (event, validator) { //display error alert on form submit
                successHandler2.hide();
                errorHandler2.show();
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
            submitHandler: function (form,e) {
                successHandler2.show();
                errorHandler2.hide();
                // submit form
                //$('#form2').submit();
            // Prevent form submission
 	           e.preventDefault();
                console.log("hurra new society");
                var reponse = new Object;
                var newSociety = new Object;

    				   reponse.id =  $("#id").val();
   						newSociety.id = $("#id").val();
   						reponse.METHOD = (newSociety.id>0)?'PUT':'POST';

						newSociety.reference = $("#reference").val();
						newSociety.name = $("#name").val();
						newSociety.description = $("#description").val();
						newSociety.zip = $("#zip").val();
						newSociety.address = $("#address").val();
						newSociety.city = $("#city").val();
						newSociety.email = $("#email").val();
						reponse.data = newSociety;
                        $.ajax({
                            url: url,
                            dataType: 'json',
                            type : 'POST', // obligatoire
                            data : JSON.stringify(reponse),
                            contentType : "application/json; charset=utf-8",
                            success : function(json) {
    							$.unblockUI();
	    						if (json.success || json.success == 'true') {
	    							$("#id").val(json.data.o_id);
	                                toastr.success(json.message);
	                                successHandler2.html('<i class="fa fa-ok"></i>'+json.message);
	                            }
                        	}
                        });
            }
        });
      
    };
    return {
        //main function to initiate template pages
        init: function () {
        	validateCheckRadio();
            runValidator2();
        }
    };
}();
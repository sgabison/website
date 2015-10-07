var SocieteSetupFormValidator = function () {
	"use strict";
	$('#closingDateStart').datepicker({ todayHighlight: true, defaultDate: new Date(), autoclose: true });
	$('#closingDateEnd').datepicker({ todayHighlight: true, defaultDate: new Date(), autoclose: true });
	var societeSetupSubmit= function(){
		$('#submitform').click( function(){
			var newSociete = new Object;
			  newSociete.id= $("#id").val() 
			, newSociete.name = $("#name").val()
			, newSociete.address = $("#address").val()
			, newSociete.zip = $("#zip").val()
			, newSociete.city = $("#city").val()
			, newSociete.email = $("#email").val()
			, newSociete.tel = $("#tel").val()
			, newSociete.fax = $("#fax").val()
			, newSociete.maxSeats = $("#maxSeats").val()
			, newSociete.maxTables = $("#maxTables").val()
			, newSociete.maxResaPerUnit = $("#maxResaPerUnit").val()
			, newSociete.mealduration = $("#mealduration").val()
			, newSociete.resaUnit = $("#resaUnit").val()
			, newSociete.closingDateStart = $("#closingDateStart").val()
			, newSociete.closingDateEnd = $("#closingDateEnd").val()
			, newSociete.METHOD = 'PUT';
			$.blockUI({
				message: '<i class="fa fa-spinner fa-spin"></i> Veuillez patienter...'
			});
			var reponse= new Object; // object(id,METHOD =(PUT,GET,POST,DELETE),data)
			reponse.data=newSociete;
			reponse.id = newSociete.id;
			reponse.METHOD = newSociete.METHOD; 
			$.ajax({
				url: '/data/societe/get-data',
				dataType: 'json',
				type:'POST', //obligatoire
				data: JSON.stringify(reponse),
				contentType: "application/json; charset=utf-8",
				success: function(json) {
					$.unblockUI();
					if (json.success || json.success == 'true') {
						//var i = $("#reservation-id").val();
						//reservation[i] = json.data;
						toastr.success(newSociete.maxseats +' '+ newSociete.maxtables + ' '+ json.message);
					}
				},
				error: function (request, status, error) {
					alert(error);
					//alert(JSON.stringify(request));
				}        
			});
		});
	};
	var validateCheckRadio = function (val) {
        $("input[type='radio'], input[type='checkbox']").on('ifChecked', function(event) {
			$(this).parent().closest(".has-error").removeClass("has-error").addClass("has-success").find(".help-block").hide().end().find('.symbol').addClass('ok');
		});
    }; 
    // function to initiate Validation Sample 1
    var runValidator1 = function () {
        var form1 = $('#societesetupform');
        var errorHandler1 = $('.errorHandler', form1);
        var successHandler1 = $('.successHandler', form1);
        $.validator.addMethod("FullDate", function () {
            //if all values are selected
            if ($("#dd").val() != "" && $("#mm").val() != "" && $("#yyyy").val() != "") {
                return true;
            } else {
                return false;
            }
        }, 'Please select a day, month, and year');
        $('#societesetupform').validate({
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
                name: {
                    required: true
                },
                address: {
                    required: true
                },
                zip: {
                    required: true
                },
                city: {
                    required: true
                },
                tel: {
                    required: true
                },
                email: {
                    required: true
                },
                maxseats: {
                    required: true,
                    number: true
                },
                maxtables: {
                    required: true,
                    number: true
                },
                mealduration: {
                    required: true,
                    number: true
                },
                maxResaPerUnit: {
                    required: true,
                    number: true
                }
            },
            messages: {
                name: "Please enter the name of the company",
                address: "Please enter an address for the company",
                zip: "Please enter a postal code for the company",
                city: "Please enter a city for the company",
                tel: "Please enter a telephone number for the company",
                email: "Please enter an email address for the company",
                maxseats: "Please enter a maximum seats value, a numeric value",
                maxtables: "Please enter a maximum tables value, a numeric value",
                meallength: "Please enter a maximum length of the meal in minutes, a numeric value",
                maxResaPerUnit: "Please enter a maximum number of reservations per unit of time, a numeric value",
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
                successHandler1.show();
                errorHandler1.hide();
                //submit form
                //form.submit();
                //alert('submitform');
            }
        });
    };
	var editor; // use a global for the submit and return data rendering in the examples 
    editor = new $.fn.dataTable.Editor( {
        ajax: "/data/societe/persons-list",
        table: "#personlist",
        fields: [ {
                label: "First Name:",
                name: "firstname"
            }, {
                label: "Last Name:",
                name: "lastname"
            }, {
                label: "Email:",
                name: "email"
            }, {
                label: "Phone:",
                name: "phone"
            }, {
                label: "Password",
                name: "password",
                type: "password"
            }
        ]
    } );
    // Edit record
    $('#personlist').on('click', 'a.editor_edit', function (e) {
        e.preventDefault();
 
        editor.edit( $(this).closest('tr'), {
            title: 'Edit record',
            buttons: 'Update'
        } );
    } );
 
    // Delete a record
    $('#personlist').on('click', 'a.editor_remove', function (e) {
        e.preventDefault();
 
        editor.remove( $(this).closest('tr'), {
            title: 'Delete record',
            message: 'Are you sure you wish to remove this record?',
            buttons: 'Delete'
        } );
    } ); 
    // Activate an inline edit on click of a table cell
    $('a.editor_create').on('click', function (e) {
        e.preventDefault();
 
        editor.create( {
            title: 'Create new record',
            buttons: 'Add'
        } );
    } );
	editor.on( 'onInitCreate', function () {
	 	//editor.hide('email');
	 	//editor.hide('phone');
	});
    $('#personlist').on( 'click', 'tbody td:not(:first-child)', function (e) {
        editor.inline( this );
    } );
	$('#personlist').DataTable( {
		dom: "Tfrtip",
		ajax: "/data/societe/persons-list",
		columns: [
		  { data: null, defaultContent: '', orderable: false },
		  { data: "firstname" },
		  { data: "lastname" },
		  { data: "email" },
		  { data: "phone" },
          { data: null, defaultContent: '<a href="" class="btn btn-xs btn-green tooltips editor_edit"data-original-title="Edit"><i class="fa fa-edit"></i></a> / <a href="" class="btn btn-xs btn-red tooltips editor_remove" data-original-title="Remove"><i class="fa fa-times fa fa-white"></i></a>'}
		],
		order: [ 1, 'asc' ],
		tableTools: {
		  sRowSelect: "os",
		  sRowSelector: 'td:first-child',
		  aButtons: [
		      { sExtends: "editor_create", editor: editor }
		  ]
		}
	} );
	var editor2; // use a global for the submit and return data rendering in the examples 
    editor2 = new $.fn.dataTable.Editor( {
        ajax: "/data/societe/locations-list",
        table: "#locationlist",
        fields: [ {
                label: "Location Name:",
                name: "name"
            }, {
                label: "Resa Unit:",
                name: "resaUnit"
            }, {
                label: "Max Seats:",
                name: "maxSeats"
            }, {
                label: "Max Tables:",
                name: "maxTables"
            }, {
                label: "Max Resas Per Unit:",
                name: "maxResaPerUnit"
            }
        ]
    } );
    // Edit record
    $('#locationlist').on('click', 'a.editor_edit', function (e) {
        e.preventDefault();
        editor2.edit( $(this).closest('tr'), {
            title: 'Edit record',
            buttons: 'Update'
        } );
    } );
 
    // Delete a record
    $('#locationlist').on('click', 'a.editor_remove', function (e) {
        e.preventDefault();
        editor2.remove( $(this).closest('tr'), {
            title: 'Delete record',
            message: 'Are you sure you wish to remove this record?',
            buttons: 'Delete'
        } );
    } ); 
    // Activate an inline edit on click of a table cell
    $('a.editor_create').on('click', function (e) {
        e.preventDefault();
        editor2.create( {
            title: 'Create new record',
            buttons: 'Add'
        } );
    } );
    $('#locationlist').on( 'click', 'tbody td:not(:first-child)', function (e) {
        editor2.inline( this );
    } );
	editor2.on( 'onInitCreate', function () {
	 	editor2.hide('resaUnit');
	 	editor2.hide('maxSeats');
	 	editor2.hide('maxTables');
	 	editor2.hide('maxResaPerUnit');
	});
	editor2.on( 'postCreate', function ( e, json, data ) {
		var id = json.row.DT_RowId;
	    window.location.href="locationsetup?locationid="+id;
	} );
	$('#locationlist').DataTable( {
		dom: "Tfrtip",
		ajax: "/data/societe/locations-list",
		columns: [
		  { data: null, defaultContent: '', orderable: false },
		  { data: "name" },
		  { data: "resaUnit" },
		  { data: "maxSeats" },
		  { data: "maxTables" },
		  { data: "maxResaPerUnit" },
          {
			"class": "center",
			"data": "id",
			"orderable": false,
		    "render": function ( data, type, full, meta ) {
		      	return '<a href="locationsetup?locationid='+data+'" class="btn btn-xs btn-green tooltips" data-original-title="Edit"><i class="fa fa-edit"></i></a>';
		    }
          },
          { data: null, defaultContent: '<!--<a href="" class="btn btn-xs btn-green tooltips editor_edit"data-original-title="Edit"><i class="fa fa-edit"></i></a> / --><a href="" class="btn btn-xs btn-red tooltips editor_remove" data-original-title="Remove"><i class="fa fa-times fa fa-white"></i></a>'}
		],
		order: [ 1, 'asc' ],
		tableTools: {
		  sRowSelect: "os",
		  sRowSelector: 'td:first-child',
		  aButtons: [{ sExtends: "editor_create", editor: editor2 }]
		}
	} );
    return {
        //main function to initiate template pages
        init: function () {
            runValidator1();
            societeSetupSubmit(); 
        }
    };
}();
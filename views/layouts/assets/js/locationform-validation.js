var LocationFormValidator = function () {
	"use strict";
	var changeLocation = function () {
		$('#changelocationform').change( function(){
			$( "#changelocationform" ).submit();
		});
	};
	var initModals = function() {
		$.fn.modalmanager.defaults.resize = true;
		$.fn.modal.defaults.spinner = $.fn.modalmanager.defaults.spinner = '<div class="loading-spinner" style="width: 200px; margin-left: -100px;">' + '<div class="progress progress-striped active">' + '<div class="progress-bar" style="width: 100%;"></div>' + '</div>' + '</div>';
		var $modal = $('#ajax-modal');
		$('.demo').on('click', function() {
			// create the backdrop and wait for next modal to be triggered
			$('body').modalmanager('loading');
			setTimeout(function() {
				$modal.load('/serving-setup?servingid=98', '', function() {
					$modal.modal();
				});
			}, 1000);
		});
		$modal.on('click', '.update', function() {
			$modal.modal('loading');
			setTimeout(function() {
				$modal.modal('loading').find('.modal-body').prepend('<div class="alert alert-info fade in">' + 'Updated!<button type="button" class="close" data-dismiss="alert">&times;</button>' + '</div>');
			}, 1000);
		});
	};
	$.urlParam = function(name){
	    var results = new RegExp('[\?&]' + name + '=([^&#]*)').exec(window.location.href);
	    if (results==null){
	       return null;
	    }
	    else{
	       return results[1] || 0;
	    }
	};
	var locationid;
	if( $.urlParam('locationid') ){ locationid=$.urlParam('locationid');}else{locationid=$.urlParam('selectedLocationId');}
	var locationsetupDataLoad = function(){
		//$('#locationformsubmit').click( function(){
			var newLocation = new Object;
			  newLocation.id= locationid 
			, newLocation.name = $("#name").val()  
			, newLocation.address = $("#address").val()  
			, newLocation.zip = $("#zip").val()  
			, newLocation.city = $("#city").val()
			, newLocation.email = $("#email").val()
			, newLocation.tel = $("#tel").val()
			, newLocation.fax = $("#fax").val()
			, newLocation.description = $("#description").val()
			, newLocation.resaUnit = $("#resaUnit").val()
			, newLocation.maxSeats = $("#maxSeats").val()
			, newLocation.maxTables = $("#maxTables").val()
			, newLocation.maxResaPerUnit = $("#maxResaPerUnit").val()
			, newLocation.mealduration = $("#mealduration").val()
			, newLocation.closingDateStart = $("#closingDateStart").val()
			, newLocation.closingDateEnd = $("#closingDateEnd").val()
			, newLocation.METHOD = 'PUT';
			$.blockUI({
				message: '<i class="fa fa-spinner fa-spin"></i> Veuillez patienter...'
			});
			var reponse= new Object; // object(id,METHOD =(PUT,GET,POST,DELETE),data)
			reponse.data=newLocation;
			reponse.id = newLocation.id;
			reponse.METHOD = newLocation.METHOD; 
			$.ajax({
				url: '/data/location/get-data',
				dataType: 'json',
				type:'POST', //obligatoire
				data: JSON.stringify(reponse),
				contentType: "application/json; charset=utf-8",
				success: function(json) {
					$.unblockUI();
					if (json.success || json.success == 'true') {
						//var i = $("#reservation-id").val();
						//reservation[i] = json.data;
						toastr.success(newLocation.name + ' '+ json.message);
					}
				},
				error: function (request, status, error) {
					alert(error);
					//alert(JSON.stringify(request));
				}        
			});
		//});
	};
	var loadServings = function () {
	    // Edit record
	    var editor;
	    editor = new $.fn.dataTable.Editor( {
	        ajax: "/data/serving/serving-list?locationid="+locationid,
	        table: "#servinglist",
	        i18n: {
				create: {
					button: t("js_new"),
					title:  t("js_create_new_record"),
					submit: t("js_create")
				},
				edit: {
					button: t("js_modify"),
					title:  t("js_modify_entry"),
					submit: t("js_renew"),
				},
				remove: {
					button: t("js_delete"),
					title:  t("js_delete"),
					submit: t("js_delete"),
					confirm: {
						_: t("js_delete_n_lines"),
						1: t("js_delete_1_lines")
					}
				},
				error: {
					system: t("js_error_admin")
				}
	        },
	        fields: [ {
	                label: t("js_name"),
	                name: "title"
	            }, {
	                label: t("js_maxseats"),
	                name: "maxseats"
	            }, {
	                label: t("js_maxtables"),
	                name: "maxtables"
	            }, {
	                label: t("js_mealduration"),
	                name: "mealduration"
	            }, {
	                label: t("js_id"),
	                name: "id",
		            type: "readonly"
	            }
	        ]
	    } );
	    $('#servinglist').on('click', 'a.editor_edit', function (e) {
	        e.preventDefault();
	        editor.edit( $(this).closest('tr'), {
	            title: t('js_modify_entry'),
	            buttons: t('js_update'),
	        } );
	    } );
		editor.on( 'onInitCreate', function () {
		 	editor.hide('maxseats');
		 	editor.hide('maxtables');
		 	editor.hide('mealduration');
		 	editor.hide('id');
		});
	    // Delete a record
	    $('#servinglist').on('click', 'a.editor_remove', function (e) {
	        e.preventDefault();
	        editor.remove( $(this).closest('tr'), {
	            title: t('js_delete'),
	            message: t('js_delete_record_confirm'),
	            buttons: t('js_delete')
	        } );
	    } ); 
	    // Activate an inline edit on click of a table cell
	    $('a.editor_create').on('click', function (e) {
	        e.preventDefault();
	        editor.create( {
	            title: t('js_create_new_record'),
	            buttons: t('js_create')
	        } );
	    } );
		editor.on( 'postCreate', function ( e, json, data ) {
			var id = json.row.DT_RowId;
		    window.location.href="/serving-setup?servingid="+id;
		} );
	    $('#servinglist').on( 'click', 'tbody td:not(:first-child)', function (e) {
	    	if ( $(this).index() < 5 ) {
		        editor.inline( this );
	    	}
	    } );
		$('#servinglist').DataTable( {
			dom: "Tfrtip",
			ajax: "/data/serving/serving-list?locationid="+locationid,
			columns: [
			  { data: null, defaultContent: '', orderable: false },
			  { data: "title" },
			  { data: "maxseats" },
			  { 
			  	"data": "maxtables",
			  	"type": "number" 
			  },
			  { 
			  	"data": "mealduration",
			  	"type": "number"
			  },
			  { 
				"class": "center",
				"data": "id",
				"orderable": false,
			    "render": function ( data, type, full, meta ) {
			      	return '<a href="/serving-setup?servingid='+data+'" class="btn btn-blue tooltips" data-original-title="Edit"><i class="fa fa-edit"></i> </a>';
				}
			  },
	          { data: null, defaultContent: '<a href="" class="btn btn-red tooltips editor_remove" data-original-title="Remove"><i class="fa fa-times fa fa-white"></i> </a>'}
			],
			order: [ 1, 'asc' ],
			tableTools: {
			  sRowSelect: "os",
			  sRowSelector: 'td:first-child',
			  aButtons: [{ sExtends: "editor_create", editor: editor }]
			}
		} );
	}
	var validateCheckRadio = function (val) {
        $("input[type='radio'], input[type='checkbox']").on('ifChecked', function(event) {
			$(this).parent().closest(".has-error").removeClass("has-error").addClass("has-success").find(".help-block").hide().end().find('.symbol').addClass('ok');
		});
    }; 

    // function to initiate Validation Sample 1
    var runValidator2 = function () {
        var form2 = $('#locationsetupform');
        var errorHandler2 = $('.errorHandler', form2);
        var successHandler2 = $('.successHandler', form2);
        $.validator.addMethod("FullDate", function () {
            //if all values are selected
            if ($("#dd").val() != "" && $("#mm").val() != "" && $("#yyyy").val() != "") {
                return true;
            } else {
                return false;
            }
        }, 'Please select a day, month, and year');
        $('#locationsetupform').validate({
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
                email: {
                    required: true
                },
                tel: {
                    required: true
                },
                resaUnit: {
                    required: true,
                    number: true
                },
                mealduration: {
                    required: true,
                    number: true
                },
                maxSeats: {
                    required: true,
                    number: true
                },
                maxTables: {
                    required: true,
                    number: true
                },
                maxResaPerUnit: {
                    required: true,
                    number: true
                }            },
            messages: {
                name: t('js_name_please'),
                address: t('js_address_please'),
                zip: t('js_zip_please'),
                city: t('js_city_please'),
                email: t('js_email_please'),
                tel: t('js_tel_please'),
                resaUnit: t('js_resaunit_please'),
                maxSeats: t('js_maxseats_please'),
                maxTables: t('js_maxtables_please'),
                maxResaPerUnit: t('js_maxresperunits_please'),
                mealduration: t('js_mealduration_please')
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
            submitHandler: function (form) {
                successHandler2.show();
                errorHandler2.hide();
                //submit form
                locationsetupDataLoad();
                //alert('submitform');
            }
        });
    };
    return {
        //main function to initiate template pages
        init: function () {
        	initModals();
            validateCheckRadio();
            runValidator2();
            loadServings();
            changeLocation();
        }
    };
}();
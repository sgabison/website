var SocieteSetupFormValidator = function () {
	"use strict";
	var url = document.location.toString();
	if (url.match('#')) {
	    $('.nav-tabs a[href=#'+url.split('#')[1]+']').tab('show') ;
	} 
	// Change hash for page-reload
	$('.nav-tabs a').on('shown.bs.tab', function (e) {
	    window.location.hash = e.target.hash;
	})
	$("#nocopydata").click(function(){ 
		$("#nocopybox").removeClass('no-display');
		$("#copybox").addClass('no-display');
	});
	$("#copydata").click(function(){ 
	    var myurl=window.location.href;
	    var finalurl=myurl.split('#');
	    window.location.href=window.location.href.replace( /[\?#].*|$/, "?copydata=yes#locations" );
	});	
	$('#closingDateStart').datepicker({ todayHighlight: true, defaultDate: new Date(), autoclose: true });
	$('#closingDateEnd').datepicker({ todayHighlight: true, defaultDate: new Date(), autoclose: true });
	var societeSetupSubmit= function(){
//		$('#submitform').click( function(){
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
			, newSociete.maxResaSeats = $("#maxResaSeats").val()
			, newSociete.mealduration = $("#mealduration").val()
			, newSociete.resaUnit = $("#resaUnit").val()
			, newSociete.closingDateStart = $("#closingDateStart").val()
			, newSociete.closingDateEnd = $("#closingDateEnd").val()
			, newSociete.lngresult = $("#lngresult").val()
			, newSociete.latresult = $("#latresult").val()
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
//		});
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
        $.validator.addMethod("checkTableSeats", function (value, element) {
        	if(element.value > $('#maxSeats').val()) 
       		{
			return false;
			}
			return true;
		},'Cannot be less than number of Seats');
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
                maxSeats: {
                    required: true,
                    number: true
                },
                maxTables: {
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
                },
                maxResaSeats: {
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
                maxSeats: "Please enter a maximum seats value, a numeric value",
                maxTables: "Please enter a maximum tables value, a numeric value",
                meallength: "Please enter a maximum length of the meal in minutes, a numeric value",
                maxResaPerUnit: "Please enter a maximum number of reservations per unit of time, a numeric value"
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
                societeSetupSubmit();
                //alert('submitform');
            }
        });
    };
    var loadPersons = function () {
	    var editor = new $.fn.dataTable.Editor( {
	        ajax: "/data/societe/persons-list",
	        table: "#personlist",
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
		                _: "Etes-vous sûr de vouloir supprimer %d lignes?",
		                1: "Etes-vous sûr de vouloir supprimer 1 ligne?"
		            }
		        },
		        error: {
		            system: "Une erreur s’est produite, contacter l’administrateur système"
		        }
            },
	        fields: [ {
	                label: t('js_firstname'),
	                name: "firstname"
	            }, {
	                label: t('js_lastname'),
	                name: "lastname"
	            }, {
	                label: t('js_email'),
	                name: "email"
	            }, {
	                label: t('js_phone'),
	                name: "phone"
	            }, {
	                label: t('js_password'),
	                name: "password",
	                type: "password"
	            }
	        ]
	    } );
	    // Edit record
	    $('#personlist').on('click', 'a.editor_edit', function (e) {
	        e.preventDefault();
	 
	        editor.edit( $(this).closest('tr'), {
	            title: t("js_modify"),
	            buttons: t("js_update"),
	        } );
	    } );
	 
	    // Delete a record
	    $('#personlist').on('click', 'a.editor_remove', function (e) {
	        e.preventDefault();
	 
	        editor.remove( $(this).closest('tr'), {
	            title: t("js_delete"),
	            message: t("js_delete_record_confirm"),
	            buttons: t("js_delete")
	        } );
	    } ); 
	    // Activate an inline edit on click of a table cell
	    $('a.editor_create').on('click', function (e) {
	        e.preventDefault();
	 
	        editor.create( {
	            title: t("js_create_new_record"),
	            buttons: t("js_add")
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
	          { data: null, orderable: false, defaultContent: '<a href="" class="btn btn-blue tooltips editor_edit"data-original-title="Edit"><i class="fa fa-edit"></i> </a>'},
	          { data: null, orderable: false, defaultContent: '<a href="" class="btn btn-red tooltips editor_remove" data-original-title="Remove"><i class="fa fa-times fa fa-white"></i> </a>'}
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
    };
	var format= function ( d ) {
	    // `d` is the original data object for the row
	    var servings=d.servings.split('____');
	    var add='';
	    var displayserving=function( servings ){
	    	var i=0;
		    $.each(servings, function(index, value){
		    	i++;
		    	if(i==1){var info="LISTE DES SERVICES";}else{info="";}
		    	var serv=value.split('----');
		    	add = add+
		    		'<tr>'+
		    		'<td width="150px">'+ info +'</td>'+
		    		'<td width="5%"><i class="fa fa-lg fa-cutlery"></i></td>'+
		    		'<td width="100px">'+serv[0].toUpperCase()+'</td>'+
		    		'<td><a class="btn btn-blue" style="color:#FFFFFF" href="/serving-setup?selectedLocationId='+d.id+'&servingid='+serv[1]+'"><i class="fa fa-edit"></i> </button></td>'+
		    		'</tr>'
		    });
		    return add;
	    }
	    return '<table cellpadding="10" cellspacing="10" border="0" class="table">'+
			displayserving(servings)+
	    '</table>';
	}	
	var loadLocations = function () {
	    var editor2 = new $.fn.dataTable.Editor( {
	        ajax: "/data/societe/locations-list",
	        table: "#locationlist",
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
		            system: "Une erreur s’est produite, contacter l’administrateur système"
		        }
            },		        
	        fields: [ {
	                label: t("js_location_name"),
	                name: "name"
	            }, {
	                label: t("js_resaunit"),
	                name: "resaUnit"
	            }, {
	                label: t("js_maxseats"),
	                name: "maxSeats"
	            }, {
	                label: t("js_maxtables"),
	                name: "maxTables"
	            }, {
	                label: t("js_maxresaperunit"),
	                name: "maxResaPerUnit"
	            }
	        ]
	    } );
	    $('#locationlist').on( 'click', 'tbody td.details-control', function () {
	        var tr = $(this).closest('tr');
	        var row = table.row( tr );
	        if ( row.child.isShown() ) {
	            // This row is already open - close it
	            row.child.hide();
	            tr.removeClass('shown');
	        }
	        else {
	            // Open this row
	            row.child( format(row.data()) ).show();
	            tr.addClass('shown');
	        }
	    } );
	    // Edit record
	    $('#locationlist').on('click', 'a.editor_edit', function (e) {
	        e.preventDefault();
	        editor2.edit( $(this).closest('tr'), {
	            title: t('js_change_location'),
	            buttons: t("js_modify")
	        } );
	    } );
	 
	    // Delete a record
	    $('#locationlist').on('click', 'a.editor_remove', function (e) {
	        e.preventDefault();
	        editor2.remove( $(this).closest('tr'), {
	            title: t('js_delete_location'),
	            message: t('js_delete_location_confirm'),
	            buttons: t("js_delete")
	        } );
	    } ); 
	    // Activate an inline edit on click of a table cell
	    $('a.editor_create').on('click', function (e) {
	        e.preventDefault();
	        editor2.create( {
	            title: t("js_create_new_record"),
	            buttons: t("js_add")
	        } );
	    } );
//	    $('#locationlist').on( 'click', 'tbody td:not(:first-child)', function (e) {
//	        editor2.inline( this );
//	    } );
		editor2.on( 'onInitCreate', function () {
		 	editor2.hide('resaUnit');
		 	editor2.hide('maxSeats');
		 	editor2.hide('maxTables');
		 	editor2.hide('maxResaPerUnit');
		});
		editor2.on( 'postCreate', function ( e, json, data ) {
			var id = json.row.DT_RowId;
		    window.location.href="/location-setup?selectedLocationId="+id;
		} );
		var table = $('#locationlist').DataTable( {
			dom: "Tfrtip",
			ajax: "/data/societe/locations-list",
			columns: [
              { "className":      'details-control',
                "orderable":      false,
                "data":           null,
                "defaultContent": '',
                "render": function ( data, type, row ) {
                	return "<a class='btn btn-default'><i class='fa fa-plus-square'> </i></a>"
                }
              },
			  { data: "name" },
			  { data: "resaUnit" },
			  { data: "maxSeats" },
			  { data: "maxTables" },
			  { data: "maxResaPerUnit" },
	          {
				"class": "center",
				"data": "icon",
				"orderable": false,
			    "render": function ( data, type, full, meta ) {
			      	return '<a href="/location-setup?selectedLocationId='+data+'" class="btn btn-blue tooltips" data-original-title="Edit"><i class="fa fa-edit"></i> </a>';
			    }
	          },
	          { data: null, orderable: false, defaultContent: '<a href="" class="btn btn-red tooltips editor_remove" data-original-title="Remove"><i class="fa fa-times fa fa-white"></i> </a>'}
			],
			order: [ 1, 'asc' ],
			tableTools: {
			  sRowSelect: "os",
			  sRowSelector: 'td:first-child',
			  aButtons: [{ sExtends: "editor_create", editor: editor2 }]
			}
		} );
	}
	var loadTags = function () {
	    var editor3 = new $.fn.dataTable.Editor( {
	        ajax: "/data/tags/tags-list",
	        table: "#tagslist",
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
		                _: "Etes-vous sûr de vouloir supprimer %d lignes?",
		                1: "Etes-vous sûr de vouloir supprimer 1 ligne?"
		            }
		        },
		        error: {
		            system: "Une erreur s’est produite, contacter l’administrateur système"
		        }
            },		        
	        fields: [ {
					name: "id",
					type: "hidden"
				}, {
	                label: t("js_tag_code"),
	                name: "code"
	            }, {
	                label: t("js_name_fr"),
	                name: "name_fr"
	            }, {
	                label: t("js_name_en"),
	                name: "name_en"
	            }, {
	                label: "icon",
	                name: "icon",           
	                type:  "select",
	                options: [
	                    { label: "camera", 		value: "fa-camera-retro" },
	                    { label: "wheelchair",  value: "fa-wheelchair" },
	                    { label: "money",      	value: "fa-money" },
	                    { label: "medic",      	value: "fa-medkit" },
	                    { label: "ambulance",  	value: "fa-ambulance" },
	                    { label: "coffee",  	value: "fa-coffee" },
	                    { label: "cutlery",  	value: "fa-cutlery" },
	                    { label: "calendar",  	value: "fa-calendar" },
	                    { label: "gift",  		value: "fa-gift" },
	                    { label: "group",  		value: "fa-group" },
	                    { label: "male",  		value: "fa-male" },
	                    { label: "warning",  	value: "fa-warning" },
	                    { label: "group",  		value: "fa-group" },
	                    { label: "briefcase",  	value: "fa-briefcase" },
	                    { label: "asterisk",  	value: "fa-asterisk" },
	                    { label: "beer",  		value: "fa-beer" },
	                    { label: "bug",  		value: "fa-bug" }
	                ]
	            }
	            
	        ]
	    } );
	    $('#tagslist').on( 'click', 'tbody td.details-control', function () {
	        var tr = $(this).closest('tr');
	        var row = table.row( tr );
	        if ( row.child.isShown() ) {
	            // This row is already open - close it
	            row.child.hide();
	            tr.removeClass('shown');
	        }
	        else {
	            // Open this row
	            row.child( format(row.data()) ).show();
	            tr.addClass('shown');
	        }
	    } );
	    // Edit record
	    $('#tagslist').on('click', 'a.editor_edit', function (e) {
	        e.preventDefault();
	        editor3.edit( $(this).closest('tr'), {
	            title: t('js_change_tag'),
	            buttons: t("js_modify")
	        } );
	    } );
	 
	    // Delete a record
	    $('#tagslist').on('click', 'a.editor_remove', function (e) {
	        e.preventDefault();
	        editor3.remove( $(this).closest('tr'), {
	            title: t('js_delete_tag'),
	            message: t('js_delete_tag_confirm'),
	            buttons: t("js_delete")
	        } );
	    } ); 
	    // Activate an inline edit on click of a table cell
	    $('a.editor_create').on('click', function (e) {
	        e.preventDefault();
	        editor.create( {
	            title: t("js_create_new_record"),
	            buttons: t("js_add")
	        } );
	    } );
//	    $('#tagslist').on( 'click', 'tbody td:not(:first-child)', function (e) {
//	        editor3.inline( this );
//	    } );
		var table = $('#tagslist').DataTable( {
			dom: "Tfrtip",
			ajax: "/data/tags/tags-list",
			columns: [
			  { data: null, defaultContent: '', orderable: false },
			  { 
			  	"data": "id",
			  	"visible": false 
			  },
			  { data: "code" },
			  { data: "name_fr" },
			  { data: "name_en" },
	          {
				"class": "center",
				"data": "icon",
				"orderable": false,
			    "render": function ( data, type, row ) {
			      	return '<i class="fa '+row.icon+' fa-2x"></i> ';
			    }
	          },
	          { data: null, orderable: false, defaultContent: '<a href="" class="btn btn-blue tooltips editor_edit"data-original-title="Edit"><i class="fa fa-edit"></i> </a>'},
	          { data: null, orderable: false, defaultContent: '<a href="" class="btn btn-red tooltips editor_remove" data-original-title="Remove"><i class="fa fa-times fa fa-white"></i> </a>'}
			],
			order: [ 1, 'asc' ],
			tableTools: {
			  sRowSelect: "os",
			  sRowSelector: 'td:first-child',
			  aButtons: [{ sExtends: "editor_create", editor: editor3 }]
			}
		} );
	}

    return {
        //main function to initiate template pages
        init: function () {
            runValidator1();
            //societeSetupSubmit(); 
            loadLocations();
            loadPersons();
            loadTags();
        }
    };
}();
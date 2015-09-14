var PagesReservationList = function () {
	"use strict";
	var oTable, reservations=[];
    var subViewElement, subViewContent, subViewIndex;
    //function to initiate Pulsate
    var runPulsate = function () {
        $('.pulsate').pulsate({
            color: '#C43C35', // set the color of the pulse
            reach: 10, // how far the pulse goes in px
            speed: 1000, // how long one pulse takes in ms
            pause: 200, // how long the pause between pulses is in ms
            glow: false, // if the glow should be shown too
            repeat: 3, // will repeat forever if true, if given a number will repeat for that many times
            onHover: false // if true only pulsate if user hovers over the element
        });
		
    };
	var checkboxCallback = function(mydata){
 
		var data  =  'positionId=' + mydata.positionId + '&personId='+ mydata.personId +'&value='+ mydata.checked ;//$.param(mydata) ; //
 
		$.ajax({
				url:'/data/person/set-position',
				data:data,
				dataType : 'json',
				success:function(json){
					toastr.success(mydata.fullName + ' ' +json.message);
				}
			});   
	};
		//function to initiate Callback on Checkbox and RadioButton
	var runCallbackIcheck = function() {
		var checkboxP =$('input.checkbox-position');
		
		checkboxP.on('ifChecked', function(event) {	
			var mydata = $( this ).data();
			mydata.checked=1;
			checkboxCallback(mydata);
		});
		$('input.checkbox-position').on('ifUnchecked', function(event) {
			var mydata = $( this ).data();
			mydata.checked=0;
			// var data  = 'positionId=' + mydata.positionId + '&personId='+ mydata.personId +'&value=0' ;
			checkboxCallback(mydata);
		});
		$('input.radio-position').on('ifChecked', function(event) {
			alert('checked ' + $(this).val() + ' radio button');
		});
		$(".show-subviews.edit-reservation").off().on("click", function() {

                    subViewElement = $(this);
                    subViewContent = subViewElement.attr('href');
					var contributorIndex = subViewElement.data("index");
                    $.subview({
                        content: subViewContent,
                        onShow: function() {
							if ( !reservations) setReservationsList().editReservation(reservationIndex);
							else editReservation(reservationIndex);
                        }
                    });
                });
		};
	var LISTING_RESULTS = [];
	var setReservation= function(item, index, array){
			
			var a = new Array(item.id, item.startdate, item.starttime, item.servingtitle, item.guestname, item.partysize, item.guesttel, item.id, item.id);
			LISTING_RESULTS.push(a);
			return  a;
			// id:0, day:1,timestart:2, timeend:3, maxseats:4, maxtables:5, id:6, location:7, id:8
		};	
		
		
    var setReservationsList = function() {
        var  url='/data/advanceddid/reservation-list';		
		$.getJSON( url ).done(function( data ) {
			$.each(data.data, function( index, value ) {
				reservations[value.id] = value;	
			});
			reservations.forEach(setReservation);
		});
	};
 
	var getReservationById =function (id){
		return reservations[id];
	}
	
    var showReservations = function() {
        $('#reservations').append('<table class="table table-striped" id="example"></table>');
   //     $.fn.dataTableExt.sErrMode = 'console'; //suprime les alertes;
		oTable = $('#example').dataTable({
            "oLanguage": {
                "sLengthMenu": "_MENU_",
                "sSearch": "",
                "oPaginate": {
                    "sPrevious": "",
                    "sNext": ""
                }
            },
            "fnRowCallback": function(nRow, aData, iDisplayIndex) {
                /* Append the grade to the default row class name */
                //alert(aData) => c'est LISTING_RESULTS
                $('#example_wrapper .dataTables_filter input').addClass("form-control").attr("placeholder", "Search");
                // modify table search input

                // modify table per page dropdown
                $('#example_wrapper .dataTables_length select').selectpicker();
                // initialzie select2 dropdown
				console.log (nRow, aData, iDisplayIndex, aData[8]);
                $('td:eq(0)', nRow).html( aData[1].toUpperCase() );
                var reservationIndex = aData[8];
                console.log( 'aData[8]: '+reservationIndex );
                $("td:eq(1)", nRow).empty();
                $("td:eq(8)", nRow).empty();
                $(".options-reservations").children().clone().appendTo($("td:eq(8)", nRow)).find(".edit-reservation").data("index", reservationIndex).off().on("click", function() {
                    subViewElement = $(this);
                    subViewContent = subViewElement.attr('href');
					var reservationIndex = subViewElement.data("index");
					console.log( 'reservationIndex: '+reservationIndex );
                    $.subview({
                        content: subViewContent,
                        onShow: function() {
                            editReservation(reservationIndex);
                        }
                    });
                }).end().find(".delete-reservation").data("index", reservationIndex).off().on("click", function() {
                    var target_tr = $(this).closest("tr");
					var target_row = $(this).closest("tr").get(0);
					
                    var el = $(this).data("index");
					var reservation = reservations[el], name= reservation.firstname +' '+ reservation.lastname;	
					console.log('delete', el, reservations, 'target',target_tr, target_row);
                    // this line did the trick
                    bootbox.confirm("Delete "+ name +" ?", function(result) {

                        if (result) {
                            $.blockUI({
                                message: '<i class="fa fa-spinner fa-spin"></i> Do some ajax to sync with backend...'
                            });
							var reponse= new Object; // object(id,METHOD =(PUT,GET,POST,DELETE),data)
							
							reponse.data = {id:el};
							reponse.id = el;
							reponse.METHOD = 'DELETE';
                            $.ajax({
                                url: '/data/serving/get-data',
								dataType: 'json',
								type:'POST', //obligatoire
								data: JSON.stringify(reponse),
								contentType: "application/json; charset=utf-8",
								success: function(json) {
									$.unblockUI();
									
									if (json.success || json.success == 'true') {
											reservations.splice( el, 1 );
											destroyReservations();
											showReservations();
										toastr.success(name + ' '+ json.message);
									} else {
										toastr.error( name + ' '+ json.message);
									}
								}
							});
                    } 
					});
                });			
            },
            "aaData": LISTING_RESULTS,
            "aoColumns": 			[
               {
                "sTitle": "",
                "bSearchable": false
            }, {
                "sTitle": "Day"
            }, {
                "sTitle": "Time"
            }, {
                "sTitle": "serving"
            }, {
                "sTitle": "GuestName"
            }, {
                "sTitle": "Party Size",
                "bSearchable": false
            }, {
                "sTitle": "Guest Tel."
            }, {
                "sTitle": "Booking ref."
            }, {
                "sTitle": "Options",
                "sClass": "center"
            }],
            "aoColumnDefs": [{
                bSortable: false,
                aTargets: [0, -1]
            }],
            "aaSorting": [
                [1, "asc"]
            ]
        });
    };
    
    var destroyReservations = function() {
        //Delete the datable object first
        if (oTable != null)
            oTable.fnDestroy();
        //Remove all the DOM elements
        $('#example').remove();
    };
    var editReservation = function(el) {
		$(".form-reservation").attr('action','/data/reservation/get-data'); 
		$(".form-reservation").attr('method','POST'); 
        $(".form-reservation .help-block").remove();
        $(".form-reservation .form-group").removeClass("has-error").removeClass("has-success");
		console.log("element clicker",el);
        if (typeof el == "undefined") {
            $(".reservation-id").val("");
            $(".reservation-startdate").val("");
            $(".reservation-starttime").val("");
            $(".reservation-guestname").val(""); 
            $(".reservation-servingtitle").val("");
            $(".reservation-partysize").val("");
            $(".reservation-guesttel").val("");
            $(".reservation-message").val("");
			$(".reservation-form-method").val("POST");
        } else {
            $(".reservation-index").val(el);
            $(".reservation-id").val(reservations[el].id);
            $(".reservation-startdate").val(reservations[el].startdate);
            $(".reservation-starttime").val(reservations[el].starttime);
            $(".reservation-guestname").val(reservations[el].guestname); 
            $(".reservation-servingtitle").val(reservations[el].servingtitle); 
            $(".reservation-partysize").val(reservations[el].partysize);
            $(".reservation-guesttel").val(reservations[el].guesttel);
            $(".reservation-message").val("");
			$(".reservation-form-method").val("PUT");
        }
    };
    var runReservationsFormValidation = function(el) {
        var formReservation = $('.form-reservation');
        var errorHandler3 = $('.errorHandler', formReservation);
        var successHandler3 = $('.successHandler', formReservation);
        formReservation.validate({
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
                },
                password: {
                    minlength: 6,
                    required: true
                },
                password_again: {
                    required: true,
                    minlength: 5,
                    equalTo: ".reservation-password"
                },
                yyyy: "FullDate",
                gender: {
                    required: true
                },
                zipcode: {
                    required: true,
                    number: true,
                    minlength: 5
                },
                city: {
                    required: true
                },
                newsletter: {
                    required: true
                }
            },
            messages: {
                firstname: "Please specify your first name",
                lastname: "Please specify your last name",
                email: {
                    required: "We need your email address to contact you",
                    email: "Your email address must be in the format of name@domain.com"
                },
                gender: "Please check a gender!"
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

                var newReservation = new Object;
				newReservation.id= $(".reservation-id").val() 
                , newReservation.startdate = $(".reservation-startdate").val()
				, newReservation.starttime = $(".reservation-starttime").val()
				, newReservation.bookingref = $(".reservation-bookingref").val()
				, newReservation.bookingnotes = $(".reservation-bookingnotes").val()
				, newReservation.guestname = $(".reservation-guestname").val()
				, newReservation.guesttel = $(".reservation-guesttel").val()
				, newReservation.guestemail = $("reservation-guestemail").val()
				, newReservation.partysize = $(".reservation-partysize").val()
				, newReservation.servingid = $(".reservation-servingid").val()
				, newReservation.servingtitle = $(".reservation-servingtitle").val()
				, newReservation.locationid = $(".reservation-locationid").val()
				, newReservation.locationname = $(".reservation-locationname").val()
				, newReservation.message = $(".reservation-message").val()
				, newReservation.method = $(".reservation-form-method").val();
                $.blockUI({
                    message: '<i class="fa fa-spinner fa-spin"></i> Do some ajax to sync with backend...'
                });
				var reponse= new Object; // object(id,METHOD =(PUT,GET,POST,DELETE),data)
				reponse.data=newReservation;
				reponse.id = newReservation.id;
				reponse.METHOD = newReservation.method;
                if ($(".reservation-id").val() !== "") {					 
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
                                reservations[i] = json.data;
                                $.hideSubview();
                                toastr.success(newReservation.firstname +' '+ newReservation.lastname + ' '+ json.message);
                            } else {
								toastr.error(newReservation.firstname +' '+ newReservation.lastname + ' '+ json.message);
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
                                reservations.push(json.data);
                                $.hideSubview();
                                toastr.success(newReservation.firstname +' '+ newReservation.lastname + ' '+ json.message);
                            } else {
								toastr.error(newReservation.firstname +' '+ newReservation.lastname + ' '+ json.message);
							}
                        }
                    });
                }
            }
        });
    };

   var runSubViews = function() {

        $(".new-reservation").off().on("click", function() {
            subViewElement = $(this);
            subViewContent = subViewElement.attr('href');
            $.subview({
                content: subViewContent,
                onShow: function() {
                    editContributor();
                }
            });
        });
        $(".show-reservations").off().on("click", function() {
            subViewElement = $(this);
            subViewContent = subViewElement.attr('href');
            $.subview({
                content: subViewContent,
                startFrom: "right",
                onShow: function() {
                    showReservations();
                },
                onHide: function() {
                    destroyReservations();
                }
            });
        });
    };

	//function to initiate bootstrap-datepicker
	var runDatePicker = function() {
		$('.date-picker').datepicker({
			autoclose: true
		});
	};
		
    return {
        //main function to initiate template pages
        init: function () {
            runPulsate();
			setReservationsList();
            runReservationsFormValidation();
            runSubViews();
			runCallbackIcheck();
			runDatePicker();
        }
    };
}();

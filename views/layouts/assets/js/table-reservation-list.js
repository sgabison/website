var TableReservationList = function () {
	"use strict";
	var table;
	var locationid;
	var editor;
	var calendar=$('#calendar').val();
	var servingid=$('#servingid').val();
	var guestid=$('#guestid').val(); 
	var cancelled=$('#cancelled').val(); 
	var runInputLimiter = function() {
		$('.limited').inputlimiter({
			remText: 'You only have %n character%s remaining...',
			remFullText: 'Stop typing! You\'re not allowed any more characters!',
			limitText: 'You\'re allowed to input %n character%s into this field.'
		});
	};
//	if( $('#warning').val() == 'search' ){
//		window.location.href = '/liste-reservations-search';
//	}
	$(".search-select").select2({
		placeholder: "Select a State",
		allowClear: false
	});
	// START-----INITIAL ROW SELECTION CRITERIA
	$("input[type='checkbox'].make-switch").bootstrapSwitch();
	if( $('#arrived').val() == 1){
		$('#checkarrived').prop( "checked", true );
	}
	if( $('#cancelled').val() == 1){
		$('#checkcancelled').prop( "checked", true );
	}
    // END------INITIAL ROW SELECTION CRITERIA	
	// START-----INITIAL COLUMN SELECTION CRITERIA
 	$(".search-select").on("select2-removed", function(e) {
    	console.log(e.val);
    })
	$(".search-select").on("select2-selecting", function(e) {
    	console.log(e.val);
    })
    // END------INITIAL COLUMN SELECTION CRITERIA
	$.urlParam = function(name){
	    var results = new RegExp('[\?&]' + name + '=([^&#]*)').exec(window.location.href);
	    if (results==null){
	       return null;
	    }
	    else{
	       return results[1] || 0;
	    }
	}
	//START-----DISPLAY GUEST BOX OR INFO BOX
	if( $.urlParam('guestid') ){
		$('.actionitems').addClass('no-display');
		$('.guestactionitems').removeClass('no-display');
	}else{
		$('.actionitems').removeClass('no-display');
		$('.guestactionitems').addClass('no-display');
	}
    var locationid=$('#selectedLocationId').val();
	// END-----DISPLAY GUEST BOX OR INFO BOX
	var initModals = function() {
		$.fn.modalmanager.defaults.resize = true;
		$.fn.modal.defaults.spinner = $.fn.modalmanager.defaults.spinner = '<div class="loading-spinner" style="width: 200px; margin-left: -100px;">' + '<div class="progress progress-striped active">' + '<div class="progress-bar" style="width: 100%;"></div>' + '</div>' + '</div>';
		var $modal = $('#ajax-modal');
		$modal.on('click', '.update', function() {
			$modal.modal('loading');
			setTimeout(function() {
				$modal.modal('loading').find('.modal-body').prepend('<div class="alert alert-info fade in">' + 'Updated!<button type="button" class="close" data-dismiss="alert">&times;</button>' + '</div>');
			}, 1000);
		});
	};
	var format= function ( d ) {
	    // `d` is the original data object for the row
	    var array=d.bookingnotes.split(',');
	    var html='';
	    $.each(array, function( index, value ) {
	    	html=html+'<a class="btn btn-xs btn-green tooltips" data-original-title="Edit" style="margin-right:10px">'+value+'</a>'
	    });
	    return '<table cellpadding="10" cellspacing="10" border="0" class="table">'+
	        '<tr>'+
	            '<td><i class="fa fa-lg fa-envelope-o"></i></td>'+
	            '<td><b>'+d.guestemail.toUpperCase()+'</b></td>'+
				'<td><a data-toggle="modal" id="modal_ajax_demo_btn" data="'+d.guestemail+'" resa="'+d.id+'" class="sendmail btn btn-xs btn-blue"><i class="fa fa-lg fa-envelope-o"></i> Send MAIL</a></td>'+
	        '</tr>'+
	        '<tr>'+
	            '<td><i class="fa fa-lg fa-mobile-phone"></i></td>'+
	            '<td><b>'+d.guesttel+'<b></td>'+
				'<td><a data-toggle="modal" id="modal_ajax_demo_btn" data="'+d.guesttel+'" resa="'+d.id+'" class="sendtext btn btn-xs btn-blue"><i class="fa fa-lg fa-mobile-phone"></i> Send SMS</a></td>'+
	        '</tr>'+
	        '<tr>'+
	            '<td>Notes:</td>'+  '<td colspan="2">' + html + '</td>'+
	        '</tr>'+
	    '</table>';
	}
	var doTable = function () {
		var backdrop = $('.ajax-white-backdrop');
		backdrop.remove();
		var oTable=$("#reservationList");
		var url ="/data/reservation/get-list?locationid="+locationid+"&guestid="+guestid+"&calendar="+calendar+"&servingid="+servingid+"&cancelled="+cancelled;
		var editor = new $.fn.dataTable.Editor( {
			ajax: url,
			table: "#reservationList",
			fields: [ {
					name: "datereservation",
					type: "hidden"
				}, {
					label: "start:",
					name: "start",
					type: "readonly"
				}, {
					label: "extra:",
					name: null
				}, {
					label: "ID:",
					name: "id"
				}, {
					label: "guestname:",
					name: "guestname"
				}, {
					label: "partysize:",
					name: "partysize"
				}, {
					label: "BookingRef:",
					name: "bookingref",
					type: "hidden"
				}, {
					label: "BookingNotes:",
					name: "bookingnotes"
				}, {
					label: "Status:",
					name: "status",
					type:  "select",
					options: ['Telephone', 'Internet', 'Fullfilled', 'Cancelled']
				}, {
	                label:     "Arrived:",
	                name:      "arrived",
	                type:      "checkbox",
	                separator: "|",
	                options:   [
	                    { label: '', value: 1 }
	                ]
           		}, {
					label: "Guestid:",
					name: "guestid",
					type: "hidden"
				}, {
					name: "guestemail",
					type: "hidden"
				}, {
					name: "guesttel",
					type: "hidden"
				} ]
			} );
			// Edit record 
			oTable.on('click', 'a.editor_edit', function (e) {
				e.preventDefault();
				editor.edit( $(this).closest('tr'), {
					title: 'Edit record',
					buttons: 'Update'
				} );
			} );
		 
			// Delete a record
			oTable.on('click', 'a.editor_remove', function (e) {
				e.preventDefault();
				editor.remove( $(this).closest('tr'), {
					title: 'Delete record',
					message: 'Are you sure you wish to remove this record?',
					buttons: 'Delete'
				} );
			} );
		    oTable.on( 'switchChange.bootstrapSwitch', 'input.editor-active', function () {
		        editor.edit( $(this).closest('tr'), false ).set( 'arrived', $(this).bootstrapSwitch('state') ? 1 : 0 ).submit();
		        //if( $(this).bootstrapSwitch('state') ){ $('input.editor-active').prop('checked', true);}
		        console.log( 'input.editor-active'+$('input.editor-active').val() );
		        //toastr.success("reussi" + ' ' +"merci");
		    } );
			// Activate an inline edit on click of a oTable cell
			$('a.editor_create').on('click', function (e) {
				e.preventDefault();
				editor.create( {
					title: 'Create new record',
					buttons: 'Add'
				} );
			} );	 
			// Activate an inline edit on click of a table cell
			oTable.on( 'click', 'tbody td:not(:first-child)', function (e, data) {
				console.log(this);
				console.log( $(e.target).html() );
				console.log( $("table thead tr th").eq($(e.target).index()) );
				//editor.inline( this );
			} );
		    oTable.on( 'click', 'tbody td.details-control', function () {
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
				var $modal = $('#ajax-modal');
				$('#ajax-modal').data('book_id', 5);
				$('.sendmail').on('click', function(e) {
					// create the backdrop and wait for next modal to be triggered
					$('body').modalmanager('loading');
					//setTimeout(function() {
						$modal.load('/send-mail-message?guestemail='+$(e.target).attr('data')+'&resaid='+$(e.target).attr('resa'), '', function() {
							$modal.modal();
						});
					//}, 1000);
				});	        
				$('.sendtext').on('click', function(e) {
					// create the backdrop and wait for next modal to be triggered
					$('body').modalmanager('loading');
					setTimeout(function() {
						$modal.load('/send-text-message?guesttel='+$(e.target).attr('data'), '', function() {
							$modal.modal();
						});
					}, 1000);
				});	 
		    } );
		 	$(".search-select").on("select2-removed", function(e) {
		        var column = table.column( e.val );
		        column.visible( ! column.visible() );
		    })
			$(".search-select").on("select2-selecting", function(e) {
		        var column = table.column( e.val );
		        column.visible( ! column.visible() );
		    })
			table = oTable.DataTable( {
				fnCreatedRow: function( row, data, dataIndex ) {
					if ( data['status'] === 'Cancelled' ){
						console.log( row.id );
						console.log( data['status'] );
						var $row=$(row);
						$row.addClass('danger');
					}
				},
				dom: "Tfrtip",
				//dom: 'Rlfrtip',
				ajax: {
						"url":url,
						"data": function ( d ) {
						  return $.extend( {}, d );}
					  },
				columns: [
					{ data: null, defaultContent: '', orderable: false },
		            {
		                "className":      'details-control',
		                "orderable":      false,
		                "data":           null,
		                "defaultContent": ''
		            },
					{ 
						"data": "datereservation", 
						"visible": false
					},
					{ data: "start" },
					{ data: "id" },
					{ 
						"data": "guestname",
						"render": function (data, type, row){
							return data +' ('+ row.partysize +')';
							}
					},
					{ 
						"data": "partysize",
		                "createdCell": function ( td, cellData, rowData, row, col ) {
							if ( cellData > 3 ) {
					        	$(td).css('color', 'red');
					      	}
						}
					},
					{ 
						"data": "bookingref", 
						"visible": false 
					},
					{ 
						"data": "bookingnotes",
		                "render": function ( data, type, row ) {
		                	var array=data.split(',');
		                	var wheelchair ='';var baby ='';var allergy ='';
		                    if ( $.inArray('Chaise roulante', array) >=0 || $.inArray('Wheelchair', array) >=0  ) {
		                        var wheelchair='<a class="btn btn-xs btn-dark-orange tooltips"><i class="fa fa-wheelchair"></i></a> ';
		                    } 
		                    if ( $.inArray('Baby on board', array) >=0 ){
		                    	var baby='<a class="btn btn-xs btn-dark-orange tooltips"><i class="fa fa-female"></i></a> ';
		                    } 
		                    if ( $.inArray('Nut allergy', array) >=0 || $.inArray('allergie', array) >=0 ){
		                    	var allergy='<a class="btn btn-xs btn-dark-orange tooltips"><i class="fa fa-medkit"></i></a> ';
		                    } 
		                    return wheelchair + baby + allergy;
		                	},
		                "className": "dt-body-center"	
					},
					{ 
						"data": "status",
						"className": "cancelstatus"
					},
					{
		                "data":   "arrived",
		                "render": function ( data, type, row ) {
		                	if( row.status !="Cancelled" ){
								$("input[type='checkbox'].make-switch").bootstrapSwitch();
								if( data == 1 ){
			                    	return '<input type="checkbox" class="checkbox-inline checkbox editor-active make-switch" checked>';
								}else{
									return '<input type="checkbox" class="checkbox-inline checkbox editor-active make-switch">';
								}
		                	}else{
		                		return '';
		                	}
		                },
		                "className": "dt-body-center"
					},
					{ 
						data: "guestid", 
						"visible": false 
					},
					{
						"class": "center",
						"data": null,
						"orderable": false,
						"render": function ( row  ) {
							return '<a href="/reserver?reservationid='+row.id+'" class="btn btn-xs btn-green tooltips" data-original-title="Edit"><i class="fa fa-edit"></i></a>';
						}
					},
					{ 
						"class": "center",
						"data": null,
						"orderable": false,
						"render": function ( ) {
							return '<a href="" class="btn btn-xs btn-red tooltips editor_remove" data-original-title="Remove"><i class="fa fa-times fa fa-white"></i></a>';
						}
					},
					{ 
						"data": "guestemail", 
						"visible": false
					},
					{ 
						"data": "guesttel", 
						"visible": false
					}
					],
				order: [ 1, 'asc' ],
				aaSorting  : [[1, 'asc']],
				aLengthMenu  : [[5, 10, 15, 20, -1], [5, 10, 15, 20, "All"]],
				iDisplayLength : 10,
				initComplete: function(settings, json) {
    				console.log( 'DataTables has finished its initialisation.' );
    				//$('.checkbox').iCheck({checkboxClass: 'icheckbox_square-grey'});
  				},
				tableTools: {
					sRowSelect: "os",
					sRowSelector: 'td:first-child',
					aButtons: [
					  //  { sExtends: "editor_create", editor: editor }
					]
				},
				rowCallback: function ( row, data ) {
		        	var $row=$(row);
		            if( data.arrived == '1'){
						$row.addClass('success');
		            }else{
		            	$row.removeClass('success');
		            }
		        }

			} );
	};
    $('#checkcancelled').on('switchChange.bootstrapSwitch', function() {
    	$("#reservationList").dataTable().fnDraw();
    	return false;
    });
    $('#checkarrived').on('switchChange.bootstrapSwitch', function() {
    	$("#reservationList").dataTable().fnDraw();
    	return false;
    });
	$.fn.dataTableExt.afnFiltering.push(
   		function( oSettings, aData, iDataIndex ) {
			var nTr = oSettings.aoData[ iDataIndex ].nTr;
			console.log( 'checkarrived', $('#checkarrived').is(":checked") );
			console.log( 'arrived', aData[10] );
			console.log( 'checkcancelled', $('#checkcancelled').is(":checked") );
			console.log( 'cancelled', aData[9] );
			if( aData[10]=='<input type="checkbox" class="checkbox-inline checkbox editor-active make-switch" checked>' ){
				if( $('#checkarrived').is(":checked") ){
					return false;
				}else{
					return true;
				}
			} else {
				if( aData[9]=='Cancelled' ){
					if( $('#checkcancelled').is(":checked") ){
						return false;
					}else{
						return true;
					}					
				}{
					return true;
				}
			}
   		}
	);
    return {
        //main function to initiate template pages
        init: function () {
			doTable();
			initModals();
			runInputLimiter();
        }
    };
}();
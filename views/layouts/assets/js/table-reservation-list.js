var TableReservationList = function () {
	"use strict";
	var guestid='test'; 
	var locationid;
	var editor;
	var calendar=$('#calendar').val();
	var servingid=$('#servingid').val();
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
	$.urlParam = function(name){
	    var results = new RegExp('[\?&]' + name + '=([^&#]*)').exec(window.location.href);
	    if (results==null){
	       return null;
	    }
	    else{
	       return results[1] || 0;
	    }
	}
	if( $.urlParam('selectedLocationId') ){
		locationid=$.urlParam('selectedLocationId');
	}else{
		locationid=$('#defaultlocationid').val();
	}
	var initModals = function() {
		$.fn.modalmanager.defaults.resize = true;
		$.fn.modal.defaults.spinner = $.fn.modalmanager.defaults.spinner = '<div class="loading-spinner" style="width: 200px; margin-left: -100px;">' + '<div class="progress progress-striped active">' + '<div class="progress-bar" style="width: 100%;"></div>' + '</div>' + '</div>';
		var $modal = $('#ajax-modal');
//		$('.demo').on('click', function() {
//			// create the backdrop and wait for next modal to be triggered
//			$('body').modalmanager('loading');
//			setTimeout(function() {
//				$modal.load('/send-mail-message', '', function() {
//					$modal.modal();
//				});
//			}, 1000);
//		});
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
				'<td><a data-toggle="modal" id="modal_ajax_demo_btn" data="'+d.guestemail+'" class="sendmail btn btn-xs btn-blue"><i class="fa fa-lg fa-envelope-o"></i> Send MAIL</a></td>'+
	        '</tr>'+
	        '<tr>'+
	            '<td><i class="fa fa-lg fa-mobile-phone"></i></td>'+
	            '<td><b>'+d.guesttel+'<b></td>'+
				'<td><a data-toggle="modal" id="modal_ajax_demo_btn" data="'+d.guesttel+'" class="sendtext btn btn-xs btn-blue"><i class="fa fa-lg fa-mobile-phone"></i> Send SMS</a></td>'+
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
		var url ="/data/reservation/get-list?locationid="+locationid+"&guestid="+guestid+"&calendar="+calendar+"&servingid="+servingid;
		var editor = new $.fn.dataTable.Editor( {
				ajax: url,
				table: "#reservationList",
				fields: [ {
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
					}
				]
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
//			oTable.on( 'dblclick', 'tbody tr', function () {
//			  console.log( $(this).attr('id') );
//				$('body').modalmanager('loading');
//				setTimeout(function() {
//					var $modal = $('#ajax-modal');
//					$modal.load('/send-mail-message', '', function() {
//						$modal.modal();
//					});
//				}, 1000);			  
//			} );
		    oTable.on( 'change', 'input.editor-active', function () {
		        editor
		            .edit( $(this).closest('tr'), false )
		            .set( 'arrived', $(this).prop( 'checked' ) ? 1 : 0 )
		            .submit();
		        toastr.success("reussi" + ' ' +"merci");
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
					setTimeout(function() {
						$modal.load('/send-mail-message?guestemail='+$(e.target).attr('data'), '', function() {
							$modal.modal();
						});
					}, 1000);
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
			var table = oTable.DataTable( {
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
					{ data: "status" },
					{
		                "data":   "arrived",
		                "render": function ( data, type, row ) {
							//$("input[type='checkbox'].make-switch").bootstrapSwitch();
		                    if ( type === 'display' ) {
		                        //return '<label class="checkbox-inline"><input type="checkbox" class="checkbox editor-active make-switch"></label>';
		                        return '<input type="checkbox" class="checkbox editor-active make-switch">';
		                    }
		                    return data;
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
		            // Set the checked state of the checkbox in the table
		            $('input.editor-active', row).prop( 'checked', data.arrived == 1 );
		        }
			} );
	};
    return {
        //main function to initiate template pages
        init: function () {
			doTable();
			initModals();
			runInputLimiter();
        }
    };
}();
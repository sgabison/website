var InitiateReservationList = function () {
	"use strict";
	//function to initiate bootstrap-datepicker
	var runDatePicker = function() {
		$('.date-picker').datepicker({
			autoclose: true
		});
	};
	var editor; // use a global for the submit and return data rendering in the examples
	 
	    editor = new $.fn.dataTable.Editor( {
	        ajax: "/data/advanceddid/reservation-list",
	        table: "#example",
	        fields: [ {
	                label: "start:",
	                name: "start",
	                type: "readonly"
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
	                name: "bookingref"
	            }, {
	                label: "BookingNotes:",
	                name: "bookingnotes"
	            }, {
	                label: "Status:",
	                name: "status",
	                type:  "select",
	                options: ['Telephone', 'Internet', 'Fullfilled', 'Cancelled']
	            }, {
	                label: "Guestid:",
	                name: "guestid",
	                type: "readonly"
	            }
	        ]
	    } );
	    // Edit record
	    $('#example').on('click', 'a.editor_edit', function (e) {
	        e.preventDefault();
	        editor.edit( $(this).closest('tr'), {
	            title: 'Edit record',
	            buttons: 'Update'
	        } );
	    } );
	 
	    // Delete a record
	    $('#example').on('click', 'a.editor_remove', function (e) {
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
	    // Activate an inline edit on click of a table cell
	    $('#example').on( 'click', 'tbody td:not(:first-child)', function (e) {
	        editor.inline( this );
	    } );
	    $('#example').DataTable( {
	        dom: "Tfrtip",
	        ajax: "/data/advanceddid/reservation-list",
	        columns: [
	            { data: null, defaultContent: '', orderable: false },
	            { data: "start" },
	            { data: "id" },
	            { data: "guestname" },
	            { data: "partysize" },
	            { data: "bookingref" },
	            { data: "bookingnotes" },
	           	{ data: "status" },
	           	{ data: "guestid" },
	           	{
				"class": "center",
				"data": "id",
				"orderable": false,
			    "render": function ( data, type, full, meta ) {
			      	return '<a href="reservation?reservationid='+data+'" class="btn btn-xs btn-green tooltips" data-original-title="Edit"><i class="fa fa-edit"></i></a>';
			    	}
	           	},
		        { data: null, defaultContent: '<!--<a href="" class="btn btn-xs btn-green tooltips editor_edit"data-original-title="Edit"><i class="fa fa-edit"></i></a> / --><a href="" class="btn btn-xs btn-red tooltips editor_remove" data-original-title="Remove"><i class="fa fa-times fa fa-white"></i></a>'}
	        ],
	        order: [ 1, 'asc' ],
	        tableTools: {
	            sRowSelect: "os",
	            sRowSelector: 'td:first-child',
	            aButtons: [
	              //  { sExtends: "editor_create", editor: editor }
	            ]
	        }
	    } );
    return {
        //main function to initiate template pages
        init: function () {
			runDatePicker();
			PagesReservationList.init();
        }
    };
}();
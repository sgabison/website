var GuestList = function () {
	"use strict";
	var doTable = function () {
			var oTable=$("#guestList");
			var url ="/data/guest/get-guest-list";
			var q = $.urlParam('q');
			var editor = new $.fn.dataTable.Editor( {
					ajax: url,
					table: "#guestList",
					fields: [ {
							label: "ID:",
							name: "o_id",
							type: "readonly"
						},{
							label: "lastname:",
							name: "lastname"
						},{
							label: "tel:",
							name: "tel"
						}, {
							label: "Email:",
							name: "email"
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
				// Activate an inline edit on click of a oTable cell
				$('a.editor_create').on('click', function (e) {
					e.preventDefault();
					editor.create( {
						title: 'Create new record',
						buttons: 'Add'
					} );
				} );	 
				// Activate an inline edit on click of a table cell
//				oTable.on( 'click', 'tbody td:not(:first-child)', function (e) {
//					editor.inline( this );
//				} );
				var table= oTable.DataTable( {
					
			    buttons: [
		           {
					 extend : 'print',
					 exportOptions : {
		        	   		columns : [ 1, 2, 3, 4 ]
						},
						className:'btn-white',
						text:'<i class="fa fa-print"></i>'
		           },
		           {
						 extend : 'copyHtml5',
						 exportOptions : {
			        	   		columns : [ 1, 2, 3, 4 ]
							},
							className:'btn-white',
							text:'<i class="fa fa-copy"></i>'
			           },
			           {
							 extend : 'excel',
							 exportOptions : {
				        	   		columns : [0, 1, 2, 3, 4 ]
								},
								className:'btn-white',
								text:'<i class="fa fa-edit"></i>'
					    }
		        ],
			 
					ajax: {
							"url":url,
							"data": function ( d ) {
							  return $.extend( {}, d, {
								"q": q
							  } );}
						  },
					columns: [
						{ data: null, defaultContent: '', orderable: false },
						{ data: "o_id" },
						{ data: "lastname" },
						{ data: "tel" },
						{ data: "email" },
						{
						"class": "center",
						"data": "o_id",
						"orderable": false,
						"render": function ( data, type, full, meta ) {
							return '<a href="/guest.html?guestid='+data+'" class="btn btn-blue tooltips" data-original-title="Edit"><i class="fa fa-edit"></i></a>';
							//return '<a class="btn btn-blue tooltips" data-original-title="Edit"><i class="fa fa-edit"></i></a>';
							}
						},
						{
						"class": "center",
						"data": "o_id",
						"orderable": false,
						"render": function ( data, type, full, meta ) {
							return '<a href="/data/reservation/listreservation?calendar=01-10-2015&guestid='+data+'" class="btn btn-blue tooltips" data-original-title="Modify"><i class="fa fa-share"></i></a>';
							}
						}
					],
					order: [ 2, 'asc' ],
					aaSorting  : [[1, 'desc'],[2, 'asc']],
					aLengthMenu  : [[5, 10, 15, 20, -1], [5, 10, 15, 20, "All"]],
					iDisplayLength : 10,

					tableTools: {
						sRowSelect: "os",
						sRowSelector: 'td:first-child',
						aButtons: [
						  //  { sExtends: "editor_create", editor: editor }
						]
					}
				} );
				table.buttons().container()
			    .appendTo( $('.print-table:eq(0)') );

	};
    return {
        //main function to initiate template pages
        init: function () {
			doTable();
        }
    };
}();
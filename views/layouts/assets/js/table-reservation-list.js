var TableReservationList = function () {
	"use strict";
	var table;
	var locationid;
	var editor;
	var calendar=$('#calendar').val();
	var servingid=$('#servingid').val();
	var guestid=$('#guestid').val(); 
	var cancelled=$('#cancelled').val(); 
	var compareSalle=function(a,b) {
	  if (a.salle < b.salle)
	    return -1;
	  if (a.salle > b.salle)
	    return 1;
	  return 0;
	}
	var runInputLimiter = function() {
		$('.limited').inputlimiter({
			remText: 'You only have %n character%s remaining...',
			remFullText: 'Stop typing! You\'re not allowed any more characters!',
			limitText: 'You\'re allowed to input %n character%s into this field.'
		});
	};
    if ($(".tooltips").length) {
        $('.tooltips').tooltip();
    }
    var pickerTime = function(){
		$('#arrivaltime').timepicker({showMeridian: false});
    }
    var addTagsInput = function( div ){
		div.tagsInput({
			width: 'auto',
			onRemoveTag: function(value){ console.log('removetag: ',value);$('button[id="'+value+'"]').removeClass('btn-light-orange'); $('button[id="'+value+'"]').addClass('btn-dark-orange'); $('button[id="'+value+'"]').attr("disabled", false); },
			onAddTag: function(value){ console.log('addtag: ',value)}
		});
    }
    var manageTables = function( variable ){
    	$('#tagpanel').prepend( "<div class='tags_1'></div>" );
    	addTagsInput( $('.tags_1') )
    	$('#partyiszefortable').html( variable );
		$('.tableallocation').on('hidden.bs.modal', function () {
			//alert( 'close modal' );
			//$("#tags_1").destroyTagsInput();
			$('#tagpanel').html('');
		});
    	$('.tableallocationclass').click( function(){
    		$(this).attr('disabled', true);
    		$(this).removeClass('btn-dark-orange');
    		$(this).addClass('btn-light-orange');
    		$('.tags_1').addTag( $(this).attr("value") );
    	});
    }
	var loadFullCalendar = function(){
		$("#myfullcalendar").fullCalendar({
			lang: language,
			height: 400,
			weekends: true,
			selectable: true,
	        selectHelper: false,
	        defaultDate: moment( $('#calendar').val(), 'DD-MM-YYYY' ),
	        dayClick: function(date, jsEvent, view) {
		        console.log('works');
	        },
	        dayRender: function (date, cell) {
	        	console.log( date.day() );
			   //cell.removeClass("fc-state-highlight");
			   //cell.removeClass("fc-today");
		       //cell.css("background-color", "#DDDDDD");
		       //cell.css("cursor", "not-allowed");
		       //cell.prop('data-toggle', 'tooltip');
		    },
	        select: function(start, end, allDay) {
	        	console.log( start.format("DD-MM-YYYY") );
	        	$('.bs-example-modal-basic').modal('toggle');
	        	window.location.href = "/liste-reservations?servingid="+$('#servingid').val()+"&calendar="+start.format("DD-MM-YYYY");
	        }
		});
	}
	var runTouchSpin = function() {
		$("#nrofpeople").TouchSpin({
			min: 0,
			max: 100,
			step: 1,
			decimals: 0,
			boostat: 5,
			maxboostedstep: 10,
			postfix: 'people'
		});
	}
	$('.bs-example-modal-basic').on('shown.bs.modal', function () {
	   $("#myfullcalendar").fullCalendar('render');
	});    
	//START---CONFIG PANEL----//
	$('.config').click( function(){
		$('.configpanel').removeClass('no-display');
	});
	$('.close-configpanel').click( function(){
		$('.configpanel').addClass('no-display');
	});
	//END---CONFIG PANEL----//
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
			}, 200);
		});
	};
	var format= function ( d ) {
	    // `d` is the original data object for the row
	    var array=d.bookingnotes.split(',');
	    var html='';
	    $.each(array, function( index, value ) {
	    	html=html+'<a class="btn btn-blue tooltips" data-original-title="Edit" style="margin-right:10px">'+value+'</a>'
	    });
	    var emailaddon='';
	    var smsaddon='';
	    if( d.guesttel ){
	    	//smsaddon='<td><i class="fa fa-lg fa-mobile-phone"></i></td>'+'<td><a data-toggle="modal" id="modal_ajax_demo_btn" data="'+d.guesttel+'" resa="'+d.id+'" class="sendtext btn btn-blue tooltips" data-rel="tooltip" data-original-title=" '+d.guesttel+' "><i class="fa fa-lg fa-mobile-phone"></i> '+t('send_sms')+'</a></td>';
	    	smsaddon='<td><i class="fa fa-lg fa-mobile-phone"></i></td>'+'<td><span class="btn btn-blue tooltips" data-rel="tooltip" data-original-title=" '+d.guesttel+' "><i class="fa fa-lg fa-mobile-phone"></i> '+d.guesttel+'</a></td>';
	    }else{
	    	smsaddon='<td><i class="fa fa-lg fa-mobile-phone"></i>'+'<td><span class="btn btn-blue tooltips"><i class="fa fa-lg fa-mobile-phone"></i> '+t('no_tel_recorded')+'</a></span></td>';
	    }
	    if( d.guestemail ){ 
	    	emailaddon='<td><i class="fa fa-lg fa-envelope-o"></i></td>'+'<td><a data-toggle="modal" id="modal_ajax_demo_btn" data="'+d.guestemail+'" resa="'+d.id+'" class="sendmail btn btn-blue tooltips" data-rel="tooltip" data-original-title=" '+d.guestemail.toUpperCase()+' "><i class="fa fa-lg fa-envelope-o"></i> '+t('send_mail')+'</a></td>';
	    }else{
	    	emailaddon='<td><i class="fa fa-lg fa-envelope-o"></i>'+'<td><span class="btn btn-blue tooltips"><i class="fa fa-lg fa-envelope-o"></i> '+t('no_email_recorded')+'</a></span></td>';
	    }
	    return '<div class="row">'+
	    	'<div class="col-md-6">'+
			    '<div class="panel panel-white">'+
					'<div class="panel-heading">'+
						'<h4 class="panel-title">'+t('js_comm_panel')+'</h4>'+
					'</div>'+
					'<div class="panel-body">'+
					    '<table cellpadding="10" cellspacing="10" border="0" class="table">'+
					        '<tr>'+
					        emailaddon +
					        '</tr>'+
					        '<tr>'+
					        smsaddon +
					        '</tr>'+
					    '</table>'+
					'</div>'+
				'</div>'+
			'</div>'+
	    	'<div class="col-md-6">'+
			    '<div class="panel panel-white">'+
					'<div class="panel-heading">'+
						'<h4 class="panel-title">'+t('js_extra_panel')+'</h4>'+
					'</div>'+
					'<div class="panel-body">'+
					    '<table cellpadding="10" cellspacing="10" border="0" class="table">'+
					        '<tr>'+
					            '<td>'+t('location')+'</td>'+  '<td colspan="2"><b>'+d.locationname+'</b></td>'+
					        '</tr>'+
					        '<tr>'+
					            '<td>'+t('js_serving')+'</td>'+  '<td colspan="2"><b>'+d.servingtitle+'</b></td>'+
					        '</tr>'+
					        '<tr>'+
					            '<td>Notes:</td>'+  '<td colspan="2">'+d.bookingnotes+'</td>'+
					        '</tr>'+
					    '</table>'+
					'</div>'+
				'</div>'+
			'</div>'+
		'</div>'
	    ;
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
					label: "Table:",
					name: "table"
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
					options: ['Telephone', 'Internet', 'Arrivé', 'Annulé']
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
				}, {
					name: "servingtitle",
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
					message: t('Are you sure you wish to remove this record?'),
					buttons: 'Delete'
				} );
			} );
		    oTable.on( 'switchChange.bootstrapSwitch', 'input.editor-active', function () {
		        editor.edit( $(this).closest('tr'), false ).set( 'arrived', $(this).bootstrapSwitch('state') ? 1 : 0 ).submit();
		        // if( $(this).bootstrapSwitch('state') ){ $('input.editor-active').prop('checked', true);}
		        console.log( 'input.editor-active'+$('input.editor-active').val() );
		        // toastr.success("reussi" + ' ' +"merci");
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
			    var that=this;
			    var $res = $( "#tables" );
			    var tr = $(this).closest('tr');
			    var row = table.row( tr );
			    var classresult;
			    $res.html('');
			    $.ajax({
				  	url: "/data/table/table-list?action=resatable&reservationid="+row.data().id,
					dataType: 'json',
					type:'POST', //obligatoire
					contentType: "application/json; charset=utf-8",
					success: function(json) {
						if (json.success || json.success == 'true') {
							console.log( json.data );
							json.data.sort(compareSalle);
							console.log('length: ', json.data.length);
							var i=0;
							var j=1;
							var k;
							var nexttab=''; var nextcontent=''; var initialvalue=''; var initialbutton=''; var button='';
							$.each(json.data, function (key, value) {
								console.log( 'value', value );
								console.log( key, value.salle, value.table, value.id, value.reservationid );
								if( value.reservationid == row.data().id){
									classresult="btn-green";
								}else{
									if( value.booked == "yes" ){ classresult="disabled";} else { classresult="btn-dark-orange";}
								}
								if(key==0){k=0;}else{k=key-1;}
								if( (json.data[k].salle !== value.salle) || key==(json.data.length-1) ){
									if( json.data[key-1].salle  == json.data[0].salle ){
										nexttab=
										'<li class="active">'+
											'<a href="#myTab_example'+j+'" data-toggle="tab">'+
												'<i class="green fa fa-home"></i> Salle '+json.data[k].salle+
											'</a>'+
										'</li>';
										nextcontent=
										'<div class="tab-pane fade in active" id="myTab_example'+j+'">'+
											button+
										'</div>';
										j++;
										button='<button name="tableid" id="'+value.id+'" type="button" class="btn btn-lg '+classresult+' tableallocationclass" order="'+value.reservationid+'" value="'+value.salle+'-'+value.table+'" style="margin:5px">'+value.salle+'-'+value.table+'</button>';
									}else if(key==(json.data.length-1)){
										nexttab=nexttab+
										'<li>'+
											'<a href="#myTab_example'+j+'" data-toggle="tab">'+
												'<i class="green fa fa-home"></i> Salle '+value.salle+
											'</a>'+
										'</li>';
										nextcontent=nextcontent+
										'<div class="tab-pane fade" id="myTab_example'+j+'">'+
											button+'<button name="tableid" id="'+value.id+'" type="button" class="btn btn-lg '+classresult+' tableallocationclass" order="'+value.reservationid+'" value="'+value.salle+'-'+value.table+'" style="margin:5px">'+value.salle+'-'+value.table+'</button>'+
										'</div>';
										j++;
									}else{
										nexttab=nexttab+
										'<li>'+
											'<a href="#myTab_example'+j+'" data-toggle="tab">'+
												'<i class="green fa fa-home"></i> Salle '+json.data[k].salle+
											'</a>'+
										'</li>';
										nextcontent=nextcontent+
										'<div class="tab-pane fade" id="myTab_example'+j+'">'+
											button+
										'</div>';
										j++;
										button='<button name="tableid" id="'+value.id+'" type="button" class="btn btn-lg '+classresult+' tableallocationclass" order="'+value.reservationid+'" value="'+value.salle+'-'+value.table+'" style="margin:5px">'+value.salle+'-'+value.table+'</button>';
									}
								}else{
									button=button+"<button name=\"tableid\" id=\""+value.id+"\" type=\"button\" class=\"btn btn-lg "+classresult+" tableallocationclass\" order=\""+value.reservationid+"\" value=\""+value.salle+"-"+value.table+"\" style=\"margin:5px\">"+value.salle+"-"+value.table+"</button>";
								}
							});
							var initialsetup = '<div class="tabbable">'+
								'<ul id="myTab" class="nav nav-tabs">'+
									nexttab+
								'</ul>'+
								'<div class="tab-content">'+
										nextcontent+
								'</div>'+
							'</div>';
							$res.append( initialsetup );
						}
						console.log( "partysize", row.data().partysize);
						manageTables(row.data().partysize);
					},
					error: function (request, status, error) {
						//alert(error);
						//alert(JSON.stringify(request));
						console.log( error );
					}
				});
				$('#allocatenewtable').on('click', function(e){
					e.preventDefault();
					editor.edit( $(that).closest('tr'), false ).set( 'table', $.map($('.tag span'),function(e,i){return $(e).text().trim();}) ).submit();
					//alert( $("#tags_1").destroyTagsInput() );
					//editor.edit( $(that).closest('tr'), false ).set( 'table', $("#tags_1").destroyTagsInput() ).submit();
					$('.tableallocation').modal('toggle');
					toastr.success(t('js_allocatetable'));
					$('#allocatenewtable').off('click');
				});
			} );
			oTable.on( 'click', 'tbody td.partysize', function(){
				var that=this;
				console.log( $(this).children('a').children('span').text() );
				$('#nrofpeople').val( $(this).children('a').children('span').text() );
				$('#changenrpeople').on('click', function(){
					editor.edit( $(that).closest('tr'), false ).set( 'partysize', $('#nrofpeople').val() ).submit();
					$('.nr-of-people').modal('toggle');
					toastr.success(t('js_partysize'));
					$('#changenrpeople').off('click');
				});
			} );
			oTable.on( 'click', 'tbody td.starttime', function(){
				var that=this;
				console.log( $(this).children('a').children('span').text() );
				$('#arrivaltime').val( $(this).children('a').children('span').text() );
				$('#changearrivaltime').on('click', function(){
					editor.edit( $(that).closest('tr'), false ).set( 'start', $('#arrivaltime').val() ).submit();
					$('.arrivaltime').modal('toggle');
					toastr.success(t('js_arrivaltime'));
					$('#changearrivaltime').off('click');	
				});
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
		  			$('.tooltips').tooltip();
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
						$modal.load('/send-text-message?guesttel='+$(e.target).attr('data')+'&resaid='+$(e.target).attr('resa'), '', function() {
							$modal.modal();
						});
					}, 1000);
				});	 
		    } );
		    $("#datedisplay").click( function(e) {
		        var column = table.column( '4' );
		        column.visible( ! column.visible() );
		        var col = table.column( '7' );
		        col.visible( ! col.visible() );
		    });
		    $("#locationdisplay").click( function(e) {
		        var column = table.column( '3' );
		        column.visible( ! column.visible() );
		        var col = table.column( '10' );
		        col.visible( ! col.visible() );
		    });
		 	$(".search-select").on("select2-removed", function(e) {
		        var column = table.column( e.val );
		        column.visible( ! column.visible() );
		    })
		    $.fn.bootstrapSwitch.defaults.onColor = 'success';
		    $.fn.bootstrapSwitch.defaults.offColor = 'warning';
			$(".search-select").on("select2-selecting", function(e) {
		        var column = table.column( e.val );
		        column.visible( ! column.visible() );
		    })
			table = oTable.DataTable( {
				fnCreatedRow: function( row, data, dataIndex ) {
					if ( data['status'] === 'Cancelled' || data['status'] === 'Annulé' ){
						console.log( row.id );
						console.log( data['status'] );
						var $row=$(row);
						$row.addClass('danger');
					}
				},
				dom: "BTfrtip",
				//dom: 'Tfrtip',
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
		                "defaultContent": '',
		                "render": function ( data, type, row ) {
		                	return "<a class='btn btn-default'><i class='fa fa-plus-square'> </i></a>"
		                }
		            },
					{ 
						"data": "locationid", 
						"visible": false 
					},
					{ 
						"data": "locationname", 
						"visible": false,
						"orderable":true,
						"render": function (data, type, row){
							return '<h4><strong>'+data+'</strong></h4>';
						} 
					},
					{ 
						"data": "datereservation", 
						"visible": false,
						"orderable":true,
						"render": function (data, type, row){
							return '<h4><strong>'+data+'</strong></h4>';
						} 
					},
					{ 
						"data": "start",
						"className": 'starttime',
					    "name" : "printable",
					    "orderable":true,
						"render": function ( data, type, row ) {
							return '<a class="btn btn-blue" data-target=".arrivaltime" data-toggle="modal" rowid="'+row.id+'"><i class="fa fa-clock-o"></i> <span class="starttime">'+data+'<span></a>';
						}
					},
					{ 	
						"data": "id",
						"name" : "no-printable",
						"visible": false,
						"render": function (data, type, row){
							return '<h4><strong>'+data+'</strong></h4>';
						} 
					},
					{ 
						"data": "guestname",
						'name':"printable",
						"render": function (data, type, row){
							return '<h4><strong>'+data+'</strong></h4>';
						}
					},
					{ 
						"data": "partysize",
						"className": 'partysize',
						'name':"printable",
						"render": function (data, type, row){
							return '<a class="btn btn-blue nrpeople" data-target=".nr-of-people" data-toggle="modal"><i class="fa fa-group"></i> <span class="people">'+data+'<span></a>';
						}
					},
					{ 
						"data": "table", 
						'name':"printable",
						"render": function (data, type, row){
							if( data ){
								return '<a class="btn btn-blue" data-target=".tableallocation" data-toggle="modal" id="tableallocation"><i class="fa fa-table"></i><span class="tablealloc"> '+data+'<span></a>';
							}else{
								return '<a class="btn btn-blue" data-target=".tableallocation" data-toggle="modal" id="tableallocation"><i class="fa fa-table"></i><span class="tablealloc"> No table<span></a>';								
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
		                	var wheelchair ='';var baby ='';var allergy ='';var party ='';var bug ='';var group ='';var warning ='';var addedcomment='';
		                    if ( $.inArray('Chaise roulante', array) >=0 || $.inArray('Wheelchair', array) >=0  ) {
		                        var wheelchair='<a class="btn btn-dark-orange tooltips" data-rel="tooltip" data-original-title="'+t('js_wheelchair')+'"><i class="fa fa-wheelchair"></i></a> ';
			                    array = $.grep(array, function(value) {
									  return value != 'Chaise roulante'
								});
			                    array = $.grep(array, function(value) {
									  return value != 'Wheelchair'
								});
		                    } 
		                    if ( $.inArray('Baby on board', array) >=0 || $.inArray('Bébé à bord', array) >=0  ){
		                    	var baby='<a class="btn btn-dark-orange tooltips" data-rel="tooltip" data-original-title="'+t('js_baby')+'"><i class="fa fa-female"></i></a> ';
			                    array = $.grep(array, function(value) {
									  return value != 'Baby on board'
								});
			                    array = $.grep(array, function(value) {
									  return value != 'Bébé à bord'
								});
		                    } 
		                    if ( $.inArray('Allergies', array) >=0 || $.inArray('Allergies', array) >=0 || $.inArray('Nut Allergy', array) >=0 || $.inArray('Allergie aux noix', array) >=0 ){
		                    	var allergy='<a class="btn btn-dark-orange tooltips" data-rel="tooltip" data-original-title="'+t('js_allergy')+'"><i class="fa fa-medkit"></i></a> ';
			                    array = $.grep(array, function(value) {
									  return value != 'Allergies'
								});
			                    array = $.grep(array, function(value) {
									  return value != 'Nut Allergy'
								});
			                    array = $.grep(array, function(value) {
									  return value != 'Allergie aux noix'
								});
		                    } 
		                    if ( $.inArray('client pénible', array) >=0 || $.inArray('picky customer', array) >=0 ){
		                    	var bug='<a class="btn btn-dark-orange tooltips" data-rel="tooltip" data-original-title="'+t('js_picky')+'"><i class="fa fa-bug"></i></a> ';
			                    array = $.grep(array, function(value) {
									  return value != 'client pénible'
								});
			                    array = $.grep(array, function(value) {
									  return value != 'picky customer'
								});
		                    } 
		                    if ( $.inArray('Célébration', array) >=0 || $.inArray('Party', array) >=0 ){
		                    	var party='<a class="btn btn-dark-orange tooltips" data-rel="tooltip" data-original-title="'+t('js_party')+'"><i class="fa fa-gift"></i></a> ';
			                    array = $.grep(array, function(value) {
									  return value != 'Célébration'
								});
			                    array = $.grep(array, function(value) {
									  return value != 'Party'
								});
		                    } 
		                    if ( $.inArray('Groupe entreprise', array) >=0 || $.inArray('Company party', array) >=0 ){
		                    	var group='<a class="btn btn-dark-orange tooltips" data-rel="tooltip" data-original-title="'+t('js_group')+'"><i class="fa fa-group"></i></a> ';
			                    array = $.grep(array, function(value) {
									  return value != 'Groupe entreprise'
								});
			                    array = $.grep(array, function(value) {
									  return value != 'Company party'
								});
		                    } 
		                    if ( $.inArray('Special Table', array) >=0 || $.inArray('Spéciale table', array) >=0  || $.inArray('Table particulière', array) >=0  || $.inArray('Table spéciale', array) >=0 ){
		                    	var warning='<a class="btn btn-dark-orange tooltips" data-rel="tooltip" data-original-title="'+t('js_specialtable')+'"><i class="fa fa-warning"></i></a> ';
			                    array = $.grep(array, function(value) {
									  return value != 'Special Table'
								});
			                    array = $.grep(array, function(value) {
									  return value != 'Spéciale table'
								});
			                    array = $.grep(array, function(value) {
									  return value != 'Table particulière'
								});
			                    array = $.grep(array, function(value) {
									  return value != 'Table spéciale'
								});
		                    } 
		                    if ( array.length > 0 && array[0] != ''){
		                    	console.log( 'array', array );
		                    	console.log( 'array[0]', array[0] );
		                    	var addedcomment='<a class="btn btn-light-orange tooltips" data-rel="tooltip" data-original-title="'+array.toString()+'"><i class="fa fa-info"></i></a> ';

		                    }
		                    return wheelchair + baby + allergy + party + bug + group + warning + addedcomment;
		                	},
		                "className": "dt-body-center hidden-xs hidden-sm"	
					},
					{ 
						"data": "status",
						"className": "cancelstatus"
					},
					{
		                "data":   "arrived",
		                "render": function ( data, type, row ) {
		                	if( row.status !="Cancelled" && row.status !="Annulé" ){
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
							return '<a href="/reserver?reservationid='+row.id+'" class="btn btn-blue tooltips" data-original-title="Edit"><i class="fa fa-edit"></i></a>';
						}
					},
					{ 
						"class": "center",
						"data": null,
						"orderable": false,
						"render": function ( ) {
							return '<a href="" class="btn btn-red tooltips editor_remove" data-original-title="Remove"><i class="fa fa-times fa fa-white"></i></a>';
						}
					},
					{ 
						"data": "guestemail", 
						"visible": false,
						"name" : "no-printable"
					},
					{ 
						"data": "guesttel", 
						"name" : "printable",
						"visible": false
					},
					{ 
						"data": "servingtitle", 
						"name" : "printable",
						"visible": false
					},
					{ 
					"data": "bookingnotes",
					"visible":false,
					"name" : "printable",
	                "render": function ( data, type, row ) {	
	                    return data;
	                	}
	                },
					{ 
					"data": "arrived",
					"visible":false
					}
					],
					    buttons: [
				           {
							 extend : 'print',
							 exportOptions : {
				        	   		columns: ['printable:name'] 
								},
								className:'btn-white',
								text:'<i class="fa fa-print"></i>',
								fnCellRender: function ( sValue, iColumn, nTr, iDataIndex ) {
			                        // Append the text 'TableTools' to column 5
			                        if ( iColumn >1 ) {
			                            return sValue +" TableTools";
			                        }
			                        return sValue;
			                    }
				           },
				           {
								 extend : 'pdf',
								 exportOptions : {
					        	   		columns : [ 'printable:name']
									},
									className:'btn-white',
									text:'<i class="fa fa-download"></i>'
					           },
				           {
								 extend : 'copyHtml5',
								 exportOptions : {
					        	   		columns : ['printable:name',':visible'] 
									},
									className:'btn-white',
									text:'<i class="fa fa-copy"></i>'
					           },
					           {
									 extend : 'excel',
									 exportOptions : {
						        	   		columns :['printable:name',':visible'] 
										},
										className:'btn-white',
										text:'<i class="fa fa-edit"></i>'
							    }
				            
				        ],

				order: [ 1, 'asc' ],
				aaSorting  : [[1, 'asc']],
				aLengthMenu  : [[5, 10, 15, 20, -1], [5, 10, 15, 20, "All"]],
				iDisplayLength : 100,
				initComplete: function(settings, json) {
    				console.log( 'DataTables has finished its initialisation.' );
    				$('.tooltips').tooltip();
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
		table.buttons().container().appendTo( $('.print-table:eq(0)') );
	};
	$('#checkcancelled').iCheck();
	$('#checkarrived').iCheck();
	var manageCheckBoxes=function(){
		$('#checkcancelled').on('ifChecked', function(event){
	    	$("#reservationList").dataTable().fnDraw();
	    	return false;
		});
		$('#checkcancelled').on('ifUnchecked', function(event){
	    	$("#reservationList").dataTable().fnDraw();
	    	return false;
		});
		$('#checkarrived').on('ifChecked', function(event){
	    	$("#reservationList").dataTable().fnDraw();
	    	return false;
		});
		$('#checkarrived').on('ifUnchecked', function(event){
	    	$("#reservationList").dataTable().fnDraw();
	    	return false;
		});
	}
	$.fn.dataTableExt.afnFiltering.push( function( oSettings, aData, iDataIndex ) {
			var nTr = oSettings.aoData[ iDataIndex ].nTr;
			if( aData[21]=='1' ){
				if( $('#checkarrived').is(":checked") ){
					return false;
				}else{
					return true;
				}
			}
			if( aData[12]=='Cancelled'  || aData[12]=='Annulé' ){
				if( $('#checkcancelled').is(":checked") ){
					return false;
				}else{
					return true;
				}					
			}{
				return true;
			}
   	} );
//	$.fn.dataTableExt.afnFiltering.push( function( oSettings, aData, iDataIndex ) {
//		var servinglist=$('#servinglist').val();
//		var list=servinglist.split(',');
//		$.each( list, function( i, val ){
			//if( aData[16]==val ){
			//	return false;
			//} else {
			//	return true;
			//}
//		});
//		return true;
//   	});
    return {
        //main function to initiate template pages
        init: function () {
			doTable();
			initModals();
			runInputLimiter();
			loadFullCalendar();
			runTouchSpin();
			pickerTime();
			manageCheckBoxes();
        }
    };
}();
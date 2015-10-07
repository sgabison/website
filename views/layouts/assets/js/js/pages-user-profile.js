var PIMCORE_WEBSITE_LAYOUTS = "http://resaexpress.com/website/views/layouts";
var PagesUserProfile = function() {
	"use strict";
	var oTable, contributors = [];
	var subViewElement, subViewContent, subViewIndex;
	// function to initiate Pulsate
	var runPulsate = function() {
		$('.pulsate').pulsate({
			color : '#C43C35', // set the color of the pulse
			reach : 10, // how far the pulse goes in px
			speed : 1000, // how long one pulse takes in ms
			pause : 200, // how long the pause between pulses is in ms
			glow : false, // if the glow should be shown too
			repeat : 3, // will repeat forever if true, if given a number will
						// repeat for that many times
			onHover : false
		// if true only pulsate if user hovers over the element
		});

	};
	var checkboxCallback = function(mydata) {

		var data = 'positionId=' + mydata.positionId + '&personId='
				+ mydata.personId + '&value=' + mydata.checked;// $.param(mydata)
																// ; //
		$.ajax({
			url : '/data/person/set-position',
			data : data,
			dataType : 'json',
			success : function(json) {
				toastr.success(mydata.fullName + ' ' + json.message);
			}
		});
	};
	// function to initiate Callback on Checkbox and RadioButton
	var runCallbackIcheck = function() {
		var checkboxP = $('input.checkbox-position');

		checkboxP.on('ifChecked', function(event) {
			var mydata = $(this).data();
			mydata.checked = 1;
			checkboxCallback(mydata);
		});
		$('input.checkbox-position').on('ifUnchecked', function(event) {
			var mydata = $(this).data();
			mydata.checked = 0;
			// var data = 'positionId=' + mydata.positionId + '&personId='+
			// mydata.personId +'&value=0' ;
			checkboxCallback(mydata);
		});
		$('input.radio-position').on('ifChecked', function(event) {
			alert('checked ' + $(this).val() + ' radio button');
		});
		$(".show-subviews.edit-contributor").off().on("click", function() {
			subViewElement = $(this);
			subViewContent = subViewElement.attr('href');
			var contributorIndex = subViewElement.data("index");
			console.log('click', subViewContent, contributorIndex);
			$.subview({
				content : subViewContent,
				onShow : function() {
					loadContributor(contributorIndex);
				}
			});
		});
	};
	var loadContributor = function(id) {
		var reponse = new Object; // object(id,METHOD
									// =(PUT,GET,POST,DELETE),data)
		var url = '/data/person/get-data';
		$.blockUI({
			message : '<i class="fa fa-spinner fa-spin"></i> '+t('js_please_wait')
		});
		reponse.data = {
			id : id
		};
		reponse.id = id;
		reponse.METHOD = 'GET';
		$.ajax({
			url : url,
			dataType : 'json',
			type : 'POST', // obligatoire
			data : JSON.stringify(reponse),
			contentType : "application/json; charset=utf-8",
			success : function(json) {
				$.unblockUI();
				if (json.success || json.success == 'true') {
					var contributor = json.data;
					console.log('url', url, contributor);
					fillContributorForm(contributor);
					toastr.success(contributor.firstname + ' '
							+ contributor.lastname + ' ' + json.message);
				} else {
					toastr.error(json.message);
				}
			}
		});
	};
	var LISTING_RESULTS = [];
	var setContributor = function(item, index, array) {
		var a = new Array(item.avatar, item.firstname + ' ' + item.lastname,
				item.email, item.gender, item.id, item.permits);
		LISTING_RESULTS.push(a);
		return a;
		// avatar:0, fullname:1,email:2, gender:3, id:4
	};

	var setContributorsList = function() {
		var url = '/data/person/person-list';
		$.getJSON(url).done(function(data) {
			$.each(data.data, function(index, value) {
				contributors[value.id] = value;
			});
			contributors.forEach(setContributor);
		});
	};

	var getContributorById = function(id) {
		return contributors[id];
	}

	var showContributors = function() {
		$('#contributors').append(
				'<table class="table table-striped" id="example"></table>');
		// $.fn.dataTableExt.sErrMode = 'console'; //suprime les alertes;
		oTable = $('#example')
				.dataTable(
						{
							"oLanguage" : {
								"sLengthMenu" : "_MENU_",
								"sSearch" : "",
								"oPaginate" : {
									"sPrevious" : "",
									"sNext" : ""
								}
							},
							"fnRowCallback" : function(nRow, aData,
									iDisplayIndex) {
								/*
								 * Append the grade to the default row class
								 * name
								 */
								// alert(aData) => c'est LISTING_RESULTS
								$('#example_wrapper .dataTables_filter input')
										.addClass("form-control").attr(
												"placeholder", "Search");
								// modify table search input

								// modify table per page dropdown
								$('#example_wrapper .dataTables_length select')
										.selectpicker();
								// export and print tools

								// initialzie select2 dropdown
								if (aData[0] !== "") {
									$('td:eq(0)', nRow).html(
											'<img src="' + aData[0]
													+ '" width="50">');
								} else {
									$('td:eq(0)', nRow)
											.html(
													'<img src="/website/views/layouts/assets/images/anonymous.jpg" width="50" height ="50">');
								}
								var contributorIndex = aData[4];
								$("td:eq(5)", nRow).empty();
								$(".options-contributors")
										.children()
										.clone()
										.appendTo($("td:eq(5)", nRow))
										.find(".edit-contributor")
										.data("index", contributorIndex)
										.off()
										.on(
												"click",
												function() {

													subViewElement = $(this);
													subViewContent = subViewElement
															.attr('href');
													var contributorIndex = subViewElement
															.data("index");
													$
															.subview({
																content : subViewContent,
																onShow : function() {
																	loadContributor(contributorIndex);
																}
															});
												})
										.end()
										.find(".delete-contributor")
										.data("index", contributorIndex)
										.off()
										.on(
												"click",
												function() {
													var target_tr = $(this)
															.closest("tr");
													var target_row = $(this)
															.closest("tr").get(
																	0);

													var el = $(this).data(
															"index");
													var contributor = contributors[el], name = contributor.firstname
															+ ' '
															+ contributor.lastname;
													console.log('delete', el,
															contributors,
															'target',
															target_tr,
															target_row);
													// this line did the trick
													bootbox
															.confirm(
																	"Delete "
																			+ name
																			+ " ?",
																	function(
																			result) {

																		if (result) {
																			$
																					.blockUI({
																						message : '<i class="fa fa-spinner fa-spin"></i> Do some ajax to sync with backend...'
																					});
																			var reponse = new Object; // object(id,METHOD
																										// =(PUT,GET,POST,DELETE),data)

																			reponse.data = {
																				id : el
																			};
																			reponse.id = el;
																			reponse.METHOD = 'DELETE';
																			$
																					.ajax({
																						url : '/data/person/get-data',
																						dataType : 'json',
																						type : 'POST', // obligatoire
																						data : JSON
																								.stringify(reponse),
																						contentType : "application/json; charset=utf-8",
																						success : function(
																								json) {
																							$
																									.unblockUI();

																							if (json.success
																									|| json.success == 'true') {
																								contributors
																										.splice(
																												el,
																												1);
																								destroyContributors();
																								showContributors();
																								toastr
																										.success(name
																												+ ' '
																												+ json.message);
																							} else {
																								toastr
																										.error(name
																												+ ' '
																												+ json.message);
																							}
																						}
																					});
																		}
																	});
												});

							},
							"aaData" : LISTING_RESULTS,
							"aoColumns" : [ {
								"sTitle" : "",
								"bSearchable" : false
							}, {
								"sTitle" : "Full Name"
							}, {
								"sTitle" : "Email"
							}, {
								"sTitle" : "Gender",
								"sClass" : "center"
							}, {
								"sTitle" : "Ident."
							}, {
								"sTitle" : "Options",
								"sClass" : "center"
							} ],
							"aoColumnDefs" : [ {
								bSortable : false,
								aTargets : [ 0, -1 ]
							} ],
							"aaSorting" : [ [ 1, "asc" ] ],
							"dom" : 'T<"clear">lfrtip',
							"tableTools" : {
								"aButtons" : [
										{
											"sExtends" : "print",
											"sButtonText" : "Imprimer <i class='fa fa-print'></i>",
											"sButtonClass" : "btn btn-blue dropdown-toggle"
										},
										{
											"sExtends" : "collection",
											"sButtonText" : "Enregistrer <i class='fa fa-angle-down'></i>",
											"sButtonClass" : "btn btn-green dropdown-toggle",
											"aButtons" : [
													{
														"sExtends" : "csv",
														"sButtonText" : "CSV <i class='fa fa-download'></i>"
													},
													{
														"sExtends" : "xls",
														"sButtonText" : "Excel <i class='fa fa-download'></i>"
													},
													{
														"sExtends" : "pdf",
														"sButtonText" : "PDF <i class='fa fa-download'></i>"
													} ]
										} ]
							}
						});
		// var tt = new $.fn.dataTable.TableTools( oTable );
		// $( tt.fnContainer() ).insertBefore('div.dataTables_wrapper');

	};
	var destroyContributors = function() {
		// Delete the datable object first
		if (oTable != null)
			oTable.fnDestroy();
		// Remove all the DOM elements
		$('#example').remove();
	};
	var editContributor = function(el) {
		$(".form-contributor").attr('action', '/data/person/get-data');
		$(".form-contributor").attr('method', 'POST');
		$(".form-contributor .help-block").remove();
		$(".form-contributor .form-group").removeClass("has-error")
				.removeClass("has-success");
		console.log("element clicker", el);
		if (typeof el == "undefined") {
			$(".contributor-id").val("");
			$(".contributor-firstname").val("");
			$(".contributor-lastname").val("");
			$(".contributor-email").val("");
			$(".contributor-password").val("");
			$(".contributor-password-again").val("");
			$('.contributor-gender').iCheck('uncheck');
			$(".contributor-permits option:eq(0)").prop('selected', true);
			$(".contributor-avatar").removeClass("fileupload-exists").addClass(
					"fileupload-new");
			$(".contributor-avatar .fileupload-preview").empty();
			$(".contributor-message").val("");
			$(".contributor-form-method").val("POST");
		} else {
			fillContributorForm(contributors[el]);
		}
	};
	var fillContributorForm = function(item) {
		$(".contributor-index").val(item.id);
		$(".contributor-id").val(item.id);
		$(".contributor-firstname").val(item.firstname);
		$(".contributor-lastname").val(item.lastname);
		$(".contributor-email").val(item.email);
		$(".contributor-password").val(item.password);
		$(".contributor-password-again").val(item.password);
		$(".contributor-gender[value='" + item.gender + "']").iCheck('check');
		$(".contributor-permits option[value='" + item.permits + "']").prop(
				'selected', true);
		if (item.avatar !== "") {
			$(".contributor-avatar").removeClass("fileupload-new").addClass(
					"fileupload-exists");

			$(".contributor-avatar .fileupload-preview").empty().append(
					"<img src='" + item.avatar + "'>");

		} else {
			$(".contributor-avatar").removeClass("fileupload-exists").addClass(
					"fileupload-new");

			$(".contributor-avatar .fileupload-preview").empty().append(
					"<img src='/website/views/layouts/assets/images/anonymous.jpg'>");
		}
		$(".contributor-message").val("");
		$(".contributor-form-method").val("PUT");
	};
	var runContributorsFormValidation = function(el) {
		var formContributor = $('.form-contributor');
		var errorHandler3 = $('.errorHandler', formContributor);
		var successHandler3 = $('.successHandler', formContributor);
		formContributor
				.validate({
					errorElement : "span", // contain the error msg in a span
											// tag
					errorClass : 'help-block',
					errorPlacement : function(error, element) { 
						if (element.attr("type") == "radio" || element.attr("type") == "checkbox") { 
							error.insertBefore($(element).closest('.form-group').children('div').children().last());
						} else if (element.attr("name") == "dd" || element.attr("name") == "mm" || element.attr("name") == "yyyy") {
							error.insertBefore($(element).closest('.form-group').children('div'));
						} else {
							error.insertBefore(element);
							// for other inputs, just perform default behavior
						}
					},
					ignore : "",
					rules : {
						firstname : {
							minlength : 2,
							required : true
						},
						lastname : {
							minlength : 2,
							required : true
						},
						email : {
							required : true,
							email : true
						},
						password : {
							minlength : 6,
							required : true
						},
						password_again : {
							required : true,
							minlength : 5,
							equalTo : ".contributor-password"
						},
						yyyy : "FullDate",
						gender : {
							required : true
						},
						zipcode : {
							required : true,
							number : true,
							minlength : 5
						},
						city : {
							required : true
						},
						newsletter : {
							required : true
						}
					},
					messages : {
						firstname : t("js_first_name_please"),
						lastname : t("js_last_name_please"),
						email : {
							required : t("js_email_please"),
							email : t("js_emailformat_please"),
						}
					},
					invalidHandler : function(event, validator) { // display
																	// error
																	// alert on
																	// form
																	// submit
						successHandler3.hide();
						errorHandler3.show();
					},
					highlight : function(element) {
						$(element).closest('.help-block').removeClass('valid');
						// display OK icon
						$(element).closest('.form-group').removeClass(
								'has-success').addClass('has-error').find(
								'.symbol').removeClass('ok').addClass(
								'required');
						// add the Bootstrap error class to the control group
					},
					unhighlight : function(element) { // revert the change
														// done by hightlight
						$(element).closest('.form-group').removeClass(
								'has-error');
						// set error class to the control group
					},
					success : function(label, element) {
						label.addClass('help-block valid');
						// mark the current input as valid and display OK icon
						$(element).closest('.form-group').removeClass('has-error').addClass('has-success').find('.symbol').removeClass('required').addClass('ok');
					},
					submitHandler : function(form) {
						errorHandler3.hide();
						var userAvatar;
						if ($(".fileupload-preview img").attr("src") == null) {
							userAvatar = "";
						} else {
							userAvatar = $(".fileupload-preview img").attr("src");
						}
						var newContributor = new Object;
						newContributor.id = $(".contributor-id").val(),
						newContributor.firstname = $(".contributor-firstname").val(),
						newContributor.lastname = $(".contributor-lastname").val(),
						newContributor.email = $(".contributor-email").val(), newContributor.password = $(".contributor-password").val(),
						newContributor.gender = $("input.contributor-gender:checked").val(), newContributor.permits = $(".contributor-permits option:selected").val(),
						newContributor.avatar = userAvatar,
						newContributor.message = $(".contributor-message").val(),
						newContributor.method = $(".contributor-form-method").val();
						$.blockUI({
							message : '<i class="fa fa-spinner fa-spin"></i>'+t('js_please_wait')
						});
						var reponse = new Object; // object(id,METHOD
													// =(PUT,GET,POST,DELETE),data)
						reponse.data = newContributor;
						reponse.id = newContributor.id;
						reponse.METHOD = newContributor.method;
						if ($(".contributor-id").val() !== "") {
							$.ajax({
								url : '/data/person/get-data',
								dataType : 'json',
								type : 'POST', // obligatoire
								data : JSON.stringify(reponse),
								contentType : "application/json; charset=utf-8",
								success : function(json) {
									$.unblockUI();
									if (json.success
											|| json.success == 'true') {
										var i = $(".contributor-index")
												.val();
										contributors[i] = json.data;
										oTable.ajax.reload();
										$.hideSubview();
										// TODO mettre à jour la liste
										toastr.success(newContributor.firstname
										+ ' '
										+ newContributor.lastname
										+ ' '
										+ json.message);
									} else {
										toastr.error(newContributor.firstname
										+ ' '
										+ newContributor.lastname
										+ ' '
										+ json.message);
									}
								}
							});
						} else {
							$.ajax({
							url : '/data/person/get-data',
							dataType : 'json',
							type : 'POST',
							contentType : "application/json; charset=utf-8",
							data : JSON.stringify(reponse),
							success : function(json) {
								$.unblockUI();
								if (json.success
										|| json.success == 'true') {
									contributors.push(json.data);
									oTable.ajax.reload();
									$.hideSubview();
									toastr.success(newContributor.firstname
									+ ' '
									+ newContributor.lastname
									+ ' '
									+ json.message);
								} else {
									toastr.error(newContributor.firstname
									+ ' '
									+ newContributor.lastname
									+ ' '
									+ json.message);
								}
							}
						});
						}
					}
				});
	};

	var runSubViews = function() {
		$(".new-contributor").off().on("click", function() {
			subViewElement = $(this);
			subViewContent = subViewElement.attr('href');
			$.subview({
				content : subViewContent,
				onShow : function() {
					editContributor();
				}
			});
		});
		$(".show-contributors").off().on("click", function() {
			subViewElement = $(this);
			subViewContent = subViewElement.attr('href');
			$.subview({
				content : subViewContent,
				startFrom : "right",
				onShow : function() {
					showContributors();
				},
				onHide : function() {
					destroyContributors();
				}
			});
		});
	};

	return {
		// main function to initiate template pages
		init : function() {
			runPulsate();
			setContributorsList();
			runContributorsFormValidation();
			runSubViews();
			runCallbackIcheck();
		}
	};
}();

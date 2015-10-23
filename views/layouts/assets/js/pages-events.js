var Events = function() {
    "use strict";
    var dateToShow, calendar, demoCalendar, eventClass, eventCategory, subViewElement, subViewContent, $eventDetail;
    var defaultRange = new Object;
    var $eventDetail = $('.form-full-event .summernote');
    console.log('$eventDetail', $eventDetail);

    defaultRange.start = moment();
    defaultRange.end = moment().add('days', 1);
    //Calendar
    var setFullCalendarEvents = function() {
        var date = new Date();
		moment.lang(language);
        dateToShow = date;
        var d = date.getDate();
        var m = date.getMonth();
        var y = date.getFullYear();
		var start = new Date(y, m-1, d);
        //var end = new Date(y, m+1, d );
        var end = new Date(y, m+1, d );
    };
    //function to initiate Full Calendar
    var runFullCalendar = function() {
        $(".add-event").off().on("click", function() {
            subViewElement = $(this);
            subViewContent = subViewElement.attr('href');
            $.subview({
                content: subViewContent,
                onShow: function() {
                    editFullEvent();
                },
                onHide: function() {
                    hideEditEvent();
                }
            });
        });

        $('#event-categories div.event-category').each(function() {
            // create an Event Object (http://arshaw.com/fullcalendar/docs/event_data/Event_Object/)
            // it doesn't need to have a start or end
            var eventObject = {
                title: $.trim($(this).text()) // use the element's text as the event title
            };
            // store the Event Object in the DOM element so we can get to it later
            $(this).data('eventObject', eventObject);
            // make the event draggable using jQuery UI
            $(this).draggable({
                zIndex: 999,
                revert: true, // will cause the event to go back to its
                revertDuration: 50 //  original position after the drag
            });
        });
        /* initialize the calendar
		-----------------------------------------------------------------*/
        var date = new Date();
        var d = date.getDate();
        var m = date.getMonth();
        var y = date.getFullYear();
        var form = '';
        $('#full-calendar').fullCalendar({
        	lang:language,
            buttonIcons: {
                prev: 'fa fa-chevron-left',
                next: 'fa fa-chevron-right'
            },
            header: {
                left: 'prev,next today',
                center: 'title',
                right: 'month,agendaWeek,agendaDay'
            },
            weekends: true,
            firstDay: 1,
            events: loadEvents,
            editable: true,
            eventLimit: true, // allow "more" link when too many events
            droppable: true, // this allows things to be dropped onto the calendar !!!
            drop: function(date, allDay) { // this function is called when something is dropped

                // retrieve the dropped element's stored Event Object
                var originalEventObject = $(this).data('eventObject');


                var $categoryClass = $(this).attr('data-class');
                var $category = $categoryClass.replace("event-", "").toLowerCase().replace(/\b[a-z]/g, function(letter) {
                    return letter.toUpperCase();
                });
                // we need to copy it, so that multiple events don't have a reference to the same object



                var newEvent = new Object;
                newEvent.title = originalEventObject.title;
                newEvent.start = new Date(date);
                newEvent.end = moment(new Date(date)).add('hours', 1);
                newEvent.allDay = true;
                newEvent.className = $categoryClass;
                newEvent.category = t($category);
                newEvent.content = "";
				console.log("save event dropped",$category, t($category));
				saveEvent(newEvent);

             //   $('#full-calendar').fullCalendar('renderEvent', newEvent, true);

                // is the "remove after drop" checkbox checked?
                if ($('#drop-remove').is(':checked')) {
                    // if so, remove the element from the "Draggable Events" list
                    $(this).remove();
                }
            },
            selectable: true,
            selectHelper: true,
            select: function(start, end, allDay) {
                defaultRange.start = moment(start);
                defaultRange.end = moment(start).add('hours', 1);
                $.subview({
                    content: "#newFullEvent",
                    onShow: function() {
                        editFullEvent();
                    },
                    onHide: function() {
                        hideEditEvent();
                    }
                });
            },
            eventClick: function(calEvent, jsEvent, view) {
                if(calEvent.id != 'statutory' && calEvent.id != 'extraday'){
	                dateToShow = calEvent.start;
	                $.subview({
	                    content: "#readFullEvent",
	                    startFrom: "right",
	                    onShow: function() {
							console.log(calEvent);
	                        readFullEvents(calEvent.id);
	                    }
	                });
                }
            },
            eventRender: function(event, element) {
            	console.log( 'event.title', event.id );
            	console.log( 'element', element );
            	if( event.id=='statutory' || event.id=='extraday'){
            		element.find('.fc-title').parent().removeClass('fc-content');
            		element.find('.fc-title').parent().prepend("<img src='/logos/party.gif' width='12' height='12'>");
            	}
		    },
        });
    };
    var editFullEvent = function(el) {
       
       $(".close-new-event").off().on("click", function() {
            $(".back-subviews").trigger("click");
        });
        $(".form-full-event .help-block").remove();
        $(".form-full-event .form-group").removeClass("has-error").removeClass("has-success");
        $eventDetail.summernote({
            oninit: function() {
                if ($eventDetail.code() == "" || $eventDetail.code().replace(/(<([^>]+)>)/ig, "") == "") {
                    $eventDetail.code($eventDetail.attr("placeholder"));
                }
            },
            onfocus: function(e) {
                if ($eventDetail.code() == $eventDetail.attr("placeholder")) {
                    $eventDetail.code("");
                }
            },
            onblur: function(e) {
                if ($eventDetail.code() == "" || $eventDetail.code().replace(/(<([^>]+)>)/ig, "") == "") {
                    $eventDetail.code($eventDetail.attr("placeholder"));
                }
            },
            onkeyup: function(e) {
                $("span[for='detailEditor']").remove();
            },
            toolbar: [
                ['style', ['bold', 'italic', 'underline', 'clear']],
                ['color', ['color']],
                ['para', ['ul', 'ol', 'paragraph']],
            ]
        });
        if (typeof el == "undefined") {
            $(".form-full-event .event-id").val("");
            $(".form-full-event .event-name").val("");
            $(".form-full-event .all-day").bootstrapSwitch('state', true);
            $('.form-full-event .all-day-range').hide();
            $(".form-full-event .event-start-date").val(defaultRange.start);
            $(".form-full-event .event-end-date").val(defaultRange.end);

            $('.form-full-event .no-all-day-range .event-range-date').val(moment(defaultRange.start).format('DD/MM/YYYY h:mm A') + ' - ' + moment(defaultRange.end).format('DD/MM/YYYY h:mm A'))
                .daterangepicker({
                    startDate: defaultRange.start,
                    endDate: defaultRange.end,
                    timePicker: true,
                    timePickerIncrement: 30,
                    format: 'DD/MM/YYYY h:mm A'
                });

            $('.form-full-event .all-day-range .event-range-date').val(moment(defaultRange.start).format('DD/MM/YYYY') + ' - ' + moment(defaultRange.end).format('DD/MM/YYYY'))
                .daterangepicker({
                    startDate: defaultRange.start,
                    endDate: defaultRange.end
                });

            $('.form-full-event .event-categories option').filter(function() {
                return ($(this).text() == "Generic");
            }).prop('selected', true);
            $('.form-full-event .event-categories').selectpicker('render');
            $eventDetail.code($eventDetail.attr("placeholder"));

            defaultRange.start = moment();
            defaultRange.end = moment().add('days', 1);

        } else {

            $(".form-full-event .event-id").val(el);

            for (var i = 0; i < demoCalendar.length; i++) {
				console.log("editevent", el, demoCalendar[i]);
                if (demoCalendar[i].id == el) {
                    $(".form-full-event .event-name").val(demoCalendar[i].title);
                    $(".form-full-event .all-day").bootstrapSwitch('state', demoCalendar[i].allDay);
                    $(".form-full-event .event-start-date").val(moment(demoCalendar[i].start));
                    $(".form-full-event .event-end-date").val(moment(demoCalendar[i].end));
                    if (typeof $('.form-full-event .no-all-day-range .event-range-date').data('daterangepicker') == "undefined") {
                        $('.form-full-event .no-all-day-range .event-range-date').val(moment(demoCalendar[i].start).format('DD/MM/YYYY h:mm A') + ' - ' + moment(demoCalendar[i].end).format('DD/MM/YYYY h:mm A'))
                            .daterangepicker({
                                startDate: moment(moment(demoCalendar[i].start)),
                                endDate: moment(moment(demoCalendar[i].end)),
                                timePicker: true,
                                timePickerIncrement: 10,
                                format: 'DD/MM/YYYY h:mm A'
                            });

                        $('.form-full-event .all-day-range .event-range-date').val(moment(demoCalendar[i].start).format('DD/MM/YYYY') + ' - ' + moment(demoCalendar[i].end).format('DD/MM/YYYY'))
                            .daterangepicker({
                                startDate: moment(demoCalendar[i].start),
                                endDate: moment(demoCalendar[i].end)
                            });
                    } else {
                        $('.form-full-event .no-all-day-range .event-range-date').val(moment(demoCalendar[i].start).format('DD/MM/YYYY h:mm A') + ' - ' + moment(demoCalendar[i].end).format('DD/MM/YYYY h:mm A'))
                            .data('daterangepicker').setStartDate(moment(moment(demoCalendar[i].start)));
                        $('.form-full-event .no-all-day-range .event-range-date').data('daterangepicker').setEndDate(moment(moment(demoCalendar[i].end)));
                        $('.form-full-event .all-day-range .event-range-date').val(moment(demoCalendar[i].start).format('DD/MM/YYYY') + ' - ' + moment(demoCalendar[i].end).format('DD/MM/YYYY'))
                            .data('daterangepicker').setStartDate(demoCalendar[i].start);
                        $('.form-full-event .all-day-range .event-range-date').data('daterangepicker').setEndDate(demoCalendar[i].end);
                    }

                    if (demoCalendar[i].category == "" || typeof demoCalendar[i].category == "undefined") {
                        eventCategory = "Generic";
                    } else {
                        eventCategory = demoCalendar[i].category;
                    }
                    $('.form-full-event .event-categories option').filter(function() {
                    // 	console.log(t(eventCategory), eventCategory, $(this).text());
                        return ($(this).text().toLowerCase() == t(eventCategory) );
                    }).prop('selected', true);
                    $('.form-full-event .event-categories').selectpicker('render');
                    if (typeof demoCalendar[i].content !== "undefined" && demoCalendar[i].content !== "") {
                        $eventDetail.code(demoCalendar[i].content);
                    } else {
                        $eventDetail.code($eventDetail.attr("placeholder"));
                    }
                }

            }
        }
        $('.form-full-event .all-day').bootstrapSwitch();

        $('.form-full-event .all-day').on('switchChange.bootstrapSwitch', function(event, state) {
            $(".daterangepicker").hide();
            var startDate = moment($("#newFullEvent").find(".event-start-date").val());
            var endDate = moment($("#newFullEvent").find(".event-end-date").val());
            if (state) {
                $("#newFullEvent").find(".no-all-day-range").hide();
                $("#newFullEvent").find(".all-day-range").show();
                $("#newFullEvent").find('.all-day-range .event-range-date').val(startDate.format('DD/MM/YYYY') + ' - ' + endDate.format('DD/MM/YYYY')).data('daterangepicker').setStartDate(startDate);
                $("#newFullEvent").find('.all-day-range .event-range-date').data('daterangepicker').setEndDate(endDate);
            } else {
                $("#newFullEvent").find(".no-all-day-range").show();
                $("#newFullEvent").find(".all-day-range").hide();
                $("#newFullEvent").find('.no-all-day-range .event-range-date').val(startDate.format('DD/MM/YYYY h:mm A') + ' - ' + endDate.format('DD/MM/YYYY h:mm A')).data('daterangepicker').setStartDate(startDate);
                $("#newFullEvent").find('.no-all-day-range .event-range-date').data('daterangepicker').setEndDate(endDate);
            }

        });
        $('.form-full-event .event-range-date').on('apply.daterangepicker', function(ev, picker) {
            $(".form-full-event .event-start-date").val(picker.startDate);
            $(".form-full-event .event-end-date").val(picker.endDate);
        });
    };
    var readFullEvents = function(el) {
    	 console.log("readfull-event") ;
         	
        $(".edit-event").off().on("click", function() {
			subViewElement = $(this);
            subViewContent = subViewElement.attr('href');
            $.subview({
                content: subViewContent,
                onShow: function() {
            	console.log("edit",el);
                    editFullEvent(el);
                },
                onHide: function() {
                    hideEditEvent();
                }
            });
        });

        $(".delete-event").data("event-id", el);

        $("#readFullEvent").find(".delete-event").off().on("click", function() {
            el = $(this).data("event-id");
            bootbox.confirm(t('js_sure_cancel'), function(result) {
                if (result) {
                    $.blockUI({
                        message: '<i class="fa fa-spinner fa-spin"></i> '+t('js_please_wait')
                    });
                    var reponse = new Object; 
    				   reponse.data = "";
					   reponse.id =  el;
    				   reponse.METHOD = ( is_int(reponse.id) )? 'DELETE':'';
                        $.ajax({
                            url: '/data/event/get-data',
                            dataType: 'json',
                            type : 'POST', // obligatoire
                            data : JSON.stringify(reponse),
                            contentType : "application/json; charset=utf-8",
                            success : function(json) {
    							$.unblockUI();
	    						if (json.success || json.success == 'true') {
	                            $('#full-calendar').fullCalendar('removeEvents', el);
                                demoCalendar = $("#full-calendar").fullCalendar("clientEvents");
                                $.hideSubview();
                                toastr.success(json.message);
                            }
                        }
                    });

                }
            });
        });
        for (var i = 0; i < demoCalendar.length; i++) {
            if (demoCalendar[i].id == el) {


                $("#readFullEvent .event-allday").hide();
                $("#readFullEvent .event-end").empty().hide();
                $("#readFullEvent .event-title").empty().text(demoCalendar[i].title);
                if (demoCalendar[i].className == "" || typeof demoCalendar[i].className == "undefined") {
                    eventClass = "event-generic";
                } else {
                    eventClass = demoCalendar[i].className;
                }
                if (demoCalendar[i].category == "" || typeof demoCalendar[i].category == "undefined") {
                    eventCategory = "Generic";
                } else {
                    eventCategory = demoCalendar[i].category;
                }

                $("#readFullEvent .event-category")
                    .empty()
                    .removeAttr("class")
                    .addClass("event-category " + eventClass)
                    .text(eventCategory);
                if (demoCalendar[i].allDay) {
                    $("#readFullEvent .event-allday").show();
                    $("#readFullEvent .event-start").empty().html("<p>Start:</p> <div class='event-day'><h2>" + moment(demoCalendar[i].start).format('DD') + "</h2></div><div class='event-date'><h3>" + moment(demoCalendar[i].start).format('dddd') + "</h3><h4>" + moment(demoCalendar[i].start).format('MMMM YYYY') + "</h4></div>");
                    if (demoCalendar[i].end !== null) {
                        if (moment(demoCalendar[i].end).isValid()) {
                            $("#readFullEvent .event-end").show().html("<p>End:</p> <div class='event-day'><h2>" + moment(demoCalendar[i].end).format('DD') + "</h2></div><div class='event-date'><h3>" + moment(demoCalendar[i].end).format('dddd') + "</h3><h4>" + moment(demoCalendar[i].end).format('MMMM YYYY') + " </h4></div>");
                        }
                    }
                } else {
                    $("#readFullEvent .event-start").empty().html("<p>Start:</p> <div class='event-day'><h2>" + moment(demoCalendar[i].start).format('DD') + "</h2></div><div class='event-date'><h3>" + moment(demoCalendar[i].start).format('dddd') + "</h3><h4>" + moment(demoCalendar[i].start).format('MMMM YYYY') + "</h4></div> <div class='event-time'><h3><i class='fa fa-clock-o'></i> " + moment(demoCalendar[i].start).format('h:mm A') + "</h3></div>");
                    if (demoCalendar[i].end !== null) {
                        if (moment(demoCalendar[i].end).isValid()) {
                            $("#readFullEvent .event-end").show().html("<p>End:</p> <div class='event-day'><h2>" + moment(demoCalendar[i].end).format('DD') + "</h2></div><div class='event-date'><h3>" + moment(demoCalendar[i].end).format('dddd') + "</h3><h4>" + moment(demoCalendar[i].end).format('MMMM YYYY') + "</h4></div> <div class='event-time'><h3><i class='fa fa-clock-o'></i> " + moment(demoCalendar[i].end).format('h:mm A') + "</h3></div>");
                        }
                    }
                }

                $("#readFullEvent .event-content").empty().html(demoCalendar[i].content);

                break;
            }

        }

    };
	var is_int = function (value){
	  if((parseFloat(value) == parseInt(value)) && !isNaN(value)){
		  return true;
	  } else {
		  return false;
	  }
	};
    var runFullCalendarValidation = function(el) {

        var formEvent = $('.form-full-event');
        var errorHandler2 = $('.errorHandler', formEvent);
        var successHandler2 = $('.successHandler', formEvent);

        formEvent.validate({
            errorElement: "span", // contain the error msg in a span tag
            errorClass: 'help-block',
            errorPlacement: function(error, element) { // render error placement for each input type
                if (element.attr("type") == "radio" || element.attr("type") == "checkbox") { // for chosen elements, need to insert the error after the chosen container
                    error.insertAfter($(element).closest('.form-group').children('div').children().last());
                } else if (element.parent().hasClass("input-icon")) {

                    error.insertAfter($(element).parent());
                } else {
                    error.insertAfter(element);
                    // for other inputs, just perform default behavior
                }
            },
            ignore: "",
            rules: {
                eventName: {
                    minlength: 2,
                    required: true
                },
                eventStartDate: {
                    required: true,
                    date: true
                },
                eventEndDate: {
                    required: true,
                    date: true
                }
            },
            messages: {
                eventName: "* Please specify the event name"

            },
            invalidHandler: function(event, validator) { //display error alert on form submit
                successHandler2.hide();
                errorHandler2.show();
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
                successHandler2.show();
                errorHandler2.hide();
                var newEvent = new Object;
                newEvent.title = $(".form-full-event .event-name ").val();
                newEvent.start = new Date($('.form-full-event .event-start-date').val());
                newEvent.end = new Date($('.form-full-event .event-end-date').val());
                newEvent.allDay = $(".form-full-event .all-day").bootstrapSwitch('state');
                newEvent.className = $(".form-full-event .event-categories option:checked").val();
                newEvent.category = $(".form-full-event .event-categories option:checked").text();
                if ($eventDetail.code() !== "" && $eventDetail.code().replace(/(<([^>]+)>)/ig, "") !== "" && $eventDetail.code() !== $eventDetail.attr("placeholder")) {
                    newEvent.content = $eventDetail.code();
                } else {
                    newEvent.content = "";
                }
                var reponse = new Object; // object(id,METHOD
													// =(PUT,GET,POST,DELETE),data)
				reponse.data = newEvent;
				
                $.blockUI({
                    message: '<i class="fa fa-spinner fa-spin"></i> '+t('js_please_wait')
                });

                if ($(".form-full-event .event-id").val() !== "") {
                    el = $(".form-full-event .event-id").val();
                    var actual_event = $('#full-calendar').fullCalendar('clientEvents', el);
                    actual_event = actual_event[0];
                    for (var i = 0; i < demoCalendar.length; i++) {
                        if (demoCalendar[i].id == el) {
                            newEvent.id = el;
                            var eventIndex = i;
                        }
                    }
 
				   reponse.id =  newEvent.id;
				   reponse.METHOD = ( is_int(reponse.id) )?'PUT':'POST';


                    $.ajax({
                        url: '/data/event/get-data',
                        dataType: 'json',
                        type : 'POST', // obligatoire
                        data : JSON.stringify(reponse),
                        contentType : "application/json; charset=utf-8",
                        success : function(json) {
							$.unblockUI();
							if (json.success || json.success == 'true') {

                                $('#full-calendar').fullCalendar('removeEvents', actual_event.id);
                                $('#full-calendar').fullCalendar('renderEvent', newEvent, true);

                                demoCalendar = $("#full-calendar").fullCalendar("clientEvents");
                                $.hideSubview();
                                toastr.success(json.message);
                            }
                        }
                    });

                } else {

					   // console.log("hurra new event");
    				   reponse.id =  "";
    				   reponse.METHOD = 'POST';
                        $.ajax({
                            url: '/data/event/get-data',
                            dataType: 'json',
                            type : 'POST', // obligatoire
                            data : JSON.stringify(reponse),
                            contentType : "application/json; charset=utf-8",
                            success : function(json) {
    							$.unblockUI();
	    						if (json.success || json.success == 'true') {
	                                $('#full-calendar').fullCalendar('renderEvent', newEvent, true);
	                                demoCalendar = $("#full-calendar").fullCalendar("clientEvents");
	                                $.hideSubview();
	                                toastr.success(json.message);
	                            }
                        	}
                        });

                }



            }
        });
    };
	var saveEvent = function (newEvent){
					    
					   var reponse = new Object; 
    				   reponse.data = newEvent;
					   reponse.id =  newEvent.id;
    				   reponse.METHOD = ( is_int(reponse.id) )?'PUT':'POST';
                        $.ajax({
                            url: '/data/event/get-data',
                            dataType: 'json',
                            type : 'POST', // obligatoire
                            data : JSON.stringify(reponse),
                            contentType : "application/json; charset=utf-8",
                            success : function(json) {
    							$.unblockUI();
	    						if (json.success || json.success == 'true') {
	                                $('#full-calendar').fullCalendar('renderEvent', json.data, true);
	                                demoCalendar = $('#full-calendar').fullCalendar('clientEvents');
	                                toastr.success(json.message);
	                            }
                        	}
                        });
	};
	var loadEvents = function (start,end,timezone,callback){
					  
					   var reponse = new Object; 
    				   reponse.start = start;
					   reponse.end =  end;
					   reponse.timezone =  timezone;
    				   reponse.METHOD = 'GET';
                        $.ajax({
                            url: '/data/event/get-events',
                            dataType: 'json',
                            type : 'POST', // obligatoire
                            data : JSON.stringify(reponse),
                            contentType : "application/json; charset=utf-8",
                            success : function(json) {
    							$.unblockUI();
	    						if (json.success || json.success == 'true') {	                               
									callback(json.data);
									demoCalendar = $.makeArray(json.data);
									console.log("loadEvents",demoCalendar);
	                            }
                        	}
                        });
	}
    // on hide event's form destroy summernote and bootstrapSwitch plugins
    var hideEditEvent = function() {
        $.hideSubview();
        $(".form-full-event .all-day").bootstrapSwitch('destroy');
        $('.form-full-event .summernote').destroy();

    };
    return {
        init: function() {
            setFullCalendarEvents();
			runFullCalendar();
			runFullCalendarValidation();
        }
    };
}();
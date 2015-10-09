var Maps = function () {
	"use strict";
    //function to initiate GMaps
    //Gmaps.js allows you to use the potential of Google Maps in a simple way.
    //For more information, please visit http://hpneo.github.io/gmaps/documentation.html
	$.urlParam = function(name){
	    var results = new RegExp('[\?&]' + name + '=([^&#]*)').exec(window.location.href);
	    if (results==null){
	       return null;
	    }
	    else{
	       return results[1] || 0;
	    }
	}
	$('.introductionclose').click( function(){
		$('.introduction').addClass('no-display');
		$('.reservation').removeClass('no-display');
	});
	var len=$('#len').val();
	var selectedInfoWindow;
	$(document).on('click', '.booktable', function(e){
		e.preventDefault();
		console.log(e);
		console.log( 'booktable' );
       	$('.restaurantpanel').removeClass('no-display');
       	$('#map2panel').addClass('no-display');
       	$('.reservation').html('<iframe src="/reservation?selectedLocationid='+$(this).attr('data-id')+'" width="100%" height="600px" frameborder="0" id="iframe"></iframe>');
	});
	var buttonplace='';
    var runMaps = function () {
        // Basic Map 
        //Markers
        var map3 = new GMaps({
            div: '#map3',
	        lat: $('#selectedLat').val(),
        	lng: $('#selectedLong').val(),
        });
        map3.addMarker({
	        lat: $('#selectedLat').val(),
        	lng: $('#selectedLong').val(),
            title: 'marker',
            infoWindow: {
		        content: '<p>Restaurant</p>'
		    }
        });
        var map2 = new GMaps({
            div: '#map2',
            zoom: 6,
            lat: 46.0,
            lng: 2.0
        });
        var i=0;
        while( i<len ){
        	console.log('i=', i, $('#'+i).attr('data-lat'),$('#'+i).attr('data-long'));
	        map2.addMarker({
	            lat: $('#'+i).attr('data-lat'),
	            lng: $('#'+i).attr('data-long'),
	            title: 'marker'+i,
	            id: $('#'+i).attr('data-id'),
	            infoWindow: {
	                content: '<p><b>'+$('#'+i).attr('data-name')+'</b></br>'+$('#'+i).attr('data-address')+'</br>'+$('#'+i).attr('data-zip')+' '+$('#'+i).attr('data-city')+'</p>'+'<span class="btn btn-blue booktable" data-id="'+$('#'+i).attr('data-id')+'">'+t("js_book_a_table")+'</span>'
	            }
	        });
	        i++;
        }
        
		GMaps.prototype.markerById=function(id){
		  for(var m=0;m<this.markers.length;++m){
		    if(this.markers[m].get('id')===id){
		      return this.markers[m];
		    }
		  }
		  return new google.maps.Marker();
		}
		google.maps.event.trigger(map2.markerById( $.urlParam('selectedLocationid') ), 'click');
		while( i<len ){
			map2.markerById( i ).addListener('click', function(e) {
            	console.log('title',e.title);
            	console.log('id',e.id);
				i=e.title.substr(6);
				console.log(i);
				console.log( $('#'+i).attr('data-name') );
				$('#locname').html( $('#'+i).attr('data-name') );
            	map2.setZoom(10);
            	map2.setCenter(e.position['H'], e.position['L']);
            	map3.setZoom(17);
				map3.setCenter(e.position['H'], e.position['L']);
				map3.addMarker({
					lat: e.position['H'],
					lng: e.position['L'],
					title: 'marker'+i,
					id: i,
					infoWindow: {
		                content: '<p><b>'+$('#'+i).attr('data-name')+'</b></br>'+$('#'+i).attr('data-address')+'</br>'+$('#'+i).attr('data-zip')+' '+$('#'+i).attr('data-city')+'</p>'+buttonplace
		            },
					click: function (e) {
		                if (console.log)
		                    console.log(e);
		                i=e.title.substr(6);
		                var locid=$('#'+i).attr('data-id');
		               	$('.restaurantpanel').removeClass('no-display');
		               	$('#map2panel').addClass('no-display');
		               	$('.reservation').html('<iframe src="/reservation?selectedLocationid='+locid+'" width="100%" height="600px" frameborder="0" id="iframe"></iframe>');
		            }
				})
			});
			i++;
		}
    };
    
    return {
        //main function to initiate template pages
        init: function () {
            runMaps();
        }
    };
}();
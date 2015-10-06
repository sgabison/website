var Maps = function () {
	"use strict";
    var runMaps = function () {
        // Basic Map 
        //Markers
        var map = new GMaps({
            div: '#map-canvas',
	        lat: $('#latresult').val(),
        	lng: $('#lngresult').val()
        });
        var marker = map.addMarker({
	        lat: $('#latresult').val(),
        	lng: $('#lngresult').val(),
        	id: 'initial',
            draggable: true,
            title: 'location',
            infoWindow: {
		        content: '<p>'+t('js_drag_to_refine')+'</p>'
		    }
        });
        $('#geocode').click(function (e) {
            e.preventDefault();
            console.log(e);
            map.removeMarkers();
            GMaps.geocode({
                address: $('#address').val().trim() + ',' + $('#city').val().trim() + ',' + $('#zip').val().trim(),
                callback: function (results, status) {
                    if (status == 'OK') {
                        var latlng = results[0].geometry.location;
                        map.setCenter(latlng.lat(), latlng.lng());
                        var marker2 = map.addMarker({
                            lat: latlng.lat(),
                            lng: latlng.lng(),
                            draggable: true
                        });
                        google.maps.event.addListener( marker2, 'dragend', function() {
						    $('#latresult').val( marker2.position.lat() );
						    $('#lngresult').val( marker2.position.lng() );
						});
                    }
                }
            });
        });
        google.maps.event.addListener( marker, 'dragend', function() {
		        $('#latresult').val( marker.position.lat() );
		        $('#lngresult').val( marker.position.lng() );
		});    
		GMaps.prototype.markerById=function(id){
		  for(var m=0;m<this.markers.length;++m){
		    if(this.markers[m].get('id')===id){
		      return this.markers[m];
		    }
		  }
		  return new google.maps.Marker();
		}
		//google.maps.event.trigger(map2.markerById( $.urlParam('selectedLocationid') ), 'click');
    };
    
    return {
        init: function () {
            runMaps();
        }
    };
}();
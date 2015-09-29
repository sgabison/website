var Maps = function () {
    var map2;
    var runMaps = function () {
        //Markers
        $("#mapmodal").click(function (e) {
        	$("#map2").css("width", 500).css("height", 500);
        });
        $(".bs-example-modal-basic").on("shown.bs.modal",function (e) {
        	var res = $('#latlong').val().split("; ");
	        var map2 = new GMaps({
	            div: '#map2',
	            lat: res[1],
	            lng: res[0]
	        });
	        map2.addMarker({
	            lat: res[1],
	            lng: res[0],
	            title: 'Location'
	        });
	   		google.maps.event.trigger(map2, 'resize');
		});
    };
    return {
        init: function () {
            runMaps();
        }
    };
}();
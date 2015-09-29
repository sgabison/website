<script src="http://maps.googleapis.com/maps/api/js?sensor=false"></script>
<script type="text/javascript">
 
// The latitude and longitude of your business / place
var position = [27.1959739, 78.02423269999997];
var latdid,longdid;
latdid=position[0]-0.003;
longdid=position[1]-0.004;
 
function showGoogleMaps() {
 
    var latLng = new google.maps.LatLng(position[0], position[1]);
    var latLng2 = new google.maps.LatLng(latdid, longdid);
 
    var mapOptions = {
        zoom: 16, // initialize zoom level - the max value is 21
        streetViewControl: false, // hide the yellow Street View pegman
        scaleControl: true, // allow users to zoom the Google Map
        mapTypeId: google.maps.MapTypeId.ROADMAP,
        center: latLng2
    };
    map = new google.maps.Map(document.getElementById('googlemaps'),  mapOptions);
 	infoWindow = new google.maps.InfoWindow();
 	infoWindow.setOptions({
 		map: map,
        content: "<div>This is the html content.</div>",
        position: latLng2,
    });
    // Show the default red marker at the location
    marker = new google.maps.Marker({
        position: latLng,
        map: map,
        draggable: false,
        animation: google.maps.Animation.DROP
    });
    infoWindow.open(map, marker);
}
 
google.maps.event.addDomListener(window, 'load', showGoogleMaps);
</script>
<div class="panel panel-white" style="height:100%">
	<div class="panel-heading">
		<h4 class="panel-title"><?php echo $this->translate('TXT_BOOK_A_TABLE');?> <?php echo $this->translate('TXT_AT');?> </h4>
	</div>
	<div class="panel-body">
		<div class="row">
		    <div id="googlemaps"></div>
		    	<div class="col-md-4">
				    <div class="panel panel-white" id="contactform">
						<iframe src="/reservation?selectedLocationid=<?php echo $this->selectedLocation->getId();?>" width="100%" height="500px" frameborder="0" id="iframe">
							<p>Votre navigateur ne supporte pas l'élément iframe</p>
						</iframe>
				    </div>
				</div>
				<div class="col-md-2"></div>
				<div class="col-md-5">
				    <div id="description" style="height:250px">
				    					<div class="panel panel-white" style="margin-top:250px">
											<div class="panel-body">
												<div class="tabbable">
													<ul id="myTab2" class="nav nav-tabs">
														<li class="active">
															<a href="#myTab2_example1" data-toggle="tab">
																Tab 1
															</a>
														</li>
														<li>
															<a href="#myTab2_example2" data-toggle="tab">
																Tab 2
															</a>
														</li>
														<li>
															<a href="#myTab2_example3" data-toggle="tab">
																Tab 3
															</a>
														</li>
													</ul>
													<div class="tab-content">
														<div class="tab-pane fade in active" id="myTab2_example1">
															<p>
																Raw denim you probably haven't heard of them jean shorts Austin. Nesciunt tofu stumptown aliqua, retro synth master cleanse. Mustache cliche tempor, williamsburg carles vegan helvetica. Reprehenderit butcher retro keffiyeh dreamcatcher synth.
															</p>
															<p>
																Cosby sweater eu banh mi, qui irure terry richardson ex squid. Aliquip placeat salvia cillum iphone. Seitan aliquip quis cardigan american apparel, butcher voluptate nisi qui.
															</p>
														</div>
														<div class="tab-pane fade" id="myTab2_example2">
															<p>
																Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat, sed diam voluptua. At vero eos et accusam et justo duo dolores et ea rebum. Stet clita kasd gubergren, no sea takimata sanctus est Lorem ipsum dolor sit amet. Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat, sed diam voluptua. At vero eos et accusam et justo.
															</p>
															<p>
																<a href="#myTab2_example3" class="btn btn-blue show-tab">
																	Go to tab 3
																</a>
															</p>
														</div>
														<div class="tab-pane fade" id="myTab2_example3">
															<p>
																Trust fund seitan letterpress, keytar raw denim keffiyeh etsy art party before they sold out master cleanse gluten-free squid scenester freegan cosby sweater. Fanny pack portland seitan DIY, art party locavore wolf cliche high life echo park Austin.
															</p>
															<p>
																<a href="#myTab2_example1" class="btn btn-purple show-tab">
																	Return to tab 1
																</a>
															</p>
														</div>
													</div>
												</div>
											</div>
										</div>
				    </div>
				</div>
				<div class="col-md-1"></div>		
		</div>
	</div>
</div>
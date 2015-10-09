<script src="http://maps.googleapis.com/maps/api/js?sensor=false"></script>
<script type="text/javascript">
// The latitude and longitude of your business / place
<?php if( $this->selectedLocation->getGeolocalisation() ){ ?>
var position = [<?php echo $this->selectedLocation->getGeolocalisation()->getLatitude();?>, <?php echo $this->selectedLocation->getGeolocalisation()->getLongitude();?>];
var latdid,longdid;
latdid=position[0]+0.002;
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
        content: "<div><?php echo $this->selectedLocation->getName();?></div>",
        position: latLng2,
    });
    // Show the default red marker at the location
    marker = new google.maps.Marker({
        position: latLng,
        map: map,
        draggable: false,
        animation: google.maps.Animation.DROP
    });
    marker.addListener('click', function() {
    	map.setZoom(8);
    	map.setCenter(marker.getPosition());
  	});
    infoWindow.open(map, marker);
}
google.maps.event.addDomListener(window, 'load', showGoogleMaps);
<?php } ?>
</script>
<div class="panel panel-white" style="height:800px;margin-right:-15px;margin-left:-15px;">
	<div class="panel-body">
		<div class="row">
		    <div id="googlemaps"></div>
		    	<div class="col-md-6">
				    <div class="panel panel-white" id="contactform">
						<div class=" reservation">
							<iframe src="/reservation?selectedLocationid=<?php echo $this->selectedLocation->getId();?>" width="100%" height="600px" frameborder="0" id="iframe">
								<p>Votre navigateur ne supporte pas l'élément iframe</p>
							</iframe>
						</div>
				    </div>
				</div>
				<div class="col-md-6">
				    <div id="description">
    					<div class="panel panel-white">
							<div class="panel-body">
								<div class="tabbable">
									<ul id="myTab2" class="nav nav-tabs">
										<li class="active">
											<a href="#myTab2_example1" data-toggle="tab">
												<?php echo $this->translate('TXT_WEEKDAYS');?>
											</a>
										</li>
										<li>
											<a href="#myTab2_example2" data-toggle="tab">
												<?php echo $this->translate('TXT_WEEKEND');?>
											</a>
										</li>
										<li>
											<a href="#myTab2_example3" data-toggle="tab">
												<?php echo $this->translate('TXT_DESCRIPTION');?>
											</a>
										</li>
									</ul>
									<div class="tab-content">
										<div class="tab-pane fade in active" id="myTab2_example1">
											<div class="table-responsive">
												<table class="table">
													<tr>
														<td></td><td><b><?php echo $this->translate('SHORT_MONDAY');?></b></td><td><b><?php echo $this->translate('SHORT_TUESDAY');?></b></td><td><b><?php echo $this->translate('SHORT_WEDNESDAY');?></b></td><td><b><?php echo $this->translate('SHORT_THURSDAY');?></b></td><td><b><?php echo $this->translate('SHORT_FRIDAY');?></b></td>
													</tr>
													<?php foreach($this->selectedLocation->getServings() as $serving){ ?>
													<tr>
														<td><b><?php echo $serving->getTitle();?></b></td>
														<td><?php echo $serving->getTimestartmonday();?></td>
														<td><?php echo $serving->getTimestarttuesday();?></td>
														<td><?php echo $serving->getTimestartwednesday();?></td>
														<td><?php echo $serving->getTimestartthursday();?></td>
														<td><?php echo $serving->getTimestartfriday();?></td>
													</tr></tr><tr><tr>
														<td></td>
														<td><?php echo $serving->getTimeendmonday();?></td>
														<td><?php echo $serving->getTimeendtuesday();?></td>
														<td><?php echo $serving->getTimeendwednesday();?></td>
														<td><?php echo $serving->getTimeendthursday();?></td>
														<td><?php echo $serving->getTimeendfriday();?></td>
													</tr>
													<?php } ?>
												</table>
											</div>
										</div>
										<div class="tab-pane fade" id="myTab2_example2">
											<div class="table-responsive">
												<table class="table">
													<tr>
														<td></td><td><b><?php echo $this->translate('SHORT_SATURDAY');?></b></td><td><b><?php echo $this->translate('SHORT_SUNDAY');?></b></td>
													</tr>
													<?php foreach($this->selectedLocation->getServings() as $serving){ ?>
													<tr>
														<td><b><?php echo $serving->getTitle();?></b></td>
														<td><?php echo $serving->getTimestartsaturday();?></td>
														<td><?php echo $serving->getTimestartsunday();?></td>
													</tr>
													<tr>
														<td></td>
														<td><?php echo $serving->getTimeendsaturday();?></td>
														<td><?php echo $serving->getTimeendsunday();?></td>
													</tr>
													<?php } ?>
												</table>
											</div>
										</div>
										<div class="tab-pane fade" id="myTab2_example3">
											<p>
												<?php echo $this->selectedLocation->getDescription();?>
											</p>
										</div>
									</div>
								</div>
							</div>
						</div>
				    </div>
				</div>		
			</div>
		</div>
	</div>
</div>
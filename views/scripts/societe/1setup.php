<?php 
$location = $this->selectedLocation;
//$profile = $this->profile;
if($location->getGeolocalisation() == ""){
 $point = new Object_Data_Geopoint("43,42","79,20");
 $location->setGeolocalisation($point);
 $location->save();exit;
}
$pointlatlng = explode( "; ", $location->getGeolocalisation() );
?>
<script type="text/javascript" src="http://maps.google.com/maps/api/js?sensor=false"></script>
<script type="text/javascript">
var geocoder;
var map;
function initialize() {
	geocoder = new google.maps.Geocoder();
	var latlng = new google.maps.LatLng(<?php if( !empty($pointlatlng[1]) ){echo $pointlatlng[1];} else {echo "43";}?>, <?php if( !empty($pointlatlng[0]) ){echo $pointlatlng[0];} else {echo "79";} ?>);
	var mapOptions = {
		zoom: 15,
		center: latlng,
		mapTypeId: google.maps.MapTypeId.ROADMAP
	}
	var marker = new google.maps.Marker({
		position: latlng,
		map: map,
		title: 'Hello World!'
	});
	map = new google.maps.Map(document.getElementById('map-canvas'), mapOptions);
}

function codeAddress() {
	var address = document.getElementById('address').value + ',' + document.getElementById('city') .value + ',' + document.getElementById('zip').value;
	geocoder.geocode( { 'address': address}, function(results, status) {
		if (status == google.maps.GeocoderStatus.OK) {
			map.setCenter(results[0].geometry.location);
			var marker = new google.maps.Marker({
				map: map,
				position: results[0].geometry.location
			});
			var htmllat=results[0].geometry.location.lat();
			var htmllng=results[0].geometry.location.lng();
			document.getElementById("latresult").value = htmllat;
			document.getElementById("lngresult").value = htmllng;
		} else {
			alert('Geocode was not successful for the following reason: ' + status);
		}
	});
}
google.maps.event.addDomListener(window, 'load', initialize);
</script>
<div class="container">
	<div class="row">
		<div class="col-md-12">
			<div class="panel panel-white">
				<div class="panel-heading">
					<h4 class="panel-title"><span class="text-bold"><?php echo $this->translate('TXT_SETUP_SOCIETE_SET_UP');?> : <?php echo $this->name;?></span></h4>
				</div>
				<div class="panel-body">
					<div class="tabbable">
						<ul id="myTab2" class="nav nav-tabs">
							<li class="active">
								<a href="#myTab2_example1" data-toggle="tab">
									<?php echo $this->translate('TXT_SOCIETE_SETUP_TAB');?>
								</a>
							</li>
							<li>
								<a href="#myTab2_example2" data-toggle="tab">
									<?php echo $this->translate('TXT_SOCIETE_PERSONS_TAB');?>
								</a>
							</li>
							<li>
								<a href="#myTab2_example3" data-toggle="tab">
									<?php echo $this->translate('TXT_SOCIETE_LOCATIONS_TAB');?>
								</a>
							</li>
						</ul>
						<div class="tab-content">
							<div class="tab-pane fade in active" id="myTab2_example1">
								<form action="#" role="form" id="societesetupform" novalidate="novalidate">
									<div class="panel-body">
										<div class="panel-group accordion" id="accordion">
											<div class="panel panel-white">
												<div class="panel-heading">
													<h5 class="panel-title">
													<a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion" href="#collapseOne">
														<i class="icon-arrow"></i> <?php echo $this->translate('SETUP_LOCATION_COMMUNICATION');?>
													</a></h5>
												</div>
												<div id="collapseOne" class="panel-collapse collapse in">
													<div class="panel-body">
														<div class="row">
															<div class="col-md-12 form-horizontal">
																<div class="errorHandler alert alert-danger no-display">
																	<i class="fa fa-times-sign"></i> <?php echo $this->translate('TXT_YOU_HAVE_SOME_ERRORS_PLEASE_CHECK_BELOW');?>
																</div>
																<div class="successHandler alert alert-success no-display">
																	<i class="fa fa-ok"></i> <?php echo $this->translate('TXT_YOUR_FORM_VALIDATION_IS_SUCCESSFULL');?>
																</div>
															</div>
															<div class="col-md-12 form-horizontal">
																<div class="col-md-6">
																	<label class="control-label">
																		<?php echo $this->translate('TXT_SETUP_SOCIETE_NAME');?>
																	</label>
																	<input type="text" placeholder="Text Field" name="name" id="name" class="form-control limited" maxlength="100" value="<?php echo $this->name;?>">
																	<label class="control-label">
																		<?php echo $this->translate('TXT_SETUP_SOCIETE_ADDRESS');?>
																	</label>
																	<input type="text" placeholder="Text Field" name="address" id="address" class="form-control limited" maxlength="100" value="<?php echo $this->address;?>">
																	<label class="control-label">
																		<?php echo $this->translate('TXT_SETUP_SOCIETE_ZIP');?>
																	</label>
																	<input type="text" placeholder="Text Field" name="zip" id="zip" class="form-control limited" maxlength="100" value="<?php echo $this->zip;?>">
																	<label class="control-label">
																		<?php echo $this->translate('TXT_SETUP_SOCIETE_CITY');?>
																	</label>
																	<input type="text" placeholder="Text Field" name="city" id="city" class="form-control limited" maxlength="100" value="<?php echo $this->city;?>">
																</div>
																<div class="col-md-6">
																	<label class="control-label">
																		<?php echo $this->translate('TXT_SETUP_SOCIETE_EMAIL');?>
																	</label>
																	<input type="text" placeholder="Text Field" name="email" id="email" class="form-control limited" maxlength="100" value="<?php echo $this->email;?>">
																	<label class="control-label">
																		<?php echo $this->translate('TXT_SETUP_SOCIETE_TEL');?>
																	</label>
																	<input type="text" placeholder="Text Field" name="tel" id="tel" class="form-control limited" maxlength="100" value="<?php echo $this->tel;?>">
																	<label class="control-label">
																		<?php echo $this->translate('TXT_SETUP_SOCIETE_FAX');?>
																	</label>
																	<input type="text" placeholder="Text Field" name="fax" id="fax" class="form-control limited" maxlength="100" value="<?php echo $this->fax;?>">
																</div>
															</div>
														</div>
														<div class="panel-body">
																<label class="control-label" for="zip"><?php echo $this->translate('MYPROFILE_GEOLOCATION'); ?></label>
										                       <div class="controls">
										                         <button type="button" value="Geocode" onclick="codeAddress()" class="btn btn-primary">Geocode</button>
										                         <p class="help-block"><?php echo $this->translate('MYPROFILE_GEOLOCATION_HELP'); ?></p>
										                       </div>
															<div class="map" id="map-canvas" style='width:100%; height:400px'></div>
														</div>
													</div>
												</div>
											</div>
											<div class="panel panel-white">
												<div class="panel-heading">
													<h5 class="panel-title">
													<a class="accordion-toggle collapsed" data-toggle="collapse" data-parent="#accordion" href="#collapseTwo">
														<i class="icon-arrow"></i> <?php echo $this->translate('SETUP_DEFAULT_TIMEUNITS');?>
													</a></h5>
												</div>
												<div id="collapseTwo" class="panel-collapse collapse">
													<div class="panel-body">
														<div class="row">
														<div class="col-md-12">
															<div class="col-md-6">
																<div class="col-md-12 form-group form-horizontal">
																	<div class="col-md-6">
																		<label class="control-label">
																			<?php echo $this->translate('TXT_SETUP_SOCIETE_UNIT_OF_TIME_FOR_RESA');?> <span class="symbol required"></span>
																		</label>
																	</div>
																	<div class="col-md-6">																				
																		<select class="form-control" id="resaUnit" name="resaUnit">
																			<option value='5' <?php if($this->resaUnit == 5){echo "selected";}?>>5</option>
																			<option value='10' <?php if($this->resaUnit == 10){echo "selected";}?>>10</option>
																			<option value='15' <?php if($this->resaUnit == 15){echo "selected";}?>>15</option>
																		</select>
																	</div>
																</div>
								
								
																<div class="col-md-12 form-group form-horizontal">
																	<div class="col-md-6">
																		<label class="control-label">
																			<?php echo $this->translate('TXT_SETUP_SOCIETE_MEALDURATION');?><span class="symbol required"></span>
																		</label>
																	</div>
																	<div class="col-md-6">
																		<select class="form-control" id="mealduration" name="mealduration">
																			<option value='15' <?php if($this->mealduration == 15){echo "selected";}?>>15</option>
																			<option value='20' <?php if($this->mealduration == 20){echo "selected";}?>>20</option>
																			<option value='25' <?php if($this->mealduration == 25){echo "selected";}?>>25</option>
																			<option value='30' <?php if($this->mealduration == 30){echo "selected";}?>>30</option>
																			<option value='35' <?php if($this->mealduration == 35){echo "selected";}?>>35</option>
																			<option value='40' <?php if($this->mealduration == 40){echo "selected";}?>>40</option>
																			<option value='45' <?php if($this->mealduration == 45){echo "selected";}?>>45</option>
																			<option value='50' <?php if($this->mealduration == 50){echo "selected";}?>>50</option>
																			<option value='55' <?php if($this->mealduration == 55){echo "selected";}?>>55</option>
																			<option value='60' <?php if($this->mealduration == 60){echo "selected";}?>>60</option>
																			<option value='65' <?php if($this->mealduration == 65){echo "selected";}?>>65</option>
																			<option value='70' <?php if($this->mealduration == 70){echo "selected";}?>>70</option>
																			<option value='75' <?php if($this->mealduration == 75){echo "selected";}?>>75</option>
																			<option value='80' <?php if($this->mealduration == 80){echo "selected";}?>>80</option>
																			<option value='85' <?php if($this->mealduration == 85){echo "selected";}?>>85</option>
																			<option value='90' <?php if($this->mealduration == 90){echo "selected";}?>>90</option>
																		</select>
																	</div>
																</div>
															</div>
															<div class="col-md-6">
																<div class="col-md-12 form-group form-horizontal">
																	<div class="col-md-6">
																		<label class="control-label">
																			<?php echo $this->translate('TXT_SETUP_SOCIETE_MAX NUMBER_OF_SEATS');?> <span class="symbol required"></span>
																		</label>
																	</div>
																	<div class="col-md-6">
																		<span class="input-icon">
																			<input type="number" placeholder="<?php echo $this->translate('TXT_SETUP_SOCIETE_PLACEHOLDER_MAX NUMBER_OF_SEATS');?>" class="form-control" id="maxSeats" name="maxSeats" style="width=20px" value="<?php echo $this->maxSeats;?>">
																			<i class="fa fa-hand-o-right"></i>
																		</span>
																	</div>
																</div>
																<div class="col-md-12 form-group form-horizontal">
																	<div class="col-md-6">
																		<label class="control-label">
																			<?php echo $this->translate('TXT_SETUP_SOCIETE_MAX NUMBER_OF_TABLES');?> <span class="symbol required"></span>
																		</label>
																	</div>
																	<div class="col-md-6">										
																		<span class="input-icon">
																		<input type="number" placeholder="<?php echo $this->translate('TXT_SETUP_SOCIETE_PLACEHOLDER_MAX NUMBER_OF_TABLES');?>" class="form-control" id="maxTables" name="maxTables" style="width=20px" value="<?php echo $this->maxTables;?>">
																			<i class="fa fa-hand-o-right"></i>
																		</span>
																	</div>
																</div>
																<div class="col-md-12 form-group form-horizontal">
																	<div class="col-md-6">
																		<label class="control-label">
																			<?php echo $this->translate('TXT_SETUP_SOCIETE_MAX RESA_PER_UNIT');?><span class="symbol required"></span>
																		</label>
																	</div>
																	<div class="col-md-6">																				
																		<span class="input-icon">
																			<input type="number" placeholder="<?php echo $this->translate('TXT_SETUP_SOCIETE_PLACEHOLDER_MAX RESA_PER_UNIT');?>" class="form-control" name="maxResaPerUnit" id="maxResaPerUnit" value="<?php echo $this->maxResaPerUnit;?>">
																			<i class="fa fa-hand-o-right"></i>
																		</span>
																	</div>
																</div>
															</div>
														</div>
													</div>
													</div>
												</div>
											</div>
											<div class="panel panel-white">
												<div class="panel-heading">
													<h5 class="panel-title">
													<a class="accordion-toggle collapsed" data-toggle="collapse" data-parent="#accordion" href="#collapseThree">
														<i class="icon-arrow"></i> <?php echo $this->translate('SETUP_DESCRIPTION_SEASON');?>
													</a></h5>
												</div>
												<div id="collapseThree" class="panel-collapse collapse">
													<div class="panel-body">
														<div class="row">
															<div class="col-md-12 form-group form-horizontal">
																<label class="control-label">
																	<?php echo $this->translate('TXT_SETUP_SOCIETE_COMPANY PRESENTATION');?>
																</label>
																<input type="text" placeholder="Text Field" name="presentation" id="presentation" class="form-control limited" maxlength="100" value="<?php echo $this->description;?>">
															</div>
														</div>
														<hr>
														<div class="row">
															<div class="col-md-12">
																<div class="col-md-6">
																	<div class="col-md-12 form-group form-horizontal">
																		<div class="col-md-6">
																			<label class="control-label">
																				<?php echo $this->translate('TXT_SEASON_CLOSING_START');?> <span class="symbol required"></span>
																			</label>
																		</div>
																		<div class="col-md-6">
																			<span class="input-icon">
																				<input id="closingDateStart" name="closingDateStart" type="text" data-date-format="dd-mm-yyyy" data-date-viewmode="years" class="form-control date-picker" value="<?php echo $this->closingDateStart;?>">
																				<i class="fa fa-hand-o-right"></i>
																			</span>
																		</div>
																	</div>												
																</div>
																<div class="col-md-6">
																	<div class="col-md-12 form-group form-horizontal">
																		<div class="col-md-6">
																			<label class="control-label">
																				<?php echo $this->translate('TXT_SEASON_CLOSING_END');?> <span class="symbol required"></span>
																			</label>
																		</div>
																		<div class="col-md-6">
																			<span class="input-icon">
																				<input id="closingDateEnd" name="closingDateEnd" type="text" data-date-format="dd-mm-yyyy" data-date-viewmode="years" class="form-control date-picker" value="<?php echo $this->closingDateEnd;?>">
																				<i class="fa fa-hand-o-right"></i>
																			</span>
																		</div>
																	</div>												
																</div>								
															</div>
														</div>
														<div class="row">
															<div class="col-md-12">
																<div>
																	<span class="symbol required"></span><?php echo $this->translate('TXT_REQUIRED_FIELDS');?>
																	<hr>
																</div>
															</div>
														</div>
													</div>
												</div>
											</div>
										</div>
									</div>
								</div>
								<div class="row">
									<div class="col-md-8">
											<input id="id" name="id" style="display:none" value="<?php echo $this->id;?>">
									</div>
									<div class="col-md-4">
										<button class="btn btn-yellow btn-block" type="submit" id="submitform">
											<?php echo $this->translate('TXT_SAVE');?> <i class="fa fa-arrow-circle-right"></i>
										</button>
									</div>
								</form>
							</div>
							<div class="tab-pane fade" id="myTab2_example2">
								<table id="personlist" class="table">
							        <thead>
							            <tr>
							                <th></th>
							                <th>First Name</th>
							                <th>Last Name</th>
							                <th>Email</th>
							                <th>Phone</th>
							                <th></th>
							            </tr>
							        </thead>
								</table>
								<br>
							</div>
							<div class="tab-pane fade" id="myTab2_example3">
								<table id="locationlist" class="table">
							        <thead>
							            <tr>
							                <th></th>
							                <th><?php echo $this->translate('TXT_LOCATION_NAME');?></th>
							                <th><?php echo $this->translate('TXT_LOCATION_RESAUNIT');?></th>
							                <th><?php echo $this->translate('TXT_LOCATION_MAXSEATS');?></th>
							                <th><?php echo $this->translate('TXT_LOCATION_MAXTABLES');?></th>
							                <th><?php echo $this->translate('TXT_LOCATION_MAXRESAPERUNIT');?></th>
							                <th></th>
							                <th></th>
							            </tr>
							        </thead>
								</table>
								<br>
							</div>
						</div>
					</div>
				</div>
			</div>
			<!-- end: FORM VALIDATION 1 PANEL -->
		</div>
	</div>
</div>
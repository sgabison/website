<div class="panel panel-white" style="height:800px;margin-right:-15px;margin-left:-15px;">
	<div class="panel-body">
		<div class="row">
<?php 		if($this->societes){
				$i=0;
				foreach($this->societes as $societe){
					foreach( $societe->getLocations() as $location){ 
?>
						<input id="<?= $i;?>" data-long="<?php if( $location->getGeolocalisation() ){echo $location->getGeolocalisation()->getLongitude();} ?>" data-lat="<?php if( $location->getGeolocalisation() ){echo $location->getGeolocalisation()->getLatitude();} ?>" data-name="<?php echo $location->getName();?>" data-address="<?php echo $location->getAddress();?>" data-zip="<?php echo $location->getZip();?>" data-city="<?php echo $location->getCity();?>" data-tel="<?php echo $location->getTel();?>" data-id="<?php echo $location->getId();?>" class="no-display">
<?php 
						$i++;
					} 
				} 
			 } 
?>
			<input id="len" class="no-display" value="<?= $i;?>">
		    <div class="col-md-12">
		    	<div class="col-md-6" id="map2panel">
					<div>
						<div class="">
							<h4 class="panel-title">Restaurants <span class="text-bold">"La Criée" </span></h4>
<!--
							<div class="panel-tools">										
								<a class="btn btn-xs btn-link panel-close" href="#"> <i class="fa fa-times"></i> </a>
							</div>
-->
						</div>
						<div class="">
							<div style="margin-left:-15px;margin-right:-15px">
		   						<div id="map2" style="width:100%;height:600px"></div>
		   					</div>
		   				</div>
		   			</div>
		   		</div>
		    	<div class="col-md-6 restaurantpanel no-display">
				    <div id="contactform">
						<div class="reservation" style="margin-right:-15px;margin-left:-15px;">
							<iframe src="/reservation?selectedLocationid=<?php echo $this->selectedLocation->getId();?>" width="100%" height="700px" frameborder="0" id="iframe">
								<p>Votre navigateur ne supporte pas l'élément iframe</p>
							</iframe>
						</div>
				    </div>
				</div>
		    	<div class="col-md-6 hidden-xs">
					<div class="">
						<div class="">
							<h4 class="panel-title"><span class="text-bold" id="locname"><?php echo $this->selectedLocation->getName();?></span></h4>
<!--
							<div class="panel-tools">										
								<a class="btn btn-xs btn-link panel-close" href="#"> <i class="fa fa-times"></i> </a>
							</div>
-->
						</div>
						<div class="">
							<input id="selectedLat" class="no-display" value="<?php if($this->selectedLocation->getGeolocalisation()){echo $this->selectedLocation->getGeolocalisation()->getLatitude();}?>">
							<input id="selectedLong" class="no-display" value="<?php if($this->selectedLocation->getGeolocalisation()){echo $this->selectedLocation->getGeolocalisation()->getLongitude();}?>">
		   					<div id="map3" style="width:100%;height:400px"></div>
		   				</div>
		   			</div>
		   		</div>
				<div class="col-md-6 restaurantpanel no-display hidden-xs">
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
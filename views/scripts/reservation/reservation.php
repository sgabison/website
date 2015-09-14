<div class="ajax-white-backdrop" style="display: block;"></div>
<!-- start: FORM VALIDATION 1 PANEL -->
<div class="panel panel-white">
	<div class="panel-heading">
		<h4 class="panel-title"><?php echo $this->translate('TXT_BOOK_A_TABLE');?> <?php echo $this->translate('TXT_AT');?> 
			<span class="text-bold"> <?php echo $this->selectedLocation->getName();?></span>
		</h4>
		<div class="panel-tools">
			<a class="panel-expand" href="#">
				<i class="fa fa-expand"></i> <span><?php echo $this->translate('TXT_FULLSCREEN');?></span>
			</a>
		</div>
		<span class="text-bold" id="locationbox">
			<input id="language" class="no-display" value="<?php echo $this->language;?>">
			<input id="closeddays" class="no-display" value=<?php echo $this->closeddays;?>> 
			<input id="offdays" class="no-display" value="<?php echo $this->offdaysrange;?>"> 
			<input id="method2" name="method2" value="PUT" class="no-display">  
			<input id="select_location" value='<?php echo $this->selectedLocation->getId();?>' class="no-display" disabled> 
		</span>
	</div>
	<div class="panel-body" id="reservationform">
		<form role="form" id="bookingform" novalidate="novalidate">
			<div class="row">
				<div class="col-md-12">
					<div class="errorHandler alert alert-danger no-display">
						<i class="fa fa-times-sign"></i> <?php echo $this->translate('TXT_YOU_HAVE_ERRORS');?>
					</div>
					<div class="successHandler alert alert-success no-display">
						<i class="fa fa-ok"></i> <?php echo $this->translate('TXT_VALIDATION');?>
					</div>
				</div>
					<div class="col-md-6 selectiongroup">
						<div class="form-group">
							<span class="text-bold no-display" id="locationlink">
								<h4>
									<a class="linkhref locationhref locationlinkfinal"><span id="locationlinkdata"></span></a> <?php echo $this->translate('TXT_ON_THE');?> <a class="linkhref calendarhref locationlinkfinal"><span class="text-bold" id="calendarlinkdata"></span></a>
								</h4>
								<input id="method" name="method" value="<?php if($this->getParam('reservationid')){echo 'PUT';}else{echo 'POST';}?>" class="no-display">
							</span>
						</div>
						<div class="form-group">
							<div class="input-group date" id="calendarbox">
								<input id="mycalendar" disabled name="calendar" type="text" data-date-format="dd-mm-yyyy" data-date-viewmode="years" class="form-control date-picker mycalendar" value="<?php if($this->resachange){echo $this->start->get('dd-MM-YYYY');}else{$date=new \Zend_date(); echo $date->get('dd-MM-yyyy');}?>">
								<span class="input-group-addon"> <i class="fa fa-calendar"></i> </span>
							</div>
						</div>	
						<div class="form-group">
							<select id="party" name="party" class="form-control">
								<?php $i=0; while($i<16){ 
									$i++;
									if($i==2){$select='selected';}else{$select='';};
									echo "<option value='".$i."' ".$select.">".$this->translate('TXT_FOR')." ".$i." ".$this->translate('TXT_PEOPLE')."</option>";
							     } ?>
							</select>
						</div>
						<div class="form-group bookbutton" >
							<span class="btn btn-dark-orange btn-block book"><?php echo $this->translate('TXT_BOOK_A_TABLE');?> <i class="fa fa-arrow-circle-right"></i></span>
						</div>
						<span class='no-display' id='selectgroup'>
							<div class="form-group">
								<label class="control-label">
									<?php echo $this->translate('TXT_SELECT_SERVING');?> <span class="symbol required"></span>
								</label>
								<div id="servings" class="space20 panel-body buttons-widget"></div>
							</div>
							<div class="form-group">
								<label class="control-label">
									<?php echo $this->translate('TXT_SELECT_TIMESLOT');?> <span class="symbol required"></span>
								</label>
								<div id="slots" class="space20 panel-body buttons-widget"></div>
							</div>
						</span>
					</div>
					<div class="col-md-6 no-display registergroup">
						<div class="form-group">
							<label class="control-label">
								<?php echo $this->translate('TXT_GUEST_TEL');?><span class="symbol required"></span>
							</label>
							<span class="input-icon">
							<input  placeholder="06XXXXXXXX" class="form-control typeahead" id="tel" name="tel" maxlength="10" value='<?php echo $this->tel;?>' size='10'>
							<i class="telephone fa fa-phone"></i>
							</span>
						</div>
						<div class="form-group">
							<label class="control-label">
								<?php echo $this->translate('TXT_GUEST_NAME');?> <span class="symbol required"></span>
							</label>
							<span class="input-icon">
							<input type="text" placeholder="Insert your Name" class="form-control" id="firstlastname" name="firstlastname" value='<?php echo $this->firstlastname;?>'>
							<i class="fa fa-user"></i>
							</span>
						</div>
						<div class="form-group">
							<label class="control-label">
								<?php echo $this->translate('TXT_GUEST_EMAIL_ADDRESS');?> <span class="symbol required"></span>
							</label>
							<span class="input-icon">
							<input type="email" placeholder="Email@address.com" class="form-control" id="email" name="email" value='<?php echo $this->email;?>'>
							<i class="fa fa-envelope"></i>
							</span>
						</div>									
						<div class="form-group">
							<div class="panel panel-white">
								<div class="panel-heading">
									<label class="control-label"><?php echo $this->translate('TXT_SPECIFIC_REQUESTS');?></label>
									<div class="panel-tools">
										<div class="dropdown">
											<a class="panel-collapse expand" href="#"><i class="fa fa-angle-up"></i> <span>Expand</span> </a>
										</div>
									</div>
								</div>
								<div class="panel-body" style="display:none" id='tagpanel'>
									<button type="button" class="btn btn-sm btn-tags btn-dark-orange" value="<?php echo $this->translate('TXT_WARNING_BABY');?>" style="margin:5px"><?php echo $this->translate('TXT_WARNING_BABY');?></button>
									<button type="button" class="btn btn-sm btn-tags btn-dark-orange" value="<?php echo $this->translate('TXT_WARNING_WHEELCHAIR');?>" style="margin:5px"><?php echo $this->translate('TXT_WARNING_WHEELCHAIR');?></button>
									<button type="button" class="btn btn-sm btn-tags btn-dark-orange" value="<?php echo $this->translate('TXT_WARNING_SPECIATABLE');?>" style="margin:5px"><?php echo $this->translate('TXT_WARNING_SPECIATABLE');?></button>
									<button type="button" class="btn btn-sm btn-tags btn-dark-orange" value="<?php echo $this->translate('TXT_WARNING_NUTALLERGY');?>" style="margin:5px"><?php echo $this->translate('TXT_WARNING_NUTALLERGY');?></button>
									<input id="tags_1" type="text" class="tags" value='<?php echo $this->bookingnotes;?>'>
								</div>
							</div>
						</div>
						<div class="form-group">
							<hr>
							<label class="control-label">
								<strong><?php echo $this->translate('TXT_SIGNUP_NEWSLETTER');?></strong> <span class="symbol required"></span>
							</label>
							<p>
								<?php echo $this->translate('TXT_WANT_TO_SIGNUP_NEWSLETTER');?>
							</p>
							<div>
								<label class="radio-inline">
									<input type="radio" class="grey" value="" name="newsletter">
									<?php echo $this->translate('TXT_NO');?>
								</label>
								<label class="radio-inline">
									<input type="radio" class="grey" value="" name="newsletter">
									<?php echo $this->translate('TXT_YES');?>
								</label>
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
			<div class="row no-display registergroup">
				<div class="col-md-8">
					<p>
						<?php echo $this->translate('TXT_AGREED_TERMS_1');?> <a href="#"><?php echo $this->translate('TXT_AGREED_TERMS_2');?></a>
					</p>
				</div>
				<div id="inputs"></div>
				<div class="col-md-4">
					<button class="btn btn-dark-orange btn-block" type="submit" value='submit' id='submit'>
						<?php echo $this->translate('TXT_BOOK_A_TABLE');?> <i class="fa fa-arrow-circle-right"></i>
					</button>
				</div>
			</div>
		</form>
	</div>
	<div class="panel-body no-display" id="confirmationform">
		<div class="successHandler alert alert-success">
				<h4><?php echo $this->translate('TXT_YOUR_RESERVATION_IS_CONFIRMED');?></h4>
				<?php echo $this->translate('TXT_YOU_WILL RECEIVE_CONFIRMATION');?><br>
				<?php echo $this->translate('TXT_YOU_WILL RECEIVE_CONFIRMATION_SMS');?>
		</div>
		<div class="col-md-6">
			<div class="panel">
				<div class="panel-heading border-light panel-orange">
					<h4 class="panel-title"><?php echo $this->translate('TXT_DETAILS_OF_YOUR');?> <span class="text-bold"><?php echo $this->translate('TXT_RESERVATION');?></span></h4>
				</div>
				<div class="panel-body">
					<h4><span class="text-bold"><?= $this->selectedLocation->getName();?></span></h4>
					<div>
						<?= $this->selectedLocation->getAddress();?>, <?= $this->selectedLocation->getZip();?>, <?= $this->selectedLocation->getCity();?><br>
						<?= $this->selectedLocation->getTel();?>
					</div>
					<h4><span class="text-bold"><span id='finaldate'></span></span></h4>
					<div>
						<span id='finalpartysize'></span> <?php echo $this->translate('TXT_PERSONS_AT');?> <span id='finaltimeslot'></span>
					</div>
					<h4><span class="text-bold"><span id='finalguestname'></span></span></h4>
					<div>
						<span id='finalguestemail'></span><br>
						<span id='finalguesttel'></span>
					</div>
					<h4><span class="text-bold"><?php echo $this->translate('TXT_REFERENCE_NER');?> <span id='finalid'></span></span></h4>
				</div>
			</div>
		</div>
		<div class="col-md-6">
			<div class="panel">
				<div class="panel-heading border-light panel-orange">
					<h4 class="panel-title"><?php echo $this->translate('TXT_WHAT');?> <span class="text-bold"><?php echo $this->translate('TXT_NEXT');?></span></h4>
				</div>
				<div class="panel-body">
					<a class="btn btn-social btn-primary btn-block" data-target=".bs-example-modal-basic" data-toggle="modal" id="mapmodal" ><i class="fa fa-map-marker"></i> <?php echo $this->translate('TXT_CHECK_LOCATION');?></a>
					<a class="btn btn-social btn-facebook btn-block" href="/liste-reservations-search"><i class="fa fa-gears"></i> <?php echo $this->translate('TXT_LIST_RESERVATION');?></a>
					<a class="btn btn-social btn-success btn-block" href="/evenements"><i class="fa fa-calendar"></i> <?php echo $this->translate('TXT_TITLE_EVENT');?></a>
					<a class="btn btn-social btn-purple btn-block" href="/reserver"><i class="fa fa-reply"></i> <?php echo $this->translate('TXT_MAKE_NEW_RESERVATION');?></a>
				</div>
			</div>
		</div>
	</div>
</div>
<!-- end: FORM VALIDATION 1 PANEL -->
<div aria-hidden="true" aria-labelledby="myModalLabel" role="dialog" tabindex="-1" class="modal bs-example-modal-basic fade">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button aria-hidden="true" data-dismiss="modal" class="close" type="button">
					×
				</button>
				<h4 id="myModalLabel" class="modal-title"><?php echo $this->translate('TXT_LOCATION');?></h4>
			</div>
			<div class="modal-body">
				<input class="no-display" id="latlong" value="<?= $this->selectedLocation->getGeolocalisation();?>">
				<div class="map" id="map2" style="width:400px; height:400px"></div>
				<!--<div id="map-canvas" style="width:90%;height:300px"></div>
                   <input id="latresult" name="latresult" value='' style="display:none">
                   <input id="lngresult" name="lngresult" value='' style="display:none">-->
			</div>
			<div class="modal-footer">
				<button data-dismiss="modal" class="btn btn-default" type="button">
					<?php echo $this->translate('TXT_CLOSE');?>
				</button>
			</div>
		</div>
		<!-- /.modal-content -->
	</div>
	<!-- /.modal-dialog -->
</div>
<div class="ajax-white-backdrop" style="display: block;"></div>

			<!-- start: FORM VALIDATION 1 PANEL -->
			<div class="panel panel-white">
				<div class="panel-heading">
					<h4 class="panel-title">Reserve 
						<span class="text-bold">a Table at </span>
					</h4>
					<div class="panel-tools">
						<div class="dropdown">
							<a data-toggle="dropdown" class="btn btn-xs dropdown-toggle btn-transparent-grey">
								<i class="fa fa-cog"></i>
							</a>
							<ul class="dropdown-menu dropdown-light pull-right" role="menu">
								<li>
									<a class="panel-collapse collapses" href="#"><i class="fa fa-angle-up"></i> <span>Collapse</span> </a>
								</li>
								<li>
									<a class="panel-refresh" href="#">
										<i class="fa fa-refresh"></i> <span>Refresh</span>
									</a>
								</li>
								<li>
									<a class="panel-config" href="#panel-config" data-toggle="modal">
										<i class="fa fa-wrench"></i> <span>Configurations</span>
									</a>
								</li>
								<li>
									<a class="panel-expand" href="#">
										<i class="fa fa-expand"></i> <span>Fullscreen</span>
									</a>
								</li>
							</ul>
						</div>
						<a class="btn btn-xs btn-link panel-close" href="#">
							<i class="fa fa-times"></i>
						</a>
					</div>
				</div>
				<div class="panel-body">
					<form role="form" id="bookingform" novalidate="novalidate">
						<div class="row">
							<div class="col-md-12">
								<div class="errorHandler alert alert-danger no-display">
									<i class="fa fa-times-sign"></i> You have some form errors. Please check below.
								</div>
								<div class="successHandler alert alert-success no-display">
									<i class="fa fa-ok"></i> Your form validation is successful!
								</div>
							</div>
								<div class="col-md-6 selectiongroup">
									<div class="form-group">		
										<span class="text-bold" id="locationbox"> 
											<select id="select_location">
											<?php $i=0;foreach($this->locations as $location){ ?>
												<option value='<?php echo $location->getId();?>' 
												<?php 
												if($this->selectedlocationid){
													if($location->getId()==$this->selectedlocationid){
														echo 'selected';
													}
												}else{
													if($i==0){ echo 'selected';}
												}
												?>>
												<?php echo $location->getName();?>
												</option>
											<?php $i++;} ?>
											</select>
										</span>
										<span class="text-bold no-display" id="locationlink">
											<h4>
												<a class="linkhref locationhref locationlinkfinal"><span id="locationlinkdata"></span></a> on the <a class="linkhref calendarhref locationlinkfinal"><span class="text-bold" id="calendarlinkdata"></span></a>
											</h4>
										</span>
									</div>
								
									<div class="form-group">
										<div class="input-group" id="calendarbox">
											<input name="calendar" type="text" data-date-format="dd-mm-yyyy" data-date-viewmode="years" class="form-control date-picker mycalendar" value="<?php if($this->resachange){echo $this->start->get('dd-MM-yyyy');}else{echo $this->getParam('resadate');}?>">
											<span class="input-group-addon"> <i class="fa fa-calendar"></i> </span>
										</div>
									</div>	
									<div class="form-group">
										<label class="control-label">
											Select # of people in your party <span class="symbol required"></span>
										</label>
										<select id="party" name="party" class="form-control">
											<?php $i=0; while($i<16){ 
												$i++;
												if($i==2){$select='selected';}else{$select='';};
												echo "<option value='".$i."' ".$select.">".$i."</option>";
										     } ?>
										</select>
									</div>
									<div class="form-group bookbutton" >
										<span class="btn btn-dark-orange btn-block book">Book a table <i class="fa fa-arrow-circle-right"></i></span>
									</div>
									<span class='no-display' id='selectgroup'>
										<div class="form-group">
											<label class="control-label">
												Select Serving <span class="symbol required"></span>
											</label>
											<div id="servings" class="space20 panel-body buttons-widget"></div>
										</div>
										<div class="form-group">
											<label class="control-label">
												Select Time slot <span class="symbol required"></span>
											</label>
											<div id="slots" class="space20 panel-body buttons-widget"></div>
										</div>
									</span>
								</div>
								<div class="col-md-6 no-display registergroup">
									<div class="form-group">
										<label class="control-label">
											<?php echo $this->translate('TXT_YOUR_NAME');?> <span class="symbol required"></span>
										</label>
										<input type="text" placeholder="Insert your Name" class="form-control" id="firstlastname" name="firstlastname" value='<?php echo $this->firstlastname;?>'>
									</div>
									<div class="form-group">
										<label class="control-label">
											<?php echo $this->translate('TXT_YOUR_TEL');?><span class="symbol required"></span>
										</label>
										<input type="tel" placeholder="06XXXXXXXX" class="form-control" id="tel" name="tel" maxlength="10" value='<?php echo $this->tel;?>'>
									</div>
									<div class="form-group">
										<label class="control-label">
											<?php echo $this->translate('TXT_YOUR_EMAIL_ADDRESS');?> <span class="symbol required"></span>
										</label>
										<input type="email" placeholder="Email@address.com" class="form-control" id="email" name="email" value='<?php echo $this->email;?>'>
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
											Would you like to signup for the newsletter?
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
									<span class="symbol required"></span>Required Fields
									<hr>
								</div>
							</div>
						</div>
						<div class="row no-display registergroup">
							<div class="col-md-8">
								<p>
									By clicking REGISTER, you are agreeing to the Policy and Terms &amp; Conditions.
								</p>
							</div>
							<div id="inputs" style="display:none"></div>
							<div class="col-md-4">
								<button class="btn btn-dark-orange btn-block" type="submit" value='submit' id='submit'>
									Register <i class="fa fa-arrow-circle-right"></i>
								</button>
							</div>
						</div>
					</form>
				</div>
			</div>
			<!-- end: FORM VALIDATION 1 PANEL -->

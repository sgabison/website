
								<!-- start: FORM VALIDATION 2 PANEL -->
								<div class="panel panel-white">
									<div class="panel-heading">
										<h4 class="panel-title">Creation Compte Societe<span class="text-bold"> Booking</span></h4>
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
										<h2><i class="fa fa-pencil-square"></i><?php echo $this->t("TXT_REGISTER_SOCIETE")?></h2>
										<p>
											Create one account to manage everything you do with your Restaurant activity.
										</p>
										<hr>
										<form action="#" role="form" id="create-society" novalidate>
											<div class="row">
												<div class="col-md-12">
													<div class="errorHandler alert alert-danger no-display">
														<i class="fa fa-times-sign"></i> You have some form errors. Please check below.
													</div>
													<div class="successHandler alert alert-success no-display">
														<i class="fa fa-ok"></i> Your form validation is successful!
													</div>
												</div>
												<div class="col-md-6">
													<div class="form-group">
														<label class="control-label">
															Name <span class="symbol required"></span>
														</label>
														<input type="text" placeholder="Insert Society Name" class="form-control" id="name" name="name" value="<?php if($this->societe): echo $this->societe->getName();endif;?>" >
													</div>
													<div class="form-group">
														<label class="control-label">
															Reference <span class="symbol required"></span>
														</label>
														<input type="text" placeholder="Insert your Reference" class="form-control" id="reference" name="reference" value="<?php if($this->societe): echo $this->societe->getReference();endif;?>" >
													</div>
													<div class="form-group">
														<label class="control-label">
															Id<span class="symbol required"></span>
														</label>
														<input readonly="readonly" type="text" placeholder="Society id" class="form-control" id="id" name="id" value="<?php if($this->societe): echo $this->societe->getId(); endif;?>" >
													</div>
													<div class="form-group">
														<label class="control-label">
															Description <span class="symbol required"></span>
														</label>
														<input type="text" class="form-control" name="description" id="description" value="<?php if($this->societe): echo $this->societe->getDescription(); endif;?>" >
													</div>
												</div>
												<div class="col-md-6">

													<div class="form-group connected-group">
														<label class="control-label">
															<?php echo $this->t("TXT_ADDRESS")?> <span class="symbol required"></span>
														</label>
														<input type="text" class="form-control" id="address" name="address" value="<?php if($this->societe): echo $this->societe->getAddress(); endif;?>" >
													</div>
													
													<div class="row">
														<div class="col-md-4">
															<div class="form-group">
																<label class="control-label">
																	<?php echo $this->t("TXT_ZIPCODE")?> <span class="symbol required"></span>
																</label>
																<input class="form-control" type="text" name="zip" id="zip" value="<?php if($this->societe): echo $this->societe->getZip(); endif;?>" >
															</div>
														</div>
														<div class="col-md-8">
															<div class="form-group">
																<label class="control-label">
																	<?php echo $this->t("TXT_CITY")?> <span class="symbol required"></span>
																</label>
																<input class="form-control tooltips" type="text" data-original-title="We'll display it when you write reviews" data-rel="tooltip"  title="" data-placement="top" name="city" id="city" value="<?php if($this->societe): echo $this->societe->getCity(); endif;?>">
															</div>
														</div>
													</div>
													<div class="form-group connected-group">
														<label class="control-label">
															Email <em>(e.g: your@site.com)</em> <span class="symbol required"></span>
														</label>
														<input type="email" class="form-control" id="email" name="email" value="<?php if($this->societe): echo $this->societe->getEmail(); endif;?>">
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
											<div class="row">
												<div class="col-md-8">
													<p>
														By clicking REGISTER, you are agreeing to the Policy and Terms &amp; Conditions.
													</p>
												</div>
												<div class="col-md-4">
													<button class="btn btn-yellow btn-block" type="submit">
														<?php echo $this->t("TXT_REGISTER_SOCIETE")?> <i class="fa fa-arrow-circle-right"></i>
													</button>
												</div>
											</div>
										</form>
									</div>
								</div>
								<!-- end: FORM VALIDATION 2 PANEL -->
						

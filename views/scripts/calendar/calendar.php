
								<!-- start: FULL CALENDAR PANEL -->
								<div class="panel panel-white">
									<div class="panel-heading">
										<i class="fa fa-calendar"></i>
										<?php echo $this->t('TXT_TITLE_RAPPORT')?> <?php echo ($this->selectedLocation)? $this->selectedLocation->getName():$this->t("TXT_CHOISIR_LOCATION");?>
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
										
										<div class="col-sm-12">
											<div id='rapport-calendar'></div>
										</div>
										
									</div>
								</div>
								<!-- end: FULL CALENDAR PANEL -->

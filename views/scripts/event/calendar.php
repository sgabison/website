
								<!-- start: FULL CALENDAR PANEL -->
								<div class="panel panel-white">
									<div class="panel-heading">
										<i class="fa fa-calendar"></i>
										<?php echo $this->t('TXT_TITLE_EVENT')?> <?php echo ($this->selectedLocation)? $this->selectedLocation->getName():$this->t("TXT_CHOISIR_LOCATION");?>
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
										<div class="col-sm-12 space20">
											<a href="#newFullEvent" class="btn btn-green add-event"><i class="fa fa-plus"></i> <?php echo $this->t('TXT_ADD_EVENT')?></a>
										</div>
										<div class="col-sm-9">
											<div id='full-calendar'></div>
										</div>
										<div class="col-sm-3">
											<h4 class="space20"><?php echo $this->t('TXT_EVENT_CATEGORIES')?></h4>
											<?php if($this->categories):?>
											<div id="event-categories">
											<?php Foreach ($this->categories as $category): ?>
												<div class="event-category event-<?php echo $category?>" data-class="event-<?php echo $category?>">
													<?php echo $this->t($category)?>
												</div>
											<?php endforeach ; ?>
											<!--
												<div class="checkbox">
													<label>
														<input type="checkbox" class="grey" id="drop-remove" />
														Remove after drop
													</label>
												</div>
											-->
											</div>
											<?php endif; ?>
										</div>
									</div>
								</div>
								<!-- end: FULL CALENDAR PANEL -->

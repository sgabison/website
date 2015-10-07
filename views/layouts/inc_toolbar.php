<!-- start: TOOLBAR -->
						<div class="toolbar row">
							<div class="col-sm-6 hidden-xs">
								<div class="page-header">
									<h1><?php echo $this->document->getTitle()?><small><?php echo $this->societe->getName()?></small></h1>
								</div>
							</div>
							<div class="col-sm-6 col-xs-12">
								<div class="toolbar-tools-stats pull-right">
									<!-- start: TOP NAVIGATION MENU -->
									<ul class="nav navbar-right">
										<!-- start: TO-DO DROPDOWN Language-->
										<li class="dropdown">
											<a data-toggle="dropdown" data-hover="dropdown" class="dropdown-toggle" data-close-others="true" href="#">
												<i class="fa fa-language"></i> <?php echo ($this->language)? $this->language : $this->t("TXT_CHOISIR_LANGUE");?>
											</a>
											<ul class="dropdown-menu dropdown-light dropdown-langage">
												
												<?php if($this->languageOptions and count($this->languageOptions)>1):?>
												<li class="dropdown-header">
													<?php echo $this->t("TXT_LANGUES")?>
												</li>
												 <?php foreach($this->languageOptions as $l) :?>
												<li <?php if(substr($this->language,0,2) == substr($l["language"],0,2)) {?> class="active" <?php } ?>>
													<a href="?<?php if($_SERVER['QUERY_STRING']) echo  $_SERVER['QUERY_STRING'].'&'; ?>lg=<?php echo $l["language"] ?>" data-location="<?php echo $l["language"] ?>" class="new-language">
														<span class="fa-stack"> <i class="fa fa-language fa-lg"></i> </span> <?php echo $l["display"] ?></a>
												</li>
												<?php   endforeach; endif; ?>				
											</ul>
										</li>
										<!-- start: TO-DO DROPDOWN Locations-->
								<?php if( $this->person->getPermits()==1 ){ ?>
										<li class="dropdown">
											<a data-toggle="dropdown" data-hover="dropdown" class="dropdown-toggle" data-close-others="true" href="#">
												<i class="fa fa-cutlery"></i> <?php echo ($this->selectedLocation)? $this->selectedLocation->getName():$this->t("TXT_CHOISIR_LOCATION");?>
											</a>
											<ul class="dropdown-menu dropdown-light dropdown-location">
												
												<?php if($this->locations and count($this->locations)>1):?>
												<li class="dropdown-header">
													<?php echo $this->t("TXT_LOCATIONS")?>
												</li>
												<?php foreach($this->locations as $location) : ?>
												 
												<li <?php if($location->getId() == $this->selectedLocation->getId()) {?> class="active" <?php } ?>>
													<a href="?selectedLocationId=<?php echo $location->getId() ?>" data-location="<?php echo $location->getId() ?>" class="new-location">
														<span class="fa-stack"> <i class="fa fa-cutlery fa-lg"></i> </span> <span class="glyphicon-class"><?php echo $location->getName()?></span></a>
												</li>
												<?php   endforeach; endif; ?>				
											</ul>
										</li>
								<?php } else { ?>
									<li class="dropdown">
										<a data-toggle="dropdown" data-hover="dropdown" class="dropdown-toggle" data-close-others="true" href="#">
											<i class="fa fa-cutlery"></i> <?php echo ($this->selectedLocation)? $this->selectedLocation->getName():$this->t("TXT_CHOISIR_LOCATION");?>
										</a>
									</li>								
								<?php } ?>
										<li class="dropdown menu-search">
											<a href="#">
												<i class="fa fa-search"></i> <?php echo $this->t("TXT_SEARCH");?>
											</a>
											<!-- start: SEARCH POPOVER -->
											<div class="popover bottom search-box transition-all">
												<div class="arrow"></div>
												<div class="popover-content">
													<!-- start: SEARCH FORM -->
													<form class="" id="searchform" action="/data/guest/search">
														<div class="input-group">
															<input type="text" name="q" class="form-control" placeholder="Search">
															<span class="input-group-btn">
																<button class="btn btn-main-color btn-squared" type="button">
																	<i class="fa fa-search"></i>
																</button> </span>
														</div>
													</form>
													<!-- end: SEARCH FORM -->
												</div>
											</div>
											<!-- end: SEARCH POPOVER -->
										</li>
									</ul>
									<!-- end: TOP NAVIGATION MENU -->
								</div>
							</div>
						</div>
						<!-- end: TOOLBAR -->
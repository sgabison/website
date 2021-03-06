<!-- start: DYNAMIC TABLE PANEL -->
<div class="panel panel-white">
	<div class="panel-heading">
		<h4 class="panel-title">
			<span class="text-bold"><?php if($this->selectedLocation) : echo $this->selectedLocation->getName() ; endif;?></span>
		</h4>
	</div>
	<div class="panel-body">
		<div class="tabbable">
			<ul id="myTab2" class="nav nav-tabs">
				<li class="active">
					<a href="#intro" data-toggle="tab">
						<?php echo $this->translate('TXT_INTRODUCTION');?>
					</a>
				</li>
				<li class="stats">
					<a href="#statistics" data-toggle="tab">
						<?php echo $this->translate('TXT_STATISTICS');?>
					</a>
				</li>
			</ul>
			<div class="tab-content">
				<div class="tab-pane fade in active" id="intro">
					<div class="row">
						<div class="col-lg-4 col-md-6 col-sm-6 col-xs-12">
							<div>
								<?php include( PIMCORE_LAYOUTS_DIRECTORY ."/inc_meteo.php") ; ?>
							</div>
							<div class="panel panel-red">
								<div class="panel-heading border-light">
									<h4 class="panel-title"><?php echo $this->translate('TXT_TODAY');?></h4>
								</div>
								<div class="panel-body">
									<div class="col-xs-6">
										<div class="actual-date">
											<span class="actual-day"></span>
											<span class="actual-month"></span>
										</div>
									</div>
									<div class="col-xs-6">
										<div class="row">
											<div class="col-xs-12">
												<div class="clock-wrapper">
													<div class="clock">
														<div class="circle">
															<div class="face">
																<div id="hour"></div>
																<div id="minute"></div>
																<div id="second"></div>
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
						<div class="col-lg-4 col-md-6 col-sm-6 col-xs-12">
							<div class="row">
								<div class="panel panel-white">
									<div class="panel-heading border-light">
										<h4 class="panel-title"><?php echo $this->translate('TXT_QUICK_ACCESS');?></h4>
									</div>
									<div class="panel-body">
										<div class="space20">
											<a class="btn btn-block btn-lg btn-red" href='/reserver'><?php echo $this->translate('TXT_BOOK_A_TABLE');?></a>
										</div>
										<div class="space20">
											<a class="btn btn-block btn-lg btn-blue" href='/liste-reservations?calendar=<?php $today=new Zend_Date();echo $today->get("dd-MM-YYYY");?>'><?php echo $this->translate('TXT_LIST_RESERVATIONS_TODAY');?></a>
										</div>						
										<div class="space20">
											<a class="btn btn-block btn-lg btn-green" href='/booking-calendar'><?php echo $this->translate('TXT_CALENDRIER_RESERVATION');?></a>
										</div>						
									</div>
								</div>
							</div>
						</div>
						<div class="col-lg-4 col-md-6 col-sm-6 col-xs-12">
							<div class="panel-heading">
								<h4 class="panel-title"><?php echo $this->translate('QUICK_SUMMARY');?></h4>
							</div>
							<div class="panel-body">
								<?php foreach( $this->todayreport as $report){?>
								<div class="col-md-6">
									<div class="space20">
										<a class="btn btn-block btn-lg btn-blue" href='/booking-calendar'>
											<h5 class="text-white semi-bold no-margin p-b-5"><?php echo $report['name'];?></h5>
											<h1><?php echo $report['nbre'];?></h1>
											<span style="font-size:small"><?php echo $this->translate('ORDERS');?></span><br>
											<span style="font-size:small"><?php echo $this->translate('TXT_TODAY');?></span>
										</a>
									</div>
								</div>
								<?php } ?>
								<?php foreach( $this->tomorrowreport as $report){?>
								<div class="col-md-6">
									<div class="space20">
										<a class="btn btn-block btn-lg btn-green" href='/booking-calendar'>
											<h5 class="text-white semi-bold no-margin p-b-5"><?php echo $report['name'];?></h5>
											<h1><?php echo $report['couverts'];?></h1>
											<span style="font-size:small"><?php echo $this->translate('SEATS');?></span><br>
											<span style="font-size:small"><?php echo $this->translate('TXT_TOMORROW');?></span>
										</a>
									</div>
								</div>
								<?php } ?>
							</div>
						</div>
					</div>
				</div>
				<div class="tab-pane fade" id="statistics">
					<div class="row">
						<div class="col-md-6">
							<div class="panel panel-white">
								<div class="panel-heading border-light">
									<h4 class="panel-title"><?php echo $this->translate('LAST_SEVEN');?></h4>
								</div>
								<div class="panel-body">
									<div class="addsparkline"></div>
									<div class="addsparkline2"></div>
								</div>
							</div>
						</div>
						<div class="col-md-6">
							<div class="panel panel-white">
								<div class="panel-heading border-light">
									<h4 class="panel-title"><?php echo $this->translate('NEXT_SEVEN');?></h4>
								</div>
								<div class="panel-body">
									<div class="addsparkline3"></div>
									<div class="addsparkline4"></div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<input class="no-display" value="<?php echo $this->selectedLocation->getId();?>" id="selectedLocationId">
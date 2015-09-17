
								<!-- start: DYNAMIC TABLE PANEL -->
								<div class="panel panel-white">
									<div class="panel-heading">
										<h4 class="panel-title"><?= $this->translate("tache actuelle")?> <span class="text-bold"><?= $this->translate("état")?></span></h4>
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
											<div class="row">
											<div class="col-md-12 space20">
												<button  href="#newContributor" class="btn btn-green new-contributor">
													<?= $this->translate("Action 1")?> <i class="fa fa-plus"></i>
												</button>
												<button data-table="#list-employees"  class="btn btn-orange print-table">
													<?= $this->translate("Print")?> <i class="fa fa-print"></i>
												</button>
												<div class="btn-group pull-right">
													<button data-toggle="dropdown" class="btn btn-green dropdown-toggle">
														Export <i class="fa fa-angle-down"></i>
													</button>
													<ul class="dropdown-menu dropdown-light pull-right">
														<li>
															<a href="#" class="export-pdf" data-table="#list-employees" data-ignoreColumn ="0,2,5">
																<img src='<?= PIMCORE_WEBSITE_LAYOUTS?>/assets/icons/pdf.png' width='24px'> Save as PDF
															</a>
														</li>
														<li>
															<a href="#" class="export-png" data-table="#list-employees" data-ignoreColumn ="0,2,5">
																<img src='<?= PIMCORE_WEBSITE_LAYOUTS?>/assets/icons/png.png' width='24px'> Save as PNG
															</a>
														</li>
														<li>
															<a href="#" class="export-csv" data-table="#list-employees" data-ignoreColumn ="0,2,5">
																<img src='<?= PIMCORE_WEBSITE_LAYOUTS?>/assets/icons/csv.png' width='24px'> Save as CSV
															</a>
														</li>
														<li>
															<a href="#" class="export-txt" data-table="#list-employees" data-ignoreColumn ="0,2,5">
																<img src='<?= PIMCORE_WEBSITE_LAYOUTS?>/assets/icons/txt.png' width='24px'> Save as TXT
															</a>
														</li>
														<li>
															<a href="#" class="export-xml" data-table="#list-employees" data-ignoreColumn ="0,2,5">
																<img src='<?= PIMCORE_WEBSITE_LAYOUTS?>/assets/icons/xml.png' width='24px'> Save as XML
															</a>
														</li>
														<li>
															<a href="#" class="export-sql" data-table="#list-employees" data-ignoreColumn ="0,2,5">
																<img src='<?= PIMCORE_WEBSITE_LAYOUTS?>/assets/icons/sql.png' width='24px'> Save as SQL
															</a>
														</li>
														<li>
															<a href="#" class="export-json" data-table="#list-employees" data-ignoreColumn ="0,2,5">
																<img src='<?= PIMCORE_WEBSITE_LAYOUTS?>/assets/icons/json.png' width='24px'> Save as JSON
															</a>
														</li>
														<li>
															<a href="#" class="export-excel" data-table="#list-employees" data-ignoreColumn ="0,2,5">
																<img src='<?= PIMCORE_WEBSITE_LAYOUTS?>/assets/icons/xls.png' width='24px'> Export to Excel
															</a>
														</li>
														<li>
															<a href="#" class="export-doc" data-table="#list-employees" data-ignoreColumn ="0,2,5">
																<img src='<?= PIMCORE_WEBSITE_LAYOUTS?>/assets/icons/word.png' width='24px'> Export to Word
															</a>
														</li>
														<li>
															<a href="#" class="export-powerpoint" data-table="#list-employees" data-ignoreColumn ="0,2,5">
																<img src='<?= PIMCORE_WEBSITE_LAYOUTS?>/assets/icons/ppt.png' width='24px'> Export to PowerPoint
															</a>
														</li>
													</ul>
												</div>
											</div>
										</div>
										<div class="row">
											<div class="col-md-7 col-lg-4">
												<div class="panel panel-white">
													<iframe src="/reservation" width="100%" height="600px" frameborder="0" id="iframe">
													  <p>Votre navigateur ne supporte pas l'élément iframe</p>
													</iframe>
												</div>
											</div>
											<div class="col-lg-4 col-md-5">
												<div class="row">
													<div class="col-md-6">
														<div class="panel panel-blue">
															<div class="panel-body padding-20 text-center">
																<div class="space10">
																	<h5 class="text-white semi-bold no-margin p-b-5">Aujourd'hui</h5>
																	<h1>23</h1> Réservations
																</div>
																<div class="sparkline-4 space10">
																	<span ></span>
																</div>
																<span class="text-light"><i class="fa fa-clock-o"></i> 1 hour ago</span>
															</div>
														</div>
													</div>
													<div class="col-md-6">
														<div class="panel panel-green">
															<div class="panel-body padding-20 text-center">
																<div class="space10">
																	<h5 class="text-white semi-bold no-margin p-b-5">Hier</h5>
																	<h1>18</h1> Réservations
																</div>
																<div class="sparkline-5 space10">
																	<span></span>
																</div>
																<span class="text-light"><i class="fa fa-clock-o"></i> 1 hour ago</span>
															</div>
														</div>
													</div>
													<div class="col-sm-6">
														<div class="panel">
															<div class="panel-body">
																<div class="easy-pie-chart">
																	<h1>80%</h1>
																	<!--<span class="cpu number appear" data-percent="82" data-plugin-options='{"barColor": "#ff0000"}'> <span class="percent"></span> </span>-->
																	<div class="label-chart">
																		<h4 class="no-margin">Satisfaction</h4>
																	</div>
																</div>
																<div class="small-text text-center space15">
																	<span class="block">Objectif</span><span class="label label-danger vertical-align-bottom">85%</span>
																</div>
															</div>
														</div>
													</div>
													<div class="col-sm-6">
														<div class="panel">
															<div class="panel-body">
																<div class="easy-pie-chart">
																	<!--<span class="bounce number appear" data-percent="44" data-plugin-options='{"barColor": "#35aa47"}'> <span class="percent"></span> </span>-->
																	<h1>44%</h1>
																	<div class="label-chart">
																		<h4 class="no-margin">Remplissage</h4>
																	</div>
																</div>
																<div class="text-center space15">
																	<span class="block">Objectif</span><span class="label label-danger vertical-align-bottom">49%</span>
																</div>
															</div>
														</div>
													</div>
												</div>
											</div>


											<div class="col-lg-4 col-md-5">
												<div class="panel panel-red panel-calendar">
													<div class="panel-heading border-light">
														<h4 class="panel-title">Appointments</h4>
														<div class="panel-tools">
															<div class="dropdown">
																<a data-toggle="dropdown" class="btn btn-xs dropdown-toggle btn-transparent-white">
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
														<div class="height-300">
															<div class="row">
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
															<div class="row">
																<div class="col-xs-12">
																	<div class="row center-block">
																		<div style="margin-left:40px; margin-top:20px">
																			<div style="width:220px; height:150px;">
																			    <object type="application/x-shockwave-flash" data="http://swf.yowindow.com/yowidget3.swf" width="220" height="150">
																			    	<param name="movie" value="http://swf.yowindow.com/yowidget3.swf"/>
																			    	<param name="allowfullscreen" value="true"/>
																			    	<param name="wmode" value="opaque"/>
																			    	<param name="bgcolor" value="#FFFFFF"/>
																			    	<param name="flashvars" value="location_id=gn:2988507&amp;location_name=Paris&amp;landscape=airport&amp;time_format=24&amp;unit_system=metric&amp;lang=fr&amp;background=#FFFFFF&amp;mini_action=full_screen&amp;copyright_bar=false" /> <a href="http://WeatherScreenSaver.com?client=widget&amp;link=copyright" style="width:220px;height:150px;display: block;text-indent: -50000px;font-size: 0px;background:#DDF url(http://yowindow.com/img/logo.png) no-repeat scroll 50% 50%;">Free Weather Widget</a>
																			    </object>
																			</div>
																			<div style="width: 220px; height: 15px; font-size: 14px; font-family: Arial,Helvetica,sans-serif;">
																				<span style="float:left;"><a target="_top" href="http://WeatherScreenSaver.com?client=widget&amp;link=copyright" style="color: #2fa900; font-weight:bold; text-decoration:none;" title="Weather Widget">YoWindow.com</a></span>
																				<span style="float:right; color:#888888;"><a href="http://yr.no" style="color: #2fa900; text-decoration:none;">yr.no</a></span>
																			</div>
																		</div>
																	</div>
																</div>
															</div>
															<div class="row">
																<div class="col-xs-12">
																	<div class="pull-right">
																		<a href="#newEvent" class="btn btn-sm btn-transparent-white new-event"><i class="fa fa-plus"></i> New Event </a>
																		<a href="#showCalendar" class="btn btn-sm btn-transparent-white show-calendar"><i class="fa fa-calendar-o"></i> Calendar </a>
																	</div>
																</div>
															</div>
														</div>
													</div>
												</div>
											</div>
										</div>
										<div class="row">

											<div class="col-md-7 col-lg-4">
												<div class="panel panel-bricky">
													<div class="panel-heading border-light">
														<h4 class="panel-title">Next <span class="text-bold">Orders</span></h4>
														<div class="panel-tools">
															<div class="dropdown">
																<a data-toggle="dropdown" class="btn btn-xs dropdown-toggle btn-transparent-white">
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
														<div class="row">
															<div class="col-md-5">
																<div id='chart3'>
																	<svg></svg>
																</div>
															</div>
															<div class="col-md-7">
																<div class="space20 padding-5 border-bottom border-light">
																	<h4 class="pull-left no-margin space5">32.16K &euro;</h4>
																	<span class="text-dark pull-right">12:30</span>
																	<div class="clearfix"></div>
																	<span class="text-light">Supply acc. for Emea Region</span>
																</div>
																<div class="space20 padding-5 border-bottom border-light">
																	<h4 class="pull-left no-margin space5">127.52K $</h4>
																	<span class="text-dark pull-right">12:30</span>
																	<div class="clearfix"></div>
																	<span class="text-light">London HQ Account</span>
																</div>
																<div class="space20 padding-5 border-bottom border-light">
																	<h4 class="pull-left no-margin space5">127.52K $</h4>
																	<span class="text-dark pull-right">12:30</span>
																	<div class="clearfix"></div>
																	<span class="text-light">London HQ Account</span>
																</div>
															</div>
														</div>
													</div>
													<div class="panel-footer partition-white">
														<div class="clearfix padding-5 space5">
															<div class="col-xs-4 text-center no-padding">
																<div class="border-right border-dark">
																	<span class="text-bold block text-extra-large">90%</span>
																	<span class="text-light">Satisfied</span>
																</div>
															</div>
															<div class="col-xs-4 text-center no-padding">
																<div class="border-right border-dark">
																	<span class="text-bold block text-extra-large">2%</span>
																	<span class="text-light">Unsatisfied</span>
																</div>
															</div>
															<div class="col-xs-4 text-center no-padding">
																<span class="text-bold block text-extra-large">8%</span>
																<span class="text-light">NA</span>
															</div>
														</div>
													</div>
												</div>
											</div>
											<div class="col-lg-4 col-md-5">
												<div class="panel uploads">
													<div class="panel-body panel-portfolio no-padding">
														<div class="portfolio-grid portfolio-hover">
															<div class="overlayer bottom-left fullwidth">
																<div class="overlayer-wrapper">
																	<div class="padding-20">
																		<h4 class="text-white no-margin">Recent Uploads</h4>
																		<h5 class="text-white">Take a look at what other users are uploading right now</h5>
																	</div>
																</div>
															</div>
															<div class="e-slider owl-carousel owl-theme portfolio-grid portfolio-hover" data-plugin-options='{"pagination": false, "stopOnHover": true}'>
																<div class="item">
																	<img src="website/views/layouts/assets/images/image01.jpg" alt="">
																	<div class="caption">
																		<h2 class="caption-title">Hover Style #10</h2>
																		<p class="caption-description">
																			A wonderful serenity has taken possession of my entire soul, like these sweet mornings of spring which I enjoy with my whole heart.
																		</p>
																		<a href="#" class="caption-button">
																			Read More
																		</a>
																	</div>
																</div>
																<div class="item">
																	<img src="website/views/layouts/assets/images/image02.jpg" alt="">
																	<div class="caption">
																		<h2 class="caption-title">Hover Style #10</h2>
																		<p class="caption-description">
																			A wonderful serenity has taken possession of my entire soul, like these sweet mornings of spring which I enjoy with my whole heart.
																		</p>
																		<a href="#" class="caption-button">
																			Read More
																		</a>
																	</div>
																</div>
																<div class="item">
																	<img src="website/views/layouts/assets/images/image03.jpg" alt="">
																	<div class="caption">
																		<h2 class="caption-title">Hover Style #10</h2>
																		<p class="caption-description">
																			A wonderful serenity has taken possession of my entire soul, like these sweet mornings of spring which I enjoy with my whole heart.
																		</p>
																		<a href="#" class="caption-button">
																			Read More
																		</a>
																	</div>
																</div>
																<div class="item">
																	<img src="website/views/layouts/assets/images/image04.jpg" alt="">
																	<div class="caption">
																		<h2 class="caption-title">Hover Style #10</h2>
																		<p class="caption-description">
																			A wonderful serenity has taken possession of my entire soul, like these sweet mornings of spring which I enjoy with my whole heart.
																		</p>
																		<a href="#" class="caption-button">
																			Read More
																		</a>
																	</div>
																</div>
															</div>
														</div>
														<div class="partition partition-white padding-15">
															<div class="navigator">
																<a href="#" class="circle-50 partition-white owl-prev"><i class="fa fa-chevron-left text-extra-large"></i></a>
																<a href="#" class="circle-50 partition-white owl-next"><i class="fa fa-chevron-right text-extra-large"></i></a>
															</div>
															<div class="clearfix space5">
																<div class="col-xs-12 text-center no-padding space10">
																	Lorem ipsum dolor sit amet, consectetuer adipiscing elit.
																</div>
																<div class="col-xs-12 text-center no-padding">
																	<a class="tags">
																		New York
																	</a>
																	<a class="tags">
																		London
																	</a>
																	<a class="tags">
																		Rome
																	</a>
																	<a class="tags">
																		Paris
																	</a>
																	<a class="tags">
																		Berlin
																	</a>
																	<a class="tags">
																		Amsterdam
																	</a>
																	<a class="tags">
																		Madrid
																	</a>
																</div>
															</div>
															<div class="clearfix padding-5">
																<div class="col-xs-4 text-center no-padding">
																	<div class="border-right border-dark">
																		<a href="#" class="text-dark">
																			<i class="fa fa-heart-o text-red"></i> 250
																		</a>
																	</div>
																</div>
																<div class="col-xs-4 text-center no-padding">
																	<div class="border-right border-dark">
																		<a href="#" class="text-dark">
																			<i class="fa fa-bookmark-o text-green"></i> 20
																		</a>
																	</div>
																</div>
																<div class="col-xs-4 text-center no-padding">
																	<a href="#" class="text-dark"><i class="fa fa-comment-o text-azure"></i> 544</a>
																</div>
															</div>
														</div>
													</div>
												</div>
											</div>

											<div class="col-lg-4 col-md-12">
												<div class="panel panel-white">
													<div class="panel-heading border-light">
														<h4 class="panel-title">Users</h4>
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
													<div class="panel-body no-padding">
														<div class="padding-10">
															<img width="50" height="50" alt="" class="img-circle pull-left" src="website/views/layouts/assets/images/avatar-1-big.jpg">
															<h4 class="no-margin inline-block padding-5">Peter Clark <span class="block text-small text-left">UI Designer</span></h4>
															<div class="pull-right padding-15">
																<span class="text-small text-bold text-green"><i class="fa fa-dot-circle-o"></i> on-line</span>
															</div>
														</div>
														<div class="clearfix padding-5 space5">
															<div class="col-xs-4 text-center no-padding">
																<div class="border-right border-dark">
																	<a href="#" class="text-dark">
																		<i class="fa fa-heart-o text-red"></i> 250
																	</a>
																</div>
															</div>
															<div class="col-xs-4 text-center no-padding">
																<div class="border-right border-dark">
																	<a href="#" class="text-dark">
																		<i class="fa fa-bookmark-o text-green"></i> 20
																	</a>
																</div>
															</div>
															<div class="col-xs-4 text-center no-padding">
																<a href="#" class="text-dark"><i class="fa fa-comment-o text-azure"></i> 544</a>
															</div>
														</div>
														<div class="tabbable no-margin no-padding partition-dark">
															<ul class="nav nav-tabs" id="myTab">
																<li class="active">
																	<a data-toggle="tab" href="#users_tab_example1">
																		All
																	</a>
																</li>
																<li class="">
																	<a data-toggle="tab" href="#users_tab_example2">
																		View and Edit
																	</a>
																</li>
																<li class="">
																	<a data-toggle="tab" href="#users_tab_example3">
																		View Only
																	</a>
																</li>
															</ul>
															<div class="tab-content partition-white">
																<div id="users_tab_example1" class="tab-pane padding-bottom-5 active">
																	<div class="panel-scroll height-230">
																		<table class="table table-striped table-hover">
																			<tbody>
																				<tr>
																					<td class="center"><img src="website/views/layouts/assets/images/avatar-1.jpg" class="img-circle" alt="image"/></td>
																					<td><span class="text-small block text-light">UI Designer</span><span class="text-large">Peter Clark</span><a href="#" class="btn"><i class="fa fa-pencil"></i></a></td>
																					<td class="center">
																					<div>
																						<div class="btn-group">
																							<a class="btn btn-transparent-grey dropdown-toggle btn-sm" data-toggle="dropdown" href="#">
																								<i class="fa fa-cog"></i> <span class="caret"></span>
																							</a>
																							<ul role="menu" class="dropdown-menu dropdown-dark pull-right">
																								<li role="presentation">
																									<a role="menuitem" tabindex="-1" href="#">
																										<i class="fa fa-edit"></i> Edit
																									</a>
																								</li>
																								<li role="presentation">
																									<a role="menuitem" tabindex="-1" href="#">
																										<i class="fa fa-share"></i> Share
																									</a>
																								</li>
																								<li role="presentation">
																									<a role="menuitem" tabindex="-1" href="#">
																										<i class="fa fa-times"></i> Remove
																									</a>
																								</li>
																							</ul>
																						</div>
																					</div></td>
																				</tr>
																				<tr>
																					<td class="center"><img src="website/views/layouts/assets/images/avatar-2.jpg" class="img-circle" alt="image"/></td>
																					<td><span class="text-small block text-light">Content Designer</span><span class="text-large">Nicole Bell</span><a href="#" class="btn"><i class="fa fa-pencil"></i></a></td>
																					<td class="center">
																					<div>
																						<div class="btn-group">
																							<a class="btn btn-transparent-grey dropdown-toggle btn-sm" data-toggle="dropdown" href="#">
																								<i class="fa fa-cog"></i> <span class="caret"></span>
																							</a>
																							<ul role="menu" class="dropdown-menu dropdown-dark pull-right">
																								<li role="presentation">
																									<a role="menuitem" tabindex="-1" href="#">
																										<i class="fa fa-edit"></i> Edit
																									</a>
																								</li>
																								<li role="presentation">
																									<a role="menuitem" tabindex="-1" href="#">
																										<i class="fa fa-share"></i> Share
																									</a>
																								</li>
																								<li role="presentation">
																									<a role="menuitem" tabindex="-1" href="#">
																										<i class="fa fa-times"></i> Remove
																									</a>
																								</li>
																							</ul>
																						</div>
																					</div></td>
																				</tr>
																				<tr>
																					<td class="center"><img src="website/views/layouts/assets/images/avatar-3.jpg" class="img-circle" alt="image"/></td>
																					<td><span class="text-small block text-light">Visual Designer</span><span class="text-large">Steven Thompson</span><a href="#" class="btn"><i class="fa fa-pencil"></i></a></td>
																					<td class="center">
																					<div>
																						<div class="btn-group">
																							<a class="btn btn-transparent-grey dropdown-toggle btn-sm" data-toggle="dropdown" href="#">
																								<i class="fa fa-cog"></i> <span class="caret"></span>
																							</a>
																							<ul role="menu" class="dropdown-menu dropdown-dark pull-right">
																								<li role="presentation">
																									<a role="menuitem" tabindex="-1" href="#">
																										<i class="fa fa-edit"></i> Edit
																									</a>
																								</li>
																								<li role="presentation">
																									<a role="menuitem" tabindex="-1" href="#">
																										<i class="fa fa-share"></i> Share
																									</a>
																								</li>
																								<li role="presentation">
																									<a role="menuitem" tabindex="-1" href="#">
																										<i class="fa fa-times"></i> Remove
																									</a>
																								</li>
																							</ul>
																						</div>
																					</div></td>
																				</tr>
																				<tr>
																					<td class="center"><img src="website/views/layouts/assets/images/avatar-5.jpg" class="img-circle" alt="image"/></td>
																					<td><span class="text-small block text-light">Senior Designer</span><span class="text-large">Kenneth Ross</span><a href="#" class="btn"><i class="fa fa-pencil"></i></a></td>
																					<td class="center">
																					<div>
																						<div class="btn-group">
																							<a class="btn btn-transparent-grey dropdown-toggle btn-sm" data-toggle="dropdown" href="#">
																								<i class="fa fa-cog"></i> <span class="caret"></span>
																							</a>
																							<ul role="menu" class="dropdown-menu dropdown-dark pull-right">
																								<li role="presentation">
																									<a role="menuitem" tabindex="-1" href="#">
																										<i class="fa fa-edit"></i> Edit
																									</a>
																								</li>
																								<li role="presentation">
																									<a role="menuitem" tabindex="-1" href="#">
																										<i class="fa fa-share"></i> Share
																									</a>
																								</li>
																								<li role="presentation">
																									<a role="menuitem" tabindex="-1" href="#">
																										<i class="fa fa-times"></i> Remove
																									</a>
																								</li>
																							</ul>
																						</div>
																					</div></td>
																				</tr>
																				<tr>
																					<td class="center"><img src="website/views/layouts/assets/images/avatar-4.jpg" class="img-circle" alt="image"/></td>
																					<td><span class="text-small block text-light">Web Editor</span><span class="text-large">Ella Patterson</span><a href="#" class="btn"><i class="fa fa-pencil"></i></a></td>
																					<td class="center">
																					<div>
																						<div class="btn-group">
																							<a class="btn btn-transparent-grey dropdown-toggle btn-sm" data-toggle="dropdown" href="#">
																								<i class="fa fa-cog"></i> <span class="caret"></span>
																							</a>
																							<ul role="menu" class="dropdown-menu dropdown-dark pull-right">
																								<li role="presentation">
																									<a role="menuitem" tabindex="-1" href="#">
																										<i class="fa fa-edit"></i> Edit
																									</a>
																								</li>
																								<li role="presentation">
																									<a role="menuitem" tabindex="-1" href="#">
																										<i class="fa fa-share"></i> Share
																									</a>
																								</li>
																								<li role="presentation">
																									<a role="menuitem" tabindex="-1" href="#">
																										<i class="fa fa-times"></i> Remove
																									</a>
																								</li>
																							</ul>
																						</div>
																					</div></td>
																				</tr>
																			</tbody>
																		</table>
																	</div>
																</div>
																<div id="users_tab_example2" class="tab-pane padding-bottom-5">
																	<div class="panel-scroll height-230">
																		<table class="table table-striped table-hover">
																			<tbody>
																				<tr>
																					<td class="center"><img src="website/views/layouts/assets/images/avatar-3.jpg" class="img-circle" alt="image"/></td>
																					<td><span class="text-small block text-light">Visual Designer</span><span class="text-large">Steven Thompson</span><a href="#" class="btn"><i class="fa fa-pencil"></i></a></td>
																					<td class="center">
																					<div>
																						<div class="btn-group">
																							<a class="btn btn-transparent-grey dropdown-toggle btn-sm" data-toggle="dropdown" href="#">
																								<i class="fa fa-cog"></i> <span class="caret"></span>
																							</a>
																							<ul role="menu" class="dropdown-menu dropdown-dark pull-right">
																								<li role="presentation">
																									<a role="menuitem" tabindex="-1" href="#">
																										<i class="fa fa-edit"></i> Edit
																									</a>
																								</li>
																								<li role="presentation">
																									<a role="menuitem" tabindex="-1" href="#">
																										<i class="fa fa-share"></i> Share
																									</a>
																								</li>
																								<li role="presentation">
																									<a role="menuitem" tabindex="-1" href="#">
																										<i class="fa fa-times"></i> Remove
																									</a>
																								</li>
																							</ul>
																						</div>
																					</div></td>
																				</tr>
																				<tr>
																					<td class="center"><img src="website/views/layouts/assets/images/avatar-5.jpg" class="img-circle" alt="image"/></td>
																					<td><span class="text-small block text-light">Senior Designer</span><span class="text-large">Kenneth Ross</span><a href="#" class="btn"><i class="fa fa-pencil"></i></a></td>
																					<td class="center">
																					<div>
																						<div class="btn-group">
																							<a class="btn btn-transparent-grey dropdown-toggle btn-sm" data-toggle="dropdown" href="#">
																								<i class="fa fa-cog"></i> <span class="caret"></span>
																							</a>
																							<ul role="menu" class="dropdown-menu dropdown-dark pull-right">
																								<li role="presentation">
																									<a role="menuitem" tabindex="-1" href="#">
																										<i class="fa fa-edit"></i> Edit
																									</a>
																								</li>
																								<li role="presentation">
																									<a role="menuitem" tabindex="-1" href="#">
																										<i class="fa fa-share"></i> Share
																									</a>
																								</li>
																								<li role="presentation">
																									<a role="menuitem" tabindex="-1" href="#">
																										<i class="fa fa-times"></i> Remove
																									</a>
																								</li>
																							</ul>
																						</div>
																					</div></td>
																				</tr>
																				<tr>
																					<td class="center"><img src="website/views/layouts/assets/images/avatar-4.jpg" class="img-circle" alt="image"/></td>
																					<td><span class="text-small block text-light">Web Editor</span><span class="text-large">Ella Patterson</span><a href="#" class="btn"><i class="fa fa-pencil"></i></a></td>
																					<td class="center">
																					<div>
																						<div class="btn-group">
																							<a class="btn btn-transparent-grey dropdown-toggle btn-sm" data-toggle="dropdown" href="#">
																								<i class="fa fa-cog"></i> <span class="caret"></span>
																							</a>
																							<ul role="menu" class="dropdown-menu dropdown-dark pull-right">
																								<li role="presentation">
																									<a role="menuitem" tabindex="-1" href="#">
																										<i class="fa fa-edit"></i> Edit
																									</a>
																								</li>
																								<li role="presentation">
																									<a role="menuitem" tabindex="-1" href="#">
																										<i class="fa fa-share"></i> Share
																									</a>
																								</li>
																								<li role="presentation">
																									<a role="menuitem" tabindex="-1" href="#">
																										<i class="fa fa-times"></i> Remove
																									</a>
																								</li>
																							</ul>
																						</div>
																					</div></td>
																				</tr>
																			</tbody>
																		</table>
																	</div>
																</div>
																<div id="users_tab_example3" class="tab-pane padding-bottom-5">
																	<div class="panel-scroll height-230">
																		<table class="table table-striped table-hover">
																			<tbody>
																				<tr>
																					<td class="center"><img src="website/views/layouts/assets/images/avatar-2.jpg" class="img-circle" alt="image"/></td>
																					<td><span class="text-small block text-light">Content Designer</span><span class="text-large">Nicole Bell</span><a href="#" class="btn"><i class="fa fa-pencil"></i></a></td>
																					<td class="center">
																					<div>
																						<div class="btn-group">
																							<a class="btn btn-transparent-grey dropdown-toggle btn-sm" data-toggle="dropdown" href="#">
																								<i class="fa fa-cog"></i> <span class="caret"></span>
																							</a>
																							<ul role="menu" class="dropdown-menu dropdown-dark pull-right">
																								<li role="presentation">
																									<a role="menuitem" tabindex="-1" href="#">
																										<i class="fa fa-edit"></i> Edit
																									</a>
																								</li>
																								<li role="presentation">
																									<a role="menuitem" tabindex="-1" href="#">
																										<i class="fa fa-share"></i> Share
																									</a>
																								</li>
																								<li role="presentation">
																									<a role="menuitem" tabindex="-1" href="#">
																										<i class="fa fa-times"></i> Remove
																									</a>
																								</li>
																							</ul>
																						</div>
																					</div></td>
																				</tr>
																				<tr>
																					<td class="center"><img src="website/views/layouts/assets/images/avatar-3.jpg" class="img-circle" alt="image"/></td>
																					<td><span class="text-small block text-light">Visual Designer</span><span class="text-large">Steven Thompson</span><a href="#" class="btn"><i class="fa fa-pencil"></i></a></td>
																					<td class="center">
																					<div>
																						<div class="btn-group">
																							<a class="btn btn-transparent-grey dropdown-toggle btn-sm" data-toggle="dropdown" href="#">
																								<i class="fa fa-cog"></i> <span class="caret"></span>
																							</a>
																							<ul role="menu" class="dropdown-menu dropdown-dark pull-right">
																								<li role="presentation">
																									<a role="menuitem" tabindex="-1" href="#">
																										<i class="fa fa-edit"></i> Edit
																									</a>
																								</li>
																								<li role="presentation">
																									<a role="menuitem" tabindex="-1" href="#">
																										<i class="fa fa-share"></i> Share
																									</a>
																								</li>
																								<li role="presentation">
																									<a role="menuitem" tabindex="-1" href="#">
																										<i class="fa fa-times"></i> Remove
																									</a>
																								</li>
																							</ul>
																						</div>
																					</div></td>
																				</tr>
																				<tr>
																					<td class="center"><img src="website/views/layouts/assets/images/avatar-5.jpg" class="img-circle" alt="image"/></td>
																					<td><span class="text-small block text-light">Senior Designer</span><span class="text-large">Kenneth Ross</span><a href="#" class="btn"><i class="fa fa-pencil"></i></a></td>
																					<td class="center">
																					<div>
																						<div class="btn-group">
																							<a class="btn btn-transparent-grey dropdown-toggle btn-sm" data-toggle="dropdown" href="#">
																								<i class="fa fa-cog"></i> <span class="caret"></span>
																							</a>
																							<ul role="menu" class="dropdown-menu dropdown-dark pull-right">
																								<li role="presentation">
																									<a role="menuitem" tabindex="-1" href="#">
																										<i class="fa fa-edit"></i> Edit
																									</a>
																								</li>
																								<li role="presentation">
																									<a role="menuitem" tabindex="-1" href="#">
																										<i class="fa fa-share"></i> Share
																									</a>
																								</li>
																								<li role="presentation">
																									<a role="menuitem" tabindex="-1" href="#">
																										<i class="fa fa-times"></i> Remove
																									</a>
																								</li>
																							</ul>
																						</div>
																					</div></td>
																				</tr>
																				<tr>
																					<td class="center"><img src="website/views/layouts/assets/images/avatar-4.jpg" class="img-circle" alt="image"/></td>
																					<td><span class="text-small block text-light">Web Editor</span><span class="text-large">Ella Patterson</span><a href="#" class="btn"><i class="fa fa-pencil"></i></a></td>
																					<td class="center">
																					<div>
																						<div class="btn-group">
																							<a class="btn btn-transparent-grey dropdown-toggle btn-sm" data-toggle="dropdown" href="#">
																								<i class="fa fa-cog"></i> <span class="caret"></span>
																							</a>
																							<ul role="menu" class="dropdown-menu dropdown-dark pull-right">
																								<li role="presentation">
																									<a role="menuitem" tabindex="-1" href="#">
																										<i class="fa fa-edit"></i> Edit
																									</a>
																								</li>
																								<li role="presentation">
																									<a role="menuitem" tabindex="-1" href="#">
																										<i class="fa fa-share"></i> Share
																									</a>
																								</li>
																								<li role="presentation">
																									<a role="menuitem" tabindex="-1" href="#">
																										<i class="fa fa-times"></i> Remove
																									</a>
																								</li>
																							</ul>
																						</div>
																					</div></td>
																				</tr>
																			</tbody>
																		</table>
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
							

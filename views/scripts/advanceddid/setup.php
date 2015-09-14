<div class="container">
	<div class="toolbar row">
		<div class="col-sm-6 hidden-xs">
			<div class="page-header">
				<h1><small>societe:</small><?php echo $this->societename;?></h1>
			</div>
		</div>
		<div class="col-sm-6 col-xs-12">
			<a href="#" class="back-subviews">
				<i class="fa fa-chevron-left"></i> BACK
			</a>
			<a href="#" class="close-subviews">
				<i class="fa fa-times"></i> CLOSE
			</a>
			<div class="toolbar-tools pull-right">
				<!-- start: TOP NAVIGATION MENU -->
				<ul class="nav navbar-right">
					<!-- start: TO-DO DROPDOWN -->
					<li class="dropdown">
						<a data-toggle="dropdown" data-hover="dropdown" class="dropdown-toggle" data-close-others="true" href="#">
							<i class="fa fa-plus"></i> SUBVIEW
							<div class="tooltip-notification hide">
								<div class="tooltip-notification-arrow"></div>
								<div class="tooltip-notification-inner">
									<div>
										<div class="semi-bold">
											HI THERE!
										</div>
										<div class="message">
											Try the Subview Live Experience
										</div>
									</div>
								</div>
							</div>
						</a>
						<ul class="dropdown-menu dropdown-light dropdown-subview">
							<li class="dropdown-header">
								Notes
							</li>
							<li>
								<a href="#newNote" class="new-note"><span class="fa-stack"> <i class="fa fa-file-text-o fa-stack-1x fa-lg"></i> <i class="fa fa-plus fa-stack-1x stack-right-bottom text-danger"></i> </span> Add new note</a>
							</li>
							<li>
								<a href="#readNote" class="read-all-notes"><span class="fa-stack"> <i class="fa fa-file-text-o fa-stack-1x fa-lg"></i> <i class="fa fa-share fa-stack-1x stack-right-bottom text-danger"></i> </span> Read all notes</a>
							</li>
							<li class="dropdown-header">
								Calendar
							</li>
							<li>
								<a href="#newEvent" class="new-event"><span class="fa-stack"> <i class="fa fa-calendar-o fa-stack-1x fa-lg"></i> <i class="fa fa-plus fa-stack-1x stack-right-bottom text-danger"></i> </span> Add new event</a>
							</li>
							<li>
								<a href="#showCalendar" class="show-calendar"><span class="fa-stack"> <i class="fa fa-calendar-o fa-stack-1x fa-lg"></i> <i class="fa fa-share fa-stack-1x stack-right-bottom text-danger"></i> </span> Show calendar</a>
							</li>
							<li class="dropdown-header">
								Contributors
							</li>
							<li>
								<a href="#newContributor" class="new-contributor"><span class="fa-stack"> <i class="fa fa-user fa-stack-1x fa-lg"></i> <i class="fa fa-plus fa-stack-1x stack-right-bottom text-danger"></i> </span> Add new contributor</a>
							</li>
							<li>
								<a href="#showContributors" class="show-contributors"><span class="fa-stack"> <i class="fa fa-user fa-stack-1x fa-lg"></i> <i class="fa fa-share fa-stack-1x stack-right-bottom text-danger"></i> </span> Show all contributor</a>
							</li>
						</ul>
					</li>
					<li class="dropdown">
						<a data-toggle="dropdown" data-hover="dropdown" class="dropdown-toggle" data-close-others="true" href="#">
							<span class="messages-count badge badge-default hide">3</span> <i class="fa fa-envelope"></i> MESSAGES
						</a>
						<ul class="dropdown-menu dropdown-light dropdown-messages">
							<li>
								<span class="dropdown-header"> You have 9 messages</span>
							</li>
							<li>
								<div class="drop-down-wrapper ps-container">
									<ul>
										<li class="unread">
											<a href="javascript:;" class="unread">
												<div class="clearfix">
													<div class="thread-image">
														<img src="./assets/images/avatar-2.jpg" alt="">
													</div>
													<div class="thread-content">
														<span class="author">Nicole Bell</span>
														<span class="preview">Duis mollis, est non commodo luctus, nisi erat porttitor ligula...</span>
														<span class="time"> Just Now</span>
													</div>
												</div>
											</a>
										</li>
										<li>
											<a href="javascript:;" class="unread">
												<div class="clearfix">
													<div class="thread-image">
														<img src="./assets/images/avatar-3.jpg" alt="">
													</div>
													<div class="thread-content">
														<span class="author">Steven Thompson</span>
														<span class="preview">Duis mollis, est non commodo luctus, nisi erat porttitor ligula...</span>
														<span class="time">8 hrs</span>
													</div>
												</div>
											</a>
										</li>
										<li>
											<a href="javascript:;">
												<div class="clearfix">
													<div class="thread-image">
														<img src="./assets/images/avatar-5.jpg" alt="">
													</div>
													<div class="thread-content">
														<span class="author">Kenneth Ross</span>
														<span class="preview">Duis mollis, est non commodo luctus, nisi erat porttitor ligula...</span>
														<span class="time">14 hrs</span>
													</div>
												</div>
											</a>
										</li>
									</ul>
								</div>
							</li>
							<li class="view-all">
								<a href="pages_messages.html">
									See All
								</a>
							</li>
						</ul>
					</li>
					<li class="menu-search">
						<a href="#">
							<i class="fa fa-search"></i> SEARCH
						</a>
						<!-- start: SEARCH POPOVER -->
						<div class="popover bottom search-box transition-all">
							<div class="arrow"></div>
							<div class="popover-content">
								<!-- start: SEARCH FORM -->
								<form class="" id="searchform" action="#">
									<div class="input-group">
										<input type="text" class="form-control" placeholder="Search">
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
	<!-- end: PAGE HEADER -->
	<!-- start: BREADCRUMB -->
	<div class="row">
		<div class="col-md-12">
			<ol class="breadcrumb">
				<li>
					<a href="#">
						Dashboard
					</a>
				</li>
				<li class="active">
					Form Validation
				</li>
			</ol>
		</div>
	</div>
	<!-- end: BREADCRUMB -->
	<!-- start: PAGE CONTENT -->
	<div class="row">
		<div class="col-md-12">
			<!-- start: FORM VALIDATION 1 PANEL -->
			<div class="panel panel-white">
			
			
			
												<div class="tabbable">
													<ul id="myTab2" class="nav nav-tabs">
														<li class="active">
															<a href="#myTab2_example1" data-toggle="tab">
																Tab 1
															</a>
														</li>
														<li>
															<a href="#myTab2_example2" data-toggle="tab">
																Tab 2
															</a>
														</li>
														<li>
															<a href="#myTab2_example3" data-toggle="tab">
																Tab 3
															</a>
														</li>
													</ul>
													<div class="tab-content">
														<div class="tab-pane fade in active" id="myTab2_example1">
															<p>
																Raw denim you probably haven't heard of them jean shorts Austin. Nesciunt tofu stumptown aliqua, retro synth master cleanse. Mustache cliche tempor, williamsburg carles vegan helvetica. Reprehenderit butcher retro keffiyeh dreamcatcher synth.
															</p>
															<p>
																Cosby sweater eu banh mi, qui irure terry richardson ex squid. Aliquip placeat salvia cillum iphone. Seitan aliquip quis cardigan american apparel, butcher voluptate nisi qui.
															</p>
														</div>
														<div class="tab-pane fade" id="myTab2_example2">
															<p>
																Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat, sed diam voluptua. At vero eos et accusam et justo duo dolores et ea rebum. Stet clita kasd gubergren, no sea takimata sanctus est Lorem ipsum dolor sit amet. Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat, sed diam voluptua. At vero eos et accusam et justo.
															</p>
															<p>
																<a href="#myTab2_example3" class="btn btn-blue show-tab">
																	Go to tab 3
																</a>
															</p>
														</div>
														<div class="tab-pane fade" id="myTab2_example3">
															<p>
																Trust fund seitan letterpress, keytar raw denim keffiyeh etsy art party before they sold out master cleanse gluten-free squid scenester freegan cosby sweater. Fanny pack portland seitan DIY, art party locavore wolf cliche high life echo park Austin.
															</p>
															<p>
																<a href="#myTab2_example1" class="btn btn-purple show-tab">
																	Return to tab 1
																</a>
															</p>
														</div>
													</div>
												</div>			
			
			
			
			
			
				<div class="panel-heading">
					<h4 class="panel-title">Set up <span class="text-bold">Global Default values</span></h4>
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
					<p>
						<?php echo $this->societedescription;?>
					</p>
					<hr>
					<form action="#" role="form" id="setupform">
						<div class="row">
							<div class="col-md-12">
								<div class="errorHandler alert alert-danger no-display">
									<i class="fa fa-times-sign"></i> You have some form errors. Please check below.
								</div>
								<div class="successHandler alert alert-success no-display">
									<i class="fa fa-ok"></i> Your form validation is successful!
								</div>
							</div>
							<div class="col-md-12">
								<div class="col-md-12 form-group">
									<label class="control-label">
										Company presentation
									</label>
									<input type="text" placeholder="Text Field" name="presentation" id="presentation" class="form-control limited" maxlength="100">
								</div>
							</div>
							<div class="col-md-6">
								<div class="col-md-12 form-group">
									<div class="col-md-6">
										<label class="control-label">
											Maximum number of seats <span class="symbol required"></span>
										</label>
									</div>
									<div class="col-md-6">
										<span class="input-icon">
											<input type="number" placeholder="Indicate the maximum number of seats" class="form-control" id="maxseats" name="maxseats" style="width=20px">
											<i class="fa fa-hand-o-right"></i>
										</span>
									</div>
								</div>
								<div class="col-md-12 form-group">
									<div class="col-md-6">
										<label class="control-label">
											Maximum number of tables <span class="symbol required"></span>
										</label>
									</div>
									<div class="col-md-6">										
										<span class="input-icon">
										<input type="number" placeholder="Insert the maximum number of tables" class="form-control" id="maxtables" name="maxtables" style="width=20px">
											<i class="fa fa-hand-o-right"></i>
										</span>
									</div>
								</div>
								<div class="col-md-12 form-group">
									<div class="col-md-6">
										<label class="control-label">
											Unit of time for reservations <span class="symbol required"></span>
										</label>
									</div>
									<div class="col-md-6">																				
										<select class="form-control" id="resaUnit" name="resaUnit">
											<option value='15'>15</option>
											<option value='30'>30</option>
											<option value='45'>45</option>
											<option value='60'>60</option>
										</select>
									</div>
								</div>
							</div>
							<div class="col-md-6">
								<div class="col-md-12 form-group">
									<div class="col-md-6">
										<label class="control-label">
											Max Reservations per time unit<span class="symbol required"></span>
										</label>
									</div>
									<div class="col-md-6">																				
										<span class="input-icon">
											<input type="number" placeholder="Indicate the maximum number of reservation per time unit" class="form-control" name="maxResaPerUnit" id="maxResaPerUnit">
											<i class="fa fa-hand-o-right"></i>
										</span>
									</div>
								</div>
								<div class="col-md-12 form-group">
									<div class="col-md-6">
										<label class="control-label">
											Length of the meal<span class="symbol required"></span>
										</label>
									</div>
									<div class="col-md-6">																				
										<span class="input-icon">
											<input type="number" placeholder="Indicate the length of the meal"  class="form-control" name="meallength" id="meallength">
											<i class="fa fa-hand-o-right"></i>
										</span>
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
						<div class="row">
							<div class="col-md-8">
							</div>
							<div class="col-md-4">
								<button class="btn btn-yellow btn-block" type="submit">
									Register <i class="fa fa-arrow-circle-right"></i>
								</button>
							</div>
						</div>
					</form>
				</div>
			</div>
			<!-- end: FORM VALIDATION 1 PANEL -->
		</div>
	</div>
</div>
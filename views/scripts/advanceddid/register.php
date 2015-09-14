<div class="container">	
	<!-- start: PAGE HEADER -->
	<!-- start: TOOLBAR -->
	<div class="toolbar row">
		<div class="col-sm-6 hidden-xs">
			<div class="page-header">
				<h1>
					<select>
						<?php foreach($this->name as $name){ ?>
						<option><?php echo $name;?></option>
						<?php } ?>
					</select>
					<small>form validation samples</small>
				</h1>
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
				<div class="panel-heading">
				    <ul class="nav navbar-nav">
				      <li class="active">
					<a href="#">Lunch</a>
				      </li>
				      <li>
					<a href="#about">Diner</a>
				      </li>
				      <li>
					<a href="#contact">Add new serving</a>
				      </li>
				     </ul>
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
					<!--<h2><i class="fa fa-pencil-square"></i> ADD NEW CUSTOMER</h2>-->
					<p>
						Create one account to manage everything you do with Rapido, from your shopping preferences to your Rapido activity.
					</p>
					<hr>
					<form action="#" role="form" id="servingform" method="POST">
						<div class="row">
							<div class="col-md-12">
								<div class="errorHandler alert alert-danger no-display">
									<i class="fa fa-times-sign"></i> You have some form errors. Please check below.
								</div>
								<div class="successHandler alert alert-success no-display">
									<i class="fa fa-ok"></i> Your form validation is successful!
								</div>
							</div>
							<div class="col-md-5">
								<div class="col-md-4">
									<div class="form-group">
										<label class="control-label">
											MONDAY<span class="symbol required"></span>
										</label>
									</div>
									<div class="form-group">
										<label class="control-label">
											Time start
										</label>
										<div class="input-group input-append">
											<input type="text" name="timestartmonday" class="form-control time-picker">
											<span class="input-group-addon add-on"><i class="fa fa-clock-o"></i></span>
										</div>
									</div>
									<div class="form-group">
										<label class="control-label">
											Time end
										</label>
										<div class="input-group input-append">
											<input type="text" name="timeendmonday" class="form-control time-picker">
											<span class="input-group-addon add-on"><i class="fa fa-clock-o"></i></span>
										</div>
									</div>
									<div class="form-group">
										<label class="control-label">
											Max seats <span class="symbol required"></span>
										</label>
										<input type="number" placeholder="Max seats" class="form-control" id="maxseatsmonday" name="maxseatsmonday">
									</div>
									<div class="form-group">
										<label class="control-label">
											Max tables <span class="symbol required"></span>
										</label>
										<input type="number" placeholder="Max tables" class="form-control" id="maxtablesmonday" name="maxtablesmonday">
									</div>
								</div>
								<div class="col-md-4">
									<div class="form-group">
										<label class="control-label">
											TUESDAY<span class="symbol required"></span>
										</label>
									</div>
									<div class="form-group">
										<label class="control-label">
											Time start
										</label>
										<div class="input-group input-append">
											<input type="text" name="timestarttuesday" class="form-control time-picker">
											<span class="input-group-addon add-on"><i class="fa fa-clock-o"></i></span>
										</div>
									</div>
									<div class="form-group">
										<label class="control-label">
											Time end
										</label>
										<div class="input-group input-append">
											<input type="text" name="timeendtuesday" class="form-control time-picker">
											<span class="input-group-addon add-on"><i class="fa fa-clock-o"></i></span>
										</div>
									</div>
									<div class="form-group">
										<label class="control-label">
											Max seats <span class="symbol required"></span>
										</label>
										<input type="number" placeholder="Max seats" class="form-control" id="maxseatstuesday" name="maxseatstuesday">
									</div>
									<div class="form-group">
										<label class="control-label">
											Max tables <span class="symbol required"></span>
										</label>
										<input type="number" placeholder="Max tables" class="form-control" id="maxtablestuesday" name="maxtablestuesday">
									</div>
								</div>
								<div class="col-md-4">
									<div class="form-group">
										<label class="control-label">
											WEDNESDAY<span class="symbol required"></span>
										</label>
									</div>
									<div class="form-group">
										<label class="control-label">
											Time start
										</label>
										<div class="input-group input-append">
											<input type="text" name="timestartwednesday" class="form-control time-picker">
											<span class="input-group-addon add-on"><i class="fa fa-clock-o"></i></span>
										</div>
									</div>
									<div class="form-group">
										<label class="control-label">
											Time end
										</label>
										<div class="input-group input-append">
											<input type="text" name="timeendwednesday" class="form-control time-picker">
											<span class="input-group-addon add-on"><i class="fa fa-clock-o"></i></span>
										</div>
									</div>
									<div class="form-group">
										<label class="control-label">
											Max seats <span class="symbol required"></span>
										</label>
										<input type="number" placeholder="Max seats" class="form-control" id="maxseatswednesday" name="maxseatswednesday">
									</div>
									<div class="form-group">
										<label class="control-label">
											Max tables <span class="symbol required"></span>
										</label>
										<input type="number" placeholder="Max tables" class="form-control" id="maxtableswednesday" name="maxtableswednesday">
									</div>
								</div>
							</div>
							<div class="col-md-7">
								<div class="col-md-3">
									<div class="form-group">
										<label class="control-label">
											THURSDAY<span class="symbol required"></span>
										</label>
									</div>
									<div class="form-group">
										<label class="control-label">
											Time start
										</label>
										<div class="input-group input-append">
											<input type="text" name="timestartthursday" class="form-control time-picker">
											<span class="input-group-addon add-on"><i class="fa fa-clock-o"></i></span>
										</div>
									</div>
									<div class="form-group">
										<label class="control-label">
											Time end
										</label>
										<div class="input-group input-append">
											<input type="text" name="timeendthursday" class="form-control time-picker">
											<span class="input-group-addon add-on"><i class="fa fa-clock-o"></i></span>
										</div>
									</div>
									<div class="form-group">
										<label class="control-label">
											Max seats <span class="symbol required"></span>
										</label>
										<input type="number" placeholder="Max seats" class="form-control" id="maxseatsthursday" name="maxseatsthursday">
									</div>
									<div class="form-group">
										<label class="control-label">
											Max tables <span class="symbol required"></span>
										</label>
										<input type="number" placeholder="Max tables" class="form-control" id="maxtablesthursday" name="maxtablesthursday">
									</div>
								</div>
								<div class="col-md-3">
									<div class="form-group">
										<label class="control-label">
											FRIDAY<span class="symbol required"></span>
										</label>
									</div>
									<div class="form-group">
										<label class="control-label">
											Time start
										</label>
										<div class="input-group input-append">
											<input type="text" name="timestartfriday" class="form-control time-picker">
											<span class="input-group-addon add-on"><i class="fa fa-clock-o"></i></span>
										</div>
									</div>
									<div class="form-group">
										<label class="control-label">
											Time end
										</label>
										<div class="input-group input-append">
											<input type="text" name="timeendfriday" class="form-control time-picker">
											<span class="input-group-addon add-on"><i class="fa fa-clock-o"></i></span>
										</div>
									</div>
									<div class="form-group">
										<label class="control-label">
											Max seats <span class="symbol required"></span>
										</label>
										<input type="number" placeholder="Max seats" class="form-control" id="maxseatsfriday" name="maxseatsfriday">
									</div>
									<div class="form-group">
										<label class="control-label">
											Max tables <span class="symbol required"></span>
										</label>
										<input type="number" placeholder="Max tables" class="form-control" id="maxtablesfriday" name="maxtablesfriday">
									</div>
								</div>
								<div class="col-md-3">
									<div class="form-group">
										<label class="control-label">
											SATURDAY<span class="symbol required"></span>
										</label>
									</div>
									<div class="form-group">
										<label class="control-label">
											Time start
										</label>
										<div class="input-group input-append">
											<input type="text" name="timestartsaturday" class="form-control time-picker">
											<span class="input-group-addon add-on"><i class="fa fa-clock-o"></i></span>
										</div>
									</div>
									<div class="form-group">
										<label class="control-label">
											Time end
										</label>
										<div class="input-group input-append">
											<input type="text" name="timeendsaturday" class="form-control time-picker">
											<span class="input-group-addon add-on"><i class="fa fa-clock-o"></i></span>
										</div>
									</div>
									<div class="form-group">
										<label class="control-label">
											Max seats <span class="symbol required"></span>
										</label>
										<input type="number" placeholder="Max seats" class="form-control" id="maxseatssaturday" name="maxseatssaturday">
									</div>
									<div class="form-group">
										<label class="control-label">
											Max tables <span class="symbol required"></span>
										</label>
										<input type="number" placeholder="Max tables" class="form-control" id="maxtablessaturday" name="maxtablessaturday">
									</div>
								</div>
								<div class="col-md-3">
									<div class="form-group">
										<label class="control-label">
											SUNDAY<span class="symbol required"></span>
										</label>
									</div>
									<div class="form-group">
										<label class="control-label">
											Time start
										</label>
										<div class="input-group input-append">
											<input type="text" name="timestartsunday" class="form-control time-picker">
											<span class="input-group-addon add-on"><i class="fa fa-clock-o"></i></span>
										</div>
									</div>
									<div class="form-group">
										<label class="control-label">
											Time end
										</label>
										<div class="input-group input-append">
											<input type="text" name="timeendsunday" class="form-control time-picker">
											<span class="input-group-addon add-on"><i class="fa fa-clock-o"></i></span>
										</div>
									</div>
									<div class="form-group">
										<label class="control-label">
											Max seats <span class="symbol required"></span>
										</label>
										<input type="number" placeholder="Max seats" class="form-control" id="maxseatssunday" name="maxseatssunday">
									</div>
									<div class="form-group">
										<label class="control-label">
											Max tables <span class="symbol required"></span>
										</label>
										<input type="number" placeholder="Max tables" class="form-control" id="maxtablessunday" name="maxtablessunday">
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
								<p>
									Click to update the setup for this serving.
								</p>
							</div>
							<div class="col-md-4">
								<button class="btn btn-yellow btn-block" type="submit" value="update">
									Update <i class="fa fa-arrow-circle-right"></i>
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
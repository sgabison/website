<div class="container">	
	<!-- start: PAGE HEADER -->
	<!-- start: TOOLBAR -->
	<div class="toolbar row">
		<div class="col-sm-6 hidden-xs">
			<div class="page-header">
				<h1>
					<select id="select_location">
						<?php $i=0;foreach($this->locations as $location){ ?>
						<option value='<?php echo $location->getId();?>' <?php if($i==0){echo 'selected';}?>><?php echo $location->getName();?></option>
						<?php $i++;} ?>
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
					<h4 class="panel-title">Reserve <span class="text-bold">a Table at this location</span></h4>
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
					<!--
					<p>
						Create one account to manage everything you do with Rapido, from your shopping preferences to your Rapido activity.
					</p>
					-->
					<form role="form" id="servingform" novalidate="novalidate">
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
										<div class="input-group">
											<input id="calendar" name="calendar" type="text" data-date-format="dd-mm-yyyy" data-date-viewmode="years" class="form-control date-picker">
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
										<span class="btn btn-yellow btn-block" id='book'>Book a table <i class="fa fa-arrow-circle-right"></i></span>
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
											Your Name <span class="symbol required"></span>
										</label>
										<input type="text" placeholder="Insert your Name" class="form-control" id="firstlastname" name="firstlastname">
									</div>
									<div class="form-group">
										<label class="control-label">
											Your Telephone number (10 chars only)<span class="symbol required"></span>
										</label>
										<input type="tel" placeholder="06XXXXXXXX" class="form-control" id="tel" name="tel" maxlength="10">
									</div>
									<div class="form-group">
										<label class="control-label">
											Your Email Address <span class="symbol required"></span>
										</label>
										<input type="email" placeholder="Email@address.com" class="form-control" id="email" name="email">
									</div>
									<div class="form-group">
										<label class="control-label">
											Extra information (allergies...)
										</label>
										<input type="text" placeholder="Text Field" name="extra" id="extra" class="form-control limited" maxlength="100">
									</div>
									<div class="form-group">
										<hr>
										<label class="control-label">
											<strong>Signup for Rapido Emails</strong> <span class="symbol required"></span>
										</label>
										<p>
											Would you like to review Rapido emails?
										</p>
										<div>
											<label class="radio-inline">
												<input type="radio" class="grey" value="" name="newsletter">
												No
											</label>
											<label class="radio-inline">
												<input type="radio" class="grey" value="" name="newsletter">
												Yes
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
								<button class="btn btn-yellow btn-block" type="submit" value='submit' id='submit'>
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
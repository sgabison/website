			<!-- start: PAGESLIDE LEFT -->
			<a class="closedbar inner hidden-sm hidden-xs" href="#">
			</a>
			<nav id="pageslide-left" class="pageslide inner">
				<div class="navbar-content">
					<!-- start: SIDEBAR -->
					<div class="main-navigation left-wrapper transition-left">
						<div class="navigation-toggler hidden-sm hidden-xs">
							<a href="#main-navbar" class="sb-toggle-left">
							</a>
						</div>
						<div class="user-profile border-top padding-horizontal-10 block">
							<div class="inline-block">
								<img src="<?= PIMCORE_WEBSITE_LAYOUTS?>/assets/images/avatar-1.jpg" alt="">
							</div>
							<div class="inline-block">
								<h5 class="no-margin"> Welcome </h5>
								<h4 class="no-margin"> Peter Clark </h4>
								<a class="btn user-options sb_toggle">
									<i class="fa fa-cog"></i>
								</a>
							</div>
						</div>
						<!-- start: MAIN NAVIGATION MENU -->
						<ul class="main-navigation-menu">
							<li class="start">
								<a href="<?= PIMCORE_WEBSITE_LAYOUTS?>/layouts_single_content_0.html"><i class="fa fa-home"></i> <span class="title"> Dashboard </span><span class="label label-default pull-right ">LABEL</span> </a>
							</li>
							<li>
								<a href="javascript:void(0)"><i class="fa fa-desktop"></i> <span class="title"> Ajax Submenu 1 </span><i class="icon-arrow"></i> </a>
								<ul class="sub-menu">
									<li>
													<a href="#showCalendar" class="show-calendar"><span class="fa-stack"> <i class="fa fa-calendar-o fa-stack-1x fa-lg"></i> <i class="fa fa-share fa-stack-1x stack-right-bottom text-danger"></i> </span> Show calendar</a>
									</li>
									<li>
										<a href="<?= PIMCORE_WEBSITE_LAYOUTS?>/layouts_single_content_1.html">
											<span class="title"> Ajax Sample Page 1 </span>
										</a>
									</li>
									<li>
										<a href="<?= PIMCORE_WEBSITE_LAYOUTS?>/layouts_single_content_2.html">
											<span class="title"> Ajax Sample Page 2 </span>
										</a>
									</li>								
									<li>
										<a href="<?= PIMCORE_WEBSITE_LAYOUTS?>/layouts_single_content_3.html">
											<span class="title"> Ajax Sample Page 3 </span>
										</a>
									</li>
								</ul>
							</li>


<?php if($this->documents and $this->documents->getTotalCount() > 0) { ?>
        <?php foreach($this->documents as $doc) { ?>
            <li><a href="<?= $doc; ?>"><span class="title"><?= 'Menu '. $doc->getProperty("navigation_name"); ?></span></a></li>
        <?php } ?>
<?php } ?>


						</ul>
						<!-- end: MAIN NAVIGATION MENU -->
					</div>
					<!-- end: SIDEBAR -->
				</div>
				<div class="slide-tools">
					<div class="col-xs-6 text-left no-padding">
						<a class="btn btn-sm status" href="#">
							Status <i class="fa fa-dot-circle-o text-green"></i> <span>Online</span>
						</a>
					</div>
					<div class="col-xs-6 text-right no-padding">
						<a class="btn btn-sm log-out text-right" href="login_login.html">
							<i class="fa fa-power-off"></i> Log Out
						</a>
					</div>
				</div>
			</nav>
			<!-- end: PAGESLIDE LEFT -->

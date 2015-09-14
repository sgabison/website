			<!-- start: TOPBAR -->
			<header class="topbar navbar navbar-inverse navbar-fixed-top inner">
				<!-- start: TOPBAR CONTAINER -->
				<div class="container">
					<div class="navbar-header">
						<a class="sb-toggle-left hidden-md hidden-lg" href="#main-navbar">
							<i class="fa fa-bars"></i>
						</a>
						<!-- start: LOGO -->
						<a class="navbar-brand" href="index.html">
							<img src="<?= PIMCORE_WEBSITE_LAYOUTS?>/assets/images/logo.png" alt="RésaRapido"/>
						</a>
						<!-- end: LOGO -->
					</div>
					<div class="topbar-tools">
						<!-- start: TOP NAVIGATION MENU -->
						<ul class="nav navbar-right">
							<!-- start: USER DROPDOWN -->
							<?php if ($this->person instanceof Pimcore\Model\Object\Person) :?>
							<li class="dropdown current-user">
								<a data-toggle="dropdown" data-hover="dropdown" class="dropdown-toggle" data-close-others="true" href="#">
									<img src="<?php if($this->person->getAvatar() instanceof \Asset) : echo $this->person->getAvatar()->getThumbnail('avatarxs') ; else : echo '#'; endif; ?>" class="img-circle" alt=""> <span class="username hidden-xs"><?= $this->person->getName();?></span> <i class="fa fa-caret-down "></i>
								</a>
								<ul class="dropdown-menu dropdown-dark">
									<li>
										<a href="/website/views/layouts/pages_user_profile.html">
											My Profile
										</a>
									</li>
									<li>
										<a href="/website/views/layouts/pages_calendar.html">
											My Calendar
										</a>
									</li>
									<li>
										<a href="/website/views/layouts/pages_messages.html">
											My Messages (3)
										</a>
									</li>
									<li>
										<a href="/website/views/layouts/utility_lock_screen.html">
											Lock Screen
										</a>
									</li>
									<li>
										<a href="/data/login/logout">
											Log Out
										</a>
									</li>
								</ul>
							</li>
							<?php endif;?>
							<!-- end: USER DROPDOWN -->
						</ul>
						<!-- end: TOP NAVIGATION MENU -->
					</div>
				</div>
				<!-- end: TOPBAR CONTAINER -->
			</header>
			<!-- end: TOPBAR -->
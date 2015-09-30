			<!-- start: TOPBAR -->
			<header class="topbar navbar navbar-inverse navbar-fixed-top inner">
				<!-- start: TOPBAR CONTAINER -->
				<div class="container">
					<div class="navbar-header">
						<a class="sb-toggle-left hidden-lg" href="#main-navbar">
							<i class="fa fa-bars"></i>
						</a>
						<!-- start: LOGO -->
						<a class="navbar-brand" href="index.html">
							<!--  <img src="<?= PIMCORE_WEBSITE_LAYOUTS?>/assets/images/logo.png" alt="ResaExpress"/>-->
							<i class="fa fa-globe">ResaExpress</i>
						
							</a>
						<!-- end: LOGO -->
					</div>
					<div class="topbar-tools">
						<!-- start: TOP NAVIGATION MENU -->
						<ul class="nav navbar-right">
							<!-- start: USER DROPDOWN -->
							<li class="dropdown current-user">
								<a data-toggle="dropdown" data-hover="dropdown" class="dropdown-toggle" data-close-others="true" href="#">
									<img src="<?php if($this->person->getAvatar() instanceof \Asset) : echo $this->person->getAvatar()->getThumbnail('avatarxs') ; else : echo '#'; endif; ?>" class="img-circle" alt=""> <span class="username hidden-xs"><?= $this->person->getName();?></span> <i class="fa fa-caret-down "></i>
								</a>
								<ul class="dropdown-menu dropdown-dark">
									<li>
										<a href="/profil">
											<?php echo $this->t('TXT_MY_PROFILE')?>
										</a>
									</li>
<!--
									<li>
										<a href="pages_calendar.html">
											Mon Calendrier
										</a>
									</li>
									<li>
										<a href="pages_messages.html">
											Mes Messages (3)
										</a>
									</li>
									<li>
										<a href="utility_lock_screen.html">
											Lock Screen
										</a>
									</li>
-->
									<li>
										<a href="/data/login/logout">
											<?php echo $this->t('TXT_LOGOUT')?>
										</a>
									</li>
								</ul>
							</li>
							<!-- end: USER DROPDOWN -->
							
							<li class="right-menu-toggle">
<!--								<a href="#" class="sb-toggle-right">
									<i class="fa fa-globe toggle-icon"></i> <i class="fa fa-caret-right"></i> <span class="notifications-count badge badge-default hide"> 3</span>
								</a>
-->	
							<a class="btn user-options sb_toggle">
								<i class="fa fa-globe toggle-icon"></i>
							</a>
							</li>

						</ul>
						<!-- end: TOP NAVIGATION MENU -->
					</div>
					
					
					
				</div>
				<!-- end: TOPBAR CONTAINER -->
			</header>
			<!-- end: TOPBAR -->
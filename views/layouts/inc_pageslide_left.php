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
					<h5 class="no-margin"> <?= $this->translate('WELCOME')?> </h5>
					<h4 class="no-margin"> <?= $this->translate('TO_RESAEXPRESS')?> </h4>
					<a class="btn user-options sb_toggle">
						<i class="fa fa-cog"></i>
					</a>
				</div>
			</div>
			<!-- start: MAIN NAVIGATION MENU -->
			<ul class="main-navigation-menu">
<?php if($this->societes){foreach($this->societes as $societe){ ?>							
				<li>
					<a href="javascript:void(0)"><i class="fa fa-desktop"></i> <span class="title"> <?= $societe->getName()?></span><i class="icon-arrow"></i> </a>
					<ul class="sub-menu">
<?php foreach( $societe->getLocations() as $location){ ?>
						<li>
							<a href="/reservation?selectedLocationid=<?php echo $location->getId();?>">
								<span class="title"> <?= $location->getName();?> </span>
							</a>
						</li>
<?php } ?>
					</ul>
				</li>
<?php } } ?>
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

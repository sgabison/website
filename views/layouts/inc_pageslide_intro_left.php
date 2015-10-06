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
					<img src="/logos/resaexpress_small.png" alt="">
				</div>
				<div class="inline-block">
					<h5 class="no-margin"> <?= $this->translate('WELCOME')?> </h5>
					<h4 class="no-margin"> <?= $this->translate('TO_RESAEXPRESS')?> </h4>
				</div>
			</div>
			<!-- start: MAIN NAVIGATION MENU -->
			<ul class="main-navigation-menu">
<?php if($this->societes){foreach($this->societes as $societe){ ?>							
				<li class='open'>
					<a href="javascript:void(0)"><i class="fa fa-desktop"></i> <span class="title"> <?= $societe->getName()?></span><i class="icon-arrow"></i> </a>
					<ul class="sub-menu" style="display: block;">
						<li>
							<a href="/initialisation">
								<span class="title"> <?= $this->translate('TXT_GLOBALVIEW')?> </span>
							</a>
						</li>
<?php foreach( $societe->getLocations() as $location){ ?>
						<li>
							<a href="/initialisation?selectedLocationid=<?php echo $location->getId();?>">
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
</nav>
<!-- end: PAGESLIDE LEFT -->

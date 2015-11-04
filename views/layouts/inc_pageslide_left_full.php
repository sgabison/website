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
			<?php  if ($this->person instanceof Pimcore\Model\Object\Person) :?>
			<div class="user-profile border-top padding-horizontal-10 block">							
				<div class="inline-block">
					<img src="<?php if($this->person->getAvatar() instanceof \Asset) : echo $this->person->getAvatar()->getThumbnail('avatar') ; else : echo '#'; endif; ?>" alt="">
				</div>
				<div class="inline-block">
					<h5 class="no-margin"> <?php echo $this->t('TXT_WELCOME')?></h5>
					<h4 class="no-margin"> <?= $this->person->getName();?> </h4>
				</div>
			</div>
			<?php endif;?>
			<!-- start: MAIN NAVIGATION MENU -->
			<ul class="main-navigation-menu">
				<li>
					<a href="/booking"><i class="fa fa-bar-chart-o"></i> <span class="title"> <?php echo $this->t('TXT_DASHBOARD')?> </span><!--<span class="label label-default pull-right "><?php echo $this->t('TXT_LABEL_DASHBOARD')?></span>--> </a>
				</li>
<?php if( $this->person->getPermits() == 1 ){ ?>
				<li>
					<a href="/societe"><i class="fa fa-building"></i> <span class="title"><?php echo $this->t('TXT_SOCIETE')?></span> </a>
				</li>
<?php } ?>
				<li>
					<a href="/evenements"><i class="fa fa-calendar"></i> <span class="title"><?php echo $this->t('TXT_TITLE_EVENT')?></span> </a>
				</li>
				<li>
					<a href="/reserver"><i class="fa fa-pencil-square-o"></i> <span class="title"><?php echo $this->t('TXT_PRENDRE_RESERVATION')?></span> </a>
				</li>
				<li>
					<a href="/booking-calendar"><i class="fa fa-calendar"></i> <span class="title"><?php echo $this->t('TXT_CALENDRIER_RESERVATION')?></span> </a>
				</li>
				<li>
					<a href="/guests"><i class="fa fa-male"></i> <span class="title"><?php echo $this->t('TXT_LIST_GUEST')?></span> </a>
				</li>
				
<!--
				<li>
					<a href="/communication-setup"><i class="fa fa-pencil-square-o"></i> <span class="title"><?php echo $this->t('TXT_COMMUNICATION')?></span> </a>
				</li>
				<li>
					<a href="/offers-setup"><i class="fa fa-pencil-square-o"></i> <span class="title"><?php echo $this->t('TXT_OFFERS')?></span> </a>
				</li>
-->
			</ul>
			<!-- end: MAIN NAVIGATION MENU -->
		</div>
		<!-- end: SIDEBAR -->
	</div>
	<div class="slide-tools">
		<div class="col-xs-6 text-left no-padding">
			<a class="btn btn-sm status" href="#">
				<?php echo $this->t('TXT_HEADER_STATUS')?> <i class="fa fa-dot-circle-o text-green"></i> <span>Online</span>
			</a>
		</div>
		<div class="col-xs-6 text-right no-padding">
			<a class="btn btn-sm log-out text-right" href="/data/login/logout">
				<i class="fa fa-power-off"></i> <?php echo $this->t('TXT_LOGOUT')?>
			</a>
		</div>
	</div>
</nav>
<!-- end: PAGESLIDE LEFT -->
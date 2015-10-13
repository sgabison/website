<!-- start: DYNAMIC TABLE PANEL -->
<div class="panel panel-white">
	<div class="panel-heading">
		<h4 class="panel-title">
			<span class="text-bold"><?php if($this->selectedLocation) : echo $this->selectedLocation->getName() ; endif;?></span>
		</h4>
<!--
		<div class="panel-tools">
			<div class="dropdown">
				<a data-toggle="dropdown"
					class="btn btn-xs dropdown-toggle btn-transparent-grey"> <i
					class="fa fa-cog"></i>
				</a>
				<ul class="dropdown-menu dropdown-light pull-right" role="menu">
					<li><a class="panel-collapse collapses" href="#"><i
							class="fa fa-angle-up"></i> <span>Collapse</span> </a>
					</li>
					<li><a class="panel-refresh" href="#"> <i class="fa fa-refresh"></i>
							<span>Refresh</span>
					</a>
					</li>
					<li><a class="panel-config" href="#panel-config"
						data-toggle="modal"> <i class="fa fa-wrench"></i> <span>Configurations</span>
					</a>
					</li>
					<li><a class="panel-expand" href="#"> <i class="fa fa-expand"></i>
							<span>Fullscreen</span>
					</a>
					</li>
				</ul>
			</div>
			<a class="btn btn-xs btn-link panel-close" href="#"> <i
				class="fa fa-times"></i>
			</a>
		</div>
-->
	</div>
	<div class="panel-body">
		<div class="row">
			<div class="col-lg-4 col-md-5">
				<div>
					<?php include( PIMCORE_LAYOUTS_DIRECTORY ."/inc_meteo.php") ; ?>
				</div>
				<div>
					
				</div>
			</div>
			<div class="col-lg-4 col-md-5">
				<div class="panel panel-white">
					<div class="panel-heading border-light">
						<h4 class="panel-title">La Criée</h4>
					</div>
					<div class="panel-body">
						<iframe src="http://www.lacriee.com/" width="100%" height="600px" frameborder="0" id="iframe">
							<p>Votre navigateur ne supporte pas l'élément iframe</p>
						</iframe>
					</div>
				</div>
			</div>
			<div class="col-lg-4 col-md-5 col-sm-6">
				<div class="row">
					<div class="addsparkline"></div>
					<div class="addsparkline2"></div>
<!--
					<div class="col-md-6">
						<div class="panel panel-blue">
							<div class="panel-body padding-20 text-center">
								<div class="space10">
									<h5 class="text-white semi-bold no-margin p-b-5">Last 7 days</h5>
									<h1>23</h1>
									Réservations
								</div>
								<div class="sparkline-4 space10">
									<span></span>
								</div>
								<span class="text-light"><i class="fa fa-clock-o"></i> 1 hour
									ago</span>
							</div>
						</div>
					</div>
					<div class="col-md-6">
						<div class="panel panel-green">
							<div class="panel-body padding-20 text-center">
								<div class="space10">
									<h5 class="text-white semi-bold no-margin p-b-5">Hier</h5>
									<h1>18</h1>
									Réservations
								</div>
								<div class="sparkline-5 space10">
									<span></span>
								</div>
								<span class="text-light"><i class="fa fa-clock-o"></i> 1 hour
									ago</span>
							</div>
						</div>
					</div>
-->
				</div>
			</div>
		</div>
	</div>
</div>
<input class="no-display" value="<?php echo $this->selectedLocation->getId();?>" id="selectedLocationId">

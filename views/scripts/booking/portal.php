<!-- start: DYNAMIC TABLE PANEL -->
<div class="panel panel-white">
	<div class="panel-heading">
		<h4 class="panel-title">
			<span class="text-bold"><?php if($this->selectedLocation) : echo $this->selectedLocation->getName() ; endif;?></span>
		</h4>
	</div>
	<div class="panel-body">
		<div class="row">
			<div class="col-lg-4 col-md-6 col-sm-6 col-xs-12">
				<div>
					<?php include( PIMCORE_LAYOUTS_DIRECTORY ."/inc_meteo.php") ; ?>
				</div>
				<div>
					
				</div>
			</div>
			<div class="col-lg-4 col-md-6 col-sm-6 col-xs-12">
				<div class="panel panel-white">
					<div class="panel-heading border-light">
						<h4 class="panel-title"><?php echo $this->translate('TXT_QUICK_ACCESS');?></h4>
					</div>
					<div class="panel-body">
						<div class="space20">
							<a class="btn btn-block btn-lg btn-blue" href='/reserver'><?php echo $this->translate('TXT_BOOK_A_TABLE');?><a>
						</div>
						<div class="space20">
							<a class="btn btn-block btn-lg btn-blue" href='/liste-reservations?calendar=<?php $today=new Zend_Date();echo $today->get("dd-MM-YYYY");?>'><?php echo $this->translate('TXT_LIST_RESERVATIONS_TODAY');?><a>
						</div>						
						<div class="space20">
							<a class="btn btn-block btn-lg btn-blue" href='/booking-calendar'><?php echo $this->translate('TXT_CALENDRIER_RESERVATION');?><a>
						</div>						
					</div>
				</div>
			</div>
			<div class="col-lg-4 col-md-6 col-sm-6 col-xs-12">
				<div class="row">
					<div class="addsparkline"></div>
					<div class="addsparkline2"></div>
				</div>
			</div>
		</div>
	</div>
</div>
<input class="no-display" value="<?php echo $this->selectedLocation->getId();?>" id="selectedLocationId">

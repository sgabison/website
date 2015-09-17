<div class="panel panel-white">
	<div class="panel-heading">
		<h4 class="panel-title"><?= $this->translate("TXT_LIST_RESERVATION_SEARCH")?><span class="text-bold"> <?= $this->translate("TXT_NEW_RESERVATION_LIST")?> </span></h4>
	</div>
	<div class="panel-body">
		<form role="form" id="searchform" novalidate="novalidate" action="/liste-reservations">
			<div class="row">
				<div class="col-md-12">
					<div class="errorHandler alert alert-danger no-display">
						<i class="fa fa-times-sign"></i> <?php echo $this->translate('TXT_YOU_HAVE_ERRORS');?>
					</div>
					<div class="successHandler alert alert-success no-display">
						<i class="fa fa-ok"></i> <?php echo $this->translate('TXT_YOUR_FORM_VALIDATION_IS_SUCCESSFULL');?>
					</div>
					<input id="selectedLocationId" name="selectedLocationId" value="<?php if($this->selectedLocation) {echo $this->selectedLocation->getId();}?>" class="no-display">
					<input id="language" class="no-display" value="<?php echo $this->language;?>">
					<input id="servingid" name="servingid" value="<?php echo $servid ?>" class="no-display">
					<input id="calendar" name="calendar" value="" class="no-display">
				</div>
				<div class="col-md-12">
					<div class="col-md-6">
						<div class="form-group">
							<label class="control-label">
								<?php echo $this->translate('TXT_SELECT_DATE');?><span class="symbol required"></span>
							</label>
							<div class="input-group date" id="calendarbox">
								<input id="mycalendar" disabled type="text" data-date-format="dd-mm-yyyy" data-date-viewmode="years" class="form-control date-picker mycalendar" value="<?php echo $this->getParam('calendar');?>">
								<span class="input-group-addon"> <i class="fa fa-calendar"></i> </span>
							</div>
						</div>
						<div class="form-group">
							<label class="control-label">
								<?php echo $this->translate('TXT_SELECT_SERVING');?><span class="symbol required"></span>
							</label>
							<div>
							<?php $i=0;foreach( $this->selectedLocation->getServings() as $serving){ ?>
								<button type="button" class="btn btn-sm buttons-widget servingbutton btn-light-orange" value="<?php echo $serving->getId(); ?>" style="margin:5px"><?php echo $serving->getTitle(); ?></button>		
							<?php if($i==0){$servid=$serving->getId();}$i++;} ?>
							</div>
						</div>
<!--
						<div class="form-group">
							<label class="checkbox-inline">
								<input type="checkbox" id="cancelled" name="cancelled" class="checkbox square-orange" value="1">
								<?php echo $this->translate('TXT_INCLUDE_CANCELLED');?>
							</label>
						</div>
						<div class="form-group">
							<label class="checkbox-inline">
								<input type="checkbox" id="arrived" name="arrived" class="checkbox square-orange" value="1">
								<?php echo $this->translate('TXT_INCLUDE_ARRIVED');?>
							</label>
						</div>
-->
						<button class="btn btn-dark-orange btn-block" value='submit' id='submit'>
							<?php echo $this->translate('TXT_GENERATE_LIST');?> <i class="fa fa-arrow-circle-right"></i>
						</button>
					</div>
				</div>
			</div>
		</form>	 
	</div>
</div>
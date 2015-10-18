<div class="ajax-white-backdrop" style="display: block;"></div>
<!-- start: DYNAMIC TABLE PANEL -->
<div class="panel panel-white">
	<div class="panel-heading">
		<div class="col-md-12 space20">
			<span class="actionitems">
<!--
				<a href="/liste-reservations-search?selectedLocationId=<?php echo $this->selectedLocation->getId();?>&" class="btn btn-blue"><?= $this->translate("TXT_NEW_SEARCH")?> <i class="fa fa-search"></i></a>
-->
				<button data-toggle="dropdown" class="btn btn-blue dropdown-toggle tooltips" data-rel="tooltip" data-original-title="<?= $this->selectedLocation->getName();?>">
					<?= strtoupper($this->servingname);?> <i class="fa fa-angle-down"></i>
				</button>
				<ul class="dropdown-menu">
					<li>
						<a href="/liste-reservations?servingid=&calendar=<?php echo $this->calendar;?>"><?= $this->translate("TXT_ALL_SERVICES")?> 
						</a>
					</li>
					<?php $servingstring="";$i=0;foreach( $this->servings as $serving ){ ?>
					<li>
						<a href="/liste-reservations?servingid=<?php echo $serving->getId();?>&calendar=<?php echo $this->calendar;?>"><span class="servinglink" value="<?php echo $serving->getId();?>"><?php echo $serving->getTitle();?></span>
						</a>
					</li>
					<?php 
						$servingstring=$servingstring.$serving->getTitle().',';
					} ?>
				</ul>
				<div class="btn-group">
					<a href="/liste-reservations?servingid=<?php echo $this->getParam('servingid');?>&calendar=<?php echo $this->daybefore;?>" class="btn btn-blue hidden-xs">
						<i class="fa fa-fast-backward"></i>
					</a>
					<a class="btn btn-blue"  data-target=".bs-example-modal-basic" data-toggle="modal">
						<?php echo $this->calendar;?>
					</a> 
					<a href="/liste-reservations?servingid=<?php echo $this->getParam('servingid');?>&calendar=<?php echo $this->dayafter;?>" class="btn btn-blue hidden-xs">
						<i class="fa fa-fast-forward"></i>
					</a>
				</div>
				<a class="btn btn-blue" href="/liste-reservations?servingid=<?php echo $this->getParam('servingid');?>&calendar=<?php echo $this->calendar;?>">
					<i class="fa fa-refresh"></i> 
				</a>
				<div class="pull-right">
					<button data-table="#reservationList" class="btn btn-orange print-table">
						<!--<?= $this->translate("Print")?>-->
						<i class="fa fa-print"></i>
					</button> 
					<button data-toggle="dropdown" class="btn btn-blue dropdown-toggle" style="margin-right:30px">
					<i class="fa fa-share-square"></i> <i class="fa fa-angle-down"></i></button>
					<ul class="dropdown-menu dropdown-light pull-right">
<!--
						<li><a href="#" class="export-pdf" data-table="#reservationList"
							data-ignoreColumn="0,2,5"> <img
								src='<?= PIMCORE_WEBSITE_LAYOUTS?>/assets/icons/pdf.png'
								width='24px'> Save as PDF
						</a>
						</li>
						<li><a href="#" class="export-png" data-table="#reservationList"
							data-ignoreColumn="0,2,5"> <img
								src='<?= PIMCORE_WEBSITE_LAYOUTS?>/assets/icons/png.png'
								width='24px'> Save as PNG
						</a>
						</li>
						<li><a href="#" class="export-csv" data-table="#reservationList"
							data-ignoreColumn="0,2,5"> <img
								src='<?= PIMCORE_WEBSITE_LAYOUTS?>/assets/icons/csv.png'
								width='24px'> Save as CSV
						</a>
						</li>
						<li><a href="#" class="export-txt" data-table="#reservationList"
							data-ignoreColumn="0,2,5"> <img
								src='<?= PIMCORE_WEBSITE_LAYOUTS?>/assets/icons/txt.png'
								width='24px'> Save as TXT
						</a>
						</li>
						<li><a href="#" class="export-xml" data-table="#reservationList"
							data-ignoreColumn="0,2,5"> <img
								src='<?= PIMCORE_WEBSITE_LAYOUTS?>/assets/icons/xml.png'
								width='24px'> Save as XML
						</a>
						</li>
						<li><a href="#" class="export-sql" data-table="#reservationList"
							data-ignoreColumn="0,2,5"> <img
								src='<?= PIMCORE_WEBSITE_LAYOUTS?>/assets/icons/sql.png'
								width='24px'> Save as SQL
						</a>
						</li>
						<li><a href="#" class="export-json" data-table="#reservationList"
							data-ignoreColumn="0,2,5"> <img
								src='<?= PIMCORE_WEBSITE_LAYOUTS?>/assets/icons/json.png'
								width='24px'> Save as JSON
						</a>
						</li>
-->
						<li><a href="#" class="export-excel" data-table="#reservationList"
							data-ignoreColumn="0,2,5"> <img
								src='<?= PIMCORE_WEBSITE_LAYOUTS?>/assets/icons/xls.png'
								width='24px'> Export to Excel
						</a>
						</li>
<!--
						<li><a href="#" class="export-doc" data-table="#reservationList"
							data-ignoreColumn="0,2,5"> <img
								src='<?= PIMCORE_WEBSITE_LAYOUTS?>/assets/icons/word.png'
								width='24px'> Export to Word
						</a>
						</li>
						<li><a href="#" class="export-powerpoint"
							data-table="#reservationList" data-ignoreColumn="0,2,5"> <img
								src='<?= PIMCORE_WEBSITE_LAYOUTS?>/assets/icons/ppt.png'
								width='24px'> Export to PowerPoint
						</a>
						</li>
-->
					</ul>
				</div>
			</span>	
			<span class="guestactionitems" class="no-display">
				<button class="btn btn-blue">
					<i class="fa fa-user"></i> <?php echo $this->guestname;?>
				</button>
				<button class="btn btn-blue">
					<i class="fa fa-phone"></i> <?php echo $this->guesttel;?>
				</button>
				<button class="btn btn-blue" id="datedisplay">
					<i class="fa fa-calendar"></i> <?= $this->translate('TXT_DISPLAY_DATE')?>
				</button>
				<button class="btn btn-blue" id="locationdisplay">
					<i class="fa fa-map-marker"></i> <?= $this->translate('TXT_DISPLAY_LOCATION')?>
				</button>
				<div class="pull-right">
					<button data-table="#reservationList" class="btn btn-orange print-table">
						<!--<?= $this->translate("Print")?>-->
						<i class="fa fa-print"></i>
					</button> 
					<button data-toggle="dropdown" class="btn btn-blue dropdown-toggle" style="margin-right:30px">
					<i class="fa fa-share-square"></i> <i class="fa fa-angle-down"></i></button>
					<ul class="dropdown-menu dropdown-light pull-right">
<!--
						<li><a href="#" class="export-pdf" data-table="#reservationList" data-ignoreColumn="0,2,5"> <img src='<?= PIMCORE_WEBSITE_LAYOUTS?>/assets/icons/pdf.png' width='24px'> Save as PDF
						</a>
						</li>
						<li><a href="#" class="export-png" data-table="#reservationList" data-ignoreColumn="0,2,5"> <img src='<?= PIMCORE_WEBSITE_LAYOUTS?>/assets/icons/png.png' width='24px'> Save as PNG
						</a>
						</li>
						<li><a href="#" class="export-csv" data-table="#reservationList"
							data-ignoreColumn="0,2,5"> <img
								src='<?= PIMCORE_WEBSITE_LAYOUTS?>/assets/icons/csv.png'
								width='24px'> Save as CSV
						</a>
						</li>
						<li><a href="#" class="export-txt" data-table="#reservationList"
							data-ignoreColumn="0,2,5"> <img
								src='<?= PIMCORE_WEBSITE_LAYOUTS?>/assets/icons/txt.png'
								width='24px'> Save as TXT
						</a>
						</li>
						<li><a href="#" class="export-xml" data-table="#reservationList"
							data-ignoreColumn="0,2,5"> <img
								src='<?= PIMCORE_WEBSITE_LAYOUTS?>/assets/icons/xml.png'
								width='24px'> Save as XML
						</a>
						</li>
						<li><a href="#" class="export-sql" data-table="#reservationList"
							data-ignoreColumn="0,2,5"> <img
								src='<?= PIMCORE_WEBSITE_LAYOUTS?>/assets/icons/sql.png'
								width='24px'> Save as SQL
						</a>
						</li>
						<li><a href="#" class="export-json" data-table="#reservationList"
							data-ignoreColumn="0,2,5"> <img
								src='<?= PIMCORE_WEBSITE_LAYOUTS?>/assets/icons/json.png'
								width='24px'> Save as JSON
						</a>
-->
						</li>
						<li><a href="#" class="export-excel" data-table="#reservationList"
							data-ignoreColumn="0,2,5"> <img
								src='<?= PIMCORE_WEBSITE_LAYOUTS?>/assets/icons/xls.png'
								width='24px'> Export to Excel
						</a>
<!--
						</li>
						<li><a href="#" class="export-doc" data-table="#reservationList"
							data-ignoreColumn="0,2,5"> <img
								src='<?= PIMCORE_WEBSITE_LAYOUTS?>/assets/icons/word.png'
								width='24px'> Export to Word
						</a>
						</li>
						<li><a href="#" class="export-powerpoint"
							data-table="#reservationList" data-ignoreColumn="0,2,5"> <img
								src='<?= PIMCORE_WEBSITE_LAYOUTS?>/assets/icons/ppt.png'
								width='24px'> Export to PowerPoint
						</a>
						</li>
-->
					</ul>
				</div>
			</span>
		</div>
		<div class="panel-tools btn btn-default config">
			<i class="fa fa-cog"></i><span> </span>
			<!--<a class="panel-expand" href="#"> <i class="fa fa-expand"></i><span> </span></a>-->
		</div>
	</div>
	<input id="servinglist" class="no-display value="<?php echo addslashes($servingstring);?>">
	<input id='selectedLocationId' class="no-display" value='<?php echo $this->selectedLocation->getId();?>'>
	<input id='calendar' class='no-display' value='<?php echo $this->calendar;?>'>
	<input id='dayafter' class='no-display' value='<?php echo $this->dayafter;?>'>
	<input id='daybefore' class='no-display' value='<?php echo $this->daybefore;?>'>
	<input id='servingid' class='no-display' value='<?php echo $this->getParam("servingid");?>'>
	<input id='guestid' class='no-display' value='<?php echo $this->getParam("guestid");?>'>
	<input id='warning' class='no-display' value='<?php echo $this->warning;?>'>
	<input id='cancelled' class='no-display' value='<?php echo $this->cancelled;?>'>
	<input id='arrived' class='no-display' value='<?php echo $this->arrived;?>'>
	<div class="panel-body">
		<div class="row configpanel no-display">
			<div class="col-md-12">
			<div class="panel panel-white">
				<div class="panel-heading">
					<h4 class="panel-title"><?= $this->translate("TXT_CONFIGURATION_PANEL")?></h4>
					<div class="panel-tools">
						<a class="close-configpanel" href="#"><i class="fa fa-close"></i> </a>
					</div>
				</div>
				<div class="panel-body">
					<div class="col-md-12">
						<div class="col-md-6">
							<label class="checkbox-inline text-bold" style="font-size:large">
								<input type="checkbox" class="flat-grey" value="1" id="checkarrived"  name="checkarrived"> <?= $this->translate('EXCLUDE_STATUS_ARRIVED')?>
							</label>
						</div>
						<div class="col-md-6">
							<label class="checkbox-inline text-bold" style="font-size:large">
								<input type="checkbox" class="flat-grey" value="1" id="checkcancelled"  name="checkcancelled"> <?= $this->translate('EXCLUDE_STATUS_CANCELLED')?>
							</label>
						</div>
					</div>
<!--
					<div class="col-md-12">
						<div class="form-group">
							<label for="form-field-select-4"> 
								<?= $this->translate("DROPDOWN_MULTIPLE_SELECT")?>
							</label>
							<select multiple="multiple" id="form-field-select-4" class="form-control search-select">
								<option value="2" <?php if(in_array( '2', $this->viewcol ) ){echo "selected";}?>><?= $this->translate("TXT_HEADER_DATE_RESERVATION")?></option>
								<option value="3" <?php if(in_array( '3', $this->viewcol ) ){echo "selected";}?>><?= $this->translate("TXT_HEADER_TIMESLOT")?></option>
								<option value="4" <?php if(in_array( '4', $this->viewcol ) ){echo "selected";}?>><?= $this->translate("TXT_HEADER_REF")?></option>
								<option value="5" <?php if(in_array( '5', $this->viewcol ) ){echo "selected";}?>><?= $this->translate("TXT_HEADER_GUESTNAME")?></option>
								<option value="6" <?php if(in_array( '6', $this->viewcol ) ){echo "selected";}?>><?= $this->translate("TXT_HEADER_PARTYSIZE")?></option>
								<option value="7" <?php if(in_array( '7', $this->viewcol ) ){echo "selected";}?>><?= $this->translate("TXT_HEADER_REFERENCE")?></option>
								<option value="8" <?php if(in_array( '8', $this->viewcol ) ){echo "selected";}?>><?= $this->translate("TXT_HEADER_NOTES")?></option>
								<option value="9" <?php if(in_array( '9', $this->viewcol ) ){echo "selected";}?>><?= $this->translate("TXT_HEADER_STATUS")?></option>
								<option value="10" <?php if(in_array( '10', $this->viewcol ) ){echo "selected";}?>><?= $this->translate("TXT_HEADER_ARRIVED")?></option>
								<option value="14" <?php if(in_array( '14', $this->viewcol ) ){echo "selected";}?>><?= $this->translate("TXT_HEADER_GUEST_EMAIL")?></option>
								<option value="15" <?php if(in_array( '15', $this->viewcol ) ){echo "selected";}?>><?= $this->translate("TXT_HEADER_GUEST_TEL")?></option>
							</select>
						</div>
					</div>
-->
				</div>
			</div>
			</div>
		
		</div>
		

		<div class="row">
			<!-- le contenu ici -->
			<div class="table-responsive col-md-12 space20">
				<table id="reservationList" class="display table">
					<thead>
						<tr>
							<th></th>
							<th></th>
							<th><?= $this->translate("TXT_HEADER_LOCATIONID")?></th>
							<th><?= $this->translate("TXT_HEADER_LOCATION_NAME")?></th>
							<th><?= $this->translate("TXT_HEADER_DATE_RESERVATION")?></th>
							<th><?= $this->translate("TXT_HEADER_TIMESLOT")?></th>
							<th><?= $this->translate("TXT_HEADER_REF")?></th>
							<th><?= $this->translate("TXT_HEADER_GUESTNAME")?></th>
							<th><?= $this->translate("TXT_HEADER_PARTYSIZE")?></th>
							<th><?= $this->translate("TXT_HEADER_REFERENCE")?></th>
							<th><?= $this->translate("TXT_HEADER_NOTES")?></th>
							<th><?= $this->translate("TXT_HEADER_STATUS")?></th>
							<th><?= $this->translate("TXT_HEADER_ARRIVED")?></th>
							<th><?= $this->translate("TXT_HEADER_GUESTID")?></th>
							<th><?= $this->translate("TXT_EDIT")?></th>
							<th><?= $this->translate("TXT_HEADER_DEL")?></th>
							<th><?= $this->translate("TXT_HEADER_GUEST_EMAIL")?></th>
							<th><?= $this->translate("TXT_HEADER_GUEST_TEL")?></th>
							<th><?= $this->translate("TXT_SERVING")?></th>
						</tr>
					</thead>
				</table>
			</div>
		</div>
	</div>
	<!-- Small modal -->
	<div id="ajax-modal" class="modal extended-modal fade no-display" tabindex="-1"></div>
</div>
<div aria-hidden="true" aria-labelledby="myModalLabel" role="dialog" tabindex="-1" class="modal bs-example-modal-basic fade">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button aria-hidden="true" data-dismiss="modal" class="close" type="button">
					×
				</button>
				<h4 id="myModalLabel" class="modal-title"><?= $this->translate("TXT_SELECT_DATE")?></h4>
			</div>
			<div class="modal-body">
				<div id="myfullcalendar" style="height:400px">
				</div>
			<div class="modal-footer">
				<button data-dismiss="modal" class="btn btn-default" type="button">
					<?= $this->translate("TXT_CLOSE")?>
				</button>
			</div>
		</div>
		<!-- /.modal-content -->
	</div>
	<!-- /.modal-dialog -->
</div>
<div aria-hidden="true" aria-labelledby="myModalLabel" role="dialog" tabindex="-1" class="modal nr-of-people fade">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button aria-hidden="true" data-dismiss="modal" class="close" type="button">
					×
				</button>
				<h4 id="myModalLabel" class="modal-title"><?= $this->translate("TXT_UPDATE_PARTYSIZE")?></h4>
			</div>
			<div class="modal-body">
				<div class="row">
					<div class="col-md-3"></div>
					<div class="col-md-6">
						<input id="nrofpeople" name="nrofpeople">
					</div>
					<div class="col-md-3">
						<button id="changenrpeople" class="btn btn-blue"><?= $this->translate("CHANGE")?></button>
					</div>
				</div>
			</div>
			<div class="modal-footer">
				<button data-dismiss="modal" class="btn btn-default" type="button">
					<?= $this->translate("TXT_CLOSE")?>
				</button>
			</div>
		</div>
		<!-- /.modal-content -->
	</div>
	<!-- /.modal-dialog -->
</div>
<div aria-hidden="true" aria-labelledby="myModalLabel" role="dialog" tabindex="-1" class="modal arrivaltime fade">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button aria-hidden="true" data-dismiss="modal" class="close" type="button">
					×
				</button>
				<h4 id="myModalLabel" class="modal-title"><?= $this->translate("TXT_UPDATE_ARRIVALTIME")?></h4>
			</div>
			<div class="modal-body">
				<div class="row">
					<div class="col-md-4"></div>
					<div class="col-md-4">
						<div class="input-group input-append bootstrap-timepicker">
							<input type="text" id="arrivaltime" name="arrivaltime" class="form-control time-picker initiate">
							<span class="input-group-addon add-on"><i class="fa fa-clock-o"></i></span>
						</div>
					</div>
					<div class="col-md-4">
						<button id="changearrivaltime" class="btn btn-blue"><?= $this->translate("CHANGE")?></button>
					</div>
				</div>
			</div>
			<div class="modal-footer">
				<button data-dismiss="modal" class="btn btn-default" type="button">
					<?= $this->translate("TXT_CLOSE")?>
				</button>
			</div>
		</div>
		<!-- /.modal-content -->
	</div>
	<!-- /.modal-dialog -->
</div>
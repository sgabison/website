
<!-- start: DYNAMIC TABLE PANEL -->
<div class="panel panel-white">
	<div class="panel-heading">
		<div class="col-md-3">
			<div class="form-group">
				<div class="input-group">
					<input id="calendar" name="calendar" type="text"
						data-date-format="dd-mm-yyyy" data-date-viewmode="years"
						class="form-control date-picker"> <span class="input-group-addon">
						<i class="fa fa-calendar"></i>
					</span>
				</div>
			</div>
		</div>
		<div class="col-md-3">
			<select id="select_location" class="form-control search-select">
				<?php $i=0;foreach($this->locations as $location){ ?>
				<option value='<?php echo $location->getId();?>'
				<?php if($i==0){echo 'selected';}?>><?php echo $location->getName();?></option>
				<?php $i++;
} ?>
			</select>
		</div>
		<div class="col-md-3">
			<button class="btn btn-transparent-grey">Fetch!</button>
		</div>
	</div>
</div>
<!-- end: DYNAMIC TABLE PANEL -->

<!-- start: DYNAMIC TABLE PANEL -->
<div class="panel panel-white">
	<div class="panel-heading">
		<h4 class="panel-title">
			<?= $this->translate("RESERVATION_LIST")?>
			<span class="text-bold"><?= $this->translate("Role")?> </span>
		</h4>
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
	</div>
	<div class="panel-body">
		<div class="row" id="example-dids">
			<a href="/fr/booking/reservation" class="demo ajax btn btn-blue">Create
				New Reservation</a>
			<table id="reservationList" class="display table table-striped"
				cellspacing="0" width="100%">
				<thead>
					<tr>
						<th></th>
						<th>TimeSlot</th>
						<th>Ref #</th>
						<th>Guest Name</th>
						<th>Partysize</th>
						<th>Reference</th>
						<th>Notes</th>
						<th>Status</th>
						<th>GuestID</th>
						<th>Edit</th>
						<th></th>
					</tr>
				</thead>
			</table>
		</div>
	</div>

	<!-- end: PAGE CONTENT-->
</div>
<!-- Small modal -->
<div class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog"
	aria-labelledby="mySmallModalLabel" aria-hidden="true">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-header">
				<button aria-hidden="true" data-dismiss="modal" class="close"
					type="button">×</button>
				<h4 id="myLargeModalLabel" class="modal-title">Modal Heading</h4>
			</div>
			<div class="modal-body">
				<p>Your content here.</p>
			</div>
			<div class="modal-footer">
				<button data-dismiss="modal" class="btn btn-default" type="button">
					Close</button>
				<button class="btn btn-primary" type="button">Save changes</button>
			</div>
		</div>
		<!-- /.modal-content -->
	</div>
</div>

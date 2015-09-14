
<!-- start: DYNAMIC TABLE PANEL -->
<div class="panel panel-white">
	<div class="panel-heading">
		<h4 class="panel-title">
			<?= $this->translate("TXT_LIST_RESERVATION")?>
			<span class="text-bold"><?= $this->translate("état")?> </span>
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
		<div class="row">
			<div class="col-md-12 space20">
				<button href="#newReservation" class="btn btn-green new-reservation">
					<?= $this->translate("Action 1")?>
					<i class="fa fa-plus"></i>
				</button>
				<button data-table="#reservationList"
					class="btn btn-orange print-table">
					<?= $this->translate("Print")?>
					<i class="fa fa-print"></i>
				</button>
				<div class="btn-group pull-right">
					<button data-toggle="dropdown"
						class="btn btn-green dropdown-toggle">
						Export <i class="fa fa-angle-down"></i>
					</button>
					<ul class="dropdown-menu dropdown-light pull-right">
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
						<li><a href="#" class="export-excel" data-table="#reservationList"
							data-ignoreColumn="0,2,5"> <img
								src='<?= PIMCORE_WEBSITE_LAYOUTS?>/assets/icons/xls.png'
								width='24px'> Export to Excel
						</a>
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
					</ul>
				</div>
			</div>
		</div>
		<div class="row">
			<!-- le contenu ici -->

			<div class="table-responsive col-md-12 space20">

				<table id="reservationList" class="display table table-striped">
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
</div>


<!-- start: DYNAMIC TABLE PANEL -->
<div class="panel panel-white">
	<div class="panel-heading">
		<h4 class="panel-title">
			<span class="text-bold"><?= $this->translate("TXT_LIST_GUEST")?> <?= $this->societe->getName()?></span>
			<?php if($this->q) : ?><?= $this->translate("TXT_RECHERCHE")?> : <?php echo $this->q ?><?php endif;?>
			<div class="print-table pull-right hidden-xs hidden-sm hidden-print"></div>
		</h4>		
	</div>
	<div class="panel-body">
		<div class="row">
			<div class="table-responsive col-md-12 space20">

				<table id="guestList" class="display table table-striped">
					<thead>
						<tr>
							<th></th>
							<th><?php echo $this->translate('TXT_ID');?></th>
							<th><?php echo $this->translate('TXT_LASTNAME');?></th>
							<th><?php echo $this->translate('TXT_TEL');?></th>
							<th><?php echo $this->translate('TXT_EMAIL');?></th>
							<th><?php echo $this->translate('TXT_EDIT');?></th>
							<th><?php echo $this->translate('TXT_RESERVATION');?></th>
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

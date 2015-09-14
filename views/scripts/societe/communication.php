<!-- start: DYNAMIC TABLE PANEL -->
<div class="panel panel-white">
	<div class="panel-heading">
		<h4 class="panel-title">
			<?= $this->translate("TXT_UPDATE_DEFAULT_EMAIL")?>
			<span class="text-bold"><?= $this->selectedLocation->getName()?> </span>
		</h4>
		<div class="panel-tools">
			<a class="panel-expand" href="#"> <i class="fa fa-expand"></i>
					<span> Fullscreen</span>
			</a>
		</div>
	</div>
	<div class="panel-body" style="height:500px">
		<form role="form" id="searchform" novalidate="novalidate" action="/liste-reservations">
			<div class="row">
				<div class="col-sm-12">
					<div class="form-group">
						<label class="control-label">
							Update your message directly using the editor capabilities
						</label>
						<textarea class="ckeditor form-control" cols="10" rows="10"></textarea>
					</div>
				</div>
			</div>
		</form>
	</div>
</div>
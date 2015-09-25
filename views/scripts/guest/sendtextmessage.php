<!-- start: FORM VALIDATION 1 PANEL -->
<div class="panel panel-white">
	<div class="panel-heading">
		<h4 class="panel-title"><?= $this->translate("TXT_COMMUNICATION")?> <span class="text-bold"><?= $this->translate("TXT_CLIENT")?></span></h4>
		<div class="panel-tools">
			<div class="dropdown">
				<a data-toggle="dropdown" class="btn btn-xs dropdown-toggle btn-transparent-grey">
					<i class="fa fa-cog"></i>
				</a>
				<ul class="dropdown-menu dropdown-light pull-right" role="menu">
					<li>
						<a class="panel-collapse collapses" href="#"><i class="fa fa-angle-up"></i> <span>Collapse</span> </a>
					</li>
					<li>
						<a class="panel-refresh" href="#">
							<i class="fa fa-refresh"></i> <span>Refresh</span>
						</a>
					</li>
					<li>
						<a class="panel-config" href="#panel-config" data-toggle="modal">
							<i class="fa fa-wrench"></i> <span>Configurations</span>
						</a>
					</li>
					<li>
						<a class="panel-expand" href="#">
							<i class="fa fa-expand"></i> <span>Fullscreen</span>
						</a>
					</li>
				</ul>
			</div>
			<a class="btn btn-xs btn-link panel-close" href="#">
				<i class="fa fa-times"></i>
			</a>
		</div>
	</div>
	<div class="panel-body">
		<h2><i class="fa fa-pencil-square"></i> <?= $this->translate("TXT_SEND_TEXT_MESSAGE")?></h2>
		<p>
			<?= $this->translate("TXT_INFO_COMMUNICATION")?>
		</p>
		<hr>
		<div role="form" class="form-horizontal">
			<div class="row">
				<div class="col-md-12">
					<div class="errorHandler alert alert-danger no-display">
						<i class="fa fa-times-sign"></i> You have some form errors. Please check below.
					</div>
					<div class="successHandler alert alert-success no-display">
						<i class="fa fa-ok"></i> Your form validation is successful!
					</div>
				</div>
				<div class="col-md-12">
					<div class="form-group">
						<label class="col-sm-3 control-label">
							<?= $this->translate("TXT_CELL_NUMBER")?>
						</label>
						<div class="col-sm-8">
							<input type="text" class="form-control" id="tel" disabled value="<?php echo $this->getParam('guesttel');?>">
							<input id="resaid" value="<?php echo $this->getParam('resaid');?>" class="no-display">
						</div>
					</div>
				</div>
				<div class="col-md-12">
					<div class="form-group">
						<label class="col-sm-3 control-label" for="form-field-20">
							<?= $this->translate("TXT_WRITE_SMS")?>
						</label>
						<div class="col-sm-8">
							<input type="text" id="smstext" placeholder="Text Field" id="form-field-20" class="form-control limited" maxlength="80">
						</div>
					</div>
				</div>
			</div>
			<div class="row">
				<div class="col-md-12">
					<div>
						<hr>
					</div>
				</div>
			</div>
			<div class="row">
				<div class="col-md-8">
				</div>
				<div class="col-md-4">
					<button class="btn btn-yellow btn-block" id="sendsms" value="send">
						<?= $this->translate("TXT_SEND")?> <i class="fa fa-arrow-circle-right"></i>
					</button>
				</div>
			</div>
		</div>
	</div>
</div>
<script>
jQuery(document).ready(function() {
	$resaid=$('#resaid').val();
	$('.limited').inputlimiter({
		remText: t('Il ne vous reste plus que %n caractère%s à écrire...'),
		remFullText: t('Stop! Vous ne pouvez plus écrire plus de caractères.'),
		limitText: t("Vous pouvez écrire jusque'à %n caractères dans ce champs.")
	});
	$('#sendsms').click( function(){
		  tel = $("#tel").val() 
		, smstext = $("#smstext").val()
		$.blockUI({
			message: '<i class="fa fa-spinner fa-spin"></i> Veuillez patienter...'
		});
		$.ajax({
			url: '/data/guest/sendsmstext',
			type:'POST', //obligatoire
			data: {tel: tel, resaid: $("#resaid").val(), smstext: smstext },
			success: function() {
				$.unblockUI();
				$('#ajax-modal').modal('hide');
				toastr.success(t('js_sms_sent'));
			},
			error: function (request, status, error) {
				alert(error);
			}        
		});
	});
});
</script>
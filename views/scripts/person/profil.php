<div class="panel panel-white">
	<div class="panel-body">	
		<form class="form-contributor" novalidate="novalidate">
			<div class="row">
				<div class="col-md-12">
					<div class="errorHandler alert alert-danger no-display">
						<i class="fa fa-times-sign"></i> <?= $this->translate("TXT_YOU_HAVE_ERRORS")?>
					</div>
					<div class="successHandler alert alert-success no-display">
						<i class="fa fa-ok"></i> <?= $this->translate("TXT_YOUR_FORM_VALIDATION_IS_SUCCESSFUL")?>
					</div>
				</div>
				<div class="col-md-6">
					<div class="form-group">
						<input class="contributor-index hide" type="text">
						<input class="contributor-id hide" type="text" value="<?= $this->person->getId();?>">
						<input class="contributor-form-method hide" type="text" value="PUT">
						<label class="control-label">
							<?= $this->translate("FIRSTNAME")?> <span class="symbol required"></span>
						</label>
						<input type="text" placeholder="<?= $this->translate('INSERT_FIRSTNAME')?>" class="form-control contributor-firstname" name="firstname" value="<?= $this->person->firstname;?>">
					</div>
					<div class="form-group">
						<label class="control-label">
							<?= $this->translate("LASTNAME")?> <span class="symbol required"></span>
						</label>
						<input type="text" placeholder="<?= $this->translate('INSERT_LASTNAME')?>" class="form-control contributor-lastname" name="lastname" value="<?= $this->person->lastname;?>">
					</div>
					<div class="form-group">
						<label class="control-label">
							<?= $this->translate("EMAIL")?> <span class="symbol required"></span>
						</label>
						<input type="email" placeholder="Text Field" class="form-control contributor-email" name="email" value="<?= $this->person->email;?>">
					</div>
					<div class="form-group">
						<label class="control-label">
							<?= $this->translate("PASSWORD")?> <span class="symbol required"></span>
						</label>
						<input type="password" class="form-control contributor-password" name="password">
					</div>
					<div class="form-group">
						<label class="control-label">
							<?= $this->translate("CONFIRM_PASSWORD")?> <span class="symbol required"></span>
						</label>
						<input type="password" class="form-control contributor-password-again" name="password_again">
					</div>
				</div>
				<div class="col-md-6">
<!--
					<div class="form-group">
						<label class="control-label">
							<?= $this->translate("PERMITS")?> <span class="symbol required"></span>
						</label>
						<select name="permits" class="form-control contributor-permits">
							<option value="1"><?= $this->translate("ADMIN")?></option>
							<option value="2"><?= $this->translate("VIEW_EDIT")?></option>
						</select>
					</div>
-->
					<div class="form-group">
						<div class="fileupload contributor-avatar fileupload-exists" data-provides="fileupload">
							<div class="fileupload-new thumbnail"><img src="http://resaexpress.com/website/views/layouts/assets/images/anonymous.jpg" alt="" width="200" height="200">
							</div>
							<div class="fileupload-preview fileupload-exists thumbnail" style="height:200px"><img src="<?php if($this->person->getAvatar() instanceof \Asset) : echo $this->person->getAvatar()->getThumbnail('resaexpress') ; else : echo '#'; endif; ?>"></div>
							<div class="contributor-avatar-options">
								<span class="btn btn-light-grey btn-file"><span class="fileupload-new"><i class="fa fa-picture-o"></i> <?= $this->translate("SELECT_IMAGE")?></span><span class="fileupload-exists"><i class="fa fa-picture-o"></i> <?= $this->translate("CHANGE")?></span>
									<input type="file">
								</span>
								<a href="#" class="btn fileupload-exists btn-light-grey" data-dismiss="fileupload">
									<i class="fa fa-times"></i> <?= $this->translate("DELETE")?>
								</a>
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="pull-right">
				<div class="btn-group">
					<button class="btn btn-info save-contributor" type="submit">
						<?= $this->translate("TXT_SAVE")?>
					</button>
				</div>
			</div>
		</form>
	</div>
</div>
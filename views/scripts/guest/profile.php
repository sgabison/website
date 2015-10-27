 
<?php if(!$this->guest): ?>	
				<? include( PIMCORE_LAYOUTS_DIRECTORY ."/inc_500.php") ; ?>

<div class="page-error animated shake">

	<div class="error-details col-sm-6 col-sm-offset-3 text-red	">
										<?php echo $this->t("TXT_ERROR_NO_GUEST")?>
									</div>
</div>
<?php else: ?>
<div class="tabbable">
	<ul class="nav nav-tabs tab-padding tab-space-3 tab-blue" id="myTab4">
		<li class="active"><a data-toggle="tab" href="#panel_edit_account">
												<?php echo $this->guest->getFullName().' '.$this->t("TXT_INFOS")?>
											</a></li>
		<li><a data-toggle="tab" href="#panel_projects">
												<?php echo $this->t("TXT_RESERVATIONS")?>
											</a></li>
	</ul>
	<div class="tab-content">
		<div id="panel_edit_account" class="tab-pane fade in active"">
			<form id="form-guest" novalidate="novalidate">
				<div class="row">
					<div class="col-md-6">
						<div class="errorHandler alert alert-danger no-display">
							<i class="fa fa-times-sign"></i> <?= $this->translate("TXT_YOU_HAVE_ERRORS")?>
					</div>
						<div class="successHandler alert alert-success no-display">
							<i class="fa fa-ok"></i> <?= $this->translate("TXT_YOUR_FORM_VALIDATION_IS_SUCCESSFUL")?>
					</div>
					</div>
				</div>
				<div class="row">
					<div class="col-md-6">
						<div class="form-group">
							<label class="control-label">
																<?= $this->t("Gender")?>
															</label>
							<div>
								<label class="radio-inline"> <input type="radio" class="grey"
									value="Female" name="title" id="title_female"
									<?php if($this->guest->getTitle()=="Female") :?>
									checked="checked" <?php endif;?>>
																	<?= $this->t("Female")?>
																</label> <label class="radio-inline"> <input
									type="radio" class="grey" value="Male" name="title"
									id="title_male" <?php if($this->guest->getTitle()=="Male") :?>
									checked="checked" <?php endif;?>>
																	<?= $this->t("Male")?>
																</label>
							</div>
						</div>
						
							<input class="guest-index hide" type="text"> 
							<input class="guest-id hide" name="id" type="text"
								value="<?= $this->guest->getId();?>"> 
							<input class="guest-form-method hide" type="text" value="PUT"> 
						<div class="form-group">
							<label class="control-label">
							<?= $this->translate("TXT_LASTNAME")?> <span class="symbol required"></span>
							</label> <input type="text"
								placeholder="<?= $this->translate('INSERT_LASTNAME')?>"
								class="form-control guest-lastname" name="lastname"
								value="<?= $this->guest->getLastname();?>">
						</div>
						<div class="form-group">
							<label class="control-label">
							<?= $this->translate("TXT_EMAIL")?>
							</label> <input type="email" placeholder="" id="email"
								class="form-control guest-email" name="email"
								value="<?= $this->guest->getEmail();?>">
						</div>
						<div class="form-group">
							<label class="control-label">
							<?= $this->translate("TXT_PHONE")?> 
							</label> <input type="tel" placeholder="" id="tel"
								class="form-control guest-email" name="tel"
								value="<?= $this->guest->getTel();?>">
						</div>
					</div>
 
					<div class="col-md-6">
						<div class="form-group">
							<label class="control-label"> <?= $this->translate("TXT_PREFERRED_LANGUAGE")?> </label> 
							<select class="form-control"  id="preferredlanguage" name="preferredlanguage">
								<option value="en" <?php if($this->guest->getPreferredlanguage() == 'en'){echo 'selected';}?>> <?= $this->translate("ENGLISH")?></option>
								<option value="fr" <?php if($this->guest->getPreferredlanguage() == 'fr'|| $this->guest->getPreferredlanguage() == '' ){echo 'selected';}?>> <?= $this->translate("FRENCH")?></option>
							</select>
						</div>
						<div class="form-group" style="margin-left:20px">
							<label class="control-label"> <?php echo $this->translate("TXT_NEWSLETTER");?></label> 
							<input type="checkbox" class="grey" id="newsLetter" name="newsLetter" placeholder="" <?php if( $this->guest->getNewsLetter() =='1'){echo "checked value='1'";}else{echo "value='0'";}?>>
						</div>
						<div class="pull-right">
							<div class="btn-group">
								<button class="btn btn-info save-guest" type="submit">
									<?= $this->translate("TXT_SAVE")?>
								</button>
							</div>
						</div>
						
<!--
						<div class="form-group">
							<label class="control-label"> Google Plus </label> <span
								class="input-icon"> <input class="form-control" type="text"
								placeholder=""> <i class="fa fa-google-plus"></i>
							</span>
						</div>
						<div class="form-group">
							<label class="control-label"> Skype </label> <span
								class="input-icon"> <input class="form-control" type="text"
								placeholder=""> <i class="fa fa-skype"></i>
							</span>
						</div>
-->
					</div>

				</div>

				<div class="row">
					<div class="col-md-6"></div>
					<div class="col-md-6">

					</div>
				</div>

			</form>
		</div>

		<div id="panel_projects" class="tab-pane fade">
				<?php echo ($this->listReservations) ? $this->listReservations: $this->t("TXT_NO_RESERVATIONS"); ?>
		</div>
	</div>
</div>
<?php endif; ?>								 

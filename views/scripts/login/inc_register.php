<!-- start: REGISTER BOX -->
				<div class="box-register">
					<h3><?php echo $this->t('Sign Up')?></h3>
					<p>
						<?php echo $this->t('Enter your personal details below:')?>
					</p>
					<form class="form-register">
						<div class="errorHandler alert alert-danger no-display">
							<i class="fa fa-remove-sign"></i> <? if( $this->error) echo $this->translate($this->error)?>
						</div>
						<fieldset>
							<div class="form-group">
								<span class="input-icon">
								<input type="text" class="form-control" name="reference" placeholder="<?= $this->t("TXT_REFERENCE_SOCIETE")?>" >
								<i class="fa fa-lock"></i>
									<a class="getreference" href="http://ticketpack.fr/logiciel/accueil/27-solution-internet-ticketscanfr.html" target="_blank">
										<?= $this->t("TXT_OBTENIR_REFERENCE_SOCIETE")?>
									</a> </span>
							</div>
							<div class="form-group">
									<input type="text" class="form-control" name="firstname" placeholder="<?php echo $this->t('First Name')?>">
							</div>
							<div class="form-group">
									<input type="text" class="form-control" name="lastname" placeholder="<?php echo $this->t('Last Name')?>">
							</div>
							<div class="form-group">
								<span class="input-icon"><input type="text" class="form-control" name="address" placeholder="<?php echo $this->t('Address')?>"><i class="fa fa-envelope"></i> </span>
							</div>
							<div class="form-group">
								<input type="text" class="form-control" name="city" placeholder="<?php echo $this->t('City')?>">
							</div>
							<div class="form-group">
								<div>
									<label class="radio-inline">
										<input type="radio" class="grey" value="female" name="gender">
										<?php echo $this->t('Female')?>
									</label>
									<label class="radio-inline">
										<input type="radio" class="grey" value="male" name="gender">
										<?php echo $this->t('Male')?>
									</label>
								</div>
							</div>
							<div class="form-group">								
									<input type="text" class="form-control" id="phone" name="phone" placeholder="<?php echo $this->t('Phone number')?>">
							</div>
							<p>
								<?= $this->t("Enter your account details below:")?>
							</p>
							<div class="form-group">
								<span class="input-icon">
									<input type="email" class="form-control" name="email" placeholder="<?php echo $this->t('Email')?>">
									<i class="fa fa-envelope"></i> </span>
							</div>
							<div class="form-group">
								<span class="input-icon">
									<input type="password" class="form-control" id="password_register" name="password" placeholder="<?php echo $this->t('Password')?>">
									<i class="fa fa-lock"></i> </span>
							</div>
							<div class="form-group">
								<span class="input-icon">
									<input type="password" class="form-control" name="password_again" placeholder="<?php echo $this->t('Password Again')?>">
									<i class="fa fa-lock"></i> </span>
							</div>
							<div class="form-group">
								<div>
									<label for="agree" class="checkbox-inline">
										<input type="checkbox" class="grey agree" id="agree" name="agree">
										<?= $this->t("I agree to the Terms of Service and Privacy Policy")?>
									</label>
								</div>
							</div>
							<div class="form-actions">
								<?= $this->t("Already have an account?")?>
								<a href="#" class="go-back">
									<?php echo $this->t('Log-in')?>
								</a>
								<button type="submit" class="btn btn-green pull-right">
									<?= $this->t("Submit")?> <i class="fa fa-arrow-circle-right"></i>
								</button>
							</div>
						</fieldset>
					</form>
				<? include( PIMCORE_LAYOUTS_DIRECTORY ."/inc_copyright.php") ; ?>
				</div>
				<!-- end: REGISTER BOX -->
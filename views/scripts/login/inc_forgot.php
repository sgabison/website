				<!-- start: FORGOT BOX -->
				<div class="box-forgot">
					<h3><?php echo $this->t('Forget Password?') ?></h3>
					<p>
						<?php echo $this->t('Enter your e-mail address below to reset your password.') ?>
					</p>
					<form class="form-forgot">
						<div class="errorHandler alert alert-danger no-display">
							<i class="fa fa-remove-sign"></i> <? if( $this->error) echo $this->translate($this->error)?>
						</div>
						<fieldset>
							<div class="form-group">
								<span class="input-icon">
									<input type="email" class="form-control" name="email" placeholder="Email" value="<?php echo $this->getParam('email')?>">
									<i class="fa fa-envelope"></i> </span>
							</div>
							<div class="form-actions">
								<a class="btn btn-light-grey go-back">
									<i class="fa fa-chevron-circle-left"></i> <?php echo $this->t('Log-In')?>
								</a>
								<button type="submit" class="btn btn-green pull-right">
									<?php echo $this->t('Submit') ?> <i class="fa fa-arrow-circle-right"></i>
								</button>
							</div>
						</fieldset>
					</form>
					<? include( PIMCORE_LAYOUTS_DIRECTORY ."/inc_copyright.php") ; ?>

				</div>
				<!-- end: FORGOT BOX -->
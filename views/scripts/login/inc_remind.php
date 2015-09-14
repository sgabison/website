				<!-- start: REMIND BOX -->
				<div class="box-remind">
					<h3>Sign in to your account</h3>
					<p>
						<?= $this->translate("Entrez votre nouveau mot de passe")?>
					</p>
					<form class="form-remind" >
						<div class="errorHandler alert alert-danger <? if(!$this->error) echo 'no-display'?> ">
							<i class="fa fa-remove-sign"></i> <? if($this->error) echo $this->translate($this->error) ?>
						</div>
						<fieldset>
							<div class="form-group">
								<span class="input-icon">
									<input type="email" class="form-control" id="email" name="email" type="email" value="<?php echo $this->getParam('email')?>" readonly>
									<i class="fa fa-user"></i> </span>
							</div>
							<input	type="hidden" id="password" name="password"	value="<?php echo $this->getParam('password')?>">

							<div class="form-group form-actions">
								<span class="input-icon">
									<input id="newpassword" type="password" class="form-control password" name="newpassword" placeholder="Password">
									<i class="fa fa-lock"></i>
								</span>
							</div>
							<div class="form-group form-actions">
								<span class="input-icon">
									<input id="newpassword_again" type="password" class="form-control password" name="newpassword_again" placeholder="<?= $this->translate("Entrez votre mot de passe à nouveau")?>">
									<i class="fa fa-lock"></i>
								</span>
							</div>

							<div class="form-actions">
								<button type="submit" class="btn btn-green pull-right">
									Login <i class="fa fa-arrow-circle-right"></i>
								</button>
							</div>
						</fieldset>
					</form>
					<? include( PIMCORE_LAYOUTS_DIRECTORY ."/inc_copyright.php") ; ?>
				</div>
				<!-- end: REMIND BOX -->
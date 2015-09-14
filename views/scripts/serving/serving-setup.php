
			<div class="panel panel-white">
				<div class="panel-heading">
					<h4 class="panel-title"><span class="text-bold"><?php echo $this->translate('TXT_SETUP_SERVING_SET_UP');?> : <?php echo $this->title;?></span></h4>
				</div>
				<div class="panel-body">
					<form action="#" role="form" id="servingform" novalidate="novalidate">
						<input type="hidden" class="form-control" id="servingid" name="servingid" value="<?php if($this->serving) echo $this->serving->getId();?>">
						<div class="row">
							<div class="col-md-12">
								<div class="errorHandler alert alert-danger no-display">
									<i class="fa fa-times-sign"></i> <?php echo $this->translate('TXT_YOU_HAVE_SOME_ERRORS_PLEASE_CHECK_BELOW');?>
								</div>
								<div class="successHandler alert alert-success no-display">
									<i class="fa fa-ok"></i> <?php echo $this->translate('TXT_YOUR_FORM_VALIDATION_IS_SUCCESSFULL');?>
								</div>
							</div>
						</div>
						<div class="row">
							
							<div class="col-md-12 form-horizontal">
								<div class="form-group col-md-3">
									<label class="control-label">
										<?php echo $this->translate('TXT_SERVING_SETUP_AVERAGE_MEALDURATION');?><span class="symbol required"></span>
									</label>
								</div>	
								<div class="col-md-3">
									<input type="number" placeholder="Max seats" class="form-control" id="mealduration" name="mealduration" value="<?php echo $this->mealduration;?>">
								</div>
							</div>
							<div class="col-md-5">
								<div class="col-md-4">
									<div class="form-group">
										<label class="control-label">
											<?php echo $this->translate('MONDAY');?>
										</label>
									</div>
									<div class="form-group">
										<input type="checkbox" name="closedmonday" id="closedmonday" class="make-switch" data-on-color="success" data-off-color="danger" data-on-text="O" data-off-text="X" <?php if( $this->closedmonday==0 ){ echo 'checked';};?>>
									</div>
									<div class="form-group">
										<label class="control-label">
											<?php echo $this->translate('TXT_TIME_START');?>
										</label>
										<div class="input-group input-append bootstrap-timepicker">
											<input type="text" id="timestartmonday" name="timestartmonday" class="form-control time-picker" <?php if( $this->closedmonday==0 ){ echo 'value="'.date('H:i', strtotime($this->timestartmonday)).'"';}else{echo 'value="00:00" disabled' ;}?>>
											<span class="input-group-addon add-on"><i class="fa fa-clock-o"></i></span>
										</div>
									</div>
									<div class="form-group">
										<label class="control-label">
											<?php echo $this->translate('TXT_TIME_END');?>
										</label>
										<div class="input-group input-append bootstrap-timepicker">
											<input type="text" id="timeendmonday" name="timeendmonday" class="form-control time-picker" <?php if( $this->closedmonday==0 ){ echo 'value="'.date('H:i', strtotime($this->timeendmonday)).'"';}else{echo 'value="00:00" disabled' ;}?>>
											<span class="input-group-addon add-on"><i class="fa fa-clock-o"></i></span>
										</div>
									</div>
									<div class="form-group">
										<label class="control-label">
											<?php echo $this->translate('TXT_MAX_SEATS');?> <span class="symbol required"></span>
										</label>
										<input type="number" placeholder="Max seats" class="form-control" id="maxseatsmonday" name="maxseatsmonday" value="<?php echo $this->maxseatsmonday;?>" <?php if( $this->closedmonday!=0 ){echo 'disabled';}?>>
									</div>
									<div class="form-group">
										<label class="control-label">
											<?php echo $this->translate('TXT_MAX_TABLES');?> <span class="symbol required"></span>
										</label>
										<input type="number" placeholder="Max tables" class="form-control" id="maxtablesmonday" name="maxtablesmonday" value="<?php echo $this->maxtablesmonday;?>" <?php if( $this->closedmonday!=0 ){echo 'disabled';}?>>
									</div>
								</div>
								<div class="col-md-4">
									<div class="form-group">
										<label class="control-label">
											<?php echo $this->translate('TUESDAY');?>
										</label>
									</div>
									<div class="form-group">
										<input type="checkbox" name="closedtuesday" id="closedtuesday" class="make-switch" data-on-color="success" data-off-color="danger" data-on-text="O" data-off-text="X" <?php if( $this->closedtuesday==0  ){ echo 'checked';};?>>
									</div>
									<div class="form-group">
										<label class="control-label">
											<?php echo $this->translate('TXT_TIME_START');?>
										</label>
										<div class="input-group input-append bootstrap-timepicker">
											<input type="text" id="timestarttuesday" name="timestarttuesday" class="form-control time-picker" <?php if( $this->closedtuesday==0 ){ echo 'value="'.date('H:i', strtotime($this->timestarttuesday)).'"';}else{echo 'value="00:00" disabled' ;}?>>
											<span class="input-group-addon add-on"><i class="fa fa-clock-o"></i></span>
										</div>
									</div>
									<div class="form-group">
										<label class="control-label">
											<?php echo $this->translate('TXT_TIME_END');?>
										</label>
										<div class="input-group input-append bootstrap-timepicker">
											<input type="text" id="timeendtuesday" name="timeendtuesday" class="form-control time-picker" <?php if( $this->closedtuesday==0 ){ echo 'value="'.date('H:i', strtotime($this->timeendtuesday)).'"';}else{echo 'value="00:00" disabled' ;}?>>
											<span class="input-group-addon add-on"><i class="fa fa-clock-o"></i></span>
										</div>
									</div>
									<div class="form-group">
										<label class="control-label">
											<?php echo $this->translate('TXT_MAX_SEATS');?> <span class="symbol required"></span>
										</label>
										<input type="number" placeholder="Max seats" class="form-control" id="maxseatstuesday" name="maxseatstuesday" value="<?php echo $this->maxseatstuesday;?>" <?php if( $this->closedtuesday!=0 ){echo 'disabled';}?>>
									</div>
									<div class="form-group">
										<label class="control-label">
											<?php echo $this->translate('TXT_MAX_TABLES');?> <span class="symbol required"></span>
										</label>
										<input type="number" placeholder="Max tables" class="form-control" id="maxtablestuesday" name="maxtablestuesday" value="<?php echo $this->maxtablestuesday;?>" <?php if( $this->closedmtuesday!=0 ){echo 'disabled';}?>>
									</div>
								</div>
								<div class="col-md-4">
									<div class="form-group">
										<label class="control-label">
											<?php echo $this->translate('WEDNESDAY');?>
										</label>
									</div>
									<div class="form-group">
										<input type="checkbox" name="closedwednesday" id="closedwednesday" class="make-switch" data-on-color="success" data-off-color="danger" data-on-text="O" data-off-text="X" <?php if( $this->closedwednesday==0  ){ echo 'checked';};?>>
									</div>
									<div class="form-group">
										<label class="control-label">
											<?php echo $this->translate('TXT_TIME_START');?>
										</label>
										<div class="input-group input-append bootstrap-timepicker">
											<input type="text" name="timestartwednesday" id="timestartwednesday" class="form-control time-picker" <?php if( $this->closedwednesday==0 ){ echo 'value="'.date('H:i', strtotime($this->timestartwednesday)).'"';}else{echo 'value="00:00" disabled' ;}?>>
											<span class="input-group-addon add-on"><i class="fa fa-clock-o"></i></span>
										</div>
									</div>
									<div class="form-group">
										<label class="control-label">
											<?php echo $this->translate('TXT_TIME_END');?>
										</label>
										<div class="input-group input-append bootstrap-timepicker">
											<input type="text" name="timeendwednesday" id="timeendwednesday" class="form-control time-picker"  <?php if( $this->closedwednesday==0 ){ echo 'value="'.date('H:i', strtotime($this->timeendwednesday)).'"';}else{echo 'value="00:00" disabled' ;}?>>
											<span class="input-group-addon add-on"><i class="fa fa-clock-o"></i></span>
										</div>
									</div>
									<div class="form-group">
										<label class="control-label">
											<?php echo $this->translate('TXT_MAX_SEATS');?> <span class="symbol required"></span>
										</label>
										<input type="number" placeholder="Max seats" class="form-control" id="maxseatswednesday" name="maxseatswednesday" value="<?php echo $this->maxseatswednesday;?>" <?php if( $this->closedwednesday!=0 ){echo 'disabled';}?>>
									</div>
									<div class="form-group">
										<label class="control-label">
											<?php echo $this->translate('TXT_MAX_TABLES');?> <span class="symbol required"></span>
										</label>
										<input type="number" placeholder="Max tables" class="form-control" id="maxtableswednesday" name="maxtableswednesday" value="<?php echo $this->maxtableswednesday;?>" <?php if( $this->closedwednesday!=0 ){echo 'disabled';}?>>
									</div>
								</div>
							</div>
							<div class="col-md-7">
								<div class="col-md-3">
									<div class="form-group">
										<label class="control-label">
											<?php echo $this->translate('THURSDAY');?>
										</label>
									</div>
									<div class="form-group">
										<input type="checkbox" id="closedthursday" name="closedthursday" class="make-switch" data-on-color="success" data-off-color="danger" data-on-text="O" data-off-text="X" <?php if( $this->closedthursday==0  ){ echo 'checked';};?>>
									</div>
									<div class="form-group">
										<label class="control-label">
											<?php echo $this->translate('TXT_TIME_START');?>
										</label>
										<div class="input-group input-append bootstrap-timepicker">
											<input type="text" name="timestartthursday" id="timestartthursday" class="form-control time-picker" <?php if( $this->closedthursday==0 ){ echo 'value="'.date('H:i', strtotime($this->timestartthursday)).'"';}else{echo 'value="00:00" disabled' ;}?>>
											<span class="input-group-addon add-on"><i class="fa fa-clock-o"></i></span>
										</div>
									</div>
									<div class="form-group">
										<label class="control-label">
											<?php echo $this->translate('TXT_TIME_END');?>
										</label>
										<div class="input-group input-append bootstrap-timepicker">
											<input type="text" name="timeendthursday" id="timeendthursday" class="form-control time-picker" <?php if( $this->closedthursday==0 ){ echo 'value="'.date('H:i', strtotime($this->timeendthursday)).'"';}else{echo 'value="00:00" disabled' ;}?>>
											<span class="input-group-addon add-on"><i class="fa fa-clock-o"></i></span>
										</div>
									</div>
									<div class="form-group">
										<label class="control-label">
											<?php echo $this->translate('TXT_MAX_SEATS');?> <span class="symbol required"></span>
										</label>
										<input type="number" placeholder="Max seats" class="form-control" id="maxseatsthursday" name="maxseatsthursday" value="<?php echo $this->maxseatsthursday;?>" <?php if( $this->closedthursday!=0 ){echo 'disabled';}?>>
									</div>
									<div class="form-group">
										<label class="control-label">
											<?php echo $this->translate('TXT_MAX_TABLES');?> <span class="symbol required"></span>
										</label>
										<input type="number" placeholder="Max tables" class="form-control" id="maxtablesthursday" name="maxtablesthursday" value="<?php echo $this->maxtablesthursday;?>" <?php if( $this->closedthursday!=0 ){echo 'disabled';}?>>
									</div>
								</div>
								<div class="col-md-3">
									<div class="form-group">
										<label class="control-label">
											<?php echo $this->translate('FRIDAY');?>
										</label>
									</div>
									<div class="form-group">
										<input type="checkbox" name="closedfriday" id="closedfriday" class="make-switch" data-on-color="success" data-off-color="danger" data-on-text="O" data-off-text="X" <?php if( $this->closedfriday==0 ){ echo 'checked';};?>>
									</div>
									<div class="form-group">
										<label class="control-label">
											<?php echo $this->translate('TXT_TIME_START');?>
										</label>
										<div class="input-group input-append bootstrap-timepicker">
											<input type="text" name="timestartfriday" id="timestartfriday" class="form-control time-picker" <?php if( $this->closedfriday==0 ){ echo 'value="'.date('H:i', strtotime($this->timestartfriday)).'"';}else{echo 'value="00:00" disabled' ;}?>>
											<span class="input-group-addon add-on"><i class="fa fa-clock-o"></i></span>
										</div>
									</div>
									<div class="form-group">
										<label class="control-label">
											<?php echo $this->translate('TXT_TIME_END');?>
										</label>
										<div class="input-group input-append bootstrap-timepicker">
											<input type="text" name="timeendfriday" id="timeendfriday" class="form-control time-picker" <?php if( $this->closedfriday==0 ){ echo 'value="'.date('H:i', strtotime($this->timeendfriday)).'"';}else{echo 'value="00:00" disabled' ;}?>>
											<span class="input-group-addon add-on"><i class="fa fa-clock-o"></i></span>
										</div>
									</div>
									<div class="form-group">
										<label class="control-label">
											<?php echo $this->translate('TXT_MAX_SEATS');?> <span class="symbol required"></span>
										</label>
										<input type="number" placeholder="Max seats" class="form-control" id="maxseatsfriday" name="maxseatsfriday" value="<?php echo $this->maxseatsfriday;?>" <?php if( $this->closedfriday!=0 ){echo 'disabled';}?>>
									</div>
									<div class="form-group">
										<label class="control-label">
											<?php echo $this->translate('TXT_MAX_TABLES');?> <span class="symbol required"></span>
										</label>
										<input type="number" placeholder="Max tables" class="form-control" id="maxtablesfriday" name="maxtablesfriday" value="<?php echo $this->maxtablesfriday;?>" <?php if( $this->closedfriday!=0 ){echo 'disabled';}?>>
									</div>
								</div>
								<div class="col-md-3">
									<div class="form-group">
										<label class="control-label">
											<?php echo $this->translate('SATURDAY');?>
										</label>
									</div>
									<div class="form-group">
										<input type="checkbox" id="closedsaturday" name="closedsaturday" class="make-switch" data-on-color="success" data-off-color="danger" data-on-text="O" data-off-text="X" <?php if( $this->closedsaturday==0 ){ echo 'checked';};?>>
									</div>
									<div class="form-group">
										<label class="control-label">
											<?php echo $this->translate('TXT_TIME_START');?>
										</label>
										<div class="input-group input-append bootstrap-timepicker">
											<input type="text" name="timestartsaturday" id="timestartsaturday" class="form-control time-picker" <?php if( $this->closedsaturday==0 ){ echo 'value="'.date('H:i', strtotime($this->timestartsaturday)).'"';}else{echo 'value="00:00" disabled' ;}?>>
											<span class="input-group-addon add-on"><i class="fa fa-clock-o"></i></span>
										</div>
									</div>
									<div class="form-group">
										<label class="control-label">
											<?php echo $this->translate('TXT_TIME_END');?>
										</label>
										<div class="input-group input-append bootstrap-timepicker">
											<input type="text" name="timeendsaturday" id="timeendsaturday" class="form-control time-picker" <?php if( $this->closedsaturday==0 ){ echo 'value="'.date('H:i', strtotime($this->timeendsaturday)).'"';}else{echo 'value="00:00" disabled' ;}?>>
											<span class="input-group-addon add-on"><i class="fa fa-clock-o"></i></span>
										</div>
									</div>
									<div class="form-group">
										<label class="control-label">
											<?php echo $this->translate('TXT_MAX_SEATS');?> <span class="symbol required"></span>
										</label>
										<input type="number" placeholder="Max seats" class="form-control" id="maxseatssaturday" name="maxseatssaturday"  value="<?php echo $this->maxseatssaturday;?>" <?php if( $this->closedsaturday!=0 ){echo 'disabled';}?>>
									</div>
									<div class="form-group">
										<label class="control-label">
											<?php echo $this->translate('TXT_MAX_TABLES');?> <span class="symbol required"></span>
										</label>
										<input type="number" placeholder="Max tables" class="form-control" id="maxtablessaturday" name="maxtablessaturday" value="<?php echo $this->maxtablessaturday;?>" <?php if( $this->closedsaturday!=0 ){echo 'disabled';}?>>
									</div>
								</div>
								<div class="col-md-3">
									<div class="form-group">
										<label class="control-label">
											<?php echo $this->translate('SUNDAY');?>
										</label>
									</div>
									<div class="form-group">
										<input type="checkbox" id="closedsunday" name="closedsunday" class="make-switch" data-on-color="success" data-off-color="danger" data-on-text=" O " data-off-text=" X " <?php if( $this->closedsunday==0 ){ echo 'checked';};?>>
									</div>
									<div class="form-group">
										<label class="control-label">
											<?php echo $this->translate('TXT_TIME_START');?>
										</label>
										<div class="input-group input-append bootstrap-timepicker">
											<input type="text" name="timestartsunday" id="timestartsunday" class="form-control time-picker" <?php if( $this->closedsunday==0 ){ echo 'value="'.date('H:i', strtotime($this->timestartsunday)).'"';}else{echo 'value="00:00" disabled' ;}?>>
											<span class="input-group-addon add-on"><i class="fa fa-clock-o"></i></span>
										</div>
									</div>
									<div class="form-group">
										<label class="control-label">
											<?php echo $this->translate('TXT_TIME_END');?>
										</label>
										<div class="input-group input-append bootstrap-timepicker">
											<input type="text" name="timeendsunday" id="timeendsunday" class="form-control time-picker" <?php if( $this->closedsunday==0 ){ echo 'value="'.date('H:i', strtotime($this->timeendsunday)).'"';}else{echo 'value="00:00" disabled' ;}?>>
											<span class="input-group-addon add-on"><i class="fa fa-clock-o"></i></span>
										</div>
									</div>
									<div class="form-group">
										<label class="control-label">
											<?php echo $this->translate('TXT_MAX_SEATS');?> <span class="symbol required"></span>
										</label>
										<input type="number" placeholder="Max seats" class="form-control" id="maxseatssunday" name="maxseatssunday"  value="<?php echo $this->maxseatssunday;?>" <?php if( $this->closedsunday!=0 ){echo 'disabled';}?>>
									</div>
									<div class="form-group">
										<label class="control-label">
											<?php echo $this->translate('TXT_MAX_TABLES');?> <span class="symbol required"></span>
										</label>
										<input type="number" placeholder="Max tables" class="form-control" id="maxtablessunday" name="maxtablessunday" value="<?php echo $this->maxtablessunday;?>" <?php if( $this->closedsunday!=0 ){echo 'disabled';}?>>
									</div>
								</div>
							</div>
						</div>
						<div class="row">
							<div class="col-md-12">
								<div>
									<span class="symbol required"></span>Required Fields
									<hr>
								</div>
							</div>
						</div>
						<div class="row">
							<div class="col-md-8">
								<input name="id" id="id" style="display:none">
								<input name="locationid" id="locationid" style="display:none">
							</div>
							<input name='doaction' value='servingform' style='display:none'>
							<div class="col-md-4">
								<button class="btn btn-yellow btn-block" type="submit" value='submit' id='formsubmit'>
									Register <i class="fa fa-arrow-circle-right"></i>
								</button>
							</div>
						</div>
					</form>
				</div>
			</div>
			<!-- end: FORM VALIDATION 1 PANEL -->

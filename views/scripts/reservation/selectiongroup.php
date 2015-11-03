<div class="ajax-white-backdrop2" style="display: block;"></div>		
		<div class="form-group">		
			<div class="text-bold no-display" id="locationlink">
				<input id="method" name="method" value="<?php if($this->getParam('reservationid')){echo 'CHANGE';}else{echo 'POST';}?>" class="no-display">
			</div>
		</div>
		<div id="calendarbox">
			<h4><span class="text-bold"><?php echo $this->translate('TXT_SELECT_DATE');?></span></h4>
			<div class="col-md-12">
				<input id="mycalendar" name="calendar" type="text" data-date-format="dd-mm-yyyy" data-date-viewmode="years" class="form-control date-picker mycalendar no-display" value="<?php if($this->resadate){echo $this->resadate;}?>" style="width:205px">
				<div id="fullcalendar" style="margin-left:-15px; margin-right:-15px"></div>
			</div>
		</div>
		<div id="partybox" class="no-display" style="margin-top:10px">
			<h4><span class="text-bold"><?php echo $this->translate('TXT_SELECT_PARTY');?></span></h4>
			<!--<input id="party" class="no-display" value="<?php if($this->partysize){echo $this->partysize;}?>">-->
			<div class="col-md-12 form-group lessthanseven" style="margin-top:10px">
				<?php $i=0; while($i<10){ 
					$i++;?>
				<button id="partybutton<?php echo $i;?>" type="button" class="btn btn-lg btn-default partybutton partyselection" style="margin:5px" value="<?php echo $i;?>"> <?php echo $i;?> </button>
				<?php } ?>
				<button id="morethansevenbutton" type="button" class="btn btn-lg btn-default" style="margin:5px" > + </button>
			</div>
			<div class="col-md-2 no-display morethanseven" id="lessthansevenbutton" style="margin-top:15px">
				<button type="button" class="btn btn-lg btn-default"> - </button>
			</div>
			<div class="col-md-10 form-group no-display morethanseven" id="morethansevenselect" style="margin-top:15px">
				<select id="partyselect" class="form-control selectpartyselection" style="font-size:large">
					<option value='10'><?= $this->translate('TXT_FOR');?> 10 <?= $this->translate('TXT_PEOPLE');?></option>
					<?php $i=10; while($i<25){ 
						$i++;
						echo "<option value='".$i."' ".$select.">".$this->translate('TXT_FOR')." ".$i." ".$this->translate('TXT_PEOPLE')."</option>";
				     } ?>
				</select>
			</div>
		</div>
		<div class='no-display' id='selectgroup'>
			<div class="form-group">
				<h4><span class="text-bold"><?php echo $this->translate('TXT_SELECT_SERVING');?></span></h4>
				<div id="servings" class="space20 panel-body buttons-widget"></div>
			</div>
			<div class="form-group">
				<h4><span class="text-bold"><?php echo $this->translate('TXT_SELECT_TIMESLOT');?></span></h4>
				<div id="slots" class="space20 panel-body buttons-widget"></div>
			</div>
		</div>
	</div>
</div>
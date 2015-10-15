<div>
	<div class="btn-group btn-group-justified">
		<a class="linkhref calendarhref locationlinkfinal btn btn-default">
			<i class="fa fa-calendar fa-lg text-muted calendarlinkdata"></i><br>
			<span class="text-muted" id="calendarlinkdata"><?php $date=new \Zend_date(); echo $date->get('dd-MM-yyyy');?></span>
		</a>
		<a class="linkhref calendarhref locationlinkfinal btn btn-default">
		<i class="fa fa-users fa-lg text-muted personlinkdata"></i><br>
			<span class="text-muted" id="personlinkdata"><?php if($this->partysize){echo $this->partysize;}?></span> 
			<span class="text-muted"><?php echo $this->translate('TXT_PEOPLE');?></span>
		</a>
		<a class="linkhref calendarhref locationlinkfinal btn btn-default">
			<i class="fa fa-clock-o fa-lg text-muted slotlinkdata"></i><br>
			<span class="text-muted" id="slotlinkdata"><?php if($this->slot){echo $this->slot;}else{echo $this->translate('TXT_TIME');}?></span>
		</a>	
	</div>
	<table class="table table-hover registergroup2 no-display" id="sample-table-4" style="table-layout: fixed;">
		<tbody>
			<tr class="registergroup2 no-display">
				<td class="col-md-4">
					<span class="text-bold"><?php echo $this->translate('TXT_NAME');?>:</span>
				</td>
				<td class="col-md-4 reg-data" colspan="2">
					<span id="reg-lastname"></span>
				</td>
			</tr>
			<tr class="registergroup2 no-display">
				<td class="col-md-4">
					<span class="text-bold"><?php echo $this->translate('TXT_TEL');?>:</span>
				</td>
				<td class="col-md-4 reg-data" colspan="2">
					<span id="reg-tel"></span>
				</td>
			</tr>
			<tr class="registergroup2 no-display">
				<td class="col-md-4">
					<span class="text-bold"><?php echo $this->translate('TXT_EMAIL');?>:</span>
				</td>
				<td class="col-md-4 reg-data" colspan="2">
					<span id="reg-email"></span>
				</td>
			</tr>
		</tbody>
	</table>
</div>
<div>
	<div class="form-group no-display">		
		<span class="text-bold" id="locationbox">
			<input id="offdays" class="no-display" value="<?php echo $this->offdaysrange;?>"> 
			<input id="method2" name="method2" value="CHANGE" class="no-display">
			<input id="select_location" value='<?php echo $this->selectedLocation->getId();?>' class="no-display" disabled> 
		</span>
	</div>
	<div class="form-group">
		<div id="calendarbox" class="panel panel-white">
			<input id="mycalendar" name="calendar" type="text" data-date-format="dd-mm-yyyy" data-date-viewmode="years" class="form-control date-picker mycalendar no-display" value="<?php if($this->resadate){echo $this->resadate;}?>" style="width:205px">
			<div class="col-md-12 col-sm-12">
				<div class="col-md-4 col-sm-4"></div>
				<div class="col-md-4 col-sm-4">
					<h4><span class="text-bold"><?php echo $this->translate('TXT_SELECT_DATE');?></span></h4>
					<div id="fullcalendar" style="max-width:400px;"></div>
				</div>
				<div class="col-md-4 col-sm-4"></div>
			</div>
		</div>
	</div>	
	<div class="form-group col-md-12 col-sm-12" id="peopleselectiongroup">
		<div id="partybox" class="no-display" style="margin-top:10px; margin-left:-15px; margin-right:-15px">
			<div class="col-md-4 col-sm-4"></div>
			<div class="col-md-4 col-sm-4">
				<h4><span class="text-bold"><?php echo $this->translate('TXT_SELECT_PARTY');?></span></h4>
				<input id="party" class="no-display" value="<?php if($this->partysize){echo $this->partysize;}?>">
				<div class="col-md-12 form-group lessthanseven" style="margin-top:10px">
					<?php $i=0; while($i<7){ 
						$i++;?>
					<button id="partybutton<?php echo $i;?>" type="button" class="btn btn-lg btn-default partybutton partyselection" style="margin:5px" value="<?php echo $i;?>"> <?php echo $i;?> </button>
					<?php } ?>
					<button id="morethansevenbutton" type="button" class="btn btn-lg btn-default" style="margin:5px" > + </button>
				</div>
				<div class="col-md-12 form-group morethanseven" style="margin-top:15px">
					<div class="col-md-2 col-sm-4 col-xs-3 no-display morethanseven" id="lessthansevenbutton">
						<button type="button" class="btn btn-default"> - </button>
					</div>
					<div class="col-md-10 col-sm-8 col-xs-9 form-group no-display morethanseven" id="morethansevenselect">
						<select id="partyselect" class="form-control selectpartyselection">
							<option value='8'><?= $this->translate('TXT_FOR');?> 8 <?= $this->translate('TXT_PEOPLE');?></option>
							<?php $i=7; while($i<16){ 
								$i++;
								echo "<option value='".$i."' ".$select.">".$this->translate('TXT_FOR')." ".$i." ".$this->translate('TXT_PEOPLE')."</option>";
						     } ?>
						</select>
					</div>
				</div>
			</div>
			<div class="col-md-4 col-sm-4"></div>
		</div>
	</div>
<div>
	<span class='no-display' id='selectgroup'>
		<span id='servinggroup'>
			<div class="form-group">
				<label class="control-label">
					<h4><span class="text-bold"><?php echo $this->translate('TXT_SELECT_SERVING');?> </span></h4>
				</label>
				<div id="servings" class="buttons-widget"></div>
			</div>
		</span>
		<span class='no-display' id='slotgroup'>
			<div class="form-group">
				<label class="control-label">
					<h4><span class="text-bold"><?php echo $this->translate('TXT_SELECT_TIMESLOT');?></span></h4>
				</label>
				<div id="slots" class="buttons-widget"></div>
			</div>
		</span>
	</span>						
</div>
<div class="ajax-white-backdrop2" style="display: block;"></div>
<div class="panel panel-white">
	<div class="panel-heading">
		<h4 class="panel-title"><?php echo $this->translate('TXT_SELECTION_PANEL');?></h4>
	</div>
	<div class="panel-body">
		<table class="table table-bordered table-hover" id="sample-table-4" style="table-layout: fixed;">
			<tbody>
				<tr>
					<td class="col-md-4" style="text-align: center">
						<i class="fa fa-users fa-lg"></i><br>
						<a class="linkhref calendarhref locationlinkfinal">
							<span class="text-bold" id="personlinkdata"><?php if($this->partysize){echo $this->partysize;}?></span> 
							<span class="text-bold"><?php echo $this->translate('TXT_PEOPLE');?></span>
						</a>
 					</td>
					<td class="col-md-4" style="text-align: center">
						<i class="fa fa-calendar fa-lg"></i><br>
						<a class="linkhref calendarhref locationlinkfinal">
							<span class="text-bold" id="calendarlinkdata"><?php if($this->resadate){echo $this->resadate;}?></span>
						</a>
					</td>
					<td class="col-md-4" style="text-align: center">
						<i class="fa fa-clock-o fa-lg"></i><br>
						<a class="linkhref calendarhref locationlinkfinal">
							<span class="text-bold" id="slotlinkdata"><?php if($this->slot){echo $this->slot;}else{echo $this->translate('TXT_TIME');}?></span>
						</a>													
					</td>
				</tr>
			</tbody>
		</table>
		<div><?php echo $this->translate('TXT_SELECT_DATE_PARTY');?></div>
		<div class="form-group">		
			<div class="text-bold no-display" id="locationlink">
				<input id="method" name="method" value="<?php if($this->getParam('reservationid')){echo 'CHANGE';}else{echo 'POST';}?>" class="no-display">
			</div>
		</div>
		<div id="calendarbox">
			<div class="col-md-12">
				<input id="mycalendar" name="calendar" type="text" data-date-format="dd-mm-yyyy" data-date-viewmode="years" class="form-control date-picker mycalendar no-display" value="<?php if($this->resadate){echo $this->resadate;}?>" style="width:205px">
				<div id="fullcalendar"></div>
			</div>
		</div>
		<div id="partybox" style="margin-top:10px">
			<input id="party" class="no-display" value="<?php if($this->partysize){echo $this->partysize;}?>">
			<div class="col-md-12 form-group lessthanseven" style="margin-top:10px">
				<?php $i=0; while($i<7){ 
					$i++;?>
				<button id="partybutton<?php echo $i;?>" type="button" class="btn btn-default partybutton partyselection" style="margin:5px" value="<?php echo $i;?>"> <?php echo $i;?> </button>
				<?php } ?>
				<button id="morethansevenbutton" type="button" class="btn btn-default" style="margin:5px" > + </button>
			</div>
			<div class="col-md-2 no-display morethanseven" id="lessthansevenbutton" style="margin-top:15px">
				<button type="button" class="btn btn-default"> - </button>
			</div>
			<div class="col-md-10 form-group no-display morethanseven" id="morethansevenselect" style="margin-top:15px">
				<select id="partyselect" class="form-control selectpartyselection">
					<option value='8'><?= $this->translate('TXT_FOR');?> 8 <?= $this->translate('TXT_PEOPLE');?></option>
					<?php $i=7; while($i<16){ 
						$i++;
						echo "<option value='".$i."' ".$select.">".$this->translate('TXT_FOR')." ".$i." ".$this->translate('TXT_PEOPLE')."</option>";
				     } ?>
				</select>
			</div>
		</div>
<!--
		<div class="col-md-12 form-group bookbutton" >
			<span class="btn btn-dark-orange btn-block book"><?php echo $this->translate('TXT_NEXT_STEP');?> <i class="fa fa-arrow-circle-right"></i></span>
		</div>
-->
		<div class='no-display' id='selectgroup'>
			<div class="form-group">
				<label class="control-label">
					<?php echo $this->translate('TXT_SELECT_SERVING');?> <span class="symbol required"></span>
				</label>
				<div id="servings" class="space20 panel-body buttons-widget"></div>
			</div>
			<div class="form-group">
				<label class="control-label">
					<?php echo $this->translate('TXT_SELECT_TIMESLOT');?> <span class="symbol required"></span>
				</label>
				<div id="slots" class="space20 panel-body buttons-widget"></div>
			</div>
		</div>
	</div>
</div>
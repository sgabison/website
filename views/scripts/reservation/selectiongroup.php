<div class="ajax-white-backdrop2" style="display: block;"></div>
<div class="form-group">		
	<span class="text-bold no-display" id="locationlink">
		<h4>
			<a class="linkhref locationhref locationlinkfinal"><span id="locationlinkdata"></span></a> on the <a class="linkhref calendarhref locationlinkfinal"><span class="text-bold" id="calendarlinkdata"></span></a>
		</h4>
		<input id="method" name="method" value="<?php if($this->getParam('reservationid')){echo 'CHANGE';}else{echo 'POST';}?>" class="no-display">
	</span>
</div>
<div class="form-group">
	<div class="input-group date" id="calendarbox">
		<input id="mycalendar" name="calendar" type="text" data-date-format="dd-mm-yyyy" data-date-viewmode="years" class="form-control date-picker mycalendar" value="<?php if($this->resachange){echo $this->start->get('dd-MM-yyyy');}else{echo $this->getParam('resadate');}?>">
		<span class="input-group-addon"> <i class="fa fa-calendar"></i> </span>
	</div>
</div>	
<div class="form-group">
	<select id="party" name="party" class="form-control">
		<?php $i=0; while($i<16){ 
			$i++;
			if($i==2){$select='selected';}else{$select='';};
			echo "<option value='".$i."' ".$select.">".$this->translate('TXT_FOR')." ".$i." ".$this->translate('TXT_PEOPLE')."</option>";
	     } ?>
	</select>
</div>
<div class="form-group bookbutton" >
	<span class="btn btn-dark-orange btn-block book"><?php echo $this->translate('TXT_BOOK_A_TABLE');?> <i class="fa fa-arrow-circle-right"></i></span>
</div>
<span class='no-display' id='selectgroup'>
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
</span>
</div>
<div class="col-md-12">
	<h4>
		<?php echo $this->translate('TXT_BOOK_A_TABLE');?> <?php echo $this->translate('TXT_AT');?> 
		<span class="text-bold"> <?php echo $this->selectedLocation->getName();?></span>
		<span class="text-bold no-display" id="locationlink">

			<a class="linkhref locationhref locationlinkfinal">
				<span id="locationlinkdata"></span>
			</a> 

		</span>
	</h4>
	<table class="table table-bordered table-hover col-md-12" id="sample-table-4" style="table-layout: fixed;">
		<tbody>
			<tr>
				<td class="col-md-4" style="text-align: center">
					<i class="fa fa-users fa-lg"></i><br>
					<a class="linkhref calendarhref locationlinkfinal">
						<span class="text-bold" id="personlinkdata"></span> 
						<span class="text-bold"><?php echo $this->translate('TXT_PEOPLE');?></span>
					</a>
					</td>
				<td class="col-md-4" style="text-align: center">
					<i class="fa fa-calendar fa-lg"></i><br>
					<a class="linkhref calendarhref locationlinkfinal">
						<span class="text-bold" id="calendarlinkdata">Date</span>
					</a>
				</td>
				<td class="col-md-4" style="text-align: center">
					<i class="fa fa-clock-o fa-lg"></i><br>
					<a class="linkhref calendarhref locationlinkfinal">
						<span class="text-bold" id="slotlinkdata">Time</span>
					</a>													
				</td>
			</tr>
			<tr class="registergroup2 no-display">
				<td class="col-md-4">
					Name:
					</td>
					<td class="col-md-4" colspan="2">
						<span id="reg-lastname"></span>
					</td>
			</tr>
			<tr class="registergroup2 no-display">
				<td class="col-md-4">
					Tel:
					</td>
					<td class="col-md-4" colspan="2">
						<span id="reg-tel"></span>
					</td>
			</tr>
			<tr class="registergroup2 no-display">
				<td class="col-md-4">
					Email:
					</td>
					<td class="col-md-4" colspan="2">
						<span id="reg-email"></span>
					</td>
			</tr>
		</tbody>
	</table>
</div>
<div class="col-md-12">
		<div class="form-group">		
			<span class="text-bold" id="locationbox">
				<input id="offdays" class="no-display" value="<?php echo $this->offdaysrange;?>"> 
				<input id="method2" name="method2" value="PUT" class="no-display">
				<input id="select_location" value='<?php echo $this->selectedLocation->getId();?>' class="no-display" disabled> 
			</span>
		</div>
		<div class="form-group">
			<div id="calendarbox" class="panel panel-white">
				<div id="mycalendar" name="calendar" type="text" data-date-format="dd-mm-yyyy" data-date-viewmode="years" class="date-picker mycalendar" style="width:220px; margin-left:auto; margin-right:auto;"></div>
			</div>
		</div>	
		<div class="form-group" id="peopleselectiongroup">
			<select id="party" name="party" class="form-control">
				<?php $i=0; while($i<16){ 
					$i++;
					if($i==2){$select='selected';}else{$select='';};
					echo "<option value='".$i."' ".$select.">".$this->translate('TXT_RESERVATION_FOR')." ".$i." ".$this->translate('TXT_PERSONS')."</option>";
			     } ?>
			</select>
		</div>
		<div class="form-group bookbutton" >
			<span class="btn btn-dark-orange btn-block book"><?php echo $this->translate('TXT_BOOK_A_TABLE');?> <i class="fa fa-arrow-circle-right"></i></span>
		</div>
</div>
<div class="col-md-12">
	<span class='no-display' id='selectgroup'>
		<span id='servinggroup'>
			<div class="form-group">
				<label class="control-label">
					<?php echo $this->translate('TXT_SELECT_SERVING');?> <span class="symbol required"></span>
				</label>
				<div id="servings" class="space20 panel-body buttons-widget"></div>
			</div>
		</span>
		<span class='no-display' id='slotgroup'>
			<div class="form-group">
				<label class="control-label">
					<?php echo $this->translate('TXT_SELECT_TIMESLOT');?> <span class="symbol required"></span>
				</label>
				<div id="slots" class="space20 panel-body buttons-widget"></div>
			</div>
		</span>
	</span>						
</div>
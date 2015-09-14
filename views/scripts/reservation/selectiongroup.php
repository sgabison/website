<div class="form-group">		
	<span class="text-bold" id="locationbox"> 
		<select id="select_location">
		<?php $i=0;foreach($this->locations as $location){ ?>
			<option value='<?php echo $location->getId();?>' 
			<?php 
			if($this->selectedlocationid){
				if($location->getId()==$this->selectedlocationid){
					echo 'selected';
				}
			}else{
				if($i==0){ echo 'selected';}
			}
			?>>
			<?php echo $location->getName();?>
			</option>
		<?php $i++;} ?>
		</select>
	</span>
	<span class="text-bold no-display" id="locationlink">
		<h4>
			<a class="linkhref locationhref locationlinkfinal"><span id="locationlinkdata"></span></a> on the <a class="linkhref calendarhref locationlinkfinal"><span class="text-bold" id="calendarlinkdata"></span></a>
		</h4>
	</span>
</div>

<div class="form-group">
	<div class="input-group" id="calendarbox">
		<input name="calendar" type="text" data-date-format="dd-mm-yyyy" data-date-viewmode="years" class="form-control date-picker mycalendar" value="<?php if($this->resachange){echo $this->start->get('dd-MM-yyyy');}else{echo $this->getParam('resadate');}?>">
		<span class="input-group-addon"> <i class="fa fa-calendar"></i> </span>
	</div>
</div>	
<div class="form-group">
	<label class="control-label">
		Select # of people in your party <span class="symbol required"></span>
	</label>
	<select id="party" name="party" class="form-control">
		<?php $i=0; while($i<16){ 
			$i++;
			if($i==2){$select='selected';}else{$select='';};
			echo "<option value='".$i."' ".$select.">".$i."</option>";
	     } ?>
	</select>
</div>
<div class="form-group bookbutton" >
	<span class="btn btn-dark-orange btn-block book">Book a table <i class="fa fa-arrow-circle-right"></i></span>
</div>
<span class='no-display' id='selectgroup'>
	<div class="form-group">
		<label class="control-label">
			Select Serving <span class="symbol required"></span>
		</label>
		<div id="servings" class="space20 panel-body buttons-widget"></div>
	</div>
	<div class="form-group">
		<label class="control-label">
			Select Time slot <span class="symbol required"></span>
		</label>
		<div id="slots" class="space20 panel-body buttons-widget"></div>
	</div>
</span>
</div>

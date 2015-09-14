<?php foreach($this->resatime as $resaslot){ ?>
<button type="button" class="btn btn-dark-orange">
	<input id="resaslot" name="resaslot" value='<?php echo $resaslot; ?>' style='display:none'>
	<?php echo $resaslot; ?>
</button>
<?php } ?>
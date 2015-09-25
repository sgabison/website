<div class="col-md-2">
	<div class="form-group">
		<label class="control-label">
			<?= $this->translate("TAG_CODE")?> <span class="symbol required"></span>
		</label>
		<input type="text" placeholder="" class="form-control contributor-firstname" name="codenew<?= $i;?>" value="<?= $this->getParam('codenew<?= $i')?>">
	</div>
</div>
<div class="col-md-5">
	<div class="form-group">
		<label class="control-label">
			<?= $this->translate("TAG_FR")?> <span class="symbol required"></span>
		</label>
		<input type="text" placeholder="<?= $this->translate('INSERT_TAG_FR')?>" class="form-control" name="tagfrnew<?= $i;?>" value="<?= $this->getParam('tagfrnew<?= $i')?>">
	</div>
</div>
<div class="col-md-5">
	<div class="form-group">
		<label class="control-label">
			<?= $this->translate("TAG_EN")?> <span class="symbol required"></span>
		</label>
		<input type="text" placeholder="<?= $this->translate('INSERT_TAG_EN')?>" class="form-control contributor-email" name="tagennew<?= $i;?>" value="<?= $this->getParam('tagennew<?= $i')?>">
	</div>
</div>
<?php if ($this->editmode) { ?>
<link rel="stylesheet" type="text/css"
	href="<?php echo $this->brick->getPath(); ?>/editmode.css" />
<div class="pimcore_area_multilangue_editmode">
	<div class="module clearfix">
		<h2 class="module-title">FRANCAIS</h2>
		<div class="module-trigger module-open">
			<span>Fermer</span>
		</div>
		<div class="module-content" >
			<?php echo $this->wysiwyg("multilangue_fr"); ?>
		</div>
	</div>
	<div class="module clearfix">
		<h2 class="module-title">ENGLISH</h2>
		<div class="module-trigger module-open">
			<span>Fermer</span>
		</div>
		<div class="module-content" >
			<?php echo $this->wysiwyg("multilangue_en"); ?>
		</div>
	</div>
</div>
<?php } else { ?>

  <?php if ($this->language != "en") { ?>
		<?php $text = $this->wysiwyg("multilangue_fr");
			if (!$text->isEmpty()) { 
					if($this->parameters){
						foreach ($this->parameters as $key=>$value){
							$text = str_replace('['.$key.']',$value, $text);
						}
					}		
					echo $text; 
			 } ?>
    <?php } else if($this->language == "en") { ?>
		<?php $text = $this->wysiwyg("multilangue_en");
			if (!$text->isEmpty()) { 
					if($this->parameters){
						foreach ($this->parameters as $key=>$value){
							$text = str_replace('['.$key.']',$value, $text);
						}
					}		
					echo $text; 
			 } ?>
        <?php } ?>
<?php } ?>
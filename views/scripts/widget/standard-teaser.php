

<?php
$suffix = $this->suffix;
if(!$suffix) {
	$suffix = "";
}
?>

<?php if ($this->editmode):?>
<style>
<!--
.x-panel-bwrap {
overflow: visible;
}
-->
</style>
	<?php  echo $this->image("image".$suffix, array("thumbnail" => "standardTeaser")) ;?>
	<h3 class="area-title">FRANCAIS</h3>
	<h2>
		<?php echo $this->input("headline".$suffix) ?>
	</h2>
	<?php echo $this->wysiwyg("text".$suffix ,array("height"=>100)); ?>
	<?php echo $this->link("link".$suffix, array("class" => "btn")); ?>
	<hr>
	<h3 class="area-title">ENGLISH</h3>
	<h2>
		<?php echo $this->input("headline_en".$suffix) ?>
	</h2>
	<?php echo $this->wysiwyg("text_en".$suffix ,array("height"=>100)); ?>
	<?php echo $this->link("link_en".$suffix, array("class" => "btn")); ?>
<?php else :?>
	<?php $lg=($this->language=="en")?"_en":""; ?>
	<?php echo $this->image("image".$suffix, array("thumbnail" => "standardTeaser")) ;?>
	<h2>
		<?php echo $this->input("headline".$lg.$suffix) ?>
	</h2>
	<?php echo $this->wysiwyg("text".$lg.$suffix ,array("height"=>100)); ?>
	<?php echo $this->link("link".$lg.$suffix, array("class" => "btn")); ?>

<?php endif;?>


<?php
// unset the suffix otherwise it will cause problems when using in a loop
$this->suffix = null;
?>
<hr>



<?php
    $suffix = $this->suffix;
    if(!$suffix) {
        $suffix = "";
    }
?>
   
<div class="span4"> <?php echo $this->Areablock("slideshow".$suffix) ?></div>

<?php
    // unset the suffix otherwise it will cause problems when using in a loop
    $this->suffix = null;
?>


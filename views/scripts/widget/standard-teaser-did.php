

<?php
    $suffix = $this->suffix;
    if(!$suffix) {
        $suffix = "";
    }
?>

<?php if ($this->editmode) echo $this->image("image".$suffix) ;
else echo $this->image("image".$suffix, array(
    "thumbnail" => "standardTeaser")) ;?>

<h2> <?php echo $this->input("headline".$suffix) ?></h2>

    <?php echo $this->wysiwyg("text".$suffix ,array("height"=>100)); ?>

    <?php echo $this->link("link".$suffix, array("class" => "btn")); ?>

<?php
    // unset the suffix otherwise it will cause problems when using in a loop
    $this->suffix = null;
?>
<hr>

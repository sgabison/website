<!DOCTYPE html>
<!-- Template Name: Rapido - Responsive Admin Template build with Twitter Bootstrap 3.x Version: 1.2 Author: ClipTheme -->
<!--[if IE 8]><html class="ie8 no-js" lang="en"><![endif]-->
<!--[if IE 9]><html class="ie9 no-js" lang="en"><![endif]-->
<!--[if !IE]><!-->
<html lang="en" class="no-js">
	<!--<![endif]-->
	<!-- start: HEAD -->
	<head>
			<?php
        // portal detection => portal needs an adapted version of the layout
        $isPortal = false;
        if($this->getParam("controller") == "content" && $this->getParam("action") == "portal") {
            $isPortal = true;
        }

        // output the collected meta-data
        if(!$this->document) {
            // use "home" document as default if no document is present
            $this->document = Document::getById(1);
        }

        if($this->document->getTitle()) {
            // use the manually set title if available
            $this->headTitle()->set($this->document->getTitle());
        }

        if($this->document->getDescription()) {
            // use the manually set description if available
            $this->headMeta()->appendName('description', $this->document->getDescription());
        }

        $this->headTitle()->append("pimcore Demo");
        $this->headTitle()->setSeparator(" : ");

        echo $this->headTitle();
        echo $this->headMeta();
    ?>

		<!-- start: META -->
		<meta charset="utf-8" />
		<!--[if IE]><meta http-equiv='X-UA-Compatible' content="IE=edge,IE=9,IE=8,chrome=1" /><![endif]-->
		<meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimum-scale=1.0, maximum-scale=1.0">
		<meta name="apple-mobile-web-app-capable" content="yes">
		<meta name="apple-mobile-web-app-status-bar-style" content="black">
		<meta content="" name="description" />
		<meta content="" name="author" />
		<!-- end: META -->
		<!-- start: MAIN CSS -->
		<link rel="stylesheet" href="<?= PIMCORE_WEBSITE_LAYOUTS?>/assets/plugins/bootstrap/css/bootstrap.min.css">
		<link rel="stylesheet" href="<?= PIMCORE_WEBSITE_LAYOUTS?>/assets/plugins/font-awesome/css/font-awesome.min.css">
		<link rel="stylesheet" href="<?= PIMCORE_WEBSITE_LAYOUTS?>/assets/plugins/animate.css/animate.min.css">
		<link rel="stylesheet" href="<?= PIMCORE_WEBSITE_LAYOUTS?>/assets/plugins/iCheck/skins/all.css">
		<link rel="stylesheet" href="<?= PIMCORE_WEBSITE_LAYOUTS?>/assets/plugins/toastr/toastr.min.css">
		<link rel="stylesheet" href="<?= PIMCORE_WEBSITE_LAYOUTS?>/assets/css/styles.css">
		<link rel="stylesheet" href="<?= PIMCORE_WEBSITE_LAYOUTS?>/assets/css/styles-responsive.css">
		<link rel="stylesheet" href="<?= PIMCORE_WEBSITE_LAYOUTS?>/assets/plugins/iCheck/skins/all.css">
		<!--[if IE 7]>
		<link rel="stylesheet" href="<?= PIMCORE_WEBSITE_LAYOUTS?>/assets/plugins/font-awesome/css/font-awesome-ie7.min.css">
		<![endif]-->
		<!-- end: MAIN CSS -->
		<!-- start: CSS REQUIRED FOR THIS PAGE ONLY -->
		<!-- end: CSS REQUIRED FOR THIS PAGE ONLY -->
	</head>
	<!-- end: HEAD -->
	<!-- start: BODY -->
			<?= $this->layout()->content; ?>

			<? include( PIMCORE_LAYOUTS_DIRECTORY ."/inc_footer_js.php") ; ?>
			
		
	</body>
	<!-- end: BODY -->
</html>
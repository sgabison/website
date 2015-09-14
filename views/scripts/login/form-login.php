	<body class="login">
		<div class="row">
			<div class="main-login col-xs-10 col-xs-offset-1 col-sm-8 col-sm-offset-2 col-md-4 col-md-offset-4">
				<div class="logo">
					<img src="<?= PIMCORE_WEBSITE_LAYOUTS?>/assets/images/logo.png">
				</div>
				
				<? include( dirname(__FILE__) ."/inc_login.php") ; ?>
				<? include( dirname(__FILE__) ."/inc_forgot.php") ; ?>
				<? include( dirname(__FILE__) ."/inc_remind.php") ; ?>
				<? include( dirname(__FILE__) ."/inc_register.php") ; ?>

				
				
			</div>
		</div>
<div class="panel panel-white" style="height:100%">
	<div class="panel-heading">
		<h4 class="panel-title"><?php echo $this->translate('TXT_ERROR');?> : <span class="text-bold"><?php echo $this->translate($this->error); ?></span></h4>
		 <span id="clock"></span>
	</div>
	<div class="panel-body">
		<div class="row">
			<div class="col-md-4 col-md-offset-4">
				<div>
					<img src='/errorpages/error.jpg'>
				</div>
				<div>
					<?php echo $this->warning;?>
				</div>
			</div>
		</div>
	</div>
</div>
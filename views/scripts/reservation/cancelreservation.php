<div class="panel panel-white">
	<div class="panel-heading">
		<h4 class="panel-title"><?php echo $this->translate('TXT_CANCEL_RESERVATION');?>
			<span class="text-bold"> <?php if( $this->warning == "off" ) {echo $this->reservation->getLocation()->getName();}?></span>
		</h4>
		<div class="panel-tools">
			<a class="panel-expand" href="#">
				<i class="fa fa-expand"></i> <span><?php echo $this->translate('TXT_FULLSCREEN');?></span>
			</a>
		</div>
	</div>
<?php if( $this->warning == "off" ) { ?>
<?php if($this->reservation->getStatus()=="Cancelled"){ $s="<s>";$ends="</s>";}?>	
	<div class="panel-body" id="reservationform">
		<?php echo $this->translate('TXT_VERIFY_RESERVATION');?><br><br>
		<div class="col-md-6">
			<div class="panel">
				<div class="panel-heading border-light panel-orange">
					<h4 class="panel-title"><?php echo $this->translate('TXT_SUMMARY_OF');?> <span class="text-bold"><?php echo $this->translate('TXT_RESERVATION');?></span></h4>
				</div>
				<div class="panel-body">
					<h4><?= $s;?><span class="text-bold"><?= $this->reservation->getLocation()->getName();?><?= $ends;?></span></h4>
					<div>
						<?= $s;?><?= $this->reservation->getLocation()->getAddress();?>, <?= $this->reservation->getLocation()->getZip();?>, <?= $this->reservation->getLocation()->getCity();?><br>
						<?= $this->reservation->getLocation()->getTel();?><?= $ends;?>
					</div>
					<h4><span class="text-bold"><?= $s;?><?= $this->reservation->getStart()->get('dd-MM-YYYY');?><?= $ends;?></span></h4>
					<div>
						<?= $s;?><?= $this->reservation->getPartysize();?> <?php echo $this->translate('TXT_PERSONS_AT');?> <?= $this->reservation->getStart()->get('HH:mm');?><?= $ends;?>
					</div>
					<h4><span class="text-bold"><?= $this->reservation->getGuest()->getLastname();?></span></h4>
					<div>
						<?= $this->reservation->getGuest()->getEmail();?><br>
						<?= $this->reservation->getGuest()->getTel();?>
					</div>
					<h4><span class="text-bold"><?= $s;?><?php echo $this->translate('TXT_REFERENCE_NER');?> <?= $this->reservation->getId();?><?= $ends;?></span></h4>
				</div>
			</div>
		</div>
		<div class="col-md-6">
			<?php if($this->reservation->getStatus()!="Cancelled"){ ?>
			<form action="/cancel-reservation" method="POST">
			<input class="no-display" name="reservationid" id="reservationid" value="<?= $this->reservation->getId();?>">
			<button class="btn btn-purple" type="submit" name="confirmcancellation" value="yes">
				<?php echo $this->translate('TXT_OK_CANCEL');?> <i class="fa fa-arrow-circle-right"></i>
			</button>
			</form>
			<?php }else{ ?>
			<button class="btn btn-purple">
				<?php echo $this->translate('TXT_CANCELLED');?>
			</button>
			<?php } ?>
		</div>
	</div>
<?php } elseif( $this->warning == "on" ){ ?>	
	<div class="panel-body" id="reservationform">
		<?php echo $this->translate('TXT_NO_RESERVATION_FOUND');?>
	</div>
<?php } ?>	
</div>
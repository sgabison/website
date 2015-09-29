<div class="ajax-white-backdrop" style="display: block;"></div>
<div class="col-md-12 space-20"></div>
<!--
<div class="col-md-12 panel panel-white">
	<div class="panel-heading">
		<h4 class="panel-title">
			<?php echo $this->translate('TXT_BOOK_A_TABLE');?> <?php echo $this->translate('TXT_AT');?> 
			<span class="text-bold"> <?php echo $this->selectedLocation->getName();?></span>
			<span class="text-bold no-display" id="locationlink">
				<a class="linkhref locationhref locationlinkfinal">
					<span id="locationlinkdata"></span>
				</a> 
			</span>
		</h4>
		<div class="panel-tools">
			<div class="dropdown">
				<a data-toggle="dropdown" class="btn btn-xs dropdown-toggle btn-transparent-grey">
					<i class="fa fa-cog"></i>
				</a>
				<ul class="dropdown-menu dropdown-light pull-right" role="menu">
					<li>
						<a href="/reservation?lg=fr_FR">
							<i class="fa fa-angle-up"></i> <span><?php echo $this->translate('FRENCH');?></span> </a>
					</li>
					<li>
						<a href="/reservation?lg=en">
							<i class="fa fa-angle-up"></i> <span><?php echo $this->translate('ENGLISH');?></span>
						</a>
					</li>
				</ul>
			</div>
		</div>
	</div>
</div>
-->
<div class="col-md-12 space-20">
	<div>
		<div class="panel-heading">
			<h4 class="panel-title"><?php echo $this->translate('TXT_BOOK_A_TABLE');?> <?php echo $this->translate('TXT_AT');?>  <span class="text-bold"> <?php echo $this->selectedLocation->getName();?></span></h4>
			<div class="panel-tools">
				<a class="panel-expand" href="#">
					<i class="fa fa-expand"></i> <span><?php echo $this->translate('TXT_FULLSCREEN');?></span>
				</a>
			</div>
		</div>
		<div class="panel-body" style='margin-left:10px;margin-right:10px;'>
			<div id="reservationform">
		<!-- start: FORM VALIDATION 1 PANEL -->
				<form role="form" method="POST" id="bookingform" novalidate="novalidate">
					<div class="row">
						<!-- start: ERRORS - CONFIRMATIONS -->
						<div>
							<div class="errorHandler alert alert-danger no-display">
								<i class="fa fa-times-sign"></i> <?php echo $this->translate('TXT_YOU_HAVE_ERRORS');?>
							</div>
							<div class="successHandler alert alert-success no-display">
								<i class="fa fa-ok"></i> <?php echo $this->translate('TXT_VALIDATION');?>
							</div>
							<input id="method" name="method" value="<?php if($this->getParam('reservationid')){echo 'PUT';}else{echo 'POST';}?>" class="no-display">
							<span class="text-bold" id="locationbox" class="no-display">
								<input id="language" class="no-display" value="<?php echo $this->language;?>">
								<input id="closeddays" class="no-display" value=<?php echo $this->closeddays;?>> 
								<input id="offdays" class="no-display" value="<?php echo $this->offdaysrange;?>"> 
								<input id="method2" name="method2" value="CHANGE" class="no-display">  
								<input id="select_location" value='<?php echo $this->selectedLocation->getId();?>' class="no-display" disabled>
							</span>
						</div>
						<!-- end: ERRORS - CONFIRMATIONS -->
						<!-- start: SELECTION GROUP -->
						<div class="selectiongroup">
							<!-- start: SUMMARY SELECTION GROUP -->
							<div>
								<table class="table table-bordered table-hover" id="sample-table-4" style="table-layout: fixed;">
									<tbody>
										<tr>
											<td class="col-md-4" style="text-align: center">
												<i class="fa fa-users fa-lg"></i><br>
												<a class="linkhref calendarhref locationlinkfinal">
													<span class="text-bold" id="personlinkdata"></span> 
													<span class="text-bold"><?php echo $this->translate('TXT_PEOPLE');?></span>
												</a>
						 					</td>
											<td class="col-md-4" style="text-align: center">
												<i class="fa fa-calendar fa-lg"></i><br>
												<a class="linkhref calendarhref locationlinkfinal">
													<span class="text-bold" id="calendarlinkdata">Date</span>
												</a>
											</td>
											<td class="col-md-4" style="text-align: center">
												<i class="fa fa-clock-o fa-lg"></i><br>
												<a class="linkhref calendarhref locationlinkfinal">
													<span class="text-bold" id="slotlinkdata"><?php echo $this->translate('TXT_TIME');?></span>
												</a>													
											</td>
										</tr>
										<tr class="registergroup2 no-display">
											<td class="col-md-4">
												Name:
						 					</td>
						 					<td class="col-md-4 reg-data" colspan="2">
						 						<span id="reg-lastname"></span>
						 					</td>
										</tr>
										<tr class="registergroup2 no-display">
											<td class="col-md-4">
												Tel:
						 					</td>
						 					<td class="col-md-4 reg-data" colspan="2">
						 						<span id="reg-tel"></span>
						 					</td>
										</tr>
										<tr class="registergroup2 no-display">
											<td class="col-md-4">
												Email:
						 					</td>
						 					<td class="col-md-4 reg-data" colspan="2">
						 						<span id="reg-email"></span>
						 					</td>
										</tr>
									</tbody>
								</table>
							</div>
							<div>
								<div class="form-group">
									<div class="panel panel-white" id="calendarbox" >
										<div id="mycalendar" name="calendar" type="text" data-date-format="dd-mm-yyyy" data-date-viewmode="years" class="date-picker mycalendar" style="width:220px; margin-left:auto; margin-right:auto;"></div>
									</div>
								</div>	
								<div class="form-group" id="peopleselectiongroup">
									<select id="party" name="party" class="form-control">
										<?php $i=0; while($i<16){ 
											$i++;
											if($i==2){$select='selected';}else{$select='';};
											echo "<option value='".$i."' ".$select.">".$this->translate('TXT_RESERVATION_FOR')." ".$i." ".$this->translate('TXT_PERSONS')."</option>";
									     } ?>
									</select>
								</div>
								<div class="form-group bookbutton" >
									<span class="btn btn-dark-orange btn-block book"><?php echo $this->translate('TXT_BOOK_A_TABLE');?> <i class="fa fa-arrow-circle-right"></i></span>
								</div>
							</div>
							<div>
								<span class='no-display' id='selectgroup'>
									<span id='servinggroup'>
										<div class="form-group">
											<label class="control-label">
												<?php echo $this->translate('TXT_SELECT_SERVING');?> <span class="symbol required"></span>
											</label>
											<div id="servings" class="space20 panel-body buttons-widget"></div>
										</div>
									</span>
									<span class='no-display' id='slotgroup'>
										<div class="form-group">
											<label class="control-label">
												<?php echo $this->translate('TXT_SELECT_TIMESLOT');?> <span class="symbol required"></span>
											</label>
											<div id="slots" class="space20 panel-body buttons-widget"></div>
										</div>
									</span>
								</span>						
							</div>
						</div>
						<!-- end: SELECTION GROUP -->
						<!-- start: REGISTER GROUP -->
						<div class="no-display registergroup space-20">
							<div class="registergroup1">
								<div class="form-group">
									<label class="control-label">
										<?php echo $this->translate('TXT_YOUR_NAME');?> <span class="symbol required"></span>
									</label>
									<input type="text" placeholder="<?php echo $this->translate('INSERT_NAME');?>" class="form-control" id="firstlastname" name="firstlastname" value='<?php echo $this->firstlastname;?>'>
								</div>
								<div class="form-group">
									<label class="control-label">
										<?php echo $this->translate('TXT_YOUR_TEL');?><span class="symbol required"></span>
									</label>								
									<span class="input-icon">
										<input type="tel" class="form-control" id="tel" name="tel" value='<?php echo $this->tel;?>'>
									</span>
								</div>
								<div class="form-group">
									<label class="control-label">
										<?php echo $this->translate('TXT_YOUR_EMAIL_ADDRESS');?> <span class="symbol required"></span>
									</label>
									<input type="email" placeholder="Email@address.com" class="form-control" id="email" name="email" value='<?php echo $this->email;?>'>
								</div>
								<div class="form-group">
									<button class="btn btn-dark-orange btn-block" id='submit'>
										<?php echo $this->translate('TXT_BOOK_A_TABLE');?> <i class="fa fa-arrow-circle-right"></i>
									</button>
								</div>
							</div>
							<div class="registergroup2 no-display">		
								<div class="form-group">
									<div class="panel panel-white">
										<div class="panel-heading">
											<label class="control-label"><?php echo $this->translate('TXT_SPECIFIC_REQUESTS');?></label>
											<div class="panel-tools">
												<div class="dropdown">
													<a class="panel-collapse expand" href="#"><i class="fa fa-angle-up"></i> <span>Expand</span> </a>
												</div>
											</div>
										</div>
										<div class="panel-body" style="display:none" id='tagpanel'>
<!--
											<button type="button" class="btn btn-sm btn-tags btn-dark-orange" value="<?php echo $this->translate('TXT_WARNING_BABY');?>" style="margin:5px"><?php echo $this->translate('TXT_WARNING_BABY');?></button>
											<button type="button" class="btn btn-sm btn-tags btn-dark-orange" value="<?php echo $this->translate('TXT_WARNING_WHEELCHAIR');?>" style="margin:5px"><?php echo $this->translate('TXT_WARNING_WHEELCHAIR');?></button>
											<button type="button" class="btn btn-sm btn-tags btn-dark-orange" value="<?php echo $this->translate('TXT_WARNING_SPECIATABLE');?>" style="margin:5px"><?php echo $this->translate('TXT_WARNING_SPECIATABLE');?></button>
											<button type="button" class="btn btn-sm btn-tags btn-dark-orange" value="<?php echo $this->translate('TXT_WARNING_NUTALLERGY');?>" style="margin:5px"><?php echo $this->translate('TXT_WARNING_NUTALLERGY');?></button>
-->
										<?php foreach( $this->societe->getTags() as $tag){ ?>
										<button type="button" class="btn btn-sm btn-tags btn-dark-orange" data="<?php echo $tag->getId();?>" value="<?php echo $tag->getTag();?>" style="margin:5px"><?php echo $tag->getTag() ?></button>
										<?php } ?>
											<input id="tags_1" type="text" value='<?php echo $this->bookingnotes;?>'>
											<input id="tags_code" type="text" class="no-display" value='<?php echo $this->bookingnotes;?>'>
										</div>
									</div>
								</div>
								<div class="form-group">
									<label class="control-label">
										<strong><?php echo $this->translate('TXT_SIGNUP_NEWSLETTER');?></strong> <span class="symbol required"></span>
									</label>
									<label>
										<?php echo $this->translate('TXT_WANT_TO_SIGNUP_NEWSLETTER');?>
									</label>
									<div>
										<label class="radio-inline">
											<input type="radio" class="grey" value="" name="newsletter">
											<?php echo $this->translate('TXT_NO');?>
										</label>
										<label class="radio-inline">
											<input type="radio" class="grey" value="" name="newsletter">
											<?php echo $this->translate('TXT_YES');?>
										</label>
									</div>
								</div>
								<div class="form-group no-display registergroup2">
									<label>
										<?php echo $this->translate('TXT_AGREED_TERMS_1');?> <a data-target=".bs-example-modal-basic" data-toggle="modal"><?php echo $this->translate('TXT_TERMS_2');?></a>
									</label>
									<div id="inputs"></div>
									<button class="btn btn-dark-orange btn-block" type="submit" value='submit' id='submit2'>
										<?php echo $this->translate('TXT_BOOK_A_TABLE');?> <i class="fa fa-arrow-circle-right"></i>
									</button>
								</div>
							</div>
						</div>
						<!-- end: REGISTER GROUP -->
					</div>
				</form>
			</div>
			<!-- start: CONFIRMATION GROUP -->
			<div class="panel-body no-display panel-white" id="confirmationform">
				<div class="successHandler alert alert-success">
						<h4><?php echo $this->translate('TXT_YOUR_RESERVATION_IS_CONFIRMED');?></h4>
						<?php echo $this->translate('TXT_YOU_WILL RECEIVE_CONFIRMATION');?><br>
						<?php echo $this->translate('TXT_YOU_WILL RECEIVE_CONFIRMATION_SMS');?>
				</div>
				<div class="confirmation1">
					<div class="panel">
						<div class="panel-heading border-light panel-orange">
							<h4 class="panel-title"><?php echo $this->translate('TXT_DETAILS_OF_YOUR');?> <span class="text-bold"><?php echo $this->translate('TXT_RESERVATION');?></span></h4>
						</div>
						<div class="panel-body">
							<h4><span class="text-bold"><?= $this->selectedLocation->getName();?></span></h4>
							<div>
								<?= $this->selectedLocation->getAddress();?>, <?= $this->selectedLocation->getZip();?>, <?= $this->selectedLocation->getCity();?><br>
								<?= $this->selectedLocation->getTel();?>
							</div>
							<h4><span class="text-bold"><span id='finaldate'></span></span></h4>
							<div>
								<span id='finalpartysize'></span> <?php echo $this->translate('TXT_PERSONS_AT');?> <span id='finaltimeslot'></span>
							</div>
							<h4><span class="text-bold"><span id='finalguestname'></span></span></h4>
							<div>
								<span id='finalguestemail'></span><br>
								<span id='finalguesttel'></span>
							</div>
							<h4><span class="text-bold"><?php echo $this->translate('TXT_REFERENCE_NER');?> <span id='finalid'></span></span></h4>
						</div>
					</div>
					<div class="form-group">
						<button class="btn btn-dark-orange btn-block displaymore">
							<?php echo $this->translate('TXT_MORE');?> <i class="fa fa-arrow-circle-right"></i>
						</button>
					</div>
				</div>
				<div class="confirmation2 no-display">
					<div class="panel">
						<div class="panel-heading border-light panel-orange">
							<h4 class="panel-title"><?php echo $this->translate('TXT_WHAT');?> <span class="text-bold"><?php echo $this->translate('TXT_NEXT');?></span></h4>
						</div>
						<div class="panel-body">
							<a class="btn btn-social btn-primary btn-block"><i class="fa fa-facebook"></i> <?php echo $this->translate('TXT_UPDATE_FACEBOOK');?></a>
							<a class="btn btn-social btn-warning btn-block" target="_blank" href="http://maps.google.com/maps?q=<?php echo $this->lat;?>+<?php echo $this->long;?>+(RESTAURANT+LUNELLE)&ll=<?php echo $this->lat;?>,<?php echo $this->long;?>&spn=0.004250,0.011579&t=h&iwloc=A&hl=en"><i class="fa fa-map-marker"></i> <?php echo $this->translate('TXT_CHECK_LOCATION');?></a>
		<!--					<a class="btn btn-social btn-primary btn-block" data-target=".bs-example-modal-basic" data-toggle="modal" id="mapmodal" ><i class="fa fa-map-marker"></i> <?php echo $this->translate('TXT_CHECK_LOCATION');?></a>-->
							<a class="btn btn-social btn-success btn-block"><i class="fa fa-calendar"></i> <?php echo $this->translate('TXT_UPDATE_CALENDAR');?></a>
							<a class="btn btn-social btn-purple btn-block" href="/reserver"><i class="fa fa-reply"></i> <?php echo $this->translate('TXT_MAKE_NEW_RESERVATION');?></a>
						</div>
					</div>
					<div class="form-group">
						<button class="btn btn-dark-orange btn-block displayless">
							<i class="fa fa-arrow-circle-left"></i> <?php echo $this->translate('TXT_LESS');?>
						</button>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
	<!-- end: CONFIRMATION GROUP -->
<div aria-hidden="true" aria-labelledby="myModalLabel" role="dialog" tabindex="-1" class="modal bs-example-modal-basic fade">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button aria-hidden="true" data-dismiss="modal" class="close" type="button">
					×
				</button>
				<h4 id="myModalLabel" class="modal-title">Conditions générales d'utilisation</h4>
			</div>
			<div class="modal-body">		
				<div class="panel-group accordion" id="accordion">
					<div class="panel panel-white">
						<div class="panel-heading">
							<h5 class="panel-title">
							<a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion" href="#collapseOne">
								<i class="icon-arrow"></i> MENTIONS LÉGALES ET CONDITIONS GÉNÉRALES D'UTILISATION DES SERVICES PROPOSÉS PAR <b>RESAEXPRESS</b>
							</a></h5>
						</div>
						<div id="collapseOne" class="panel-collapse collapse in">
							<div class="panel-body">						
								<p>Le site "http://www.resaexpress.com" et les applications <b>ResaExpress</b> sont édités par:<br><br><strong><b>ResaExpress</b></strong><br>Siège social : 20, rue Paul Strauss, 75020</p><p>    Email : info@resaexpress.com<br><br>    Attention : Si vous n'êtes pas en accord avec tout ou partie des conditions générales d'utilisation ci-après, il vous est vivement recommandé de ne pas utiliser le site <a href="http://www.resaexpress.com/">www.resaexpress.com</a> ou les applications <b>ResaExpress</b>.</p><p>Les présentes mentions légales et conditions générales ont pour objet de définir les conditions et modalités de la mise à la disposition d'un service gratuit de recherche et de réservation en ligne de table de restaurant. Les présentes conditions générales sont complétées ou modifiées, le cas échéant, par des conditions et modalités d'utilisation spécifiques propres à certaines fonctionnalités.<br><br>    Le service est réservé aux personnes physiques capables de souscrire des contrats en droit français. Est considérée comme utilisateur du site accessible à l'adresse <a href="http://www.resaexpress.com/">http://www.resaexpress.com</a> ou des applications <b>ResaExpress</b>, toute personne qui visite le site ou ses applications et/ou utilise le site ou ses applications et les services associés.</p>
							</div>
						</div>
					</div>
					<div class="panel panel-white">
						<div class="panel-heading">
							<h5 class="panel-title">
							<a class="accordion-toggle collapsed" data-toggle="collapse" data-parent="#accordion" href="#collapseTwo">
								<i class="icon-arrow"></i> ACCEPTATION DES CONDITIONS GÉNÉRALES
							</a></h5>
						</div>
						<div id="collapseTwo" class="panel-collapse collapse">
							<div class="panel-body">
								<p>Un service gratuit de recherche et de réservation en ligne de table de restaurant est proposé par la société <b>ResaExpress</b> à l'utilisateur, sous réserve de son acceptation inconditionnelle des présentes conditions générales.</p>
								<p>L'utilisateur déclare et reconnaît avoir lu l'intégralité des termes des présentes conditions générales. En outre, la connexion à l'un quelconque des services proposés sur le site accessible à l'adresse : "http://www.resaexpress.com" ou sur les applications <b>ResaExpress</b> (ci-après le « site <b>ResaExpress</b> ») emporte une acceptation sans réserve par l'utilisateur des présentes conditions générales.</p>
								<p>La société <b>ResaExpress</b> se réserve la possibilité de modifier à tout moment, en tout ou partie, les présentes conditions générales. Il appartient en conséquence à l'utilisateur de consulter régulièrement la dernière version des conditions générales affichée à l'adresse <a href="http://www.resaexpress.com/terms">http://www.resaexpress.com/terms</a> et sur les applications <b>ResaExpress</b>. L'utilisateur est réputé accepter cette dernière version à chaque nouvelle connexion sur le site <b>ResaExpress</b>.</p>
								<p>En cas de non-respect par l'utilisateur des présentes conditions générales, la société <b>ResaExpress</b> se réserve le droit de suspendre sans préavis les services et/ou de lui refuser l'accès au service.</p>
							</div>
						</div>
					</div>
					<div class="panel panel-white">
						<div class="panel-heading">
							<h5 class="panel-title">
							<a class="accordion-toggle collapsed" data-toggle="collapse" data-parent="#accordion" href="#collapseThree">
								<i class="icon-arrow"></i> DESCRIPTION DU SERVICE
							</a></h5>
						</div>
						<div id="collapseThree" class="panel-collapse collapse">
							<div class="panel-body">
						<h3>Rechercher et réserver une table de restaurant en ligne et en temps réel</h3>
							<p>    Le site <b>ResaExpress</b> permet à l'utilisateur, notamment de rechercher et de réserver en ligne et en temps réel la table d'un restaurant.</p>
						<h3>Bénéficier de promotions et offres spéciales proposées par les restaurants référencés sur <b>ResaExpress</b></h3>
							<p>    Le site <b>ResaExpress</b> permet à l'utilisateur, si et seulement s'il réserve par le biais de la procédure de réservation prévue à cet effet dans le module de réservation en ligne du site <b>ResaExpress</b>, de bénéficier de promotions ou offres spéciales proposées par les restaurants référencés sur le site. Tous les restaurants ne proposent pas de promotion ou d'offre spéciale. Les conditions de validité de ces promotions sont explicitées sur le site <b>ResaExpress</b>.</p>
						<h3>Services personnalisés associés</h3>
							<p>    La création d'un compte sur le site <b>ResaExpress</b> permet à l'utilisateur de prendre des réservations sans avoir à ressaisir ses coordonnées, et dans le cadre des accords commerciaux de la société <b>ResaExpress</b>, de bénéficier d'offres exclusives dans les restaurants de sa région.</p>
						<h3>Avertissement</h3>
							<p>    Il appartient à l'utilisateur de faire toutes vérifications qui semblent nécessaires ou opportunes avant de procéder à une quelconque réservation dans l'un des restaurants présents sur le site <b>ResaExpress</b>.</p>
							<p>La société <b>ResaExpress</b> ne garantit aucunement et de quelque façon que ce soit les produits, services et/ou pratiques commerciales des tiers présents sur son site. En ce sens, la société <b>ResaExpress</b> ne garantit pas à l'utilisateur qu'il soit satisfait des produits, services et/ou pratiques commerciales qu'il a obtenus suite à une réservation par le biais du site <b>ResaExpress</b>.</p>
							</div>
						</div>
					</div>
					<div class="panel panel-white">
						<div class="panel-heading">
							<h5 class="panel-title">
							<a class="accordion-toggle collapsed" data-toggle="collapse" data-parent="#accordion" href="#collapseFour">
								<i class="icon-arrow"></i> GRATUITÉ DU SERVICE
							</a></h5>
						</div>
						<div id="collapseFour" class="panel-collapse collapse">
							<div class="panel-body">
								<p>    Les services proposés et décrits dans les présentes conditions générales, sont gratuits.<br>
									<br>    Des tarifs pourront éventuellement être applicables, notamment en fonction de l'évolution des services proposés, l'évolution du réseau, de la technique et/ou des contraintes légales. L'utilisateur en sera alors dûment informé par la modification des présentes conditions générales ou par l'insertion dans le site <b>ResaExpress</b> de conditions particulières relatives aux services payants.</p>
								<h3>Avertissement</h3>
									<p>    L'utilisation du site <b>ResaExpress</b> conformément aux présentes Conditions Générales est gratuite pour l'utilisateur.</p><p>Toutefois, l'utilisateur reconnaît que le site <b>ResaExpress</b> renvoie à des prestations de services payantes. Notamment et par exemple, suite à une réservation effectuée par le biais du site <b>ResaExpress</b>, l'utilisateur reconnaît et accepte que la prestation de restauration effectuée par le tiers restaurateur présent sur le site <b>ResaExpress</b> soit payante.</p>
									<p>Lorsque la société <b>ResaExpress</b> fournit sur son site <b>ResaExpress</b> des détails concernant des prix ou une gamme de prix concernant un tiers prestataire présent sur son site, ces informations ne sont fournies qu'à titre indicatif et par souci de commodité. En aucun cas la société <b>ResaExpress</b> ne garantit l'exactitude de telles informations.<br>
										<br>    D'autre part, le site <b>ResaExpress</b> peut contenir des liens vers des sites internet de tiers, lesquels sont détenus et exploités par des revendeurs ou des prestataires de service indépendants et étrangers à la société <b>ResaExpress</b>. Il se peut que ces tiers réclament à l'utilisateur le paiement d'une redevance pour l'utilisation de certains contenus ou certains services fournis sur le site internet tiers. Il appartient donc à l'utilisateur d'effectuer, avant de poursuivre une transaction avec un tiers, toute vérification nécessaire et opportune pour vérifier si une rémunération sera due et les modalités de cette rémunération. En aucun cas, la société <b>ResaExpress</b> ne saurait être associée aux prestations effectuées par les tiers et/ou aux sites internet des tiers en question.</p>
							</div>
						</div>
					</div>
					<div class="panel panel-white">
						<div class="panel-heading">
							<h5 class="panel-title">
							<a class="accordion-toggle collapsed" data-toggle="collapse" data-parent="#accordion" href="#collapseFive">
								<i class="icon-arrow"></i> OUVERTURE D'UN COMPTE - IDENTIFICATION - PREUVE - ÉCHANGE D'INFORMATIONS
							</a></h5>
						</div>
						<div id="collapseFive" class="panel-collapse collapse">
							<div class="panel-body">
								<p>    Dès création du compte, l'utilisateur se voit attribuer un identifiant et un mot de passe (ci-après "Identifiants") lui permettant d'accéder à son compte privé.</p>
								<h3>Confidentialité des identifiants</h3>
									<p>    Les identifiants sont personnels et confidentiels. Ils ne peuvent être changés que sur demande de l'utilisateur ou à l'initiative de la société <b>ResaExpress</b>.</p>
									<p>L'utilisateur est seul et entièrement responsable de l'utilisation des Identifiants le concernant et s'engage à mettre tout en œuvre pour conserver secret ses Identifiants et à ne pas les divulguer, à qui que ce soit, sous quelque forme que ce soit.</p>
									<p>En cas de perte ou de vol d'un des Identifiants le concernant, l'utilisateur est responsable de toute conséquence dommageable de cette perte ou de ce vol, et doit utiliser, dans les plus brefs délais, la procédure lui permettant de les modifier.</p>
								<h3>Convention sur la preuve</h3>
									<p>    Les parties conviennent expressément que :</p><ul><li>la présence d'un code d'identification identifie valablement l'auteur d'un document ou d'un message et établit l'authenticité du document ou du message ;</li><li>un document électronique contenant un code d'identification équivaut à un écrit signé par la personne émettrice ;</li><li>les parties peuvent se prévaloir de l'impression sur papier d'un message électronique à partir d'un logiciel de messagerie électronique pour prouver le contenu des échanges qu'elles ont au sujet de l'exécution des présentes conditions générales.</li></ul><p><br></p>
								<h3>Echange d'informations</h3>
									<p>    L'utilisateur accepte l'usage de la messagerie électronique pour la transmission des informations qu'il demande concernant la conclusion ou l'exécution du contrat.</p>
							</div>
						</div>
					</div>
					<div class="panel panel-white">
						<div class="panel-heading">
							<h5 class="panel-title">
							<a class="accordion-toggle collapsed" data-toggle="collapse" data-parent="#accordion" href="#collapseSix">
								<i class="icon-arrow"></i> PROTECTION DES DONNÉES A CARACTERE PERSONNEL
							</a></h5>
						</div>
						<div id="collapseSix" class="panel-collapse collapse">
							<div class="panel-body">
								<p>    La société <b>ResaExpress</b>, dans le strict respect de la loi et des règlements en vigueur, souhaite recueillir certaines informations. Ces informations sont recueillies conformément aux dispositions relatives à la protection des données personnelles et sont destinées à proposer à l'utilisateur une utilisation personnalisée et optimale du site <b>ResaExpress</b>.</p>
								<h3>Déclaration de traitement automatisé d'informations nominatives auprès de la CNIL</h3>
									<p>    La société <b>ResaExpress</b>, amenée à traiter des données à caractère personnel, a déclaré les fichiers clients-prospects (type NS-48) auprès de la CNIL.</p>
								<h3>Charte sur la vie privée</h3>
									<p>    La collecte des données à caractère personnel ne permet pas de faire apparaître, directement ou indirectement, les origines ethniques, les opinions politiques, philosophiques ou religieuses ou l'appartenance syndicale des personnes, ni des données relatives à la santé ou à la vie sexuelle de celles-ci.</p>
									<p>Les données concernant l'utilisateur sont collectées et traitées de manière loyale et licite pour des finalités déterminées, explicites et légitimes, sans être traitées ultérieurement de manière incompatible avec ces finalités, sous une forme permettant l'identification des personnes concernées pendant une durée qui n'excède pas la durée nécessaire aux finalités pour lesquelles elles sont collectées et traitées.</p><p>Les données à caractère personnel ne font l'objet d'opérations de traitement par un sous-traitant ou une personne agissant sous l'autorité du responsable du traitement ou de celle du sous-traitant, que sur instruction du responsable du traitement au sein de la société <b>ResaExpress</b>.</p>
								<h3>Cookies</h3>
									<p>    Le site <b>ResaExpress</b> et/ou ses partenaires peuvent stocker des informations sur l'ordinateur ou l’appareil de l'utilisateur. Ces informations prendront la forme de "Cooky" ou fichier similaire. Les "Cookies" sont des données qui ne contiennent aucune information personnelle et qui sont envoyées via le serveur sur le disque dur de l'ordinateur ou sur l’appareil de l'utilisateur. Le rôle des cookies est notamment d'identifier plus rapidement l'utilisateur lors de sa connexion et de faciliter sa participation à certains événements, promotions, activités... présents sur le site <b>ResaExpress</b>.</p>
									<p>La société <b>ResaExpress</b> ne peut garantir le fonctionnement optimal du site <b>ResaExpress</b> si l'utilisateur refuse la réception de cookies.</p><p>L'utilisateur reconnaît et accepte que la société <b>ResaExpress</b> se réserve la possibilité d'implanter un "Cooky" dans son ordinateur ou dans son appareil afin d'enregistrer toute information relative à la navigation sur le site <b>ResaExpress</b>.</p><p>Pour en savoir plus sur les cookies utilisés par la société <b>ResaExpress</b> et modifier les paramètres relatifs à ses cookies, l’utilisateur est invité à consulter la politique de cookies de <b>ResaExpress</b>.</p>
								<h3>Utilisation des données</h3>
									<p>    L'utilisateur est informé par les présentes conditions générales de ce que les données à caractère personnel signalées comme étant obligatoires sur les formulaires et recueillies dans le cadre du service décrit dans les présentes conditions générales sont nécessaires à l'utilisation de ce service, sont utilisées uniquement dans le cadre de ce service et sont destinées exclusivement à la société <b>ResaExpress</b> et ses partenaires clients restaurateurs, qui prennent les précautions utiles afin de préserver, dans la mesure du possible, la sécurité des données.</p><p>    L'utilisateur autorise la société <b>ResaExpress</b> à fournir certaines informations à ses prestataires techniques afin de faire bénéficier l'utilisateur de certaines fonctions du site <b>ResaExpress</b> (forum, avis, commentaires,...).</p>
									<p>    L'utilisateur autorise la société <b>ResaExpress</b> à fournir toutes les informations le concernant au client partenaire restaurateur de la société <b>ResaExpress</b>, dans le cadre de la fourniture des services proposés par <b>ResaExpress</b>.</p><p>    En outre, l'utilisateur autorise la société <b>ResaExpress</b> à utiliser et/ou à céder ces informations dans le cadre de partenariats et ce, conformément à la loi, notamment dans le but de faire profiter l'utilisateur d'informations et services personnalisés ("Points fidélités", "Bon plans", "Invitation gratuite", ....).</p>
									<p>    L’utilisateur, dans le cadre de la fonctionnalité « inviter des convives suite à une réservation », est susceptible de communiquer à <b>ResaExpress</b> les adresses emails de tiers.</p>
									<p>    L’utilisateur s'engage en communiquant ces adresses à avoir informé et obtenu le consentement explicite de leurs propriétaires. En conséquence l’utilisateur dégage <b>ResaExpress</b> de toute responsabilité quant à l'utilisation de ces emails dans le cadre des actions listées ci-dessous :</p>
									<ul>
										<li>Envoi d'une invitation pour le compte de l’utilisateur <b>ResaExpress</b> (email)</li>
										<li>Demande de dépôt d'avis suite à une réservation (email)</li>
									</ul>
								<p><b>ResaExpress</b> s'engage à ne pas utiliser les adresses emails des tiers pour d'autres utilisations.</p><p>Tout e-mail envoyé par <b>ResaExpress</b> à l'adresse recueillie lors de la première réservation de l'utilisateur sera en relation avec le service décrit dans les présentes conditions générales.</p>
									<h3>Droit d'accès, de rectification et d'opposition</h3>
										<p>    L'utilisateur bénéficie d'un droit d'accès et de rectification de ces données qu'il peut exercer en décochant une case à cet effet sur la page « Mon compte » de l'Utilisateur ou en adressant un message à l'adresse électronique suivante : "info@resaexpress.com".</p><p>L'utilisateur peut, par ailleurs, exercer son droit d'opposition à l'utilisation de ces données pour motifs légitimes en adressant un message à cette fin à l'adresse électronique suivante : "info@resaexpress.com".</p>
									<h3>Avertissement</h3>
										<p>    L'utilisateur reconnaît que, d'une manière générale et en l'état de la technique actuelle, chaque fois qu'il publie des informations en ligne, ces informations peuvent être collectées et utilisées par des tiers. Par conséquent, l'utilisateur décharge la société <b>ResaExpress</b> de toute responsabilité ou conséquence dommageable de l'utilisation par des tiers des informations échangées par le biais des outils de communication (notamment chat, forum, avis) proposés par le site <b>ResaExpress</b>.</p>
							</div>
						</div>
					</div>
					<div class="panel panel-white">
						<div class="panel-heading">
							<h5 class="panel-title">
							<a class="accordion-toggle collapsed" data-toggle="collapse" data-parent="#accordion" href="#collapseSeven">
								<i class="icon-arrow"></i> AVIS DES UTILISATEURS
							</a></h5>
						</div>
						<div id="collapseSeven" class="panel-collapse collapse">
							<div class="panel-body">
								<p>    L'utilisateur doit suivre les règles suivantes pour publier un avis sur le site concernant un restaurant réservé par l'intermédiaire du site <b>ResaExpress</b>. </p>
								<h3>Conditions de publication des avis</h3>
									<ul>
										<li>Pour publier un avis, l'utilisateur doit être majeur, avoir un compte sur le site <b>ResaExpress</b> qui l'identifie, avoir réservé un restaurant par l'intermédiaire du site <b>ResaExpress</b> et avoir honoré sa réservation dans ce restaurant. </li>
										<li>Afin d'éviter tout conflit d'intérêt et pour des raisons d'objectivité évidentes, si l'utilisateur travaille dans le domaine de la restauration, celui-ci n'est pas autorisé à publier d'avis sur le site <b>ResaExpress</b>.</li>
										<li>L'avis doit concerner exclusivement le restaurant au sein duquel l'utilisateur s'est rendu. Tout avis portant sur un autre restaurant sera supprimé par <b>ResaExpress</b>.</li>
									</ul>
								<h3>Motifs de rejet des avis</h3>
									<p>L’utilisateur est informé que son avis peut être rejeté pour les motifs suivants :</p>
										<ul>
											<li>si les « Conditions de publication des avis » énoncées ci-dessus ne sont pas respectées par l’utilisateur ;</li>
											<li>si <b>ResaExpress</b> estime que sa responsabilité civile ou pénale peut être engagée ;</li>
											<li>si le contenu textuel comporte des injures ou grossièretés ;</li>
											<li>si les éléments relatifs à l’identité de l’auteur comportent des injures ou grossièretés ;</li>
											<li>si le contenu textuel comporte des caractères aléatoires ou des suites de mots sans aucune signification ;</li>
											<li>si le contenu (texte, document, image…) est sans rapport avec le sujet noté ;</li>
											<li>si les attributs de l’avis comportent des éléments concrets de conflits d’intérêts ;</li>
											<li>si le contenu textuel est mal écrit au point d'en être inintelligible ;</li>
											<li>si un utilisateur formule un commentaire inapproprié sur un autre contenu ou son auteur ;</li>
											<li>si le contenu textuel destiné à être publié comporte des informations personnelles, telles que le nom ou prénom d'individus qui ne sont pas des personnes publiques, un numéro de téléphone, une adresse physique précise ou une adresse email ;</li>
											<li>si le contenu textuel comporte un numéro de carte de crédit, de sécurité sociale, de compte bancaire ou toute autre information susceptible d'aboutir à un vol d'identité ;</li>
											<li>si le contenu textuel comporte un appel à une action en justice ;</li>
											<li>si le contenu mentionne des sites Web, liens hypertexte, URL, adresses email ou numéros de téléphone ;</li><li>si le contenu textuel est clairement du spam.</li>
										</ul>
									<p>En cas d’identification d’un utilisateur ayant déposé des avis manifestement frauduleux, et après avoir appliqué les procédures liées au rejet ou à la suppression d’avis, la société <b>ResaExpress</b> mettra fin à l'inscription de l’utilisateur concerné, et supprimera l’ensemble des avis liés à cet utilisateur.</p>
								<h3>Modération des avis</h3>
									<p>    La modération des avis a pour but de s'assurer de la conformité des avis aux présentes CGU en vue de publier, rejeter ou supprimer cet avis. Chaque avis est soumis à une modération humaine a priori. Le délai de modération est de 2 semaines au maximum. L'utilisateur peut demander la modération d'un avis déjà publié à l'adresse suivante <a href="mailto:info@resaexpress.com">info@resaexpress.com</a> en précisant les motifs de sa demande de modération.</p>
									<p>L'utilisateur qui a publié un avis peut demander a posteriori la suppression de cet avis à l'adresse suivante : <a href="mailto:info@resaexpress.com">info@resaexpress.com</a>. Les avis sont publiés pendant une durée limitée à 3 ans à compter de leur publication. Les avis concernant des restaurants ayant fermé ou ayant changé de propriétaire sont supprimés. L'utilisateur est informé qu'il peut être contacté par <b>ResaExpress</b> à des fins de vérification de l'authenticité de son avis, par email et/ou par téléphone. L'utilisateur est informé que son avis peut être transmis à des sites partenaires de <b>ResaExpress</b> et être publié sur ces sites partenaires. Afin de faciliter la lecture des avis par les utilisateurs du site <b>ResaExpress</b>, l’utilisateur autorise <b>ResaExpress</b> à publier à côté de l’avis déposé les éléments suivants : date d'inscription au site, nombre d'avis déposés, prénom et 1ère lettre du nom, statut, date de l'expérience de consommation. Conformément à la loi du 6 janvier 1978 modifiée, l'utilisateur dispose d'un droit d'accès, de modification, de rectification et de suppression des données le concernant, ainsi que d'un droit d'opposition pour motifs légitimes. L'utilisateur peut exercer ces droits à l'adresse suivante <a href="mailto:info@resaexpress.com">info@resaexpress.com</a>. </p>
								<h3>Avis de la part de plusieurs convives</h3>
									<p>L'utilisateur qui réserve un restaurant pour plusieurs convives est invité à indiquer les emails de ses convives pour que leur soient transmis les informations pratiques concernant la réservation (adresse du restaurant, heure de réservation,…) L'utilisateur reconnaît dans ce cas avoir reçu l'autorisation préalable de ses convives pour transmettre leurs adresses email dans ce contexte. Chaque convive est ensuite invité à poster un avis sur son expérience dans le restaurant réservé par l’utilisateur. </p>
								<h3>Droit de réponse</h3>
									<p>    Chaque Restaurateur dispose d'un droit de réponse afin notamment de : </p>
										<ul>
											<li>Donner sa version des faits ;</li>
											<li>Remercier le consommateur pour sa contribution ;</li>
											<li>Indiquer les éventuels changements intervenus dans le restaurant depuis la rédaction de l'avis.</li>
										</ul>
									<p>Toute demande de réponse doit être envoyée dans les 3 mois de la diffusion du message litigieux, à l'adresse suivante <a href="mailto:info@resaexpress.com">info@resaexpress.com</a> ou par courrier à l'adresse suivante : 20, rue Paul Strauss, 75020, PARIS. </p>
									<p>    La demande doit comporter les éléments suivants : </p>
										<ul>
											<li>références de l'avis ;</li>
											<li>identification de son auteur ;</li>
											<li>mention des passages contestés ;</li>
											<li>teneur de la réponse sollicitée (la réponse ne peut être plus longue que l'avis de l'utilisateur auquel elle répond).</li>
										</ul>
									<p>Une fois cette procédure suivie, si la demande de réponse est conforme aux présentes CGU, la réponse sera modérée dans les mêmes conditions que les avis des utilisateurs et publiée le cas échéant à la suite du message auquel elle répond, dans un délai maximum de 7 jours à compter de la demande de réponse. </p>
									<h3>Note des restaurants</h3>
										<p>Chaque utilisateur ayant réservé un restaurant par le site <b>ResaExpress</b> et honoré sa réservation dans ce restaurant est invité à donner une note correspondant à son expérience de consommation.</p>
										<p>L’utilisateur est informé que la note indiquée sur le site <b>ResaExpress</b> à côté de chaque restaurant correspond à une moyenne équipondérée des notes données par table depuis 1 an.</p>
									<h3>Utilisation du contenu utilisateur </h3>
										<p>    Il se peut que nous utilisions le contenu utilisateur et notamment les avis des utilisateurs de différentes façons, y compris pour le publier sur le site <b>ResaExpress</b>, en modifier le format, l'incorporer à des publicités ou autres documents, créer des œuvres dérivées de celui-ci, le mettre en valeur, le distribuer, et permettre à d'autres d'agir de même sur leurs sites Internet et plates-formes médiatiques. En conséquence, l'utilisateur donne par les présentes à <b>ResaExpress</b> son consentement irrévocable d'utiliser ce contenu pour n'importe quelle utilisation, et il renonce irrévocablement à toute revendication et affirmation relatives aux droits moraux ou patrimoniaux en ce qui concerne ce contenu.</p>
							</div>
						</div>
					</div>
					<div class="panel panel-white">
						<div class="panel-heading">
							<h5 class="panel-title">
							<a class="accordion-toggle collapsed" data-toggle="collapse" data-parent="#accordion" href="#collapseEight">
								<i class="icon-arrow"></i> LIMITATIONS DE RESPONSABILITÉ
							</a></h5>
						</div>
						<div id="collapseEight" class="panel-collapse collapse">
							<div class="panel-body">
						<h3>Fonctionnement du réseau</h3>
							<p>Compte tenu des spécificités du réseau Internet, la société <b>ResaExpress</b> n'offre aucune garantie de continuité du service, n'étant tenue à cet égard que d'une obligation de moyens.<br><br>    
							La responsabilité de la société <b>ResaExpress</b> ne peut pas être engagée en cas de dommages liés à l'impossibilité temporaire d'accéder à l'un des services proposés par le site <b>ResaExpress</b>.</p>
						<h3>Modification du site</h3>
							<p>    Toutes les informations contenues sur le site <b>ResaExpress</b> sont susceptibles d'être modifiées à tout moment, compte tenu de l'interactivité du site, sans que cela puisse engager la responsabilité de la société <b>ResaExpress</b>.</p>
						<h3>Utilisation du site</h3>
							<p>    La société <b>ResaExpress</b> décline toute responsabilité pour tout dommage ou perte lié à l'utilisation ou l'impossibilité d'utiliser le site <b>ResaExpress</b> ou son contenu, sauf exception prévue par la loi.</p>
							<p>La société <b>ResaExpress</b> ne garantit pas que les informations présentées soient détaillées, complètes, vérifiées ou exactes. Les documents, informations, fiches descriptives, et, en général, tout contenu présent sur le site <b>ResaExpress</b> sont fournis en "l'état", sans aucune garantie expresse ou tacite de quelque sorte que ce soit.</p>
							<p>L'utilisateur reconnaît expressément que les photos présentes sur le site <b>ResaExpress</b> ne soient pas contractuelles.</p>
							<p>De façon générale, l'utilisateur accepte et reconnaît que la réservation ne soit pas garantie. En ce sens, la société <b>ResaExpress</b> ne garantit pas l'effectivité du service de réservation. La disponibilité est vérifiée en temps réel informatiquement et une table est réellement bloquée informatiquement. Toutefois, la société <b>ResaExpress</b> ne pouvant pas matériellement vérifier l'exactitude des renseignements collectés et/ou donnés par les prestataires, l'utilisateur accepte que la responsabilité de la société <b>ResaExpress</b> ne puisse être engagée si l'utilisateur ne parvient pas à bénéficier des prestations du restaurant. En effet, les paramétrages du logiciel de réservation en temps réel dépendent pour partie des informations fournies et/ou enregistrées par le restaurateur et peuvent ne pas correspondre à la réalité. Ainsi, par exemple et de façon non exhaustive, l'utilisateur reconnaît et accepte que la responsabilité de la société <b>ResaExpress</b> ne soit en aucun cas recherchée en cas d'annulation de réservation, en cas d'établissement fermé, et ce pour quelque cause que ce soit, ou encore en cas de refus de prestation, et ce pour quelque cause que ce soit.<br>
							<br>    De même et pour les mêmes raisons, l'utilisateur accepte que la responsabilité de la société <b>ResaExpress</b> ne puisse être engagée si l'utilisateur ne parvient pas à bénéficier des promotions ou offres spéciales proposées par le restaurant. L'utilisateur reconnaît et accepte que la responsabilité de la société <b>ResaExpress</b> ne soit en aucun cas recherchée dans le cas où le restaurant n'honorerait pas une promotion ou une offre spéciale, et ce pour quelque cause que ce soit.</p>
						<h3>Garanties de l'utilisateur</h3>
							<p>    L'utilisateur déclare qu'il connaît parfaitement les caractéristiques et les contraintes de l'Internet. Il reconnaît notamment qu'il est impossible de garantir que les données que l'utilisateur aura transmises via Internet seront entièrement sécurisées. La société <b>ResaExpress</b> ne pourra être tenue responsable des incidents qui pourraient découler de cette transmission.</p>
							<p>L'utilisateur les communique donc à ses risques et périls. La société <b>ResaExpress</b> ne peut qu'apporter l'assurance qu'elle use de tous les moyens mis à sa disposition pour garantir un maximum de sécurité.</p>
							<p>L'utilisateur s'engage à indemniser la société <b>ResaExpress</b> à hauteur des coûts que la société <b>ResaExpress</b> devrait supporter à la suite de toute réclamation ou contestation, judiciaire ou extrajudiciaire, liées à l'utilisation des services définis dans les présentes par l'utilisateur et garantit la société <b>ResaExpress</b> de toute condamnation à ce titre en cas d'instance judiciaire.</p>
							<p>En tout état de cause, l'utilisateur reconnaît expressément et accepte d'utiliser le site <b>ResaExpress</b> à ses propres risques et sous sa responsabilité exclusive.</p>
						<h3>Liens hypertextes</h3>
							<p>    Le site <b>ResaExpress</b> contient des liens vers des sites internet de tiers. Les sites liés ne sont pas sous le contrôle de la société <b>ResaExpress</b>, et la société <b>ResaExpress</b> n'est pas responsable des contenus de ces sites liés. La société <b>ResaExpress</b> fournit ces liens pour convenance et un lien n'implique pas que la société <b>ResaExpress</b> parraine ou recommande le site lié en question ni que la société <b>ResaExpress</b> soit affiliée à celui-ci. Les sites liés sont détenus et exploités par des revendeurs ou des prestataires de services indépendants et, de ce fait, la société <b>ResaExpress</b> ne peut vous garantir que vous serez satisfaits de leurs produits, services ou pratiques commerciales. Il vous appartient de faire toutes vérifications qui vous semblent nécessaires ou opportunes avant de procéder à une quelconque transaction avec l'un de ces tiers.</p>
							</div>
						</div>
					</div>
					<div class="panel panel-white">
						<div class="panel-heading">
							<h5 class="panel-title">
							<a class="accordion-toggle collapsed" data-toggle="collapse" data-parent="#accordion" href="#collapseTwelve">
								<i class="icon-arrow"></i> OBLIGATIONS DE L'UTILISATEUR
							</a></h5>
						</div>
						<div id="collapseTwelve" class="panel-collapse collapse">
							<div class="panel-body">
								<h3>Accepter sans restriction les présentes conditions générales</h3><p>    En ouvrant un compte, l'utilisateur accepte, expressément et sans réserve, les termes des présentes conditions générales et des éventuelles conditions particulières présentes sur le site <b>ResaExpress</b>.</p><h3>Communiquer des informations exactes, sincères et véritables</h3><p>    L'utilisateur s'oblige à transmettre des renseignements exacts et véritables notamment sur sa civilité, son nom, son ou ses prénoms, son adresse email, son téléphone, nécessaires à sa bonne identification, en vue de l'ouverture d'un compte.</p><h3>Vérifier les conditions de validité des promotions et offres spéciales</h3><p>    L'utilisateur s'oblige à vérifier les conditions de validité d'une promotion avant de réserver sur le site et ne pourra en aucun cas réclamer au restaurant une promotion <b>ResaExpress</b> en dehors des conditions de validité telles qu'explicitées sur le site <b>ResaExpress</b>, et en dehors de la procédure de réservation avec promotion ou offre spéciale.</p>
									<h3>Respecter le droit national et international de propriété intellectuelle</h3>
										<p>    L'utilisateur s'engage à ne pas soumettre, copier, revendre, rééditer, ou, en général, rendre disponible par quelque forme que ce soit toute information ou élément, reçue de la société <b>ResaExpress</b> ou disponible sur le site <b>ResaExpress</b>, à une autre personne physique ou morale, de tous pays. En général, l'utilisateur s'engage à respecter les dispositions ci-après relatives à la propriété intellectuelle.</p>
							</div>
						</div>
					</div>
					<div class="panel panel-white">
						<div class="panel-heading">
							<h5 class="panel-title">
							<a class="accordion-toggle collapsed" data-toggle="collapse" data-parent="#accordion" href="#collapseTen">
								<i class="icon-arrow"></i> PROPRIÉTÉ INTELLECTUELLE
							</a></h5>
						</div>
						<div id="collapseTen" class="panel-collapse collapse">
							<div class="panel-body">
								<h3>Propriété des droits</h3>
									<p>Tous les droits, patrimoniaux et moraux, de propriété intellectuelle, afférents aux contenus et aux éléments d'information du site <b>ResaExpress</b> appartiennent en propre à La société <b>ResaExpress</b>, sous réserve de tout droit patrimonial pouvant appartenir à un tiers et pour lesquels la Société <b>ResaExpress</b> a obtenu les cessions de droits ou les autorisations nécessaires.</p>
									<p>Les droits conférés à l'utilisateur en vue de l'utilisation du site <b>ResaExpress</b> et des services fournis par la société <b>ResaExpress</b> n'emportent aucune cession ni aucune autorisation d'exploiter ou d'utiliser l'un quelconque des éléments du site <b>ResaExpress</b>.</p>
								<h3>Protection de tous les éléments : Marques, dessins, logos, liens hypertextes, informations, etc.</h3>
									<p>    Tous les éléments (marques, dessins, textes, liens hypertextes, logos, images, vidéos, éléments sonores, logiciels, mise en page, bases de données, codes...) contenus sur le site <b>ResaExpress</b> et dans les sites associés sont protégés par le droit national et international de la propriété intellectuelle. Ces éléments restent la propriété exclusive de la société <b>ResaExpress</b> et/ou de ses partenaires.</p>
								<h3>Interdiction d'utilisation sans autorisation</h3>
									<p>    Par conséquent, sauf autorisation préalable et écrite de la société <b>ResaExpress</b> et/ou de ses partenaires, l'utilisateur ne peut procéder à une quelconque reproduction, représentation, réédition, redistribution, adaptation, traduction et/ou transformation partielle ou intégrale, ou un transfert sur un autre support de tout élément composant et présent sur le site <b>ResaExpress</b>.</p>
								<h3>Sanctions</h3>
									<p>    L'utilisateur reconnaît et prend connaissance que le non-respect de cette interdiction est constitutif d'un acte de contrefaçon répréhensible tant civilement que pénalement.</p>
							</div>
						</div>
					</div>
					<div class="panel panel-white">
						<div class="panel-heading">
							<h5 class="panel-title">
							<a class="accordion-toggle collapsed" data-toggle="collapse" data-parent="#accordion" href="#collapseEleven">
								<i class="icon-arrow"></i> SANCTION DES MANQUEMENTS CONTRACTUELS
							</a></h5>
						</div>
						<div id="collapseEleven" class="panel-collapse collapse">
							<div class="panel-body">
								<h3>Suspension ou arrêt définitif du ou des services</h3>
									<p>En cas d'inexécution ou de non-respect par l'utilisateur de l'une des obligations et stipulations prévues par les présentes conditions générales, la société <b>ResaExpress</b> pourra modifier, suspendre, limiter ou supprimer l'accès au service, sans que celui-ci ne puisse réclamer aucune indemnité quelconque.</p>
								<h3>Dommages-intérêts</h3>
									<p>    La société <b>ResaExpress</b> sera également en droit de réclamer des indemnités destinées à compenser le préjudice subi.</p>
							</div>
						</div>
					</div>
					<div class="panel panel-white">
						<div class="panel-heading">
							<h5 class="panel-title">
							<a class="accordion-toggle collapsed" data-toggle="collapse" data-parent="#accordion" href="#collapseNine">
								<i class="icon-arrow"></i> DISPOSITIONS DIVERSES
							</a></h5>
						</div>
						<div id="collapseNine" class="panel-collapse collapse">
							<div class="panel-body">
								<h3>Loi applicable</h3>
									<p>    Les relations qui se nouent entre la Société <b>ResaExpress</b> et l'utilisateur, régies notamment par les présentes conditions générales, sont soumises au droit français, à l'exclusion de toute autre législation étatique. En cas de rédaction des présentes conditions générales en plusieurs langues ou de traduction, seule la version française fera foi.</p>
								<h3>Compétence juridictionnelle</h3>
									<p>    Toute contestation et/ou difficulté d'interprétation ou d'exécution des présentes conditions générales relèvera des tribunaux compétents de la ville de Paris.</p>
								<h3>Nullité partielle - Dissociation - Titres</h3>
									<p>    Dans l'hypothèse où une disposition des présentes conditions générales serait nulle, illégale, inopposable ou inapplicable d'une manière quelconque, la validité, la légalité ou l'application des autres dispositions des présentes conditions générales n'en serait aucunement affectée ou altérée, les autres stipulations des conditions générales demeurant en vigueur et conservant leur plein et entier effet.</p>
									<p>La société <b>ResaExpress</b> pourra le cas échéant procéder à la rédaction d'une nouvelle clause ayant pour effet de rétablir la volonté commune des Parties telle qu'exprimée dans la clause initiale, et ce, dans le respect du droit en vigueur applicable aux présentes conditions générales.<br><br>    Les titres des articles des présentes n'ont qu'une valeur indicative et ne doivent pas être considérés comme faisant partie intégrante des conditions générales.</p>
								<h3>Absence de renonciation</h3>
									<p>    Sauf stipulation contraire prévue éventuellement dans les présentes conditions générales, aucune tolérance, inaction, abstention ou omission, aucun retard de la société <b>ResaExpress</b> pour se prévaloir de l'un quelconque de ses droits conformément aux termes des présentes, ne portera atteinte audit droit, ni ne saurait impliquer une renonciation pour l'avenir à se prévaloir d'un tel droit. Au contraire, ledit droit demeurera pleinement en vigueur.</p>
								<h3>Notification et retrait de contenu illicite</h3>
									<p>    La société <b>ResaExpress</b> informe tout utilisateur du site <b>ResaExpress</b> qu'il peut notifier une réclamation ou une objection quant à des éléments ou des contenus illicites placés sur le site <b>ResaExpress</b>.</p>
									<p>Si l'utilisateur pense que des éléments ou des contenus placés sur le site <b>ResaExpress</b> sont illicites et/ou contrefont des droits d'auteur qu'il détient, l'utilisateur doit adresser immédiatement une notification à la société <b>ResaExpress</b> par courrier LRAR et contenant tous les éléments justificatifs de titularité des droits le cas échéant. Une fois cette procédure suivie et après vérification de l'exactitude de la notification, la société <b>ResaExpress</b> s'efforcera, dans une mesure raisonnable et dans les meilleurs délais, de retirer le contenu illicite. Il est précisé que la responsabilité de la société <b>ResaExpress</b> ne peut être engagée pour des contenus présents sur le site <b>ResaExpress</b> et modifiables par des tiers (par exemple, fiche des restaurants, forums, avis,....).</p>

													</div>
												</div>
											</div>
										</div>
									</div>
								</div>

			</div>
			<div class="modal-footer">
				<button data-dismiss="modal" class="btn btn-default" type="button">
					Close
				</button>
			</div>
		</div>
	</div>
</div>
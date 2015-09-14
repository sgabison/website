					<div class="container">
						<!-- start: PAGE HEADER -->
					<? // include( PIMCORE_LAYOUTS_DIRECTORY ."/inc_toolbar.php") ; ?>
						<!-- end: PAGE HEADER -->
					<? // include( PIMCORE_LAYOUTS_DIRECTORY ."/inc_breadcrumb.php") ; ?>
						<!-- start: PAGE CONTENT -->
						<div class="row">
							<div class="col-md-12">
								<!-- start: DYNAMIC TABLE PANEL -->
								<div class="panel panel-white">
									<div class="panel-heading">
										<h4 class="panel-title"><?= $this->translate("Employee")?> <span class="text-bold"><?= $this->translate("Role")?></span></h4>
										<div class="panel-tools">
											<div class="dropdown">
												<a data-toggle="dropdown" class="btn btn-xs dropdown-toggle btn-transparent-grey">
													<i class="fa fa-cog"></i>
												</a>
												<ul class="dropdown-menu dropdown-light pull-right" role="menu">
													<li>
														<a class="panel-collapse collapses" href="#"><i class="fa fa-angle-up"></i> <span>Collapse</span> </a>
													</li>
													<li>
														<a class="panel-refresh" href="#">
															<i class="fa fa-refresh"></i> <span>Refresh</span>
														</a>
													</li>
													<li>
														<a class="panel-config" href="#panel-config" data-toggle="modal">
															<i class="fa fa-wrench"></i> <span>Configurations</span>
														</a>
													</li>
													<li>
														<a class="panel-expand" href="#">
															<i class="fa fa-expand"></i> <span>Fullscreen</span>
														</a>
													</li>
												</ul>
											</div>
											<a class="btn btn-xs btn-link panel-close" href="#">
												<i class="fa fa-times"></i>
											</a>
										</div>
									</div>
									<div class="panel-body">
										<div class="row">
											<div class="col-md-12 space20">
												<button  href="#newContributor" class="btn btn-green new-contributor">
													<?= $this->translate("Add new employee")?> <i class="fa fa-plus"></i>
												</button>
											</div>
										</div>
										<div class="row">									
											<table class="table table-striped table-hover" id="sample-table-2">
											<thead>
												<tr>
													<th class="center"></th>
													<th class="center"><?= $this->translate("Name")?></th>
													<th class="center"><?= $this->translate("Role")?></th>
													<th class="hidden-xs"><?= $this->translate("Phone")?></th>
													<th class="hidden-xs"><?= $this->translate("Email")?></th>
													<th></th>
												</tr>
											</thead>
											<tbody>
											<? if($this->employes): ?>
											<?php foreach($this->employes as $e) : $i++;?>
												<tr>
													<td class="center">
													<img src="<? if ( $e->getAvatar() ) { echo $e->getAvatar()->getThumbnail('avatar') ;} else { ?><?= PIMCORE_WEBSITE_LAYOUTS?>/assets/images/avatar-<?= $i;?>.jpg<? } ?>" alt="image"/></td>
													<td class="center"><?= $e->getFullName()?></td>
													<td class="center">
													<? if($this->locations ): ?> <? foreach ($this->locations as $l):?>
															<? if ($l->getPositions()):?>
															<h5 class="space15"> <?= $l->getName() ?></h5>
															<?php foreach($l->getPositions() as $p) :?>
																<div class="checkbox">
																<label class="checkbox-inline">	
																	<input type="checkbox" data-person-id="<?=$e->getId()?>" data-full-name="<?=$e->getFullname()?>" data-position-id="<?=$p->getId()?>"  <? if($e->checkPosition($p->getId())) echo 'checked' ;?>  class=" checkbox-position grey" >
																		<?= $p->getName()?> 
																</label>
																</div>
															<? endforeach;?>
															<?endif ;?>
													<? endforeach;?><? endif ; ?>
													</td>
													<td class="hidden-xs"><?= $e->getPhone();?></td>
													<td class="hidden-xs">
													<a href="<? if ($e->getEmail()): echo 'mailto:'.$e->getEmail(); else: echo'#'; endif;?>" rel="nofollow" >
														<?= $e->getEmail();?>
													</a></td>

													<td class="center">
													<div class="visible-md visible-lg hidden-sm hidden-xs">
														<a href="#newContributor" class="show-subviews edit-contributor btn btn-xs btn-blue tooltips" data-placement="top" data-id="$e->getId()" data-original-title="Edit"><i class="fa fa-edit"></i></a>
														<a href="#" class="btn btn-xs btn-green tooltips" data-placement="top" data-original-title="Share"><i class="fa fa-share"></i></a>
														<a href="#" class="btn btn-xs btn-red tooltips" data-placement="top" data-original-title="Remove"><i class="fa fa-times fa fa-white"></i></a>
													</div>
													<div class="visible-xs visible-sm hidden-md hidden-lg">
														<div class="btn-group">
															<a class="btn btn-green dropdown-toggle btn-sm" data-toggle="dropdown" href="#">
																<i class="fa fa-cog"></i> <span class="caret"></span>
															</a>
															<ul role="menu" class="dropdown-menu pull-right dropdown-dark">
																<li>
																	<a href="#newContributor" class="show-subviews edit-contributor" data-id="$e->getId()">
																		<i class="fa fa-pencil"></i> Edit
																	</a>
																</li>
																<li>
																	<a role="menuitem" tabindex="-1" href="#">
																		<i class="fa fa-share"></i> Share
																	</a>
																</li>
																<li>
																	<a role="menuitem" tabindex="-1" href="#">
																		<i class="fa fa-times"></i> Remove
																	</a>
																</li>
															</ul>
														</div>
													</div></td>
												</tr>
												<? endforeach;?>
												<? else: ?>
												<tr><?= $this->translate("TXT_NO_DATA");?></tr>
												<? endif;?>
											</tbody>
										</table>
										</div>
									</div>
								</div>
							</div>
						</div>
						<div class="hidden">
							<? if($this->locations ): ?> 
							<div id="positions" > 														 
							<? foreach ($this->locations as $l):?>
								<? if ($l->getPositions()):?>
								<h5 class="space15"> <?= $l->getName() ?></h5>
								<?php foreach($l->getPositions() as $p) :?>
									<div class="checkbox">
									<label class="checkbox-inline">	
										<input type="checkbox" data-person-id="" data-full-name="" data-position-id="<?=$p->getId()?>"  class="grey" >
											<?= $p->getName()?> 
									</label>
									</div>
								<? endforeach;?>
								<?endif ;?>
							<? endforeach;?>														 
							</div><? endif ; ?>
						</div>
						<!-- end: PAGE CONTENT-->
					</div>


										
								<!-- start: FULL CALENDAR PANEL -->
								<div class="panel panel-white"  >
								
									<div class="panel-body">
										<div class="col-sm-12 space20">
											<a href="#newFullEvent" class="btn btn-primary add-event"><i class="fa fa-plus"></i> <?php echo $this->t('TXT_ADD_EVENT')?></a>
										</div>
										<div class="col-sm-9">
											<div id='full-calendar'></div>
										</div>
										<div class="col-sm-3">
											<h4 class="space20"><?php echo $this->t('TXT_EVENT_CATEGORIES')?></h4>
											<?php if($this->categories):?>
											<div id="event-categories">
											<?php Foreach ($this->categories as $category): ?>
												<div class="event-category event-<?php echo $category?>" data-class="event-<?php echo $category?>">
													<?php echo $this->t($category)?>
												</div>
											<?php endforeach ; ?>
											<!--
												<div class="checkbox">
													<label>
														<input type="checkbox" class="grey" id="drop-remove" />
														Remove after drop
													</label>
												</div>
											-->
											</div>
											<?php endif; ?>
										</div>
									</div>
								</div>
								<!-- end: FULL CALENDAR PANEL -->

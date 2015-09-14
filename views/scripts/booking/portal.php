
								<!-- start: DYNAMIC TABLE PANEL -->
								<div class="panel panel-white">
									<div class="panel-heading">
										<h4 class="panel-title"><?= $this->translate("tache actuelle")?> <span class="text-bold"><?= $this->translate("état")?></span></h4>
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
													<?= $this->translate("Action 1")?> <i class="fa fa-plus"></i>
												</button>
												<button data-table="#list-employees"  class="btn btn-orange print-table">
													<?= $this->translate("Print")?> <i class="fa fa-print"></i>
												</button>
												<div class="btn-group pull-right">
													<button data-toggle="dropdown" class="btn btn-green dropdown-toggle">
														Export <i class="fa fa-angle-down"></i>
													</button>
													<ul class="dropdown-menu dropdown-light pull-right">
														<li>
															<a href="#" class="export-pdf" data-table="#list-employees" data-ignoreColumn ="0,2,5">
																<img src='<?= PIMCORE_WEBSITE_LAYOUTS?>/assets/icons/pdf.png' width='24px'> Save as PDF
															</a>
														</li>
														<li>
															<a href="#" class="export-png" data-table="#list-employees" data-ignoreColumn ="0,2,5">
																<img src='<?= PIMCORE_WEBSITE_LAYOUTS?>/assets/icons/png.png' width='24px'> Save as PNG
															</a>
														</li>
														<li>
															<a href="#" class="export-csv" data-table="#list-employees" data-ignoreColumn ="0,2,5">
																<img src='<?= PIMCORE_WEBSITE_LAYOUTS?>/assets/icons/csv.png' width='24px'> Save as CSV
															</a>
														</li>
														<li>
															<a href="#" class="export-txt" data-table="#list-employees" data-ignoreColumn ="0,2,5">
																<img src='<?= PIMCORE_WEBSITE_LAYOUTS?>/assets/icons/txt.png' width='24px'> Save as TXT
															</a>
														</li>
														<li>
															<a href="#" class="export-xml" data-table="#list-employees" data-ignoreColumn ="0,2,5">
																<img src='<?= PIMCORE_WEBSITE_LAYOUTS?>/assets/icons/xml.png' width='24px'> Save as XML
															</a>
														</li>
														<li>
															<a href="#" class="export-sql" data-table="#list-employees" data-ignoreColumn ="0,2,5">
																<img src='<?= PIMCORE_WEBSITE_LAYOUTS?>/assets/icons/sql.png' width='24px'> Save as SQL
															</a>
														</li>
														<li>
															<a href="#" class="export-json" data-table="#list-employees" data-ignoreColumn ="0,2,5">
																<img src='<?= PIMCORE_WEBSITE_LAYOUTS?>/assets/icons/json.png' width='24px'> Save as JSON
															</a>
														</li>
														<li>
															<a href="#" class="export-excel" data-table="#list-employees" data-ignoreColumn ="0,2,5">
																<img src='<?= PIMCORE_WEBSITE_LAYOUTS?>/assets/icons/xls.png' width='24px'> Export to Excel
															</a>
														</li>
														<li>
															<a href="#" class="export-doc" data-table="#list-employees" data-ignoreColumn ="0,2,5">
																<img src='<?= PIMCORE_WEBSITE_LAYOUTS?>/assets/icons/word.png' width='24px'> Export to Word
															</a>
														</li>
														<li>
															<a href="#" class="export-powerpoint" data-table="#list-employees" data-ignoreColumn ="0,2,5">
																<img src='<?= PIMCORE_WEBSITE_LAYOUTS?>/assets/icons/ppt.png' width='24px'> Export to PowerPoint
															</a>
														</li>
													</ul>
												</div>
											</div>
										</div>
										<div class="row">	
											<!-- le contenu ici -->								
										</div>
									</div>
								</div>
							


<!-- start: SUBVIEW FOR CALENDAR PAGE -->
<div id="newFullEvent">
	<div class="noteWrap col-md-8 col-md-offset-2">
		<h3>
			<?php echo $this->t('TXT_ADD_EVENT')?>
		</h3>
		<form class="form-full-event">
			<div class="row">
				<div class="col-md-12">
					<div class="form-group">
						<input class="event-id hide" type="text"> <input
							class="event-name form-control" name="eventName" type="text"
							placeholder="<?php echo $this->t('TXT_EVENT_NAME')?>">
					</div>
				</div>
				<div class="col-md-4">
					<div class="form-group">
						<input type="checkbox" class="all-day" data-label-text="<?= $this->t("All-Day")?>"
							data-on-text="<?= $this->t('True')?>" data-off-text="<?= $this->t('False')?>">
					</div>
				</div>
				<div class="no-all-day-range">
					<div class="col-md-8">
						<div class="form-group">
							<div class="form-group">
								<span class="input-icon"> <input type="text"
									class="event-range-date form-control" name="eventRangeDate"
									placeholder="<?php echo $this->t('TXT_EVENT_RANGE')?>" /> <i
									class="fa fa-clock-o"></i>
								</span>
							</div>
						</div>
					</div>
				</div>
				<div class="all-day-range">
					<div class="col-md-8">
						<div class="form-group">
							<div class="form-group">
								<span class="input-icon"> <input type="text"
									class="event-range-date form-control" name="ad_eventRangeDate"
									placeholder="<?php echo $this->t('TXT_EVENT_RANGE')?>" /> <i
									class="fa fa-calendar"></i>
								</span>
							</div>
						</div>
					</div>
				</div>
				<div class="hide">
					<input type="text" class="event-start-date" name="eventStartDate" />
					<input type="text" class="event-end-date" name="eventEndDate" />
				</div>
				<?php if($this->categories):?>

				<div class="col-md-12">
					<div class="form-group">
						<select class="form-control selectpicker event-categories">
							<?php Foreach ($this->categories as $category): ?>
							<option data-content="<span class='event-category event-<?php echo $category?>'><?php echo $this->t($category)?></span>" value="event-<?php echo $category?>"><?php echo $this->t($category)?></option>
							<?php endforeach ; ?>
						</select>
					</div>
				</div>
				<?php endif; ?>
				<div class="col-md-12">
					<div class="form-group">
						<textarea class="summernote" placeholder="<?php echo $this->t('TXT_EVENT_NOTE')?>"></textarea>
					</div>
				</div>
			</div>
			<div class="pull-right">
				<div class="btn-group">
					<a href="#" class="btn btn-info close-subview-button"> <?php echo $this->t('TXT_BUTTON_CLOSE')?>
					</a>
				</div>
				<div class="btn-group">
					<button class="btn btn-info save-new-event" type="submit">
						<?php echo $this->t('TXT_BUTTON_SAVE')?>
					</button>
				</div>
			</div>
		</form>
	</div>
</div>
<div id="readFullEvent">
	<div class="noteWrap col-md-8 col-md-offset-2">
		<div class="row">
			<div class="col-md-12">
				<h2 class="event-title"></h2>
				<div class="btn-group options-toggle pull-right">
					<button class="btn dropdown-toggle btn-transparent-grey" data-toggle="dropdown">
						<i class="fa fa-cog"></i> <span class="caret"></span>
					</button>
					<ul role="menu" class="dropdown-menu dropdown-light pull-right">
						<li><a href="#newFullEvent" class="edit-event"> <i
								class="fa fa-pencil"></i> <?php echo $this->t('TXT_BUTTON_EDIT')?>
						</a>
						</li>
						<li><a href="#" class="delete-event"> <i class="fa fa-times"></i>
								<?php echo $this->t('TXT_BUTTON_DELETE')?>
						</a>
						</li>
					</ul>
				</div>
			</div>
			<div class="col-md-6">
				<span class="event-category event-cancelled">Cancelled</span> <span
					class="event-allday"><i class='fa fa-check'></i> <?= $this->t("All-Day")?>
				</span>
			</div>
			<div class="col-md-12">
				<div class="row">
					<div class="col-md-6">
						<div class="event-start">
							<div class="event-day"></div>
							<div class="event-date"></div>
							<div class="event-time"></div>
						</div>
					</div>
					<div class="col-md-6">
						<div class="event-end"></div>
					</div>
				</div>
			</div>
			<div class="col-md-12">
				<div class="event-content"></div>
			</div>
		</div>
	</div>
</div>
<!-- *** SHOW CALENDAR *** -->
<div id="showCalendar" class="col-md-10 col-md-offset-1">
	<div class="barTopSubview">
		<a href="#newEvent" class="new-event button-sv"
			data-subviews-options='{"onShow": "editEvent()"}'><i
			class="fa fa-plus"></i> <?php echo $this->t('TXT_ADD_EVENT')?> </a>
	</div>
	<div id="calendar"></div>
</div>

<!-- end: SUBVIEW FOR CALENDAR PAGE -->

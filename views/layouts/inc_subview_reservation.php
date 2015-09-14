			<!-- *** NEW RESERVATION *** -->
			<div id="newReservation">
				<div class="noteWrap col-md-8 col-md-offset-2">
					<h3>Add new reservation</h3>
					<form class="form-reservation">
						<div class="row">
							<div class="col-md-12">
								<div class="errorHandler alert alert-danger no-display">
									<i class="fa fa-times-sign"></i> You have some form errors. Please check below.
								</div>
								<div class="successHandler alert alert-success no-display">
									<i class="fa fa-ok"></i> Your form validation is successful!
								</div>
							</div>
							<div class="col-md-6">
								<div class="form-group">
									<label class="control-label">
										reservation-servingtitle <span class="symbol required"></span>
									</label>
									<input type="text" class="form-control reservation-servingtitle" name="servingtitle">
								</div>
								<div class="form-group">
									<input class="reservation-index hide" type="text">
									<input class="reservation-id hide" type="text">
									<input class="reservation-form-method hide" type="text">
									<label class="control-label">
										Start Date <span class="symbol required"></span>
									</label>
									<input type="text" placeholder="Start Time" class="form-control reservation-startdate" name="startdate">
								</div>
								<div class="form-group">
									<label class="control-label">
										Start Time <span class="symbol required"></span>
									</label>
									<input type="text" placeholder="Insert your Last Name" class="form-control reservation-starttime" name="starttime">
								</div>
							</div>
							<div class="col-md-6">
								<div class="form-group">
									<label class="control-label">
										reservation-guestname <span class="symbol required"></span>
									</label>
									<input type="text" placeholder="Text Field" class="form-control reservation-guestname" name="guestname">
								</div>
								<div class="form-group">
									<label class="control-label">
										Telephone # <span class="symbol required"></span>
									</label>
									<input type="number" class="form-control reservation-guesttel" name="guesttel">
								</div>
								<div class="form-group">
									<label class="control-label">
										SEND MESSAGE (SMS)
									</label>
									<textarea class="form-control reservation-sms" placeholder="Write your sms message here...."></textarea>
								</div>
								<div class="form-group">
									<label class="control-label">
										SEND MESSAGE (Email)
									</label>
									<textarea class="form-control reservation-message" placeholder="Write your email message here...."></textarea>
								</div>
							</div>
						</div>
						<div class="pull-right">
							<div class="btn-group">
								<a href="#" class="btn btn-info close-subview-button">
									Close
								</a>
							</div>
							<div class="btn-group">
								<button class="btn btn-info save-reservation" type="submit">
									Save
								</button>
							</div>
						</div>
					</form>
				</div>
			</div>
			<!-- *** SHOW RESERVATIONS *** -->
			<div id="showReservations">
				<div class="barTopSubview">
					<a href="#newReservation" class="new-reservation button-sv"><i class="fa fa-plus"></i> Show Reservations</a>
				</div>
				<div class="noteWrap col-md-10 col-md-offset-1">
					<div class="panel panel-default">
						<div class="panel-body">
							<div id="reservations">
								<div class="options-reservations hide">
									<div class="btn-group">
										
										<a href="#newReservation" class="show-subviews edit-reservation">
											<button class="btn btn-transparent-grey">Edit
											</button>
										</a>
										<a href="#" class="delete-reservation">
											<button class="btn btn-transparent-grey">Delete
											</button>
										</a>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
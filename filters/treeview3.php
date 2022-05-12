<?php
include 'treefunctions2.php';
periodTypeFile();
getDistrict();
getClinic();

?>

<!DOCTYPE html>
<html>

<head>
	<!-- Bootstrap & JQuery CDN  -->
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.13.1/css/bootstrap-select.css" />
	<title>DHIS-2 Filter</title>
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
	<script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.13.1/js/bootstrap-select.min.js"></script>
	<!-- You can Delete these -->
	<!-- Custom CSS -->
	<style>
		@media screen and (min-width: 676px) {
			.modal-dialog {
				max-width: 600px;
				/* New width for default modal */
			}
		}
	</style>
</head>

<body>
	<!-- Modal -->
	<div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
		<div class="modal-dialog modal-dialog-centered" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title" id="exampleModalLongTitle">Modal title</h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<div class="modal-body">

					<form method="post" action="treefunctions.php" id="filter">
						<div class="row">
							<div class="col">
								<label for="title">Regions</label>
								<select name="region" id="region" class="form-control">
									<option> Select </option>
									<option value="UNSNiNqkzEM"> All of Zanzibar</option>
									<?php
									foreach (getRegion() as $key => $value) { ?>
										<option value="<?= $value['id'] ?>"> <?= $value['displayName'] ?></option>

									<?php } ?>
								</select>

							</div>
							<div class="col">
								<label for="title"> Select Districts</label>
								<select name="district" class="form-control " id="district"  >
									<!-- append here -->
								</select>
							</div>

							<div class="col">
								<label for="title"> Select Clinics</label>
								<select name="clinic" class="form-control selectpicker" id="clinic" >
									<!-- append here -->
								</select>
							</div>
						</div>
						<div class="row">
							<div class="col">
								<!-- THIS_WEEK, LAST_WEEK, LAST_4_WEEKS, LAST_12_WEEKS, LAST_52_WEEKS,
								THIS_MONTH, LAST_MONTH, THIS_BIMONTH, LAST_BIMONTH, THIS_QUARTER, LAST_QUARTER,
								THIS_SIX_MONTH, LAST_SIX_MONTH, MONTHS_THIS_YEAR, QUARTERS_THIS_YEAR,
								THIS_YEAR, MONTHS_LAST_YEAR, QUARTERS_LAST_YEAR, LAST_YEAR, LAST_5_YEARS, LAST_12_MONTHS,
								LAST_3_MONTHS, LAST_6_BIMONTHS, LAST_4_QUARTERS, LAST_2_SIXMONTHS, THIS_FINANCIAL_YEAR,
								LAST_FINANCIAL_YEAR, LAST_5_FINANCIAL_YEARS
								 -->
								<label for="title"> Period </label>
								<select class="form-control" multiple data-live-search="true">
									<option value="">Daily</option>
									<option value="THIS_WEEK">Weekly</option>
									<option value="THIS_MONTH">Monthly</option>
									<option value="THIS_QUARTER">Quarterly</option>
									<option value="THIS_SIX_MONTH">Six-monthly</option>
									<option value="LAST_52_WEEKS">Yearly</option>
								</select>
							</div>
						</div>
					</form>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
					<button type="button" class="btn btn-light">Save changes</button>
				</div>
			</div>
		</div>
	</div>
	<!-- End of Modal -->

	<div class="container">

		<!-- Button trigger modal -->
		<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModalCenter">
			Filter
		</button>
	</div>
</body>
<script>
	$(document).ready(function() {
		$("#region").change(function() {
			var region = $("#region").val();

			$.ajax({
				url: "treefunctions2.php",
				method: "post",
				data: 'region=' + region
			}).done(function(district) {
				console.log(district);
				district = JSON.parse(district);
				$('#district').empty();
				$("#district").append('<option value="UNSNiNqkzEM" > All clinics </option>')
				district.forEach(function(district) {
					$("#district").append('<option value="' + district.id + '" >' + district.name + '</option>')
				})
				$('#district').selectpicker('refresh');
			})


		})
		$("#district").change(function() {
			var district = $("#district").val();

			$.ajax({
				url: "treefunctions2.php",
				method: "post",
				data: 'district=' + district
			}).done(function(clinic) {
				console.log(clinic);
				clinic = JSON.parse(clinic);
				$('#clinic').empty();
				clinic.forEach(function(clinic) {
					$("#clinic").append('<option value="' + clinic.id + '" >' + clinic.name + '</option>')
				})
				$('#clinic').selectpicker('refresh');

			})

		})
	})

	$('select').selectpicker();

	// $('#exampleModalCenter').modal('toggle')
</script>

</html>
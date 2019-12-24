<?php 
require_once('config.php');
 ?>

<!DOCTYPE html>
<html>
<head>
	<title>Rusty Devs</title>
	<link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
	

</head>
<body>
 
	<div>
		<?php 
		
		 ?>

	</div>

<div>
	<form action="registration.php" method="post">
		<div class="container">
			<div class="row">
				<div class="col-sm-3">
					<h2>Registration Page</h2>
					<p>Please fill up the forms below.</p>

					<hr class="mb-3">

					<label for="username"><b>Username</b></label>
					<input class="form-control" id="username" type="text" name="username" required>

					<label for="password"><b>Password</b></label>
					<input class="form-control" id="password" type="password" name="password" required>

					<label for="password"><b>Confirm Password</b></label>
					<input class="form-control" id="confirmPassword" type="password" name="confirmPassword" required>

					<label for="firstname"><b>First Name</b></label>
					<input class="form-control" id="firstname" type="text" name="firstname" required>

					<label for="middlename"><b>Middle Name</b></label>
					<input class="form-control" id="middlename" type="text" name="middlename">

					<label for="lastname"><b>Last Name</b></label>
					<input class="form-control" id="lastname" type="text" name="lastname" required>

					<hr class="mb-3">


					
				</div>
			</div>
					<div class="col-md-10 alert alert-dark" role="alert">
							<div class="col-md-6">
									<h5 class="badge badge-danger">Birthday</h5>
									<select id="month"></select>
									<select id="day"></select>
									<select id="year"></select>
							</div>
					</div>
					<hr class="mb-3">

					<input class="btn btn-primary" type="submit" id="register" name="create" value="Sign Up">
		</div>
	</form>
</div>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>
<script src="package/dist/sweetalert2.all.min.js"></script>
<script type="text/javascript">
	$(function(){
		$('#register').click(function(e){

			var valid = this.form.checkValidity();
			if(valid){

				var username = $('#username').val();
				var password = $('#password').val();
				var confirmPassword = $('#confirmPassword').val();
				var firstname = $('#firstname').val();
				var middlename = $('#middlename').val();
				var lastname = $('#lastname').val();


				var month = $('#month').val();
				var day = $('#day').val();
				var year = $('#year').val();
				var dateOfBirth=year+"-"+month+"-"+day;

				e.preventDefault();

				$.ajax({
					type: 'POST',
					url: 'process.php',
					data: {username: username, password: password, confirmPassword: confirmPassword, firstname: firstname, middlename: middlename, lastname: lastname, year: year, month: month, day: day},
					success: function(data){
						Swal.fire(
						  'Registration Successful!',
						  'Thank you for filling up the forms!',
						  'success'
						)
					},
					error: function(data){
						Swal.fire(
						  'Oops!',
						  'Something went wrong...',
						  'error'
						)
					}
				});

				//alert('true');
				alert(username+password+confirmPassword+firstname+middlename+lastname+dateOfBirth);
				$("form").trigger("reset");
			}
			else{
				alert('Please fill in the forms.');
			}
			
			


		});

		

	});


</script>

<script>
	$(document).ready(function() {


		const monthNames = ["January", "February", "March", "April", "May", "June",
		  "July", "August", "September", "October", "November", "December"
		];
		  var qntYears = 40;
		  var selectYear = $("#year");
		  var selectMonth = $("#month");
		  var selectDay = $("#day");
		  var currentYear = new Date().getFullYear();
		  
		  for (var y = 0; y < qntYears; y++){
			let date = new Date(currentYear);
			var yearElem = document.createElement("option");
			yearElem.value = currentYear 
			yearElem.textContent = currentYear;
			selectYear.append(yearElem);
			currentYear--;
		  } 
		
		  for (var m = 0; m < 12; m++){
			  let monthNum = new Date(2019, m).getMonth()
			  let month = monthNames[monthNum];
			  var monthElem = document.createElement("option");
			  monthElem.value = monthNum+1; 
			  monthElem.textContent = month;
			  selectMonth.append(monthElem);
			}
		
			var d = new Date();
			var month = d.getMonth();
			var year = d.getFullYear();
			var day = d.getDate();
		
			selectYear.val(year); 
			selectYear.on("change", AdjustDays);  
			selectMonth.val(month);    
			selectMonth.on("change", AdjustDays);
		
			AdjustDays();
			selectDay.val(day)
			
			function AdjustDays(){
			  var year = selectYear.val();
			  var month = parseInt(selectMonth.val()) + 1;
			  selectDay.empty();
			  
			  
			  var days = new Date(year, month, 0).getDate(); 
			  
			 
			  for (var d = 1; d <= days; d++){
				var dayElem = document.createElement("option");
				dayElem.value = d; 
				dayElem.textContent = d;
				selectDay.append(dayElem);
			  }
			}    
		});
		
		</script>

</body>
</html>
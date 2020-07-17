
<?php 
	session_start();
	require('config/setup.php'); 
?>
<!DOCTYPE html>
<html>
<head>
	<title>Login - IT Support Online</title>
	<link rel="stylesheet" type="text/css" href="resource/css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="resource/css/styles.css">
</head>
<body>
	<header class="border-bottom">
		<img src="resource/image/logo.png" class="logo">

		<div class="nav">
			<a href="index.php">Home</a>
			<a href="" class="active">Login</a>
		</div>
	</header>


	<section class="mt-4">			
		
		<div class="row">
			<div class="offset-md-1 col-12 col-md-5 border-right">
				<div class="">
					<div class="text-center"><span class="title">Sign up</span></div>

					<?php
						if(isset($_POST['register'])){

							// Clean the data received from the form
							$username = mysqli_real_escape_string($con, $_POST['username']);
							$email = mysqli_real_escape_string($con, $_POST['email']);
							$password = mysqli_real_escape_string($con, $_POST['password']);
							$re_password = mysqli_real_escape_string($con, $_POST['re-password']);

							// Check if the data is not empty
							if(!empty($username) && !empty($email) && !empty($password) && !empty($re_password)){

								// Check if the two passwords match
								if($password ===  $re_password){

									// Insert the data to the database 
									$sql = "INSERT INTO users (username, email, password, status, role) 
											VALUES ('$username', '$email', sha('$password'), 1, 2)";
									$result = mysqli_query($con, $sql);

									// If there is no error from the request
									if(!mysqli_error($con)){

										echo "<div class='alert alert-success'><strong>Error:</strong> Registration Successfully. Login >> </div>";

									}else {

										echo "<div class='alert alert-danger'>Registration failed. Please try again.</div>" . mysqli_error($con);

									}

								}else{

									$password = "";
									$re_password = "";
									echo "<div class='alert alert-warning'>Passwords do not match.</div>";

								}

							}
						}

						?>

					<form class="mt-4" method="post" action="login.php">

						<div class="form-group row">
							<div class="col-12 col-md-6">
								<label>Username</label>
								<input class="form-control" type="text" required placeholder="Username" name="username"></input>
							</div>
							<div class="col-12 col-md-6">
								<label>Email</label>
								<input class="form-control" type="email" required placeholder="Email" name="email"></input>
							</div>
						</div>

						<div class="form-group row">
							<div class="col-12">
								<label>Password</label>
								<input class="form-control" type="password" required placeholder="Password" name="password"></input>
							</div>
						</div>


						<div class="form-group row">
							<div class="col-12">
								<label>Re-type Password</label>
								<input class="form-control" type="password" required placeholder="Re-type Password" name="re-password"></input>
							</div>
						</div>


						<div class="form-group row">
							<div class="col-12 text-center">
								<button type="submit" class="btn btn-ghost" name="register">Register</button>
							</div>
						</div>
					</form>
				</div>
			</div>
			<div class="col-12 offset-md-1 col-md-4">
				<div class="">
					<div class="text-center"><span class="title">Log in</span></div>

					<?php
						if(isset($_POST['login'])){

							// Clean the data received from the form
							$email = mysqli_real_escape_string($con, $_POST['email']);
							$password = mysqli_real_escape_string($con, $_POST['password']);

							// Check if the data is not empty
							if(!empty($email) && !empty($password)){

								// Send request to the database to retrieve user with this email and password
								$sql = "SELECT users.id, users.username, users.status, roles.name, users.email FROM users 
										INNER JOIN roles ON users.role = roles.id
										WHERE email = '$email' AND password = sha('$password') ";
								$result = mysqli_query($con, $sql);

								// If there is no error from the request
								if(!mysqli_error($con)){

									// If 0 number of rows are returned means there is no user with such username and password
									if(mysqli_num_rows($result) <= 0){

										echo "<div class='alert alert-warning'><strong>Error:</strong> Wrong credentials.</div>";

									}else {

										$row = mysqli_fetch_assoc($result);

										if($row['status'] == 0){

											echo "<div class='alert alert-danger'>Your account is disabled.<br/>Please contact admin.</div>";

										}else if($row['status'] == 1){
											
											$id = $row['id'];
											$role = strtolower($row['name']);
											$username = $row['username'];

											$_SESSION['id'] = $id;
											$_SESSION['email'] = $email;
											$_SESSION['role'] = $role;
											$_SESSION['username'] = $username;

											if($role === 'admin'){
												header("location: admin/dashboard.php");
												
											}else if($role === 'user'){
												header("location: users/");
											}

											die();
										}
									}

								}else{

									$password = "";
									echo "<div class='alert alert-warning'><strong>Error:</strong> Login failed. " . mysqli_error($con) ."</div>";

								}
							}else{

								$password = "";
								echo "<div class='alert alert-warning'><strong>Error:</strong> Please fill all fields.</div>";

							}

						}

						?>

					<form class="mt-4" method="post" action="login.php">
						<div class="form-group row">
							<div class="col-12">
								<label>Email</label>
								<input class="form-control" type="email" name="email" required placeholder="Email" />
							</div>
						</div>

						<div class="form-group row">
							<div class="col-12">
								<label>Password</label>
								<input class="form-control" type="password" name="password" required placeholder="Password"/>
							</div>
						</div>

						<div class="form-group row">
							<div class="col-12 text-center">
								<button type="submit" class="btn btn-ghost" name="login">Login</button>
							</div>
						</div>
					</form>
				</div>
			</div>
		</div>

	</section>

	<footer> &copy;2020 Chef Misosi Online Food Ordering System. </footer>
</body>
</html>
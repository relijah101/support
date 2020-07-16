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

					<form class="mt-4">

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
								<button type="submit" class="btn btn-ghost">Register</button>
							</div>
						</div>
					</form>
				</div>
			</div>
			<div class="col-12 offset-md-1 col-md-4">
				<div class="">
					<div class="text-center"><span class="title">Log in</span></div>

					<form class="mt-4">
						<div class="form-group row">
							<div class="col-12">
								<label>Email</label>
								<input class="form-control" type="email" name="email" required placeholder="Email"/>
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
								<button type="submit" class="btn btn-ghost">Login</button>
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
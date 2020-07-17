<?php
session_start();
// Check if not logged in, return to homepage
if(!isset($_SESSION['id']) || !isset($_SESSION['role'])){
	if($_SESSION['role'] !== 'admin') header("location: ../");
}

require('../config/setup.php');

//Fetch total users, questions and categories;
$sql = "SELECT count(*) as count FROM users";
$result = mysqli_query($con, $sql);

if(!mysqli_error($con)){
	$users_count = mysqli_fetch_assoc($result)['count'];
}

$sql = "SELECT count(*) as count FROM questions";
$result = mysqli_query($con, $sql);
if(!mysqli_error($con)){
	$questions_count = mysqli_fetch_assoc($result)['count'];
}

$sql = "SELECT count(*) as count FROM categories";
$result = mysqli_query($con, $sql);
if(!mysqli_error($con)){
	$category_count = mysqli_fetch_assoc($result)['count'];
}
?>
<!DOCTYPE html>
<html>
<head>
	<title>Manager Dashboard - IT Support Online</title>
	<link rel="stylesheet" type="text/css" href="../resource/css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="../resource/css/styles.css">
</head>
<body>
	<div class="w-100 bg-dark text-white text-right font-sm px-2 py-1">Welcome <?php echo $_SESSION['username']; ?></div>
	<header class="border-bottom">
		<img src="../resource/image/logo.png" class="logo">

		<div class="nav">
			<a href="../index.php">Home</a>
			<a href="#" class="active">Dashboard</a>
			<a href="../logout.php">Logout</a>
		</div>
	</header>


	<section class="mt-4">			
		
		<div class="row">
			<div class="col-12 mb-3"><div class="text-center"><span class="title">Dashboard</span></div></div>
			
			<div class="col-12 offset-md-1 col-md-10">
				
				<div class="row">
					
					<div class="col-md-4">
						<div class="card">
							<a href="users.php" class="d-flex justify-content-center align-items-center h-100">
								<h1><?php echo $users_count; ?></h1>
							</a>
							<div class="text">Users</div>
						</div>
					</div>

					<div class="col-md-4">
						<div class="card">
							<a href="questions.php" class="d-flex justify-content-center align-items-center h-100">
								<h1><?php echo $questions_count; ?></h1>
							</a>
							<div class="text">Questions</div>
						</div>
					</div>

					<div class="col-md-4">
						<div class="card">
							<a href="categories.php" class="d-flex justify-content-center align-items-center h-100">
								<h1><?php echo $category_count; ?></h1>
							</a>
							<div class="text">Categories</div>
						</div>
					</div>

				</div>
			</div>
		
		</div>

	</section>

	<footer> &copy;2020 IT Support Online System. </footer>
</body>
</html>
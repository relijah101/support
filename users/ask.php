<?php
session_start();
// Check if not logged in, return to homepage
if(!isset($_SESSION['id']) || !isset($_SESSION['role'])){
	if($_SESSION['role'] !== 'user') header("location: ../");
}

require('../config/setup.php');

?>
<!DOCTYPE html>
<html>
<head>
	<title>All Questions - IT Support Online</title>
	<link rel="stylesheet" type="text/css" href="../resource/css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="../resource/css/styles.css">
</head>
<body>
	<div class="w-100 bg-dark text-white text-right font-sm px-2 py-1">Welcome <?php echo $_SESSION['username']; ?></div>

	<header class="border-bottom">
		<img src="../resource/image/logo.png" class="logo">

		<div class="nav">
			<a href="../index.php">Home</a>
			<a href="home.php">Dashboard</a>
			<a href="../logout.php">Logout</a>
		</div>
	</header>


	<section class="mt-4">			
		
		<div class="row">
			<div class="col-12 offset-md-1 col-md-10 mb-3 d-flex justify-content-between">
				<span class="title">Ask a question</span>
			</div>

			<div class="col-12 offset-md-1 col-md-10 mb-3">
			<?php
				if(isset($_POST['save'])){

					$question = mysqli_real_escape_string($con, $_POST['question']);
					$category = mysqli_real_escape_string($con, $_POST['category']);
					echo $category;
					if(!empty($question) && !empty($category)){

						$sql = "INSERT INTO questions (question, user_id, category_id) VALUES ('$question', '$_SESSION[id]', '$category')";
						$result = mysqli_query($con, $sql);

						if(!mysqli_error($con)){
							header("location: home.php");
						}else{
							echo "<div class='alert alert-warning'><strong>Error:</strong> Failed to add question.</div>" . mysqli_error($con);
						}
					}
				}
			?>
			</div>

			<div class="col-12 offset-md-1 col-md-10">
				
				<form class="" method="post" action="ask.php">
					
					<div class="form-group row mb-2">
						<div class="col-12">
							<label>Question</label>
							<textarea class="form-control form-control-sm" required placeholder="Type question here" name="question"></textarea>
						</div>
					</div>

					<div class="form-group row mb-2">
						<div class="col-12">
							<label>Category</label>
							<select class="form-control form-control-sm" required name="category">
								<?php
									$sql = "SELECT * FROM categories";
									$result = mysqli_query($con, $sql);
									if(!mysqli_error($con)){
										while($row = mysqli_fetch_assoc($result)){
											echo "<option value='$row[id]'>$row[name]</option>";
										}
									}
								?>
							</select>
						</div>
					</div>

					<div class="form-group row">
						<div class="col-12 text-center">
							<button type="submit"  class="btn btn-ghost" name="save">Post</button>
						</div>
					</div>

				</form>

			</div>
		
		</div>

	</section>

	<footer> &copy;2020 IT Support Online System. </footer>
</body>
</html>
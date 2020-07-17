<?php
session_start();
require('config/setup.php');
?>
<!DOCTYPE html>
<html>
<head>
	<title>IT Support Online Homepage</title>
	<link rel="stylesheet" type="text/css" href="resource/css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="resource/css/styles.css">
</head>
<body>
	<main class="d-flex flex-column">
		
		<header class="">
			<img src="resource/image/logo.png" class="logo">

			<div class="d-flex">
				<form method="get" action="index.php" id="search_form"></form>
				<input type="text" name="q" required placeholder="Search question here" class="form-control form-control-sm" form="search_form">
				<button class="btn btn-sm btn-ghost ml-2" type="submit" name="search" form="search_form">Search</button>
			</div>

			<div class="nav">
				<a href="#" class="active">Home</a>
				<?php
				if(isset($_SESSION['id'])){
				?>
					<a href="<?php if($_SESSION['role'] === 'admin') { echo 'admin/dashboard.php'; }else echo 'users/home.php'; ?>">Dashboard</a>
					<a href="logout.php">Logout</a>
				<?php
				}else{
				?>
					<a href="login.php">Login</a>
				<?php
				}
				?>
			</div>
		</header>


		<section class="row">		
			<div class="col-2">
				<div class="title mb-1">Categories</div>

				<div class="d-flex flex-column">
					<?php
						$sql = "SELECT * FROM categories";
						$result = mysqli_query($con, $sql);
						if(!mysqli_error($con)){
							if(mysqli_num_rows($result) > 0){

								echo "<a href='index.php' class='mb-1 p-2'>All categories</a>";

								while($row = mysqli_fetch_assoc($result)){
									echo "<a href='index.php?category=$row[name]' class='mb-1 p-2'>$row[name]</a>";
								}
							}
						}
					?>
				</div>
			</div>
			<div class="col-8 border-left">
				<div>
					<?php

						// Check if a category is selected
						if(isset($_GET['category'])){

							$category = mysqli_real_escape_String($con, $_GET['category']);
							$sql = "SELECT questions.id, question, date, users.username, categories.name FROM questions, users, categories 
								WHERE questions.user_id = users.id 
								AND questions.category_id = categories.id
								AND categories.name = '$category'";

						}else if(isset($_GET['q'])){

							$question = mysqli_real_escape_String($con, $_GET['q']);
							$sql = "SELECT questions.id, question, date, users.username, categories.name FROM questions, users, categories 
								WHERE questions.user_id = users.id 
								AND questions.category_id = categories.id
								AND questions.question LIKE '%$question%'";

						}else{
							// Otherwise if no category is selected
							$sql = "SELECT questions.id, question, date, users.username, categories.name FROM questions, users, categories 
								WHERE questions.user_id = users.id 
								AND questions.category_id = categories.id";

						}

						
						$result = mysqli_query($con, $sql);
						if(!mysqli_error($con)){
							if(mysqli_num_rows($result) > 0){

								while($row = mysqli_fetch_assoc($result)){

									// Count number of answers for each question
									$count_sql = "SELECT count(*) as totals FROM answers WHERE question_id = '$row[id]'";
									$count_result = mysqli_query($con, $count_sql);
									if(!mysqli_error($con)){
										$total_answers = mysqli_fetch_assoc($count_result)['totals'];
									}
									
					?>

					<div class="question">
						<span class="text-success font-weight-bold"><?php echo $row['username']?> : </span>
						<a href="answers.php?id=<?php echo $row['id']; ?>"><?php echo $row['question']; ?></a>

						<div class="details d-flex justify-content-between">
							<div><small class="text-muted">Answers:</small> <?php echo $total_answers; ?></div>
							<div><small class="text-muted">Category:</small> <?php echo $row['name']; ?></div>
							<div><small class="text-muted">Posted:</small> <?php echo date('d / m / Y', strtotime($row['date'])); ?></div>
						</div>
					</div>

					<?php
								}
							}
						}
					?>
					
				</div>
			</div>
		</section>

		<footer> &copy;2020 IT Support Online Food Ordering System. </footer>
	</main>
</body>
</html>
<?php
session_start();
require('config/setup.php');
?>
<!DOCTYPE html>
<html>
<head>
	<title>Answers - IT Support Online</title>
	<link rel="stylesheet" type="text/css" href="resource/css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="resource/css/styles.css">
</head>
<body>
	<main class="d-flex flex-column">
		
		<header class="">
			<img src="resource/image/logo.png" class="logo">

			<div class="nav">
				<a href="index.php">Home</a>
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

						$question_id = mysqli_real_escape_string($con, $_GET['id']);

						if(isset($_POST['reply'])){

							$answer = mysqli_real_escape_string($con, $_POST['answer']);

							if(!empty($answer)){

								$sql = "INSERT INTO answers (user_id, question_id, answers) VALUES ('$_SESSION[id]', '$question_id', '$answer')";
								$result = mysqli_query($con, $sql);

								if(mysqli_error($con)){
									echo mysqli_error($con);
								}
							}
						}

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
						
						$sql = "SELECT questions.id, question, date, users.username, categories.name FROM questions, users, categories 
							WHERE questions.user_id = users.id 
							AND questions.category_id = categories.id
							AND questions.id = '$question_id'";
						
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
						<?php echo $row['question']; ?>

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


						// Check if the user has logged
						if(isset($_SESSION['id'])){
					?>

					<div class="my-2">
						<form method="post" action="answers.php?id=<?php echo $question_id; ?>">
							<textarea class="form-control form-control-sm mb-1" name="answer" rows="5" placeholder="Type an answer here"></textarea>
							<div class="text-right">
								<button class="btn btn-sm btn-ghost" type="submit" name="reply">Reply</button>
							</div>
						</form>
					</div>

					<?php 
						}
					?>

					<span class="title mb-2">Answers</span>

					<?php

						$question_id = mysqli_real_escape_string($con, $_GET['id']);
						
						$sql = "SELECT answers.id, answers, answers.date, users.username FROM answers, users, questions 
							WHERE  answers.question_id = questions.id
							AND answers.user_id = users.id
							AND answers.question_id = '$question_id'
							ORDER BY answers.date DESC";
						
						$result = mysqli_query($con, $sql);
						if(!mysqli_error($con)){
							if(mysqli_num_rows($result) > 0){

								while($row = mysqli_fetch_assoc($result)){

									
					?>

					<div class="answers mt-3">
						<span class="text-info font-weight-bold"><?php echo $row['username']; ?> : </span>
						<?php echo $row['answers']; ?>
					</div>

					<?php
							}
						}else{
							echo "<div class='alert alert-info mt-3'>No answers provided yet!</div>";
						}
					}else echo mysqli_error($con);
					?>

				</div>
			</div>
		</section>

		<footer> &copy;2020 IT Support Online Food Ordering System. </footer>
	</main>
</body>
</html>
<?php
session_start();
// Check if not logged in, return to homepage
if(!isset($_SESSION['id']) || !isset($_SESSION['role'])){
	if($_SESSION['role'] !== 'admin') header("location: ../");
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
			<a href="dashboard.php">Dashboard</a>
			<a href="../logout.php">Logout</a>
		</div>
	</header>


	<section class="mt-4">			
		
		<div class="row">
			<div class="col-12 mb-3"><div class="text-center"><span class="title">Questions</span></div></div>

			<div class="col-12 offset-md-1 col-md-10">
				
				<table class="table table-bordered table-sm">
					<tr>
						<th>No.</th>
						<th>Question</th>
						<th>Category</th>
						<th>User</th>
					</tr>
					<?php
                    	// Fetch all the questions from the database and display them
                    	$sql = "SELECT questions.id, questions.question, questions.date, users.username, categories.name 
	                    	FROM questions, categories, users 
	                    	WHERE questions.category_id = categories.id
	                    	AND questions.user_id = users.id
	                    	ORDER BY questions.question DESC";

                    	$result = mysqli_query($con, $sql);
                    	if(!mysqli_error($con)){
                    		if(mysqli_num_rows($result) > 0){
                    			$counter = 0;

                    			while($row = mysqli_fetch_assoc($result)){
                    				++$counter;
                    	?>  
					<tr>
						<td><?php echo $counter; ?></td>
						<td>
							<a href="../answers.php?question=<?php echo $row[id]; ?>"><?php echo $row['question']; ?></a>
						</td>
						<td><?php echo $row['name']; ?></td>
						<td><?php echo $row['username']; ?></td>
					</tr>
					<?php
								}
							}else{
								echo "<tr><td colspan=4>No items in the table</td></tr>";
							}
						}
					?>
				</table>

				
			</div>
		
		</div>

	</section>

	<footer> &copy;2020 IT Support Online System. </footer>
</body>
</html>
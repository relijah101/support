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
	<title>All Categories - IT Support Online</title>
	<link rel="stylesheet" type="text/css" href="../resource/css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="../resource/css/styles.css">
	<script>history.pushState({}, "", "")</script>
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
			<div class="col-12 mb-3"><div class="text-center"><span class="title">Categories</span></div></div>

			<div class="col-12 offset-md-1 col-md-10 mb-3">
			<?php
			if(isset($_POST['save'])){

				$category = mysqli_real_escape_string($con, $_POST['category']);

				if(!empty($category)){

					$sql = "INSERT INTO categories (name) VALUES ('$category')";
					$result = mysqli_query($con, $sql);

					if(!mysqli_error($con)){
						echo "<div class='alert alert-success'><strong>Success:</strong> Category added successfully.</div>";
					}else{
						echo "<div class='alert alert-warning'><strong>Error:</strong> Failed to add category.</div>";
					}
				}
			}else if(isset($_GET['delete']) && !empty($_GET['id'])){

				$id = mysqli_real_escape_string($con, $_GET['id']);

				$sql = "DELETE FROM categories WHERE id = '$id'";
				$result = mysqli_query($con, $sql);

				if(!mysqli_error($con)){
					echo "<div class='alert alert-success'><strong>Success:</strong> Category deleted successfully.</div>";
				}else{
					echo "<div class='alert alert-warning'><strong>Error:</strong> Failed to delete category.</div>";
				}
		
			}

			?>
			</div>

			<div class="d-flex col-12 offset-md-1 col-md-10 mb-3">
				<form class="" method="post" action="categories.php" id="cat_form"></form>
				<input class="form-control form-control-sm mr-2" type="text" name="category" required placeholder="Type category name" form="cat_form">
				<button class="btn btn-sm btn-ghost" type="submit" name="save" form="cat_form">Save</button>
			</div>
			
			<div class="col-12 offset-md-1 col-md-10">
				
				<table class="table table-bordered table-sm">
					<tr>
						<th>No.</th>
						<th>Category Name</th>
						<th class="text-center">Action</th>
					</tr>
					<?php
                    	// Fetch all the categories from the database and display them
                    	$sql = "SELECT id, name FROM categories ORDER BY name DESC";

                    	$result = mysqli_query($con, $sql);
                    	if(!mysqli_error($con)){
                    		if(mysqli_num_rows($result) > 0){
                    			$counter = 0;

                    			while($row = mysqli_fetch_assoc($result)){
                    				++$counter;
                    	?>
					<tr>
						<td><?php echo $counter; ?></td>
						<td><?php echo $row['name']; ?></td>
						<td class="text-center">
							<a href="categories.php?delete=''&id=<?php echo $row['id']; ?>" class="badge badge-danger">Delete</a>
						</td>
					</tr>
					<?php
								}
							}else{
								echo "<tr><td colspan=3>No items in the table</td></tr>";
							}
						}echo mysqli_error($con);
					?>
				</table>

				
			</div>
		
		</div>

	</section>

	<footer> &copy;2020 IT Support Online System. </footer>
</body>
</html>
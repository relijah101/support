<!DOCTYPE html>
<html>
<head>
	<title>All Questions - IT Support Online</title>
	<link rel="stylesheet" type="text/css" href="../resource/css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="../resource/css/styles.css">
</head>
<body>
	<header class="border-bottom">
		<img src="../resource/image/logo.png" class="logo">

		<div class="nav">
			<a href="index.php">Home</a>
			<a href="dashboard.php">Dashboard</a>
			<a href="../logout.php">Logout</a>
		</div>
	</header>


	<section class="mt-4">			
		
		<div class="row">
			<div class="col-12 offset-md-1 col-md-10 mb-3 d-flex justify-content-between">
				<span class="title">My Questions</span>
				<a href="ask.php" class="btn btn-sm btn-ghost">Ask question</a>
			</div>

			<div class="col-12 offset-md-1 col-md-10">
				
				<table class="table table-bordered table-sm">
					<tr>
						<th>No.</th>
						<th>Question</th>
						<th>Category</th>
						<th class="text-center">Action</th>
					</tr>
					<tr>
						<td>1</td>
						<td>
							<a href="../answers.php">Question will be printed here.</a>
						</td>
						<td>C++</td>
						<td class="text-center">
							<a href="" class="badge badge-danger">Delete</a>
						</td>
					</tr>
				</table>

				
			</div>
		
		</div>

	</section>

	<footer> &copy;2020 IT Support Online System. </footer>
</body>
</html>
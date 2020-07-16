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
				<span class="title">Ask a question</span>
			</div>

			<div class="col-12 offset-md-1 col-md-10">
				
				<form class="">
					
					<div class="form-group row mb-2">
						<div class="col-12">
							<label>Question</label>
							<textarea class="form-control form-control-sm" required placeholder="Type question here" name="question"></textarea>
						</div>
					</div>

					<div class="form-group row mb-2">
						<div class="col-12">
							<label>Category</label>
							<select class="form-control form-control-sm" required name="question">
								<option>Java</option>
								<option>Java</option>
							</select>
						</div>
					</div>

					<div class="form-group row">
						<div class="col-12 text-center">
							<button type="submit"  class="btn btn-ghost">Post</button>
						</div>
					</div>

				</form>

			</div>
		
		</div>

	</section>

	<footer> &copy;2020 IT Support Online System. </footer>
</body>
</html>
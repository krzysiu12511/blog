<?php
session_start();
?>
<!doctype html>
<html>
	<head>
		<meta charset="UTF-8">
		<title>Spalanie</title>
		<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet">
		<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.bundle.min.js"></script>
		<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
		<link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@48,400,0,0" />
	</head>
	<body>
	<div class="container" style="padding-top:10px; width:300px;">
		<div class="card" style="padding:5px;">
			<form action="script.php" method="post" enctype="multipart/form-data">
				<div class="form-outline mb-4">
					<input type="text" name="Login" class="form-control" placeholder="Login" required/>
				</div>
				<div class="form-outline mb-4">
					<input type="password" name="Paswd" class="form-control" placeholder="Haslo" required/>
				</div>
				<button type="submit" name="kategoria" value = "Zaloguj" class="btn btn-primary btn-block mb-4">Zaloguj</button>
			</form>
		</div>
	</div>
	</body>
</html>

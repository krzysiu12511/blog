<?php
session_start();
?>
<!doctype html>
<html>
	<head>
		<meta charset="UTF-8">
		<title>Login</title>
		<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet">
		<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.bundle.min.js"></script>
		<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
		<link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@48,400,0,0" />
		<link rel="stylesheet" type="text/css" href="style.css">
	</head>
	<body>
	<div class="container login-container">
		<div class="card login-card">
			<form action="script.php" method="post" enctype="multipart/form-data">
				<div class="login-form-outline">
					<input type="text" name="Login" class="form-control  login-input" placeholder="Login" required/>
				</div>
				<div class="login-form-outline">
					<input type="password" name="Paswd" class="form-control  login-input" placeholder="Haslo" required/>
				</div>
				<button type="submit" name="kategoria" value = "Zaloguj" class="btn btn-primary login-button">Zaloguj</button>
			</form>
		</div>
	</div>
	</body>
</html>

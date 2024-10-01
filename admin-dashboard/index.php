<!DOCTYPE html>
<html lang="fr">
<head>
	<meta charset="UTF-8">
	<title>Connexion Administrateur</title>
	<style>
		body {
			font-family: Arial, sans-serif;
			background-color: #f4f4f4;
			height: 100vh;
			margin: 0;
			display: flex;
			justify-content: center;
			align-items: center;
		}

		.login-container {
			width: 300px;
			margin: auto;
			padding: 20px;
			background-color: #fff;
			box-shadow: 0px 0px 10px rgba(0,0,0,0.1);
			h2 { text-align: center; }

			form {
				display: flex;
				flex-direction: column;

				input {
					margin-bottom: 10px;
					padding: 10px;
					font-size: 16px;
				}
				button {
					padding: 10px;
					background-color: #007bff;
					color: #fff;
					border: none;
					cursor: pointer;
					&:hover { background-color: #0056b3; }
				}
			}
		}
	</style>
</head>
<body>
	<div class="login-container">
		<h2>Connexion Administrateur</h2>
		<form action="script/login.php" method="post">
			<input type="text" name="username" placeholder="Nom d'utilisateur" required>
			<input type="password" name="password" placeholder="Mot de passe" required>
			<button type="submit">Connexion</button>
		</form>
		<?php
		// Afficher le message d'erreur s'il est présent dans l'URL
		if (isset($_GET['error'])) {
			echo "<p style='color: red; text-align: center;'>" . htmlspecialchars($_GET['error']) . "</p>";
		}
		?>
	</div>
</body>
</html>

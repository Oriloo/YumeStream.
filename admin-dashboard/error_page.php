<?php
session_start();

if (!isset($_SESSION['admin_id'])) {
	// Rediriger vers la page de connexion si l'utilisateur n'est pas authentifié
	header('Location: index.php');
	exit;
}

// Code du tableau de bord de l'administrateur
?>

<?php
function formatErrorMessage($error) {
	// Remplace les + par des espaces
	$message = str_replace('+', ' ', $error);
	// Met la première lettre en majuscule
	$message = ucfirst($message);
	// Ajoute un ! à la fin
	$message .= ' !';
	return $message;
}

$error_message = "Une erreur inconnue s'est produite.";
if (isset($_GET['error'])) {
	$error = $_GET['error'];
	// Sécurise l'entrée en échappant les caractères spéciaux
	$error = htmlspecialchars($error, ENT_QUOTES, 'UTF-8');
	$error_message = formatErrorMessage($error);
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Page d'erreur</title>
	<style>
	body {
		font-family: Arial, sans-serif;
		background-color: #f8f9fa;
		display: flex;
		justify-content: center;
		align-items: center;
		height: 100vh;
		margin: 0;
	}

	.error-container {
		background-color: #fff;
		border: 1px solid #dee2e6;
		padding: 20px;
		box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
		text-align: center;
		max-width: 400px;
		width: 100%;
	}

	.error-container h1 {
		color: #dc3545;
		font-size: 24px;
		margin-bottom: 10px;
	}

	.error-container p {
		color: #333;
		font-size: 18px;
	}
	</style>
</head>
<body>
	<div class="error-container">
		<h1>Erreur</h1>
		<p><?php echo htmlspecialchars($error_message, ENT_QUOTES, 'UTF-8'); ?></p>
		<a href="admin_dashboard.php">> Dashboard</a>
	</div>
</body>
</html>

<?php
session_start();

if (!isset($_SESSION['admin_id'])) {
	// Rediriger vers la page de connexion si l'utilisateur n'est pas authentifié
	header('Location: index.php');
	exit;
}

$username = $_SESSION['username'];
$niveau = isset($_SESSION['niveau']) ? $_SESSION['niveau'] : 'NULL';

// Code du tableau de bord de l'administrateur
?>

<!DOCTYPE html>
<html lang="fr">
<head>
	<meta charset="UTF-8">
	<link rel="icon" href="dash.ico">
	<title>Tableau de Bord Administrateur</title>
	<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
	<link rel="stylesheet" href="style_dashboard.css">

	<!-- Bibliotheque InputListeDeroulante-1.0 -->
	<link rel="stylesheet" href="../bibliotheque/InputListeDeroulante-1.0/InputListeDeroulante.css">
	<script src="../bibliotheque/InputListeDeroulante-1.0/InputListeDeroulante.js"></script>
</head>
<body>
<div class="container-dashboard">
	<h1>Bienvenue, Administrateur !</h1>
	<table>
		<tr>
			<th>Nom d'utilisateur</th>
			<th>Niveau</th>
		</tr>
		<tr>
			<td><?php echo htmlspecialchars($username); ?></td>
			<td><?php echo htmlspecialchars($niveau); ?></td>
		</tr>
	</table>
	<p>Contenu réservé aux administrateurs.</p>
	<p><a href="script/logout.php">Déconnexion</a></p>
</div>

<?php
include('page/AM-groupe.html');
include('page/AM-anime.php');
?>

<script type="text/javascript" src="page/PAGE-script.js"></script>
</body>
</html>

<?php
session_start();

// Configuration de la base de données
$host = 'my_db';
$username = 'root';
$password = 'rootpassword';
$dbname = 'yumestream';

try {
	$pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
	$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
	die("Erreur de connexion : " . $e->getMessage());
}

// Traitement du formulaire de connexion
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
	$username = $_POST['username'];
	$password = $_POST['password'];

	// Préparation et exécution de la requête SQL sécurisée
	$stmt = $pdo->prepare('SELECT id, password, niveau FROM admins WHERE username = :username');
	$stmt->bindParam(':username', $username);
	$stmt->execute();
	$admin = $stmt->fetch(PDO::FETCH_ASSOC);

	if ($admin && password_verify($password, $admin['password'])) {
		// L'utilisateur est authentifié
		$_SESSION['admin_id'] = $admin['id'];
		$_SESSION['username'] = $username;
		$_SESSION['niveau'] = $admin['niveau'];
		header('Location: ../admin_dashboard.php');
		exit;
	} else {
		// Les informations d'identification sont incorrectes
		$errorMessage = "Nom d'utilisateur ou mot de passe incorrect";
		// Attendre 2 secondes avant de rediriger avec un message d'erreur
		sleep(2);
		header('Location: ../index.php?error=' . urlencode($errorMessage));
		exit;
	}
}
?>

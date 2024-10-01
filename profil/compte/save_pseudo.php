<?php
$CheminVariable = "../../connexion/variables_bdd.php";
$CheminRedirection = "Location: ../../connexion/index.php?erreur=006";
include('../../accueil/script_compte.php');

if (!$user_id) {
	// L'utilisateur n'est pas connecté
	header("Location: ../../connexion/index.php?erreur=007");
	exit();
}

include('../../connexion/variables_bdd.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
	// Vérifie si le champ pseudo existe dans la requête POST
	if (isset($_POST["pseudo"])) {
		// Récupère le pseudo depuis la requête POST
		$pseudo = $_POST["pseudo"];

		// Mettre à jour le pseudo dans la base de données
		$conn = new mysqli($BDDservername, $BDDusername, $BDDpassword, $BDDname);
		if ($conn->connect_error) {
			die("La connexion à la base de données a échoué: " . $conn->connect_error);
		}

		$sql = "UPDATE $UtilisateurBDD SET nom='$pseudo' WHERE utilisateur_id='$user_id'";

		if ($conn->query($sql) === TRUE) {
			echo "Pseudo mis à jour avec succès.";
			header("Location: ../compte/?succes");
			exit();
		} else {
			echo "Erreur lors de la mise à jour du pseudo: " . $conn->error;
            header("Location: ../compte/?erreur=009");
            exit();
		}

		$conn->close();
	}
}
?>

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
	// Vérifie si le champ adresse existe dans la requête POST
	if (isset($_POST["adresse"])) {
		// Récupère l'adresse depuis la requête POST
		$adresse = $_POST["adresse"];

		// Connexion à la base de données
		$conn = new mysqli($BDDservername, $BDDusername, $BDDpassword, $BDDname);
		if ($conn->connect_error) {
			die("La connexion à la base de données a échoué: " . $conn->connect_error);
		}

		// Vérifier si l'adresse existe déjà dans la base de données
		$sql_check = "SELECT utilisateur_id FROM $UtilisateurBDD WHERE adresse = '$adresse'";
		$result_check = $conn->query($sql_check);

		if ($result_check->num_rows > 0) {
			// L'adresse existe déjà dans la base de données
			echo "L'adresse est déjà utilisée par un autre utilisateur.";
			header("Location: ../compte/?erreur=011");
			exit();
		} else {
			// Mettre à jour l'adresse dans la base de données
			$sql_update = "UPDATE $UtilisateurBDD SET adresse='$adresse' WHERE utilisateur_id='$user_id'";
			if ($conn->query($sql_update) === TRUE) {
				echo "Adresse mise à jour avec succès.";
				header("Location: ../compte/?succes");
				exit();
			} else {
				echo "Erreur lors de la mise à jour de l'adresse: " . $conn->error;
				header("Location: ../compte/?erreur=012");
				exit();
			}
		}

		$conn->close();
	}
}
?>

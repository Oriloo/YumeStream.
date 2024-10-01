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
	// Vérifie si les champs mdp1, mdp2 et mdp3 existent dans la requête POST
	if (isset($_POST["mdp1"], $_POST["mdp2"], $_POST["mdp3"])) {
		// Récupère les mots de passe depuis la requête POST
		$mdp1 = $_POST["mdp1"];
		$mdp2 = $_POST["mdp2"];
		$mdp3 = $_POST["mdp3"];

		// Vérifie si les nouveaux mots de passe correspondent
		if ($mdp2 !== $mdp3) {
			echo "Les nouveaux mots de passe ne correspondent pas.";
            header("Location: ../compte/?erreur=014");
			exit();
		}

		// Mettre à jour le mot de passe dans la base de données
		$conn = new mysqli($BDDservername, $BDDusername, $BDDpassword, $BDDname);
		if ($conn->connect_error) {
		    die("La connexion à la base de données a échoué: " . $conn->connect_error);
		}

		// Vérifie si le mot de passe actuel est correct avant de le mettre à jour
		$sql_select = "SELECT mdp FROM $UtilisateurBDD WHERE utilisateur_id='$user_id'";
		$result = $conn->query($sql_select);
		if ($result->num_rows > 0) {
		    $row = $result->fetch_assoc();
		    if (password_verify($mdp1, $row["mdp"])) {
		        // Le mot de passe actuel est correct, on peut mettre à jour le mot de passe
		        // Utilise $mdp2 pour générer le hash du nouveau mot de passe
		        $hashed_mdp = password_hash($mdp2, PASSWORD_DEFAULT);
		        $sql_update = "UPDATE $UtilisateurBDD SET mdp='$hashed_mdp' WHERE utilisateur_id='$user_id'";
		        if ($conn->query($sql_update) === TRUE) {
		            echo "Mot de passe mis à jour avec succès.";
		            header("Location: ../compte/?succes");
		            exit();
		        } else {
		            echo "Erreur lors de la mise à jour du mot de passe: " . $conn->error;
		            header("Location: ../compte/?erreur=013");
		            exit();
		        }
		    } else {
		        echo "Mot de passe actuel incorrect.";
		        header("Location: ../compte/?erreur=015");
		        exit();
		    }
		} else {
		    echo "Utilisateur non trouvé.";
		    header("Location: ../compte/?erreur=016");
		    exit();
		}

		$conn->close();
	}
}
?>

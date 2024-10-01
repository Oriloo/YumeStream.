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
    // Vérifie si les champs mdp4 et mail existent dans la requête POST
    if (isset($_POST["mdp4"], $_POST["mail"])) {
        // Récupère le mot de passe et l'adresse e-mail depuis la requête POST
        $mdp4 = $_POST["mdp4"];
        $mail = $_POST["mail"];

        // Vérification si l'email est une adresse email valide
        if (!filter_var($mail, FILTER_VALIDATE_EMAIL)) {
            // L'email n'est pas valide
            header("Location: ../compte/?erreur=019");
            exit();
        }

        // Mettre à jour l'adresse e-mail dans la base de données
        $conn = new mysqli($BDDservername, $BDDusername, $BDDpassword, $BDDname);
        if ($conn->connect_error) {
            die("La connexion à la base de données a échoué: " . $conn->connect_error);
        }

        // Vérifie si le mot de passe actuel est correct avant de mettre à jour l'adresse e-mail
        $sql_select = "SELECT mdp FROM $UtilisateurBDD WHERE utilisateur_id='$user_id'";
        $result = $conn->query($sql_select);
        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            if (password_verify($mdp4, $row["mdp"])) {
                // Le mot de passe actuel est correct, on peut mettre à jour l'adresse e-mail
                $sql_update = "UPDATE $UtilisateurBDD SET email='$mail' WHERE utilisateur_id='$user_id'";
                if ($conn->query($sql_update) === TRUE) {
                    echo "Adresse e-mail mise à jour avec succès.";
                    header("Location: ../compte/?succes");
                    exit();
                } else {
                    echo "Erreur lors de la mise à jour de l'adresse e-mail: " . $conn->error;
                    header("Location: ../compte/?erreur=017");
                    exit();
                }
            } else {
                echo "Mot de passe incorrect.";
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

<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Vérifier si l'ID de l'utilisateur est envoyé dans la requête POST
    if (!isset($_POST['user_id'])) {
        header("Location: ../compte/?erreur=007");
        exit();
    }

    // Récupérer l'ID de l'utilisateur depuis la requête POST
    $user_id = $_POST['user_id'];

    // Vérifier si le mot de passe est envoyé dans la requête POST
    if (!isset($_POST['mdp5'])) {
        header("Location: ../compte/?erreur=022");
        exit();
    }

    // Récupérer le mot de passe envoyé dans la requête POST
    $mdp_post = $_POST['mdp5'];

    // Hasher le mot de passe
    $hashed_mdp = password_hash($mdp_post, PASSWORD_DEFAULT);

    include('../../connexion/variables_bdd.php');
    // Supprimer le compte de l'utilisateur de la base de données
    $conn = new mysqli($BDDservername, $BDDusername, $BDDpassword, $BDDname);
    if ($conn->connect_error) {
        die("La connexion à la base de données a échoué: " . $conn->connect_error);
    }
    
    // Vérifier le mot de passe de l'utilisateur
    $sql_select = "SELECT mdp FROM $UtilisateurBDD WHERE utilisateur_id='$user_id'";
    $result = $conn->query($sql_select);
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $mdp_db = $row['mdp'];
        if (!password_verify($mdp_post, $mdp_db)) {
            // Mot de passe incorrect, redirection avec un message d'erreur
            header("Location: ../compte/?erreur=021");
            exit();
        }
    } else {
        // Utilisateur non trouvé, redirection avec un message d'erreur
        header("Location: ../compte/?erreur=020");
        exit();
    }

    // Début de la transaction
    $conn->begin_transaction();

    try {
        // Supprimer les données associées à l'utilisateur dans toutes les tables nécessaires
        $tables = array($CritiqueBDD, $ListeBDD, $RegardeBDD, $ReponseBDD, $SessionBDD, $UtilisateurBDD);
        foreach ($tables as $table) {
            $sql_delete = "DELETE FROM $table WHERE utilisateur_id='$user_id'";
            if ($conn->query($sql_delete) !== TRUE) {
                throw new Exception("Erreur lors de la suppression des données de la table $table: " . $conn->error);
            }
        }

        // Valider la transaction
        $conn->commit();
        echo "Compte utilisateur supprimé avec succès.";
        // Supprimer le cookie en définissant une expiration passée
        setcookie("user_id", "", time() - 3600, "/");
        header("Location: ../../connexion/?succes");
        exit();
    } catch (Exception $e) {
        // En cas d'erreur, annuler la transaction
        $conn->rollback();
        echo "Erreur lors de la suppression du compte utilisateur: " . $e->getMessage();
        header("Location: ../compte/?erreur=018");
        exit();
    }

    // Fermer la connexion à la base de données
    $conn->close();
}
?>

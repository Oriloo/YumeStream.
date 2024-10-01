<?php
// Création de la connexion
include("../script/variables_bdd.php");

// Création de la connexion
$conn = new mysqli($BDDservername, $BDDusername, $BDDpassword, $BDDname);

// Vérification de la connexion
if ($conn->connect_error) {
    die("Connexion échouée: " . $conn->connect_error);
}

// Récupération des données du formulaire
$email = $_POST['login'];
$mdp1 = $_POST['mdp2'];
$mdp2 = $_POST['mdp3'];

// Vérification si l'email est une adresse email valide
if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    // L'email n'est pas valide
    header("Location: ../connexion/?erreur=002");
    exit();
}

// Vérification si l'adresse email existe déjà dans la base de données
$sql_check_email = "SELECT email FROM utilisateurs WHERE email = '$email'";
$result_check_email = $conn->query($sql_check_email);

if ($result_check_email->num_rows > 0) {
    // L'adresse email existe déjà dans la base de données
    header("Location: ../connexion/?erreur=010");
    exit();
}

if ($mdp1 == $mdp2) {
    // Génération d'un code aléatoire unique de 10 caractères
    $adresse_unique = generateRandomString(10);

    // Vérification si l'utilisateur existe déjà avec le même code
    $sql_check_unique = "SELECT adresse FROM $UtilisateurBDD WHERE adresse = '$adresse_unique'";
    $result_check_unique = $conn->query($sql_check_unique);

    // Si l'adresse est déjà utilisée, régénérer un nouveau code
    while ($result_check_unique->num_rows > 0) {
        $adresse_unique = generateRandomString(10);
        $sql_check_unique = "SELECT adresse FROM $UtilisateurBDD WHERE adresse = '$adresse_unique'";
        $result_check_unique = $conn->query($sql_check_unique);
    }

    // Récupération du nom d'utilisateur à partir de l'adresse e-mail
    $email_parts = explode('@', $email);
    $nom_utilisateur = $email_parts[0];

    // Hashage du mot de passe
    $mdp_hash = password_hash($mdp1, PASSWORD_DEFAULT);

    // Insertion de l'utilisateur dans la base de données
    $sql_insert_user = "INSERT INTO $UtilisateurBDD (email, nom, mdp, adresse) VALUES ('$email', '$nom_utilisateur', '$mdp_hash', '$adresse_unique')";
    if ($conn->query($sql_insert_user) === TRUE) {
        // Redirection vers une page de succès
        header("Location: ../connexion/?succes");
        exit();
    } else {
        // Erreur lors de l'insertion dans la base de données
        header("Location: ../connexion/?erreur=004");
        exit();
    }
} else {
    // Les mots de passe ne sont pas identiques
    header("Location: ../connexion/?erreur=003");
    exit();
}

$conn->close();

// Fonction pour générer une chaîne aléatoire
function generateRandomString($length = 10) {
    $characters = '0123456789abcdefghijklmnopqrstuvwxyz';
    $charactersLength = strlen($characters);
    $randomString = '';
    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[rand(0, $charactersLength - 1)];
    }
    return $randomString;
}
?>

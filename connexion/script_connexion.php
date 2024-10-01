<?php
// Inclusion des variables de connexion
include("../script/variables_bdd.php");

// Création de la connexion
$conn = new mysqli($BDDservername, $BDDusername, $BDDpassword, $BDDname);

// Vérification de la connexion
if ($conn->connect_error) {
    die("Connexion échouée: " . $conn->connect_error);
}

// Récupération des données du formulaire
$email = $_POST['login'];
$mdp = $_POST['mdp1'];
$souvenir = isset($_POST['souvenir']) ? $_POST['souvenir'] : 'false';

// Requête SQL pour récupérer le mot de passe haché
$sql = "SELECT utilisateur_id, mdp FROM utilisateurs WHERE email = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $email);
$stmt->execute();
$stmt->store_result();

if ($stmt->num_rows > 0) {
    // L'utilisateur existe dans la base de données
    $stmt->bind_result($user_id, $mdp_hache);
    $stmt->fetch();
    if (password_verify($mdp, $mdp_hache)) {
        // Le mot de passe correspond
        // Définition de la durée de vie du cookie en fonction de $souvenir
        $cookie_duration = ($souvenir == 'true') ? (time() + 86400 * 30) : 0;

        // Stocker l'ID de l'utilisateur dans un cookie
        setcookie("user_id", $user_id, $cookie_duration, "/");

        // Rediriger vers la page d'accueil
        header("Location: ../");
        exit();
    } else {
        // Le mot de passe ne correspond pas
        sleep(2); // Ajout du délai de 3 secondes
        header("Location: ../connexion/?erreur=001");
        exit();
    }
} else {
    // L'utilisateur n'existe pas dans la base de données
    sleep(2); // Ajout du délai de 3 secondes
    header("Location: ../connexion/?erreur=001");
    exit();
}

$stmt->close();
$conn->close();
?>

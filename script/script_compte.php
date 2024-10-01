<?php
// Récupérer l'ID de l'utilisateur à partir du cookie
if(isset($_COOKIE['user_id'])) {
    $user_id = $_COOKIE['user_id'];

    // Création de la connexion
    $conn = new mysqli($BDDservername, $BDDusername, $BDDpassword, $BDDname);

    // Vérification de la connexion
    if ($conn->connect_error) {
        die("Connexion échouée: " . $conn->connect_error);
    }

    // Requête SQL pour récupérer les informations de l'utilisateur
    $sql = "SELECT nom, pp, email, adresse FROM utilisateurs WHERE utilisateur_id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $user_id);
    $stmt->execute();
    $stmt->store_result();

    if ($stmt->num_rows > 0) {
        // L'utilisateur existe dans la base de données
        $stmt->bind_result($user_name, $user_pp, $user_mail, $user_adresse);
        $stmt->fetch();
    } else {
        // L'utilisateur n'existe pas dans la base de données
        header($CheminRedirection);
        exit();
    }

    $stmt->close();
    $conn->close();
} else {
    $user_id = 0;
    $user_name = "";
    $user_pp = "";
    $user_mail = "";
    $user_adresse = "";
}
?>

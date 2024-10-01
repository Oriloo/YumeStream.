<?php
$servername = "my_db";
$username = "root";
$password = "rootpassword";
$dbname = "yumestream";

// Créer la connexion
$conn = new mysqli($servername, $username, $password, $dbname);

// Vérifier la connexion
if ($conn->connect_error) {
    // Redirection vers une page d'erreur ou afficher un message
    header("Location: ../error_page.php?error=erreur+de+connexion");
    exit();
}

// Fonction pour vérifier et retourner une valeur vide si le champ est vide
function check_input($input) {
    return isset($input) && !empty($input) ? $input : '';
}

// Récupérer les données du formulaire
$action = check_input($_POST['ajou-modif-select-2']);
$id_anime = isset($_POST['id-anime-select-2']) ? $_POST['id-anime-select-2'] : null;
$t_original = check_input($_POST['nom-anime1-2']);
$t_latiniser = check_input($_POST['nom-anime2-2']);
$t_anglais = check_input($_POST['nom-anime3-2']);
$t_francais = check_input($_POST['nom-anime4-2']);
$saisons = check_input($_POST['saisons-anime-2']);
$episodes = check_input($_POST['episodes-anime-2']);
$duree = check_input($_POST['duree-anime-2']);
$type = check_input($_POST['type-anime-2']);
$status = check_input($_POST['status-anime-2']);
$start_date = check_input($_POST['start_date-anime-2']);
$end_date = check_input($_POST['end_date-anime-2']);
$studios = check_input($_POST['studios-anime-2']);
$synopsis = check_input($_POST['synopsis-anime-2']);
$groupe_id = explode("#", check_input($_POST['anime-groupe-2']))[1];
$genre = implode("&", array_map(function($g) { return explode("#", $g)[1]; }, explode(", ", check_input($_POST['genre-anime-2']))));
$theme = implode("&", array_map(function($t) { return explode("#", $t)[1]; }, explode(", ", check_input($_POST['theme-anime-2']))));
$lien_image = check_input($_POST['lien-anime-2']);

// Préparer la requête en fonction de l'action
if ($action == "ajouter") {
    $sql = "INSERT INTO animes (groupe_id, t_original, t_latiniser, t_anglais, t_francais, lien_image, type, status, studios, saisons, episodes, duree, start_date, end_date, genre, theme, synopsis) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
} elseif ($action == "modifier" && $id_anime) {
    $sql = "UPDATE animes SET groupe_id=?, t_original=?, t_latiniser=?, t_anglais=?, t_francais=?, lien_image=?, type=?, status=?, studios=?, saisons=?, episodes=?, duree=?, start_date=?, end_date=?, genre=?, theme=?, synopsis=? WHERE anime_id=?";
} else {
    // Redirection vers une page d'erreur ou afficher un message
    header("Location: ../error_page.php?error=action+non+reconnue+ou+identifiant+manquant");
    exit();
}

// Préparer la requête
$stmt = $conn->prepare($sql);

// Vérifier la préparation de la requête
if ($stmt === false) {
    echo "Erreur de préparation de la requête : " . $conn->error;
    exit();
}

// Lier les paramètres
if ($action == "ajouter") {
    $stmt->bind_param("issssssssiiisssss", $groupe_id, $t_original, $t_latiniser, $t_anglais, $t_francais, $lien_image, $type, $status, $studios, $saisons, $episodes, $duree, $start_date, $end_date, $genre, $theme, $synopsis);
} elseif ($action == "modifier" && $id_anime) {
    $stmt->bind_param("issssssssiiisssssi", $groupe_id, $t_original, $t_latiniser, $t_anglais, $t_francais, $lien_image, $type, $status, $studios, $saisons, $episodes, $duree, $start_date, $end_date, $genre, $theme, $synopsis, $id_anime);
}

// Exécuter la requête
if ($stmt->execute() === TRUE) {
    // Redirection vers le tableau de bord après succès
    header("Location: ../admin_dashboard.php");
    exit();
} else {
    // Redirection vers une page d'erreur ou afficher un message
    echo "Erreur: " . $stmt->error;
}

// Fermer la déclaration et la connexion
$stmt->close();
$conn->close();
?>

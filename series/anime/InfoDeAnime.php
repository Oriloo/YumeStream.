<?php
// Créer une connexion
$conn = new mysqli($BDDservername, $BDDusername, $BDDpassword, $BDDname);

// Vérifier la connexion
if ($conn->connect_error) {
    die("Connexion échouée: " . $conn->connect_error);
}

// Récupérer l'ID de l'anime depuis l'URL
$anime_id = isset($_GET['id']) ? intval($_GET['id']) : 0;

if ($anime_id > 0) {
    // Préparer et exécuter la requête pour récupérer les informations de l'anime
    $sql_anime = "SELECT * FROM animes WHERE anime_id = ?";
    $stmt_anime = $conn->prepare($sql_anime);
    if ($stmt_anime === false) {
        die("Erreur de préparation de la requête: " . $conn->error);
    }
    $stmt_anime->bind_param("i", $anime_id);
    $stmt_anime->execute();
    $result_anime = $stmt_anime->get_result();
    
    $anime = [];
    if ($result_anime->num_rows > 0) {
        // Stocker les informations de l'anime dans un tableau associatif
        $anime = $result_anime->fetch_assoc();
        $groupe_id = $anime['groupe_id'];

        // Préparer et exécuter la requête pour récupérer les informations du groupe associé
        $sql_groupe = "SELECT * FROM groupes WHERE groupe_id = ?";
        $stmt_groupe = $conn->prepare($sql_groupe);
        if ($stmt_groupe === false) {
            die("Erreur de préparation de la requête: " . $conn->error);
        }
        $stmt_groupe->bind_param("i", $groupe_id);
        $stmt_groupe->execute();
        $result_groupe = $stmt_groupe->get_result();
        
        $groupe = [];
        if ($result_groupe->num_rows > 0) {
            // Stocker les informations du groupe dans un tableau associatif
            $groupe = $result_groupe->fetch_assoc();
        }

        // Récupérer et traiter les genres et thèmes
        $genre_ids = explode('&', $anime['genre']);
        $theme_ids = explode('&', $anime['theme']);
        $genres = [];
        $themes = [];

        // Préparer la requête pour récupérer les genres et thèmes
        if (count($genre_ids) > 0) {
            $placeholders = implode(',', array_fill(0, count($genre_ids), '?'));
            $types = str_repeat('i', count($genre_ids));
            $sql_genres = "SELECT `g-t-id`, `g-t-nom`, `g-t-lien` FROM `genres-themes` WHERE `g-t-id` IN ($placeholders) AND `g-ou-t` = 'genre'";
            $stmt_genres = $conn->prepare($sql_genres);
            if ($stmt_genres === false) {
                die("Erreur de préparation de la requête: " . $conn->error);
            }
            $stmt_genres->bind_param($types, ...$genre_ids);
            $stmt_genres->execute();
            $result_genres = $stmt_genres->get_result();

            while ($row = $result_genres->fetch_assoc()) {
                $genres[] = [
                    'nom' => $row['g-t-nom'],
                    'lien' => $row['g-t-lien']
                ];
            }
            $stmt_genres->close();
        }

        if (count($theme_ids) > 0) {
            $placeholders = implode(',', array_fill(0, count($theme_ids), '?'));
            $types = str_repeat('i', count($theme_ids));
            $sql_themes = "SELECT `g-t-id`, `g-t-nom`, `g-t-lien` FROM `genres-themes` WHERE `g-t-id` IN ($placeholders) AND `g-ou-t` = 'theme'";
            $stmt_themes = $conn->prepare($sql_themes);
            if ($stmt_themes === false) {
                die("Erreur de préparation de la requête: " . $conn->error);
            }
            $stmt_themes->bind_param($types, ...$theme_ids);
            $stmt_themes->execute();
            $result_themes = $stmt_themes->get_result();

            while ($row = $result_themes->fetch_assoc()) {
                $themes[] = [
                    'nom' => $row['g-t-nom'],
                    'lien' => $row['g-t-lien']
                ];
            }
            $stmt_themes->close();
        }

        // Fermer les déclarations
        $stmt_groupe->close();
    } else {
        echo "Anime non trouvé.";
    }

    // Fermer les déclarations
    $stmt_anime->close();
} else {
    echo "ID d'anime non valide.";
}

// Fermer la connexion
$conn->close();
?>

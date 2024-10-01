<?php
// Créer une connexion
$conn = new mysqli($BDDservername, $BDDusername, $BDDpassword, $BDDname);

// Vérifier la connexion
if ($conn->connect_error) {
    die("Connexion échouée: " . $conn->connect_error);
}

// Récupérer l'ID du groupe depuis l'URL
$groupe_id = isset($_GET['id']) ? intval($_GET['id']) : 0;

if ($groupe_id > 0) {
    // Préparer et exécuter la requête pour récupérer les informations du groupe
    $sql_groupe = "SELECT groupe_id, nom_groupe, lien_logo, lien_image, synopsis_groupe FROM groupes WHERE groupe_id = ?";
    $stmt_groupe = $conn->prepare($sql_groupe);
    $stmt_groupe->bind_param("i", $groupe_id);
    $stmt_groupe->execute();
    $result_groupe = $stmt_groupe->get_result();
    
    $groupe = [];
    if ($result_groupe->num_rows > 0) {
        // Stocker les informations du groupe dans un tableau associatif
        $groupe = $result_groupe->fetch_assoc();
    }

    // Préparer et exécuter la requête pour récupérer les animes associés au groupe
    $sql_animes = "SELECT anime_id, groupe_id, t_original, t_latiniser, t_anglais, t_francais, lien_image, type, status, studios, saisons, episodes, duree, start_date, end_date, genre, theme, synopsis FROM animes WHERE groupe_id = ?";
    $stmt_animes = $conn->prepare($sql_animes);
    $stmt_animes->bind_param("i", $groupe_id);
    $stmt_animes->execute();
    $result_animes = $stmt_animes->get_result();
    
    $animes = [];
    if ($result_animes->num_rows > 0) {
        // Stocker les informations de chaque anime dans un tableau
        while ($row = $result_animes->fetch_assoc()) {
            $animes[] = $row;
        }
        
        // Trier les animes par ordre chronologique de start_date
        usort($animes, function($a, $b) {
            if ($a['start_date'] == '0000-00-00') return 1;
            if ($b['start_date'] == '0000-00-00') return -1;
            $dateA = strtotime($a['start_date']);
            $dateB = strtotime($b['start_date']);
            return $dateA - $dateB;
        });
    }

    // Fermer les déclarations
    $stmt_groupe->close();
    $stmt_animes->close();
} else {
    echo "ID de groupe non valide.";
}

// Fermer la connexion
$conn->close();

// Filtrer les animes par catégorie
$series_animes = array_filter($animes, fn($anime) => $anime['type'] === 'tv' || $anime['type'] === 'ona');
$film_animes = array_filter($animes, fn($anime) => $anime['type'] === 'film');
$other_animes = array_filter($animes, fn($anime) => $anime['type'] != 'tv' && $anime['type'] != 'ona' && $anime['type'] != 'film');

// Trier les séries par saisons, en plaçant ceux avec saisons égale à 0 à la fin
usort($series_animes, function($a, $b) {
    if ($a['saisons'] == 0) return 1;
    if ($b['saisons'] == 0) return -1;
    return $a['saisons'] - $b['saisons'];
});
?>

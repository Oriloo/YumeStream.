<?php
function LangueAnimeID($langue) {
    global $BDDservername, $BDDusername, $BDDpassword, $BDDname;

    // Si $langue est vide, retourner un tableau vide
    if (empty($langue)) {
        return [];
    }

    // Création de la connexion
    $conn = new mysqli($BDDservername, $BDDusername, $BDDpassword, $BDDname);

    // Vérification de la connexion
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Déterminer la valeur de vf_episode en fonction de $langue
    $vf_episode = ($langue === 'vf') ? 1 : 0;

    // Construire la requête SQL
    $sql = "SELECT DISTINCT animes.anime_id 
            FROM animes 
            INNER JOIN episodes ON animes.anime_id = episodes.anime_id 
            WHERE episodes.vf_episode = ?";

    // Préparer et exécuter la requête
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $vf_episode);
    $stmt->execute();
    $result = $stmt->get_result();

    // Récupérer les résultats
    $LangueAnimeID = [];
    if ($result && $result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $LangueAnimeID[] = $row['anime_id'];
        }
    }

    // Fermer la connexion
    $stmt->close();
    $conn->close();

    return $LangueAnimeID;
}
?>

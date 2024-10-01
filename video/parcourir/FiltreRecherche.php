<?php
function RechercheAnimeID($motsClesRecherche) {
    global $BDDservername, $BDDusername, $BDDpassword, $BDDname;

    // Si $motsClesRecherche est vide, retourner un tableau vide
    if (empty($motsClesRecherche)) {
        return [];
    }

    // Création de la connexion
    $conn = new mysqli($BDDservername, $BDDusername, $BDDpassword, $BDDname);

    // Vérification de la connexion
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Construire la clause SQL pour la pertinence
    $sql = "SELECT a.anime_id, a.groupe_id, a.t_original, a.t_latiniser, a.t_anglais, a.t_francais, a.synopsis, g.nom_groupe, g.synopsis_groupe, 
            (";

    $relevance = [];
    foreach ($motsClesRecherche as $mot) {
        $mot = $conn->real_escape_string($mot);
        $relevance[] = "IF(a.t_original LIKE '%$mot%', 1, 0) + IF(a.t_latiniser LIKE '%$mot%', 1, 0) + IF(a.t_anglais LIKE '%$mot%', 1, 0) + IF(a.t_francais LIKE '%$mot%', 1, 0) + IF(a.synopsis LIKE '%$mot%', 1, 0) + IF(g.nom_groupe LIKE '%$mot%', 1, 0) + IF(g.synopsis_groupe LIKE '%$mot%', 1, 0)";
    }
    $sql .= implode(' + ', $relevance);
    $sql .= ") AS relevance
            FROM animes a 
            JOIN groupes g ON a.groupe_id = g.groupe_id
            WHERE ";

    // Construire les conditions de recherche
    $conditions = [];
    foreach ($motsClesRecherche as $mot) {
        $mot = $conn->real_escape_string($mot);
        $conditions[] = "(a.t_original LIKE '%$mot%' OR a.t_latiniser LIKE '%$mot%' OR a.t_anglais LIKE '%$mot%' OR 
                          a.t_francais LIKE '%$mot%' OR a.synopsis LIKE '%$mot%' OR g.nom_groupe LIKE '%$mot%' OR 
                          g.synopsis_groupe LIKE '%$mot%')";
    }

    $sql .= implode(' OR ', $conditions);
    $sql .= " ORDER BY relevance DESC"; // Trier par pertinence

    $result = $conn->query($sql);

    $RechercheAnimeID = [];

    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $RechercheAnimeID[] = $row['anime_id'];
        }
    }

    $conn->close();

    return $RechercheAnimeID;
}
?>

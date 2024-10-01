<?php
function TypeStatusAnimeID($type, $status) {
    global $BDDservername, $BDDusername, $BDDpassword, $BDDname;

    // Si $type et $status sont vide, retourner un tableau vide
    if (empty($type) && empty($status)) {
        return [];
    }

    // Création de la connexion
    $conn = new mysqli($BDDservername, $BDDusername, $BDDpassword, $BDDname);

    // Vérification de la connexion
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Préparer la requête SQL dynamiquement
    $sql = "SELECT anime_id FROM animes WHERE 1=1";
    $params = [];
    $types = "";

    if (!empty($type)) {
        $sql .= " AND type = ?";
        $params[] = $type;
        $types .= "s";
    }

    if (!empty($status)) {
        $sql .= " AND status = ?";
        $params[] = $status;
        $types .= "s";
    }

    // Préparer et exécuter la requête
    $stmt = $conn->prepare($sql);
    
    if (!empty($params)) {
        $stmt->bind_param($types, ...$params);
    }

    $stmt->execute();
    $result = $stmt->get_result();

    $TypeStatusAnimeID = [];

    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $TypeStatusAnimeID[] = $row['anime_id'];
        }
    }

    // Fermer la connexion
    $stmt->close();
    $conn->close();

    return $TypeStatusAnimeID;
}
?>

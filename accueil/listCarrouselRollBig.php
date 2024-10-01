<?php
try {
    $pdo = new PDO("mysql:host=$BDDservername;dbname=$BDDname", $BDDusername, $BDDpassword);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Erreur de connexion : " . $e->getMessage());
}

// Requête SQL pour sélectionner 6 groupes aléatoires
$query = "
    SELECT groupe_id, lien_logo, lien_image, synopsis_groupe
    FROM groupes
    ORDER BY RAND()
    LIMIT 6
";
$stmt = $pdo->prepare($query);
$stmt->execute();
$groupes = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

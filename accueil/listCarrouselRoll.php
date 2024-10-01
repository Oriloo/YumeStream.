<?php
include('../script/variables_bdd.php');

try {
    $pdo = new PDO("mysql:host=$BDDservername;dbname=$BDDname", $BDDusername, $BDDpassword);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Erreur de connexion : " . $e->getMessage());
}

$animes = [];

if (isset($_GET['index'])) {
    $index = (int) $_GET['index'];

    // Requête SQL pour sélectionner 18 animes aléatoires
    $query = "
        SELECT anime_id, t_original, t_latiniser, t_anglais, t_francais, lien_image
        FROM animes
        ORDER BY RAND()
        LIMIT 18
    ";
    $stmt = $pdo->prepare($query);
    $stmt->execute();
    $results = $stmt->fetchAll(PDO::FETCH_ASSOC);

    // Traitement des résultats pour prioriser les titres
    $animesTemp = [];
    foreach ($results as $anime) {
        $title = !empty($anime['t_francais']) ? $anime['t_francais'] : (!empty($anime['t_anglais']) ? $anime['t_anglais'] : (!empty($anime['t_latiniser']) ? $anime['t_latiniser'] : $anime['t_original']));
        $animesTemp[] = ["id" => $anime['anime_id'], "image" => $anime['lien_image'], "title" => $title];
    }

    foreach ($animesTemp as $anime): ?>
        <div class="carousel-card">
            <a href="series/anime/?id=<?php echo $anime['id']; ?>">
                <div class="carousel-card-top">
                    <img src="<?php echo $anime['image']; ?>">
                </div>
                <div class="carousel-card-bottom">
                    <h4><?php echo $anime['title']; ?></h4>
                </div>
            </a>
        </div>
    <?php endforeach;
} else {
    for ($i = 0; $i < $NombreSelection; $i++) {
        // Requête SQL pour sélectionner 18 animes aléatoires
        $query = "
            SELECT t_original, t_latiniser, t_anglais, t_francais, lien_image
            FROM animes
            ORDER BY RAND()
            LIMIT 18
        ";
        $stmt = $pdo->prepare($query);
        $stmt->execute();
        $results = $stmt->fetchAll(PDO::FETCH_ASSOC);

        // Traitement des résultats pour prioriser les titres
        $animesTemp = [];
        foreach ($results as $anime) {
            if (!empty($anime['t_francais'])) {
                $title = $anime['t_francais'];
            } elseif (!empty($anime['t_anglais'])) {
                $title = $anime['t_anglais'];
            } elseif (!empty($anime['t_latiniser'])) {
                $title = $anime['t_latiniser'];
            } else {
                $title = $anime['t_original'];
            }
            $animesTemp[] = ["image" => $anime['lien_image'], "title" => $title];
        }

        $animes["animes$i"] = $animesTemp;
    }
}
?>

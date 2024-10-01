<?php
$RechercheAnimeID = RechercheAnimeID($motsClesRecherche);
$TypeStatusAnimeID = TypeStatusAnimeID($type, $status);
$GenreThemeAnimeID = GenreThemeAnimeID($selectedGenres, $selectedThemes);
$LangueAnimeID = LangueAnimeID($langue);

// Initialize an array to store non-empty arrays
$nonEmptyArrays = [];

// Check if arrays are non-empty and add them to the list
if (!empty($RechercheAnimeID)) {
    $nonEmptyArrays[] = $RechercheAnimeID;
}
if (!empty($TypeStatusAnimeID)) {
    $nonEmptyArrays[] = $TypeStatusAnimeID;
}
if (!empty($GenreThemeAnimeID)) {
    $nonEmptyArrays[] = $GenreThemeAnimeID;
}
if (!empty($LangueAnimeID)) {
    $nonEmptyArrays[] = $LangueAnimeID;
}

// Find intersection of all non-empty arrays
if (count($nonEmptyArrays) > 0) {
    $idAnimeSelected = call_user_func_array('array_intersect', $nonEmptyArrays);
} else {
    $idAnimeSelected = [];
}

// Création de la connexion
$conn = new mysqli($BDDservername, $BDDusername, $BDDpassword, $BDDname);

// Vérification de la connexion
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if (!empty($idAnimeSelected)) {
    $idAnimeSelectedStr = implode(',', $idAnimeSelected);

    // Requête SQL pour récupérer les informations des animes sélectionnés
    $sql = "SELECT * FROM animes WHERE anime_id IN ($idAnimeSelectedStr)";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        echo "<div class='anime-results'>";
        while($AnimeSelected = $result->fetch_assoc()) {
            $TitreAnime = !empty($AnimeSelected['t_francais']) ? $AnimeSelected['t_francais'] : (!empty($AnimeSelected['t_anglais']) ? $AnimeSelected['t_anglais'] : (!empty($AnimeSelected['t_latiniser']) ? $AnimeSelected['t_latiniser'] : $AnimeSelected['t_original']));

            echo "
            <div class='anime-item'>
                <div class='in-anime-item'>
                <img src='" . $AnimeSelected['lien_image'] . "' alt='" . $AnimeSelected['t_original'] . "'>
                <a href='../../series/anime/?id=" . $AnimeSelected['anime_id'] . "'>" . $TitreAnime . "</a>
                </div>
            </div>
            ";
        }
        echo "</div>";
    } else {
        echo "Aucun anime trouvé.";
    }
} else {
    echo '<p>Aucun résultat trouvé</p>';
}

$conn->close();
?>

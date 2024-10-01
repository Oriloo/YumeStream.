<?php
function GenreThemeAnimeID($selectedGenres, $selectedThemes) {
    global $BDDservername, $BDDusername, $BDDpassword, $BDDname;

    // Si $selectedGenres et $selectedThemes sont vide, retourner un tableau vide
    if (empty($selectedGenres) && empty($selectedThemes)) {
        return [];
    }

    // Création de la connexion
    $conn = new mysqli($BDDservername, $BDDusername, $BDDpassword, $BDDname);

    // Vérification de la connexion
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    /**
     * Génère une condition SQL pour les genres ou thèmes sélectionnés.
     * @param array $params
     * @param mysqli $conn
     * @return string
     */
    function generateCondition($params, $conn) {
        $conditions = array_map(function($value) use ($conn) {
            return "`g-t-lien` = '" . $conn->real_escape_string($value) . "'";
        }, $params);
        return implode(' OR ', $conditions);
    }

    /**
     * Récupère les genres et thèmes en fonction des sélections.
     * @param array $selectedGenres
     * @param array $selectedThemes
     * @param mysqli $conn
     * @return array
     */
    function fetchGenresThemes($selectedGenres, $selectedThemes, $conn) {
        $conditions = [];
        if (!empty($selectedGenres)) {
            $conditions[] = '(' . generateCondition($selectedGenres, $conn) . ')';
        }
        if (!empty($selectedThemes)) {
            $conditions[] = '(' . generateCondition($selectedThemes, $conn) . ')';
        }

        if (!empty($conditions)) {
            $sql = "SELECT `g-t-id`, `g-ou-t`, `g-t-nom`, `g-t-description` FROM `genres-themes` WHERE " . implode(" OR ", $conditions);
            $result = $conn->query($sql);

            $genres = [];
            $themes = [];
            while ($row = $result->fetch_assoc()) {
                switch ($row['g-ou-t']) {
                    case 'genre':
                        $genres[] = $row;
                        break;
                    case 'theme':
                        $themes[] = $row;
                        break;
                }
            }

            return ['genres' => $genres, 'themes' => $themes];
        }

        return ['genres' => [], 'themes' => []];
    }

    /**
     * Récupère les animes correspondant aux genres et thèmes sélectionnés.
     * @param array $genre_ids
     * @param array $theme_ids
     * @param mysqli $conn
     * @return mysqli_result|false
     */
    function fetchAnimes($genre_ids, $theme_ids, $conn) {
        $anime_conditions = [];
        if (!empty($genre_ids)) {
            foreach ($genre_ids as $id) {
                $anime_conditions[] = "FIND_IN_SET('$id', REPLACE(genre, '&', ',')) > 0";
            }
        }
        if (!empty($theme_ids)) {
            foreach ($theme_ids as $id) {
                $anime_conditions[] = "FIND_IN_SET('$id', REPLACE(theme, '&', ',')) > 0";
            }
        }

        if (!empty($anime_conditions)) {
            $anime_sql = "SELECT anime_id FROM animes WHERE " . implode(" AND ", $anime_conditions);
            return $conn->query($anime_sql);
        }

        return false;
    }

    // Fetch genres and themes
    $data = fetchGenresThemes($selectedGenres, $selectedThemes, $conn);
    $genres = $data['genres'];
    $themes = $data['themes'];

    // Extract IDs
    $genre_ids = array_column($genres, 'g-t-id');
    $theme_ids = array_column($themes, 'g-t-id');

    // Fetch animes
    $anime_result = fetchAnimes($genre_ids, $theme_ids, $conn);
    $GenreThemeAnimeID = [];

    // Process results
    if ($anime_result && $anime_result->num_rows > 0) {
        while ($row = $anime_result->fetch_assoc()) {
            $GenreThemeAnimeID[] = $row['anime_id'];
        }
    }

    $conn->close();

    return $GenreThemeAnimeID;
}
?>

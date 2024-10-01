<?php
$servername = "my_db";
$username = "root";
$password = "rootpassword";
$dbname = "yumestream";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

function sanitizeInput($input) {
    // Supprimer les accents
    $input = str_replace(
        array('À','Á','Â','Ã','Ä','Å','à','á','â','ã','ä','å','Ç','ç','è','é','ê','ë','È','É','Ê','Ë','ì','í','î','ï','Ì','Í','Î','Ï','ð','Ð','ñ','Ñ','ò','ó','ô','õ','ö','ø','Ò','Ó','Ô','Õ','Ö','Ø','ù','ú','û','ü','Ù','Ú','Û','Ü','ý','ÿ','Ý'),
        array('A','A','A','A','A','A','a','a','a','a','a','a','C','c','e','e','e','e','E','E','E','E','i','i','i','i','I','I','I','I','d','D','n','N','o','o','o','o','o','o','O','O','O','O','O','O','u','u','u','u','U','U','U','U','y','y','Y'),
        $input
    );
    
    // Convertir en minuscules
    $input = strtolower($input);

    // Supprimer les caractères spéciaux et la ponctuation
    $input = preg_replace("/[^a-z0-9\s]/", "", $input);

    // Supprimer les espaces multiples
    $input = preg_replace('/\s+/', ' ', $input);

    return $input;
}

if (isset($_POST['query']) && isset($_POST['type'])) {
    $searchQuery = sanitizeInput($_POST['query']);
    $type = $_POST['type'];

    if ($type === 'group') {
        $sql = "
            SELECT groupe_id, nom_groupe, lien_logo, lien_image, synopsis_groupe 
            FROM groupes 
            WHERE SOUNDEX(nom_groupe) = SOUNDEX(?) 
            OR nom_groupe LIKE ?
            LIMIT 10
        ";
    } elseif ($type === 'anime') {
        $sql = "
            SELECT anime_id, groupe_id, t_original, t_latiniser, t_anglais, t_francais, lien_image, type, status, studios, saisons, episodes, duree, start_date, end_date, genre, theme, synopsis 
            FROM animes 
            WHERE SOUNDEX(t_original) = SOUNDEX(?) 
            OR t_original LIKE ?
            OR SOUNDEX(t_latiniser) = SOUNDEX(?) 
            OR t_latiniser LIKE ?
            OR SOUNDEX(t_anglais) = SOUNDEX(?) 
            OR t_anglais LIKE ?
            OR SOUNDEX(t_francais) = SOUNDEX(?) 
            OR t_francais LIKE ?
            LIMIT 15
        ";
    } elseif ($type === 'anime_group') {
        $sql = "SELECT groupe_id, nom_groupe FROM groupes WHERE nom_groupe LIKE ? LIMIT 10";
    } else {
        echo "Invalid search type.";
        exit;
    }

    $stmt = $conn->prepare($sql);
    if ($stmt === false) {
        die("Error in preparing the SQL statement: " . $conn->error);
    }

    $likeQuery = "%{$searchQuery}%";
    if ($type === 'group') {
        $stmt->bind_param("ss", $searchQuery, $likeQuery);
    } elseif ($type === 'anime') {
        $stmt->bind_param("ssssssss", $searchQuery, $likeQuery, $searchQuery, $likeQuery, $searchQuery, $likeQuery, $searchQuery, $likeQuery);
    } elseif ($type === 'anime_group') {
        $stmt->bind_param("s", $likeQuery);
    }

    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            if ($type === 'group') {
            echo "<div class='result-item-groupe result-item-groupe-1'>";
                echo "<input type='hidden' name='groupe_id' value='" . htmlspecialchars($row['groupe_id'], ENT_QUOTES, 'UTF-8') . "'>";
                echo "<input type='hidden' name='synopsis_groupe' value='" . htmlspecialchars($row['synopsis_groupe'], ENT_QUOTES, 'UTF-8') . "'>";
                echo "<input type='hidden' name='lien_image' value='" . htmlspecialchars($row['lien_image'], ENT_QUOTES, 'UTF-8') . "'>"; // Include the image link
                echo "<img src='" . htmlspecialchars($row['lien_logo'], ENT_QUOTES, 'UTF-8') . "' alt='Logo de " . htmlspecialchars($row['nom_groupe'], ENT_QUOTES, 'UTF-8') . "'>";
                echo "<p>" . htmlspecialchars($row['nom_groupe'], ENT_QUOTES, 'UTF-8') . "</p>";
            echo "</div>";
            } elseif ($type === 'anime') {
                // Determine the title to display
                $title = $row['t_francais'] ?: ($row['t_anglais'] ?: ($row['t_latiniser'] ?: $row['t_original']));
                
                echo "<div class='result-item-groupe result-item-anime-2'>";
                    echo "<input type='hidden' name='anime_id' value='" . htmlspecialchars($row['anime_id'], ENT_QUOTES, 'UTF-8') . "'>";
                    echo "<input type='hidden' name='groupe_id' value='" . htmlspecialchars($row['groupe_id'], ENT_QUOTES, 'UTF-8') . "'>";
                    echo "<input type='hidden' name='t_original' value='" . htmlspecialchars($row['t_original'], ENT_QUOTES, 'UTF-8') . "'>";
                    echo "<input type='hidden' name='t_latiniser' value='" . htmlspecialchars($row['t_latiniser'], ENT_QUOTES, 'UTF-8') . "'>";
                    echo "<input type='hidden' name='t_anglais' value='" . htmlspecialchars($row['t_anglais'], ENT_QUOTES, 'UTF-8') . "'>";
                    echo "<input type='hidden' name='t_francais' value='" . htmlspecialchars($row['t_francais'], ENT_QUOTES, 'UTF-8') . "'>";
                    echo "<input type='hidden' name='lien_image' value='" . htmlspecialchars($row['lien_image'], ENT_QUOTES, 'UTF-8') . "'>";
                    echo "<input type='hidden' name='type' value='" . htmlspecialchars($row['type'], ENT_QUOTES, 'UTF-8') . "'>";
                    echo "<input type='hidden' name='status' value='" . htmlspecialchars($row['status'], ENT_QUOTES, 'UTF-8') . "'>";
                    echo "<input type='hidden' name='studios' value='" . htmlspecialchars($row['studios'], ENT_QUOTES, 'UTF-8') . "'>";
                    echo "<input type='hidden' name='saisons' value='" . htmlspecialchars($row['saisons'], ENT_QUOTES, 'UTF-8') . "'>";
                    echo "<input type='hidden' name='episodes' value='" . htmlspecialchars($row['episodes'], ENT_QUOTES, 'UTF-8') . "'>";
                    echo "<input type='hidden' name='duree' value='" . htmlspecialchars($row['duree'], ENT_QUOTES, 'UTF-8') . "'>";
                    echo "<input type='hidden' name='start_date' value='" . htmlspecialchars($row['start_date'], ENT_QUOTES, 'UTF-8') . "'>";
                    echo "<input type='hidden' name='end_date' value='" . htmlspecialchars($row['end_date'], ENT_QUOTES, 'UTF-8') . "'>";
                    echo "<input type='hidden' name='genre' value='" . htmlspecialchars($row['genre'], ENT_QUOTES, 'UTF-8') . "'>";
                    echo "<input type='hidden' name='theme' value='" . htmlspecialchars($row['theme'], ENT_QUOTES, 'UTF-8') . "'>";
                    echo "<input type='hidden' name='synopsis' value='" . htmlspecialchars($row['synopsis'], ENT_QUOTES, 'UTF-8') . "'>";
                    echo "<img src='" . htmlspecialchars($row['lien_image'], ENT_QUOTES, 'UTF-8') . "' alt='Image de " . htmlspecialchars($title, ENT_QUOTES, 'UTF-8') . "'>";
                    echo "<p>" . htmlspecialchars($title, ENT_QUOTES, 'UTF-8') . "</p>";
                echo "</div>";
            } elseif ($type === 'anime_group') {
                $displayName = htmlspecialchars($row['nom_groupe'], ENT_QUOTES, 'UTF-8') . '#' . htmlspecialchars($row['groupe_id'], ENT_QUOTES, 'UTF-8');
                echo "<div class='result-item-groupe-2'>";
                    echo "<input type='hidden' name='groupe_id' value='" . htmlspecialchars($row['groupe_id'], ENT_QUOTES, 'UTF-8') . "'>";
                    echo "<p>" . $displayName . "</p>";
                echo "</div>";
            }
        }
    } else {
        echo "<p>Aucun résultat trouvé</p>";
    }

    $stmt->close();
}

$conn->close();
?>

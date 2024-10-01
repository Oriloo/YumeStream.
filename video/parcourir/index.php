<?php
$CheminRedirection = "";
include("../../script/variables_bdd.php");
include("../../script/script_compte.php");
include("../../script/script_erreur.php");

// Récupérer les paramètres 'recherche', 'genre' et 'theme' dans l'URL
$recherche = isset($_GET['recherche']) ? urldecode($_GET['recherche']) : '';
$type = isset($_GET['type']) ? urldecode($_GET['type']) : '';
$status = isset($_GET['status']) ? urldecode($_GET['status']) : '';
$langue = isset($_GET['langue']) ? urldecode($_GET['langue']) : '';
$genre = isset($_GET['genre']) ? urldecode($_GET['genre']) : '';
$theme = isset($_GET['theme']) ? urldecode($_GET['theme']) : '';

// Séparer les mots clés, genres et thèmes en tableaux
$motsClesRecherche = array_filter(explode(' ', $recherche));
$selectedGenres = array_filter(explode(' ', $genre));
$selectedThemes = array_filter(explode(' ', $theme));

// Connexion à la base de données
$conn = new mysqli($BDDservername, $BDDusername, $BDDpassword, $BDDname);

// Vérification de la connexion
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Requête pour récupérer les genres
$sql_genres = "SELECT * FROM `genres-themes` WHERE `g-ou-t` = 'genre'";
$result_genres = $conn->query($sql_genres);

// Requête pour récupérer les thèmes
$sql_themes = "SELECT * FROM `genres-themes` WHERE `g-ou-t` = 'theme' ORDER BY `g-t-nom` ASC";
$result_themes = $conn->query($sql_themes);

$conn->close();
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>YumeStream. | Parcourir</title>
    <link rel="icon" href="../../element/image/logo/YumeStream-logo-yu256.png">
    <link rel="stylesheet" type="text/css" href="../../element/navbar/navbar.css">
    <link rel="stylesheet" type="text/css" href="../../element/footer/footer.css">
    <link rel="stylesheet" type="text/css" href="../../style.css">
    <link rel="stylesheet" type="text/css" href="parcourir.css">
    <script type="text/javascript">
        function formatAndSubmitForm(event) {
            event.preventDefault();

            let form = document.getElementById('genre-theme-form');
            let genres = [];
            let themes = [];

            form.querySelectorAll('input[name="genre"]:checked').forEach(checkbox => {
                genres.push(checkbox.value);
            });

            form.querySelectorAll('input[name="theme"]:checked').forEach(checkbox => {
                themes.push(checkbox.value);
            });

            let genreParam = genres.join('+');
            let themeParam = themes.join('+');

            let recherche = form.querySelector('input[name="recherche"]').value;
            recherche = encodeURIComponent(recherche).replace(/%20/g, '+');

            // Récupérer les valeurs sélectionnées des sélecteurs de type et de statut
            let typeSelect = form.querySelector('select[name="type-select"]').value;
            let statusSelect = form.querySelector('select[name="status-select"]').value;
            let langueSelect = form.querySelector('select[name="langue-select"]').value;

            // Ajouter les valeurs des sélecteurs aux paramètres de l'URL
            let newAction = form.action.split('?')[0];
            let params = [];
            if (recherche) { params.push('recherche=' + recherche); }
            if (typeSelect) { params.push('type=' + typeSelect); }
            if (statusSelect) { params.push('status=' + statusSelect); }
            if (langueSelect) { params.push('langue=' + langueSelect); }
            if (genreParam) { params.push('genre=' + genreParam); }
            if (themeParam) { params.push('theme=' + themeParam); }
            if (params.length > 0) { newAction += '?' + params.join('&'); }

            window.location.href = newAction;
        }
    </script>
</head>
<body>
<?php
$ProvenancePage = "niv2";
include("../../element/navbar/navbar.php");
?>

<div class="page">
<div class="zone-form-recherche">
    <form id="genre-theme-form" action="" method="GET" onsubmit="formatAndSubmitForm(event);">
        <div class="form-search-bar">
            <h2>Recherche</h2>
            <div class="search-bar">
                <input type="text" name="recherche" value="<?php echo htmlspecialchars($recherche); ?>">
                <button type="submit">Rechercher</button>
            </div>
        </div>
        <div class="les-3-form-select">
            <div class="form-select form-type-select">
                <h2>Type</h2>
                <select name="type-select">
                    <option value="" <?php echo $type === '' ? 'selected' : ''; ?>>Tous les types</option>
                    <option value="tv" <?php echo $type === 'tv' ? 'selected' : ''; ?>>TV</option>
                    <option value="ona" <?php echo $type === 'ona' ? 'selected' : ''; ?>>ONA</option>
                    <option value="film" <?php echo $type === 'film' ? 'selected' : ''; ?>>Film</option>
                    <option value="oav" <?php echo $type === 'oav' ? 'selected' : ''; ?>>OAV</option>
                    <option value="special" <?php echo $type === 'special' ? 'selected' : ''; ?>>Special</option>
                </select>
            </div>
            <div class="form-select form-status-select">
                <h2>Status</h2>
                <select name="status-select">
                    <option value="" <?php echo $status === '' ? 'selected' : ''; ?>>Tous les satus</option>
                    <option value="cours" <?php echo $status === 'cours' ? 'selected' : ''; ?>>En cours</option>
                    <option value="termine" <?php echo $status === 'termine' ? 'selected' : ''; ?>>Terminé</option>
                    <option value="pause" <?php echo $status === 'pause' ? 'selected' : ''; ?>>En pause</option>
                    <option value="venir" <?php echo $status === 'venir' ? 'selected' : ''; ?>>À venir</option>
                    <option value="annule" <?php echo $status === 'annule' ? 'selected' : ''; ?>>Annulé</option>
                </select>
            </div>
            <div class="form-select form-langue-select">
                <h2>Langue</h2>
                <select name="langue-select">
                    <option value="" <?php echo $langue === '' ? 'selected' : ''; ?>>Toutes les langues</option>
                    <option value="vostfr" <?php echo $langue === 'vostfr' ? 'selected' : ''; ?>>VOSTFR</option>
                    <option value="vf" <?php echo $langue === 'vf' ? 'selected' : ''; ?>>VF</option>
                </select>
            </div>
        </div>
        <div class="form-GT form-genres">
            <h2>Genres</h2>
            <div class="form-element">
            <?php
            if ($result_genres->num_rows > 0) {
                while($row = $result_genres->fetch_assoc()) {
                    $checked = in_array($row['g-t-lien'], $selectedGenres) ? 'checked' : '';
                    echo '<div class="form-checkbox">
                        <input type="checkbox" id="genre_' . htmlspecialchars($row['g-t-lien']) . '" name="genre" value="' . htmlspecialchars($row['g-t-lien']) . '" ' . $checked . '>
                        <label for="genre_' . htmlspecialchars($row['g-t-lien']) . '">' . htmlspecialchars($row['g-t-nom']) . '</label>
                    </div>';
                }
            }
            ?>
            </div>
        </div>
        <div class="form-GT form-themes">
            <h2>Thèmes</h2>
            <div class="form-element">
            <?php
            if ($result_themes->num_rows > 0) {
                while($row = $result_themes->fetch_assoc()) {
                    $checked = in_array($row['g-t-lien'], $selectedThemes) ? 'checked' : '';
                    echo '<div class="form-checkbox">
                        <input type="checkbox" id="theme_' . htmlspecialchars($row['g-t-lien']) . '" name="theme" value="' . htmlspecialchars($row['g-t-lien']) . '" ' . $checked . '>
                        <label for="theme_' . htmlspecialchars($row['g-t-lien']) . '">' . htmlspecialchars($row['g-t-nom']) . '</label>
                    </div>';
                }
            }
            ?>
            </div>
        </div>
    </form>
</div>

<?php
include("FiltreRecherche.php");
include("FiltreTypeStatus.php");
include("FiltreGenresThemes.php");
include("FiltreLangue.php");
include("AfficheAnime.php");
?>
</div>

<?php include("../../element/footer/footer.php"); ?>
</body>
</html>

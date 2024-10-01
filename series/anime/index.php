<?php
$CheminRedirection = "";
include("../../script/variables_bdd.php");
include("../../script/script_compte.php");
include("../../script/script_erreur.php");
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" href="../../element/image/logo/YumeStream-logo-yu256.png">
    <title>YumeStream.</title>

    <link rel="stylesheet" type="text/css" href="../../style.css">
    <link rel="stylesheet" type="text/css" href="../../element/navbar/navbar.css">
    <link rel="stylesheet" type="text/css" href="../../element/footer/footer.css">
    <link rel="stylesheet" type="text/css" href="anime.css">
</head>
<body>
<?php
$ProvenancePage = "niv2";
include("../../element/navbar/navbar.php");
include("InfoDeAnime.php");

// Get parameters from URL or set default values
$defaultLangue = isset($_GET['langue']) ? $_GET['langue'] : 'vostfr';
$defaultEpisode = isset($_GET['episode']) ? intval($_GET['episode']) : 1;
$defaultLangueValue = $defaultLangue === 'vf' ? 1 : 0;
?>

<div class="page">
    <div class="all-anime-info-top">
        <div class="anime-top-background">
            <div class="image-group-background">
                <img class="image-group" src="<?php echo $groupe['lien_image']; ?>">
            </div>
            <div class="filtre-image-background">
                
            </div>
        </div>
        <div class="anime-top">
            <div class="anime-top-left">
                <img class="anime-affiche" src="<?php echo $anime['lien_image']; ?>">
            </div>

            <div class="anime-top-center">
                <a class="groupe-top-center" href="../groupe/?id=<?php echo $groupe['groupe_id']; ?>">
                    <img class="groupe-logo" src="<?php echo $groupe['lien_logo']; ?>">
                </a>
                <div class="anime-info">
                    <h2><?php echo !empty($anime['t_francais']) ? $anime['t_francais'] : (!empty($anime['t_anglais']) ? $anime['t_anglais'] : (!empty($anime['t_latiniser']) ? $anime['t_latiniser'] : $anime['t_original'])); ?></h2>
                    <div class="se-gt-anime">
                        <div class="s-ep-anime">
                            <div class="info-nb saisin-nb">Saison <?php echo $anime['saisons']; ?></div>
                            <div class="info-nb episode-nb">Episodes <?php echo $anime['episodes']; ?></div>
                        </div>
                        <div class="g-t-anime">
                            <div class="info-nb genre-nb">Genres 
                            <?php
                            $genreLinks = [];
                            foreach ($genres as $genre) {
                                $genreLinks[] = '<a href="../../video/parcourir/?genre=' . urlencode($genre['lien']) . '">' . htmlspecialchars($genre['nom']) . '</a>';
                            }
                            echo implode(', ', $genreLinks);
                            ?>
                            </div>
                            <div class="info-nb theme-nb">Themes 
                            <?php 
                            $themeLinks = [];
                            foreach ($themes as $theme) {
                                $themeLinks[] = '<a href="../../video/parcourir/?theme=' . urlencode($theme['lien']) . '">' . htmlspecialchars($theme['nom']) . '</a>';
                            }
                            echo implode(', ', $themeLinks);
                            ?>
                            </div>
                        </div>
                    </div>
                    <div class="synopsis-groupe"><?php echo !empty($anime['synopsis']) ? $anime['synopsis'] : $groupe['synopsis_groupe']; ?></div>
                </div>
            </div>
            <div class="button-up-down">
                <button class="button-scroll" id="button-up">≪</button><br>
                <button class="button-scroll" id="button-down">≫</button>
            </div>
            <script type="text/javascript">
                document.getElementById('button-up').addEventListener('click', function() {
                    const element = document.querySelector('.anime-top-center');
                    element.scrollBy({
                        top: -250, // Scroll up by 100 pixels
                        left: 0,
                        behavior: 'smooth' // Smooth scroll
                    });
                });

                document.getElementById('button-down').addEventListener('click', function() {
                    const element = document.querySelector('.anime-top-center');
                    element.scrollBy({
                        top: +250, // Scroll down by 100 pixels
                        left: 0,
                        behavior: 'smooth' // Smooth scroll
                    });
                });
            </script>

            <div class="anime-top-right">
                <div class="info-vignette">
                    <h4>Type</h4>
                    <a href="../../video/parcourir/?type=<?php echo $anime['type']; ?>">
                    <?php echo $anime['type']; ?></a>
                </div>
                <div class="info-vignette">
                    <h4>Status</h4>
                    <a href="../../video/parcourir/?status=<?php echo $anime['status']; ?>">
                    <?php echo $anime['status']; ?></a>
                </div>
                <div class="info-vignette">
                    <h4>Durée</h4>
                    <a><?php echo $anime['duree']; ?> min</a>
                </div>
                <div class="info-vignette">
                    <h4>Diffusé</h4>
                    <a><?php echo $anime['start_date']; ?>
                    <?php echo ($anime['start_date'] !== $anime['end_date']) ? $anime['end_date'] : ''; ?>
                    </a>
                </div>
                <div class="info-vignette">
                    <h4>Studios</h4>
                    <a><?php echo $anime['studios']; ?></a>
                </div>
                <div class="info-vignette">
                    <h4>Liste</h4>
                    <div class="svg-liste">
                        <a href="">
                            <svg width="800px" height="800px" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M5 6.2C5 5.07989 5 4.51984 5.21799 4.09202C5.40973 3.71569 5.71569 3.40973 6.09202 3.21799C6.51984 3 7.07989 3 8.2 3H15.8C16.9201 3 17.4802 3 17.908 3.21799C18.2843 3.40973 18.5903 3.71569 18.782 4.09202C19 4.51984 19 5.07989 19 6.2V21L12 16L5 21V6.2Z" stroke="#000000" stroke-width="2" stroke-linejoin="round"/>
                            </svg>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="anime-bottom">
        <div class="zone-anime-episode">
            <div class="anime-interaction">
                <div class="anime-select">
                    <select id="select-langue"></select>
                    <select id="select-episode"></select>
                    <select id="select-lecteur">
                        <option value="1">lecteur 1</option>
                    </select>
                </div>
                <div class="anime-bouton">
                    <button id="btn-precedent">Précédent</button>
                    <button id="btn-suivant">Suivant</button>
                </div>
            </div>
            <div class="anime-episode">
                <div id="zone-episode">Aucun épisode trouvé</div>
            </div>
            <div class="anime-episode-info">
                <h3 id="episode-titre"></h3>
                <span id="episode-date"></span>
            </div>
        </div>
    </div>

    <script src="episode-anime.js"></script>
</div>

<?php include("../../element/footer/footer.php"); ?>
</body>
</html>

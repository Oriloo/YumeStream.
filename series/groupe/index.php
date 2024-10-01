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
    <link rel="stylesheet" type="text/css" href="groupe.css">
</head>
<body>
<?php
$ProvenancePage = "niv2";
include("../../element/navbar/navbar.php");
include("InfoDuGroupe.php");
?>

<div class="page">
    <div class="groupe-top">
        <div class="groupe-fond">
            <img class="groupe-image-fond" src="<?php echo $groupe['lien_image']; ?>">
            <div class="shadow-effect3"></div>
        </div>
        <div class="groupe-img-logo">
            <img class="groupe-image" src="<?php echo $groupe['lien_image']; ?>">
            <div class="shadow-effect1"></div>
            <img class="groupe-logo" src="<?php echo $groupe['lien_logo']; ?>">
        </div>
        <div class="groupe-details">
            <h1 class="groupe-nom"><?php echo $groupe['nom_groupe']; ?></h1>
            <p class="groupe-synopsis"><?php echo $groupe['synopsis_groupe']; ?></p>
        </div>
    </div>

    <div class="group-bottom">
        <div class="liste-animes">
            <?php if (!empty($series_animes)): ?>
            <div class="liste-affiche-animes">
                <h1>Série (TV - ONA)</h1>
                <div class="une-liste-affiche">
                    <?php foreach ($series_animes as $anime): ?>
                    <a href="../../series/anime/?id=<?php echo $anime['anime_id']; ?>">
                        <img class="image-anime" src="<?php echo $anime['lien_image']; ?>">
                        <h4><?php echo !empty($anime['t_francais']) ? $anime['t_francais'] : (!empty($anime['t_anglais']) ? $anime['t_anglais'] : (!empty($anime['t_latiniser']) ? $anime['t_latiniser'] : $anime['t_original'])); ?></h4>
                    </a>
                    <?php endforeach; ?>
                </div>
            </div>
            <?php endif; ?>

            <?php if (!empty($film_animes)): ?>
            <div class="liste-affiche-animes">
                <h1>Film</h1>
                <div class="une-liste-affiche">
                    <?php foreach ($film_animes as $anime): ?>
                    <a href="../../series/anime/?id=<?php echo $anime['anime_id']; ?>">
                        <img class="image-anime" src="<?php echo $anime['lien_image']; ?>">
                        <h4><?php echo !empty($anime['t_francais']) ? $anime['t_francais'] : (!empty($anime['t_anglais']) ? $anime['t_anglais'] : (!empty($anime['t_latiniser']) ? $anime['t_latiniser'] : $anime['t_original'])); ?></h4>
                    </a>
                    <?php endforeach; ?>
                </div>
            </div>
            <?php endif; ?>

            <?php if (!empty($other_animes)): ?>
            <div class="liste-affiche-animes">
                <h1>Autre (OAV - Spécial - Short)</h1>
                <div class="une-liste-affiche">
                    <?php foreach ($other_animes as $anime): ?>
                    <a href="../../series/anime/?id=<?php echo $anime['anime_id']; ?>">
                        <img class="image-anime" src="<?php echo $anime['lien_image']; ?>">
                        <h4><?php echo !empty($anime['t_francais']) ? $anime['t_francais'] : (!empty($anime['t_anglais']) ? $anime['t_anglais'] : (!empty($anime['t_latiniser']) ? $anime['t_latiniser'] : $anime['t_original'])); ?></h4>
                    </a>
                    <?php endforeach; ?>
                </div>
            </div>
            <?php endif; ?>
        </div>
    </div>
</div>

<?php include("../../element/footer/footer.php"); ?>
</body>
</html>

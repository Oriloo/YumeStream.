<?php
$CheminRedirection = "../../connexion/?erreur=006";
include("../../script/variables_bdd.php");
include("../../script/script_compte.php");
include("../../script/script_erreur.php");

if (!$user_id) {
	// L'utilisateur n'est pas connecté
	header("Location: ../../connexion/index.php?erreur=007");
	exit();
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>YumeStream. | <?php echo $user_name; ?></title>
	<link rel="icon" href="../../element/image/logo/YumeStream-logo-yu256.png">
	<link rel="stylesheet" type="text/css" href="../../element/navbar/navbar.css">
	<link rel="stylesheet" type="text/css" href="../../element/footer/footer.css">
	<link rel="stylesheet" type="text/css" href="../../style.css">
	<link rel="stylesheet" type="text/css" href="../compte/profil.css">
</head>
<body>
<?php
$ProvenancePage = "niv2";
include('../../element/navbar/navbar.php');
?>

<div class="page">
	<div class="containeur">
		<div class="lien-page">
			<div class="liens"><a href="../compte/">Compte</a></div>
			<div class="liens"><a href="../parametre/">Paramètres</a></div>
			<div class="liens oui"><a href="">Anime Liste</a></div>
			<div class="liens"><a href="../historique/">Historique</a></div>
			<div class="liens"><a href="../notification/">Notifications</a></div>
		</div>
		<div class="cont-page"></div>
	</div>
</div>

<?php include('../../element/footer/footer.php'); ?>
</body>
</html>

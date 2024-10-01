<?php
$CheminRedirection = "";
include('../script/variables_bdd.php');
include("../script/script_compte.php");
include("../script/script_erreur.php");

if (!$user_id) {
	// L'utilisateur n'est pas connecté
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>YumeStream. | <?php echo (($user_name) ? $user_name : "Profil"); ?></title>
	<link rel="icon" href="../element/image/logo/YumeStream-logo-yu256.png">
	<link rel="stylesheet" type="text/css" href="../element/navbar/navbar.css">
	<link rel="stylesheet" type="text/css" href="../element/footer/footer.css">
	<link rel="stylesheet" type="text/css" href="../style.css">
</head>
<body>
<?php
$ProvenancePage = "niv1";
include("../element/navbar/navbar.php");
?>

<div class="page">
</div>

<?php include("../element/footer/footer.php"); ?>
</body>
</html>

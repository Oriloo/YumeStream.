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
			<div class="liens oui"><a href="">Paramètres</a></div>
			<div class="liens2"><a>> Contenu du Profil</a></div>
			<div class="liens2"><a>> Confidentialité</a></div>
			<div class="liens2"><a>> Cookies</a></div>
			<div class="petit-separateur"></div>
			<div class="liens"><a href="../liste/">Anime Liste</a></div>
			<div class="liens"><a href="../historique/">Historique</a></div>
			<div class="liens"><a href="../notification/">Notifications</a></div>
		</div>
		<div class="cont-page">
			<div class="zone">
				<h1>Contenu du Profil : (pas encore implémenter)</h1>
				<form method="post" action=""> <!-- save_profil.php -->
					<div class="zone-box">
						<input class="box-param" type="checkbox" id="box0" name="box0" disabled/>
						<label for="box0">Afficher mon "profil", en public. (Influence tous les autres contenues)</label>
					</div>
					<div class="zone-box">
						<input class="box-param" type="checkbox" id="box1" name="box1" disabled/>
						<label for="box1">Afficher mon "anime liste" sur le profil, en public.</label>
					</div>
					<div class="zone-box">
						<input class="box-param" type="checkbox" id="box2" name="box2" disabled/>
						<label for="box2">Afficher mon "historique" sur le profil, en public.</label>
					</div>
					<div class="zone-box">
						<input class="box-param" type="checkbox" id="box3" name="box3" disabled/>
						<label for="box3">Afficher mes "critiques" sur le profil, en public.</label>
					</div>
					<button id="modif-profil" type="button">Modifier</button>
					<button id="cancel-profil" type="button" style="display: none;">Annuler</button>
					<button id="save-profil" type="submit" style="display: none;">Enregistrer</button>
				</form>
			</div>
			<div class="zone">
				<h1>Confidentialité : (pas encore implémenter)</h1>
			</div>
			<div class="zone">
				<h1>Cookies : (pas encore implémenter)</h1>
			</div>
		</div>
	</div>
</div>

<?php include('../../element/footer/footer.php'); ?>
<script type="text/javascript">
<?php // Stocker les valeurs initiales des variables PHP dans des variables JavaScript
echo 'var user_profil="'. 0 .'";';
?>

/****************************************************************************************************/
/****************************************************************************************************/

// Écouteurs d'événements pour les cases à cocher
document.addEventListener("DOMContentLoaded", function() {
	var box0 = document.getelementById("box0"),
		box1 = document.getelementById("box1"),
		box2 = document.getelementById("box2"),
		box3 = document.getelementById("box3");

	box0.addEventListener("change", function() {
		// Si la case principale est décochée, décocher les autres cases
		if (box0.checked == false) {
			box1.checked = false;
			box2.checked = false;
			box3.checked = false;
		}
	});

	// Les cases à cocher 1, 2, et 3 cochent automatiquement la case principale si elles sont cochées
	box1.addEventListener("change", function() {
		if (box1.checked) {
			box0.checked = true;
		}
	});
	box2.addEventListener("change", function() {
		if (box2.checked) {
			box0.checked = true;
		}
	});
	box3.addEventListener("change", function() {
		if (box3.checked) {
			box0.checked = true;
		}
	});
});

/****************************************************************************************************/
/****************************************************************************************************/

// Fonction pour les boutons de la photo de profil
function s2(e) {
	document.getelementById("modif-profil").style.display = e ? "none" : "inline-block";
	document.getelementById("cancel-profil").style.display = e ? "inline-block" : "none";
	document.getelementById("save-profil").style.display = e ? "inline-block" : "none";
	document.querySelectorAll("#box0, #box1, #box2, #box3").forEach(box => box.disabled = !e);
	//user_profil
}

// Écouteurs d'événements pour les boutons "Modifier" et "Annuler" du profil
document.getelementById("modif-profil").addEventListener("click", () => s2(true));
document.getelementById("cancel-profil").addEventListener("click", () => { s2(false); });
</script>
</body>
</html>

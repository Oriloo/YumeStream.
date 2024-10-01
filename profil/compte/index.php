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
$ListeCaractere1 = "[a-zA-Z0-9ÀÂÉÈÊËÎÏÔÙÛÜŸÇÆŒàâéèêëîïôùûüÿçæœ_]+";
$ListeCaractere2 = "[a-z0-9]+";
?>

<div class="page">
	<div class="containeur">
		<div class="lien-page">
			<div class="liens oui"><a href="">Compte</a></div>
			<div class="liens2"><a>> Pseudo</a></div>
			<div class="liens2"><a>> Photo de Profil</a></div>
			<div class="liens2"><a>> Adresse du Profil</a></div>
			<div class="liens2"><a>> Mot de Passe</a></div>
			<div class="liens2"><a>> Adresse E-Mail</a></div>
			<div class="liens2"><a>> Supprimer le Compte</a></div>
			<div class="petit-separateur"></div>
			<div class="liens"><a href="../parametre/">Paramètres</a></div>
			<div class="liens"><a href="../liste/">Anime Liste</a></div>
			<div class="liens"><a href="../historique/">Historique</a></div>
			<div class="liens"><a href="../notification/">Notifications</a></div>
		</div>
		<div class="cont-page">
			<div class="zone">
				<h1>Pseudo :</h1>
				<form method="post" action="save_pseudo.php">
					<input type="text" name="pseudo" id="pseudo" minlength="4" maxlength="20" value="<?php echo $user_name;?>" pattern="<?php echo $ListeCaractere1;?>" required disabled>
					<button id="modif-pseudo" type="button">Modifier</button>
					<button id="cancel-pseudo" type="button" style="display: none;">Annuler</button>
					<button id="save-pseudo" type="submit" style="display: none;">Enregistrer</button>
				</form>
			</div>
			<div class="zone">
				<h1>Photo de Profil :</h1>
				<form method="post" action="save_pp.php">
					<img id="main-image" src="../../element/image/pp/<?php echo $user_pp; ?>">
					<input type="hidden" id="photo" name="photo" value="<?php echo $user_pp; ?>" required disabled>
					<button id="modif-pp" type="button">Modifier</button>
					<button id="cancel-pp" type="button" style="display: none;">Annuler</button>
					<button id="save-pp" type="submit" style="display: none;">Enregistrer</button>
					<div class="liste-pp" style="display: none;">
						<?php
						// Chemin vers le dossier contenant les images
						$dossier = "../../element/image/pp/";

						// Obtenir la liste des fichiers dans le dossier
						$files = scandir($dossier);

						// Filtrer les fichiers pour afficher uniquement les images
						$images = array_filter($files, function($file) use ($dossier) {
							$path = $dossier . $file;
							// Vérifier si le fichier est une image
							return is_file($path) && getimagesize($path);
						});

						// Afficher les images
						foreach ($images as $image) {
							echo '<img src="' . $dossier . $image . '" onclick="updateImageAndInput(\'' . $image . '\')">';
						}
						?>
					</div>
				</form>
			</div>
			<div class="zone">
				<h1>Adresse du Profil :</h1>
				<form method="post" action="save_adresse.php">
					<input type="text" name="adresse" id="adresse" minlength="4" maxlength="20" value="<?php echo $user_adresse;?>" pattern="<?php echo $ListeCaractere2;?>" required disabled>
					<button id="modif-adresse" type="button">Modifier</button>
					<button id="cancel-adresse" type="button" style="display: none;">Annuler</button>
					<button id="save-adresse" type="submit" style="display: none;">Enregistrer</button>
				</form><br>
				<a class="lien-adresse">https://AnimeTv.com/profil/?<span id="lien-adresse"></span></a>
			</div>
			<div class="zone">
				<h1>Mot de Passe :</h1>
				<form method="post" action="save_mdp.php">
					<label class="mdp-param" for="mdp1">Mot de passe actuel :</label><br>
					<div class="input-mdp">
						<input type="password" name="mdp1" id="mdp1" minlength="8" maxlength="60" required disabled><button type="button" id="but1-mdp" class="but-mdp" disabled></button>
					</div><br><br>
					<label class="mdp-param" for="mdp2">Nouveau mot de passe :</label><br>
					<div class="input-mdp">
						<input type="password" name="mdp2" id="mdp2" minlength="8" maxlength="60" required disabled><button type="button" id="but2-mdp" class="but-mdp" disabled></button>
					</div><br><br>
					<label class="mdp-param" for="mdp3">Confirmer le mot de passe :</label><br>
					<div class="input-mdp">
						<input type="password" name="mdp3" id="mdp3" minlength="8" maxlength="60" required disabled><button type="button" id="but3-mdp" class="but-mdp" disabled></button>
					</div>
					<button id="modif-mdp" type="button">Modifier</button>
					<button id="cancel-mdp" type="button" style="display: none;">Annuler</button>
					<button id="save-mdp" type="submit" style="display: none;">Enregistrer</button>
				</form>
			</div>
			<div class="zone">
				<h1>Adresse E-Mail :</h1>
				<form method="post" action="save_mail.php">
					<label class="mdp-param" for="mdp4">Mot de passe :</label><br>
					<div class="input-mdp">
						<input type="password" name="mdp4" id="mdp4" minlength="8" maxlength="60" required disabled><button type="button" id="but4-mdp" class="but-mdp" disabled></button>
					</div><br><br>
					<label class="mdp-param" for="mail">Nouvelle adresse e-mail :</label><br>
					<input type="text" name="mail" id="mail" value="<?php echo $user_mail;?>" required disabled>
					<button id="modif-mail" type="button">Modifier</button>
					<button id="cancel-mail" type="button" style="display: none;">Annuler</button>
					<button id="save-mail" type="submit" style="display: none;">Enregistrer</button>
				</form>
			</div>
			<div class="zone">
				<h1>Supprimer le Compte :</h1>
				<label class="mdp-param" for="mdp5">Mot de passe :</label><br>
				<div class="input-mdp">
					<input type="password" name="mdp5" id="mdp5" minlength="8" maxlength="60" required disabled><button type="button" id="but5-mdp" class="but-mdp" disabled></button>
				</div>
				<button id="supprimer-compte">Supprimer mon Compte</button>
				<button id="supprimer-cancel" style="display: none;">Annuler</button>
				<button id="supprimer-valide" style="display: none;">Valider la suppression</button>
			</div>
		</div>
	</div>
</div>

<?php include('../../element/footer/footer.php'); ?>
<script type="text/javascript">
<?php // Stocker les valeurs initiales des variables PHP dans des variables JavaScript
echo 'var user_name="'.$user_name.'";';
echo 'var user_pp="'.$user_pp.'";';
echo 'var user_adresse="'.$user_adresse.'";';
echo 'var user_mail="'.$user_mail.'";';
?>
</script>
<script type="text/javascript" src="script_compte.js"></script>
</body>
</html>

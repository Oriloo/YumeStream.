<!DOCTYPE html>
<html lang="fr">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>YumeStream. | Connexion</title>
	<link rel="icon" href="../element/image/logo/YumeStream-logo-yu256.png">
	<link rel="stylesheet" type="text/css" href="connexion.css">
</head>
<body>

<nav class="nav-co">
	<img class="img1-co" src="../element/image/logo/YumeStream-nom-logo256.png">
</nav>

<?php
include('../script/variables_bdd.php');
include("../script/script_erreur.php");
?>

<div class="page">
	<div id="conteneur" class="conteneur-co con">
		<div class="conteneur-titre-co">
			<div id="con" class="titre-co"><h2>Connexion</h2></div>
			<div id="cre" class="titre-co"><h2>Inscription</h2></div>
		</div>
		<div class="body-con">
			<div class="logo-co"><img src="../element/image/logo/YumeStream-logo256.png"></div>
			<form method="post" action="script_connexion.php">
				<label for="login">Adresse Mail :</label><br>
				<input type="text" id="login" name="login" required><br>
				<label for="mdp1">Mod de Passe :</label><br>
				<div class="mdp-co">
					<input type="password" id="mdp1" name="mdp1" minlength="8" maxlength="60" required><br>
					<button type="button" id="but1-mdp" class="but-mdp"></button>
				</div>
				<div class="souvenir-co">
					<input type="checkbox" id="souvenir" name="souvenir">
					<label for="souvenir" class="label-souvenir">Se souvenir de moi sur cet appareil pendant 30 jours.</label>
				</div>
				<div class="bout-co">
					<button type="submit">Se connecter</button>
				</div>
			</form>
		</div>
		<div class="body-cre">
			<div class="logo-co logo-co2"></div>
			<form method="post" action="script_inscription.php">
				<label for="login">Adresse Mail :</label><br>
				<input type="text" id="login" name="login" required><br>
				<label for="mdp2">Mod de Passe :</label><br>
				<div class="mdp-co">
					<input type="password" id="mdp2" name="mdp2" minlength="8" maxlength="60" required><br>
					<button type="button" id="but2-mdp" class="but-mdp"></button>
				</div>
				<label for="mdp3">Confirmer le Mod de Passe :</label><br>
				<div class="mdp-co">
					<input type="password" id="mdp3" name="mdp3" minlength="8" maxlength="60" required><br>
					<button type="button" id="but3-mdp" class="but-mdp"></button>
				</div>
				<div class="info-inscription">
					<p class="les-info">En cliquant sur «S’inscrire», vous acceptez nos <a href="#">Conditions générales</a>. Consultez notre <a href="#">Politique de confidentialité</a> et notre <a href="#">Politique d’utilisation des cookies</a>.</p>
				</div>
				<div class="bout-co">
					<button type="submit">S'inscrire</button>
				</div>
			</form>
		</div>
	</div>
</div>

<footer class="foot-co">
	<div class="footer-bas">
		<div class="information">
			<div class="info-con info-footer">
				<h4>Contact</h4>
				<a href="https://discord.gg/g9dVyUQz8q" target="_blank">Discord</a>
			</div>
			<div class="info-apr info-footer">
				<h4>Légal</h4>
				<div class="a-foot">
					<a href="#">À propos</a><span>, </span>
					<a href="#">Aide</a><span>, </span>
					<a href="#">Conditions générale</a><span>, </span>
					<a href="#">Confidentialité</a><span>, </span>
					<a href="#">Cookies</a>
				</div>
			</div>
		</div>
		<div class="footer-bar">
			<img class="logo" src="../element/image/logo/YumeStream-nom-logo256.png"><br>
			<span class="bar-copy1">&copy; 2024 YumeStream.
				<span class="bar-copy2">- Tous droits réservés</span>
			</span>
		</div>
	</div>
</footer>

<script type="text/javascript">
document.addEventListener("DOMContentLoaded", function() {
	const input_mdb1 = document.getElementById('mdp1');
	const butto_mdb1 = document.getElementById('but1-mdp');
	const input_mdb2 = document.getElementById('mdp2');
	const butto_mdb2 = document.getElementById('but2-mdp');
	const input_mdb3 = document.getElementById('mdp3');
	const butto_mdb3 = document.getElementById('but3-mdp');
	ChangerSvgMdp(butto_mdb1, input_mdb1);
	ChangerSvgMdp(butto_mdb2, input_mdb2);
	ChangerSvgMdp(butto_mdb3, input_mdb3);
});

function ChangerSvgMdp(buttoPass, inputPass) {
	// Contenu SVG pour l'œil ouvert
	const eyeOpenSVG = '<svg class="svg-mdp" viewBox="0 0 24 24"><path d="M15.0007 12C15.0007 13.6569 13.6576 15 12.0007 15C10.3439 15 9.00073 13.6569 9.00073 12C9.00073 10.3431 10.3439 9 12.0007 9C13.6576 9 15.0007 10.3431 15.0007 12Z"/><path d="M12.0012 5C7.52354 5 3.73326 7.94288 2.45898 12C3.73324 16.0571 7.52354 19 12.0012 19C16.4788 19 20.2691 16.0571 21.5434 12C20.2691 7.94291 16.4788 5 12.0012 5Z"/></svg>';
	// Contenu SVG pour l'œil fermé
	const eyeClosedSVG = '<svg class="svg-mdp" viewBox="0 0 24 24"><path d="M2.99902 3L20.999 21M9.8433 9.91364C9.32066 10.4536 8.99902 11.1892 8.99902 12C8.99902 13.6569 10.3422 15 11.999 15C12.8215 15 13.5667 14.669 14.1086 14.133M6.49902 6.64715C4.59972 7.90034 3.15305 9.78394 2.45703 12C3.73128 16.0571 7.52159 19 11.9992 19C13.9881 19 15.8414 18.4194 17.3988 17.4184M10.999 5.04939C11.328 5.01673 11.6617 5 11.9992 5C16.4769 5 20.2672 7.94291 21.5414 12C21.2607 12.894 20.8577 13.7338 20.3522 14.5"/></svg>';

	// Remplacer le bouton vide par le SVG
	buttoPass.innerHTML = eyeClosedSVG;

	// Remplacer le bouton et le type
	buttoPass.addEventListener('click', function() {
		if (inputPass.type === 'password') {
			inputPass.type = 'text';
			buttoPass.innerHTML = eyeOpenSVG;
		} else {
			inputPass.type = 'password';
			buttoPass.innerHTML = eyeClosedSVG;
		}
	});
}

/****************************************************************************************************/
/****************************************************************************************************/

document.addEventListener("DOMContentLoaded", function() {
	const div_con = document.getElementById('con');
	const div_cre = document.getElementById('cre');
	const body_c = document.getElementById('conteneur');
	ChangerDiv(div_con, body_c, 'con', 'cre');
	ChangerDiv(div_cre, body_c, 'cre', 'con');
});

function ChangerDiv(divC, bodyC, class1, class2) {
	divC.addEventListener('click', function() {
		bodyC.classList.add(class1);
		bodyC.classList.remove(class2);
	});
}

/****************************************************************************************************/
/****************************************************************************************************/

document.addEventListener("DOMContentLoaded", function() {
	const logoImg = document.querySelector('.img1-co');
	logoImg.addEventListener('click', function() {
		window.location.href = '../';
	});
});
</script>
</body>
</html>

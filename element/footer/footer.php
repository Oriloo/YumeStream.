<?php
switch ($ProvenancePage) {
    case 'niv0':
        $DistanceChemin = '';
        break;
    
    case 'niv1':
        $DistanceChemin = '../';
        break;
        
    case 'niv2':
        $DistanceChemin = '../../';
        break;

    default:
        // code...
        break;
}
?>

<footer>
	<div class="footer-haut">
		<span>Vous ne pouvez pas aller plus bas !</span>
	</div>
	<div class="footer-bas">
		<div class="information">
			<div class="info-nav info-footer">
				<h4>Navigation</h4>
				<ol>
					<li><a href="<?php echo $DistanceChemin; ?>">Accueli</a></li>
					<li><a href="<?php echo $DistanceChemin; ?>video/parcourir/">Parcourir</a></li>
					<li><a href="<?php echo $DistanceChemin; ?>video/nouveau/">Nouveaux</a></li>
					<li><a href="<?php echo $DistanceChemin; ?>contenu/programme/">Programme</a></li>
					<li><a href="<?php echo $DistanceChemin; ?>contenu/classement/">Classement</a></li>
					<li><a href="<?php echo $DistanceChemin; ?>video/film/">Flims</a></li>
					<li><a href="<?php echo $DistanceChemin; ?>contenu/actualite/">Actualité</a></li>
				</ol>
			</div>
			<div class="info-uti info-footer">
				<h4>Utilisateur</h4>
				<ol>
				<?php echo ($user_id != 0)
				 ? '<li><a href="'.$DistanceChemin.'profil/">Mon profli</a></li>
					<li><a href="'.$DistanceChemin.'profil/compte/">Compte</a></li>
					<li><a href="'.$DistanceChemin.'profil/parametre/">Paramètres</a></li>
					<li><a href="'.$DistanceChemin.'profil/liste/">Anime liste</a></li>
					<li><a href="'.$DistanceChemin.'profil/historique/">Historique</a></li>
					<li><a href="'.$DistanceChemin.'profil/notification/">Notifications</a></li>
					<li><a href="'.$DistanceChemin.'connexion/script_deconnexion.php">Se déconnecter</a></li>'
				 : '<li><a href="'.$DistanceChemin.'connexion/">Se Connecter</a></li>';
				?>
				</ol>
			</div>
			<div class="info-con info-footer">
				<h4>Contact</h4>
				<ol>
					<li><a href="https://discord.gg/g9dVyUQz8q" target="_blank">Discord</a></li>
				</ol>
			</div>
			<div class="info-apr info-footer">
				<h4>Légal</h4>
				<ol>
					<li><a href="#">À propos</a></li>
					<li><a href="#">Aide</a></li>
					<li><a href="#">Conditions générale</a></li>
					<li><a href="#">Confidentialité</a></li>
					<li><a href="#">Cookies</a></li>
				</ol>
			</div>
		</div>
		<div class="footer-bar">
			<img class="logo logo-acceui" src="<?php echo $DistanceChemin; ?>Element/image/logo/YumeStream-nom-logo256.png"><br>
			<span class="bar-copy1">&copy; 2024 YumeStream.
				<span class="bar-copy2">- Tous droits réservés</span>
			</span>
		</div>
	</div>
</footer>

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

<nav class="nav-bar">
	<div class="nav-left">
		<input class="checkbox" type="checkbox" name="BARmenu" id="BARmenu"/>
		<div class="hamburger-lines">
			<span class="line line1"></span>
			<span class="line line2"></span>
			<span class="line line3"></span>
		</div>
		<img class="logo logo-acceuil" src="<?php echo $DistanceChemin; ?>element/image/logo/YumeStream-nom-logo256.png">
		<menu class="menu-items"><ol>
			<div class="menu-titre">NAVIGATION</div>
				<li data-url="<?php echo $DistanceChemin; ?>">Accueil</li>
				<li data-url="<?php echo $DistanceChemin; ?>video/parcourir/">Parcourir</li>
				<li data-url="<?php echo $DistanceChemin; ?>video/nouveau/">Nouveaux</li>
				<li data-url="<?php echo $DistanceChemin; ?>contenu/programme/">Programme</li>
				<li data-url="<?php echo $DistanceChemin; ?>contenu/classement/">Classement</li>
				<li data-url="<?php echo $DistanceChemin; ?>video/film/">Films</li>
				<li data-url="<?php echo $DistanceChemin; ?>contenu/actualite/">Actualité</li>
			<div id="derouler" class="menu-titre">
				<a>GENRES</a>
				<svg class="svg-fleche" viewBox="0 0 764.95 478.09"><path d="M782.47,256.57,686.86,161,400,447.81,113.14,161,17.53,256.57,400,639.05Z" transform="translate(-17.53 -160.95)"/></svg>
			</div>
				<li data-url="<?php echo $DistanceChemin; ?>video/parcourir/?genre=action" class="genre">Action</li>
				<li data-url="<?php echo $DistanceChemin; ?>video/parcourir/?genre=avant-garde" class="genre">Avant Garde</li>
				<li data-url="<?php echo $DistanceChemin; ?>video/parcourir/?genre=aventure" class="genre">Aventure</li>
				<li data-url="<?php echo $DistanceChemin; ?>video/parcourir/?genre=boys-love" class="genre">Boys Love</li>
				<li data-url="<?php echo $DistanceChemin; ?>video/parcourir/?genre=comedie" class="genre">Comédie</li>
				<li data-url="<?php echo $DistanceChemin; ?>video/parcourir/?genre=drame" class="genre">Drame</li>
				<li data-url="<?php echo $DistanceChemin; ?>video/parcourir/?genre=fantaisie" class="genre">Fantaisie</li>
				<li data-url="<?php echo $DistanceChemin; ?>video/parcourir/?genre=girls-love" class="genre">Girls Love</li>
				<li data-url="<?php echo $DistanceChemin; ?>video/parcourir/?genre=gourmet" class="genre">Gourmet</li>
				<li data-url="<?php echo $DistanceChemin; ?>video/parcourir/?genre=horreur" class="genre">Horreur</li>
				<li data-url="<?php echo $DistanceChemin; ?>video/parcourir/?genre=mystere" class="genre">Mystère</li>
				<li data-url="<?php echo $DistanceChemin; ?>video/parcourir/?genre=romance" class="genre">Romance</li>
				<li data-url="<?php echo $DistanceChemin; ?>video/parcourir/?genre=sci-fi" class="genre">Science-Fiction</li>
				<li data-url="<?php echo $DistanceChemin; ?>video/parcourir/?genre=sports" class="genre">Sports</li>
				<li data-url="<?php echo $DistanceChemin; ?>video/parcourir/?genre=surnaturel" class="genre">Surnaturel</li>
				<li data-url="<?php echo $DistanceChemin; ?>video/parcourir/?genre=suspense" class="genre">Suspense</li>
				<li data-url="<?php echo $DistanceChemin; ?>video/parcourir/?genre=tranche-de-vie" class="genre">Tranche de Vie</li>
			<div class="separateur"></div>
			<div class="menu-titre">UTILISATEUR
			<?php echo ($user_name) ? " : ".$user_name : ""; ?></div>
			<?php echo ($user_id != 0)
			 ? '<li data-url="'.$DistanceChemin.'profil/">Mon profil</li>
				<li data-url="'.$DistanceChemin.'profil/compte/">Compte</li>
				<li data-url="'.$DistanceChemin.'profil/parametre/">Paramètres</li>
				<li data-url="'.$DistanceChemin.'profil/liste/">Anime liste</li>
				<li data-url="'.$DistanceChemin.'profil/historique/">Historique</li>
				<li data-url="'.$DistanceChemin.'profil/notification/">Notifications</li>
				<li data-url="'.$DistanceChemin.'connexion/script_deconnexion.php">Se déconnecter</li>'
			 : '<li data-url="'.$DistanceChemin.'connexion/">Se Connecter</li>';
			?>
		</ol></menu>
	</div>
	<div class="nav-center">
		<ol class="nav-center-ol">
			<li class="li-accu"><a href='<?php echo $DistanceChemin;?>'>ACCUEIL</a></li>
			<li class="li-parc"><a href='<?php echo $DistanceChemin;?>video/parcourir/'>PARCOURIR</a></li>
			<li class="li-nouv"><a href='<?php echo $DistanceChemin;?>video/nouveau/'>NOUVEAUX</a></li>
			<li class="li-prog"><a href='<?php echo $DistanceChemin;?>contenu/programme/'>PROGRAMME</a></li>
			<li class="li-clas"><a href='<?php echo $DistanceChemin;?>contenu/classement/'>CLASSEMENT</a></li>
			<li class="li-film"><a href='<?php echo $DistanceChemin;?>video/film/'>FILMS</a></li>
			<li class="li-actu"><a href='<?php echo $DistanceChemin;?>contenu/actualite/'>ACTUALITÉ</a></li>
		</ol>
	</div>
	<div class="nav-right">
		<input class="checkbox" type="checkbox" name="BARprofil" id="BARprofil"/>
		<ol class="nav-right-ol"><li  data-url="<?php echo $DistanceChemin; ?>video/parcourir/"><div>
			<svg class="svg-right" viewBox="0 0 24 24"><path d="M14.9536 14.9458L21 21M17 10C17 13.866 13.866 17 10 17C6.13401 17 3 13.866 3 10C3 6.13401 6.13401 3 10 3C13.866 3 17 6.13401 17 10Z"/></svg>
		</div></li>
		<?php echo ($user_id != 0) ? '<li class="svg0" data-url="'.$DistanceChemin.'profil/liste/"><div>
			<svg class="svg-right" viewBox="0 0 24 24"><path d="M5 6.2C5 5.07989 5 4.51984 5.21799 4.09202C5.40973 3.71569 5.71569 3.40973 6.09202 3.21799C6.51984 3 7.07989 3 8.2 3H15.8C16.9201 3 17.4802 3 17.908 3.21799C18.2843 3.40973 18.5903 3.71569 18.782 4.09202C19 4.51984 19 5.07989 19 6.2V21L12 16L5 21V6.2Z"/></svg>
		</div></li><li class="svg0" data-url="'.$DistanceChemin.'profil/historique/"><div>
			<svg class="svg-right" viewBox="0 0 24 24"><path d="M4 12C4 16.4183 7.58172 20 12 20C16.4183 20 20 16.4183 20 12C20 7.58172 16.4183 4 12 4C9.61061 4 7.46589 5.04751 6 6.70835C5.91595 6.80358 5.83413 6.90082 5.75463 7M12 8V12L14.5 14.5M5.75391 4.00391V7.00391H8.75391"/></svg>
		</div></li><li class="svg0" data-url="'.$DistanceChemin.'profil/notification/"><div>
			<svg class="svg-right" viewBox="0 0 24 24"><path d="M9.00195 17H5.60636C4.34793 17 3.71872 17 3.58633 16.9023C3.4376 16.7925 3.40126 16.7277 3.38515 16.5436C3.37082 16.3797 3.75646 15.7486 4.52776 14.4866C5.32411 13.1835 6.00031 11.2862 6.00031 8.6C6.00031 7.11479 6.63245 5.69041 7.75766 4.6402C8.88288 3.59 10.409 3 12.0003 3C13.5916 3 15.1177 3.59 16.2429 4.6402C17.3682 5.69041 18.0003 7.11479 18.0003 8.6C18.0003 11.2862 18.6765 13.1835 19.4729 14.4866C20.2441 15.7486 20.6298 16.3797 20.6155 16.5436C20.5994 16.7277 20.563 16.7925 20.4143 16.9023C20.2819 17 19.6527 17 18.3943 17H15.0003M9.00195 17L9.00031 18C9.00031 19.6569 10.3435 21 12.0003 21C13.6572 21 15.0003 19.6569 15.0003 18V17M9.00195 17H15.0003"/></svg>
		</div></li>' : ''; ?>
		<li><div>
			<?php echo ($user_pp)
			 ? '<img class="pp" src="'.$DistanceChemin.'Element/image/pp/'.$user_pp.'">'
			 : '<img class="pp" src="'.$DistanceChemin.'Element/image/pp/zzz-pp0.jpg">';
			?>
		</div></li></ol>
		<menu class="menu-profil <?php echo ($user_id == 0) ? "petit-menu" : ""; ?>"><ol>
			<div class="espacement"></div>
			<?php echo ($user_id != 0)
			 ? '<li data-url="'.$DistanceChemin.'profil/">Mom profil</li>
				<li data-url="'.$DistanceChemin.'profil/compte/">Compte</li>
				<li data-url="'.$DistanceChemin.'profil/parametre/">Paramètres</li>
				<div class="separateur"></div>
				<li data-url="'.$DistanceChemin.'profil/liste/">Anime liste</li>
				<li data-url="'.$DistanceChemin.'profil/historique/">Historique</li>
				<li data-url="'.$DistanceChemin.'profil/notification/">Notifications</li>
				<div class="separateur"></div>
				<li data-url="'.$DistanceChemin.'connexion/script_deconnexion.php">Se déconnecter</li>'
			 : '<li data-url="'.$DistanceChemin.'connexion/">Se Connecter</li>';
			?>
			<div class="espacement"></div>
		</ol></menu>
	</div>
</nav>

<div class="fond-gris"></div>

<script type="text/javascript">
// Récupère le titre de la page
let pageTitle = document.title;
// Enlève "AnimeTv | " du début du titre
let cleanTitle = pageTitle.replace(/^AnimeTv \| /, '');
// Correspondances entre cleanTitle et les classes des liens
const titleToClassMap = {
	'Accueil': 'li-accu',
	'Parcourir': 'li-parc',
	'Nouveau': 'li-nouv',
	'Programme': 'li-prog',
	'Classement': 'li-clas',
	'Film': 'li-film',
	'Actualité': 'li-actu'
};
// Ajouter la classe 'select' à l'élément correspondant
if (titleToClassMap[cleanTitle]) {
	document.querySelector('.' + titleToClassMap[cleanTitle] + ' a').classList.add('select');
}

document.addEventListener("DOMContentLoaded", function() {
	// Variables
	const logoImg = document.querySelector('.logo-acceuil');
	const genres = document.querySelectorAll(".genre");
	const svgFleche = document.querySelector(".svg-fleche");
	const fondGris = document.querySelector(".fond-gris");
	const BARmenu = document.getElementById("BARmenu");
	const BARprofil = document.getElementById("BARprofil");
	const menuProfil = document.querySelector(".menu-profil");
	const derouler = document.getElementById("derouler");

	// Redirection vers la page d'accueil lorsque le logo est cliqué
	logoImg.addEventListener('click', function() {
		window.location.href = '<?php echo $DistanceChemin; ?>';
	});

	let apparitionEnCours = false; // Variable pour suivre l'état d'exécution de apparitionGenres()

	// Fonction de présentation des genres avec animation
	function apparitionGenres() {
		apparitionEnCours = true; // Indiquer que l'apparition est en cours
		let delay = 50; // Délai entre chaque genre en millisecondes
		genres.forEach((genre, index) => {
			setTimeout(() => {
				if (!apparitionEnCours) return; // Vérifier si l'apparition est toujours en cours
				genre.style.display = "block";
				genre.classList.remove("out");
				genre.classList.add("in");
				svgFleche.classList.add("rotate-180p");
				svgFleche.classList.remove("rotate-180m");
			}, index * delay);
		});
	}

	// Fonction permettant de masquer les genres avec une animation
	function disparitionGenres() {
		apparitionEnCours = false; // Arrêter l'apparition si en cours
		genres.forEach((genre, index) => {
			setTimeout(() => {
				genre.classList.remove("in");
				genre.classList.add("out");
				setTimeout(() => {
					genre.style.display = "none";
				}, 100); // Durée de l'animation de sortie
				svgFleche.classList.add("rotate-180m");
				svgFleche.classList.remove("rotate-180p");
			}, (genres.length - index - 1) * 50); // Inverser l'ordre
		});
	}

	// Récepteur d'événements pour le clic sur le document afin de fermer les menus
	document.addEventListener("click", function(event) {
		const clickedMenu = event.target.closest(".menu-items") || event.target.classList.contains("menu-items");
		const clickedMenuP = event.target.closest(".menu-profil") || event.target.classList.contains("menu-profil");

		if (!clickedMenu && BARmenu.checked && event.target !== BARmenu) {
			disparitionGenres(); // Cacher les genres lorsque le menu est fermé
			fondGris.style.display = "none";
			document.body.style.overflowY = ""; // Rétablir le défilement
			BARmenu.checked = false; // Fermer le menu
		}

		if (!clickedMenuP && BARprofil.checked && event.target !== BARprofil) {
			fondGris.style.display = "none";
			document.body.style.overflowY = ""; // Rétablir le défilement
			BARprofil.checked = false; // Fermer le menu
		}
	});

	// Récepteur d'événements pour la modification de la case à cocher du menu
	BARmenu.addEventListener("change", function() {
		if (BARmenu.checked) {
			fondGris.style.display = "block";
			document.body.style.overflowY = "clip"; // Désactiver le défilement
		} else {
			fondGris.style.display = "none";
			disparitionGenres(); // Cacher les genres lorsque le menu est fermé
			document.body.style.overflowY = ""; // Rétablir le défilement
		}
	});

	// Récepteur d'événements pour la modification de la case à cocher du profil
	BARprofil.addEventListener("change", function() {
		if (BARprofil.checked) {
			fondGris.style.display = "block";
			document.body.style.overflowY = "clip"; // Désactiver le défilement
		} else {
			fondGris.style.display = "none";
			document.body.style.overflowY = ""; // Rétablir le défilement
		}
	});

	// Récepteur d'événements pour le clic sur la liste déroulante du genre
	derouler.addEventListener("click", function() {
		if (genres[0].style.display === "none" || genres[0].style.display === "") {
			apparitionGenres();
		} else {
			disparitionGenres();
		}
	});

	// Ajouter un récepteur d'événement de clic à chaque élément de menu
	const items = document.querySelectorAll('.menu-profil li, .menu-items li, .nav-right-ol li');
	items.forEach(function(item) {
		item.addEventListener('click', function() {
			const url = this.getAttribute('data-url');
			window.location.href = url;
		});
	});
});
</script>

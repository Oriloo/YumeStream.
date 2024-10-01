// https://owlcarousel2.github.io/OwlCarousel2/docs/started-welcome.html

$('.owl-carousel').owlCarousel({
	items: 3, // Le nombre d'éléments que vous souhaitez voir à l'écran.
	margin: 0, // Marge à droite (en pixels) sur l'élément.
	loop: false, // Boucle infinie. Duplique les derniers et premiers éléments pour créer une illusion de boucle.
	center: false, // Centrer l'élément. Fonctionne bien avec un nombre pair ou impair d'éléments.
	mouseDrag: true, // Glisser à la souris activé.
	touchDrag: true, // Glisser tactile activé.
	pullDrag: true, // Tirer l'étape vers le bord.
	freeDrag: false, // Tirer l'élément vers le bord.
	stagePadding: 0, // Remplissage à gauche et à droite sur la scène (pour voir les voisins).
	merge: false, // Fusionner les éléments. Recherche data-merge='{nombre}' à l'intérieur de l'élément.
	mergeFit: true, // Ajuster les éléments fusionnés si l'écran est plus petit que la valeur des éléments.
	autoWidth: false, // Définir le contenu non en grille. Essayez d'utiliser le style width sur les divs.
	startPosition: 0, // Position de départ ou chaîne de hachage d'URL comme '#id'.
	URLhashListener: false, // Écouter les changements de hachage d'URL. data-hash sur les éléments est requis.
	nav: false, // Afficher les boutons suivant/précédent.
	rewind: true, // Reculer lorsque la limite est atteinte.
	navText: ['suivant','précédent'], // HTML autorisé.
	navElement: 'div', // Type d'élément DOM pour un lien de navigation unidirectionnel.
	slideBy: 1, // Navigation par glissement de x. La chaîne 'page' peut être définie pour glisser par page.
	slideTransition: '', // Vous pouvez définir la transition pour la scène que vous souhaitez utiliser, par exemple linéaire.
	dots: true, // Afficher la navigation par points.
	dotsEach: false, // Afficher un point tous les x éléments.
	dotsData: false, // Utilisé par le contenu data-dot.
	lazyLoad: false, // Chargement paresseux des images. data-src et data-src-retina pour haute résolution. Charge également les images en arrière-plan si l'élément n'est pas <img>.
	lazyLoadEager: 0, // Charge paresseusement les images vers la droite (et la gauche lorsque la boucle est activée) en fonction du nombre d'éléments que vous souhaitez précharger.
	autoplay: false, // Lecture automatique.
	autoplayTimeout: 5000, // Délai d'intervalle de lecture automatique.
	autoplayHoverPause: false, // Mettre en pause au survol de la souris.
	smartSpeed: 250, // Calcul de la vitesse. Plus d'informations à venir.
	fluidSpeed: false, // Calcul de la vitesse. Plus d'informations à venir.
	autoplaySpeed: false, // Vitesse de lecture automatique.
	navSpeed: false, // Vitesse de navigation.
	dotsSpeed: false, // Vitesse de pagination.
	dragEndSpeed: false, // Vitesse de fin de glissement.
	callbacks: true, // Activer les événements de rappel.
	responsive: {}, // Objet contenant des options de réponse. Peut être défini sur false pour supprimer les capacités de réponse.
	responsiveRefreshRate: 200, // Taux de rafraîchissement réactif.
	responsiveBaseElement: window, // Définir sur n'importe quel élément DOM. Si vous vous souciez des navigateurs non réactifs (comme IE8), utilisez-le sur l'emballage principal. Cela évitera les redimensionnements fous.
	video: false, // Activer le chargement des vidéos YouTube/Vimeo/Vzaar.
	videoHeight: false, // Définir la hauteur des vidéos.
	videoWidth: false, // Définir la largeur des vidéos.
	animateOut: false, // Classe pour l'animation CSS3 de sortie.
	animateIn: false, // Classe pour l'animation CSS3 d'entrée.
	fallbackEasing: 'swing', // Rétrogradation pour $.animate CSS2.
	info: false, // Rappel pour récupérer des informations de base (élément actuel/pages/largeurs). Le deuxième paramètre de la fonction Info est une référence d'objet DOM Owl.
	nestedItemSelector: false, // Utilisez-le si les éléments de hibou sont profondément imbriqués à l'intérieur de certains contenus générés. Par exemple, 'votreélément'. Ne pas utiliser de point avant le nom de la classe.
	itemElement: 'div', // Type d'élément DOM pour owl-item.
	stageElement: 'div', // Type d'élément DOM pour owl-stage.
	navContainer: false, // Définir votre propre conteneur pour la navigation.
	dotsContainer: false, // Définir votre propre conteneur pour les points de navigation.
	checkVisible: true, // Vérifier si les éléments sont visibles.
})

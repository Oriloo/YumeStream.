# Documentation détaillée pour la bibliothèque CarrouselRoll

## Introduction
CarrouselRoll est une bibliothèque JavaScript simple pour créer des carrousels d'images ou de cartes de contenu. Cette documentation explique comment importer les fichiers JavaScript et CSS nécessaires, puis comment initialiser et utiliser le carrousel sur votre site Web.

## Importation des fichiers
Pour utiliser CarrouselRoll, vous devez d'abord inclure les fichiers JavaScript et CSS dans votre document HTML.

### HTML
Ajoutez les lignes suivantes dans la section `<head>` de votre fichier HTML pour importer le CSS et dans la section `<body>` pour importer le JavaScript:

```html
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Carrousel Crunchyroll</title>
    <link rel="stylesheet" type="text/css" href="CarrouselRoll.css">
    <style type="text/css">
        body {
            font-family: Arial, sans-serif;
            background-color: #000;
            color: #fff;
            margin: 0;
            padding: 0;
        }
    </style>
</head>
<body>
    <!-- Votre contenu de carrousel ici -->
    
    <script type="text/javascript" src="CarrouselRoll.js"></script>
    <script>
        // Initialize carousels
        CarrouselRoll('carousel1');
    </script>
</body>
</html>
```

## Structure HTML du Carrousel
Pour créer un carrousel, utilisez la structure HTML suivante. Assurez-vous d'avoir des éléments avec les classes `carousel-container`, `left-arrow`, `right-arrow`, `carousel-track-container` et `carousel-track`.

### Exemple de carrousel
```html
<div id="carousel1" class="carouselRoll-container">
    <button class="carousel-arrow left-arrow" aria-label="Précédent">‹</button>
    <div class="carousel-track-container">
        <div class="carousel-track">
            <!-- Ajoutez vos cartes de contenu ici -->
            <div class="carousel-card">
                <div class="carousel-card-top">
                    <img src="https://cdn.myanimelist.net/images/anime/1015/138006l.jpg">
                </div>
                <div class="carousel-card-bottom">
                    <h4>Sousou no Frieren</h4>
                </div>
            </div>
            <!-- Répétez pour d'autres cartes -->
        </div>
    </div>
    <button class="carousel-arrow right-arrow" aria-label="Suivant">›</button>
</div>
```

## Initialisation du Carrousel
Après avoir structuré votre HTML, vous devez initialiser le carrousel en appelant la fonction `CarrouselRoll` avec l'ID de votre conteneur de carrousel.

### Exemple d'initialisation
```html
<script type="text/javascript" src="CarrouselRoll.js"></script>
<script>
    // Initialize carousels
    CarrouselRoll('carousel1');
</script>
```

## Explications des paramètres et du fonctionnement

### Sélecteurs et éléments
- `carouselId`: L'ID du conteneur de la piste du carrousel.
- `leftArrow` et `rightArrow`: Sélecteurs pour les boutons de navigation gauche et droite.
- `track`: La piste du carrousel contenant les cartes.

### Comportement
- `currentScrollPosition`: Position actuelle du défilement du carrousel.
- `scrollAmount`: Quantité de défilement définie à 94% de la largeur de la fenêtre.
- `threshold`: Seuil pour afficher ou masquer les flèches de navigation, défini à 10% de la largeur de la fenêtre.

### Fonctions
- `updateArrowVisibility`: Met à jour la visibilité des flèches de navigation en fonction de la position actuelle du défilement.
- `leftArrow.addEventListener('click', ...)` et `rightArrow.addEventListener('click', ...)`: Écouteurs d'événements pour les flèches de navigation permettant de faire défiler la piste du carrousel.

### Gestion de la fenêtre redimensionnée
Un écouteur d'événements sur `window` met à jour `scrollAmount` lorsque la fenêtre est redimensionnée.

### Initialisation
- `updateArrowVisibility`: Vérifie initialement la visibilité des flèches de navigation.

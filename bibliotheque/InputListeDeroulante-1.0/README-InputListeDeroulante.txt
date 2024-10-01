### Documentation de la bibliothèque `InputListeDeroulante-1.0`

La bibliothèque `InputListeDeroulante-1.0` permet de créer un champ de saisie avec une liste déroulante personnalisée, offrant des options de sélection multiple, de recherche et diverses personnalisations. Voici une description détaillée de chaque option et comment utiliser cette bibliothèque.

#### Utilisation de la bibliothèque

Pour utiliser `InputListeDeroulante-1.0`, vous devez inclure les fichiers CSS et JavaScript dans votre projet, puis appeler la fonction avec les paramètres appropriés.

#### Exemple de base

```html
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sélectionner des Éléments</title>
    <link rel="stylesheet" href="path/to/InputListeDeroulante.css">
</head>
<body>
    <form action="" method="post">
        <div id="container1"></div>
        <button type="submit">Submit</button>
    </form>

    <script src="path/to/InputListeDeroulante.js"></script>
    <script>
        InputListeDeroulante(document.querySelector('#container1'), {
            liste: ['Action', 'Comédie', 'Drame', 'Fantastique', 'Horreur', 'Romance', 'Science-fiction'],
            id: 'input1', // L'identifiant unique de l'input text
            name: 'elements1', // Le nom de l'input text
            placeholder: 'Sélectionnez des éléments', // Le texte d'espace réservé pour l'input text
            customClass: 'my-custom-class', // Classe CSS personnalisée
            required: true, // Le champ input sera requis
            requiredMax: 5, // Nombre maximum de sélections
            requiredMin: 1, // Nombre minimum de sélections
            searchable: true, // Ajouter une barre de recherche
            noResultsText: 'Aucun résultat trouvé', // Texte à afficher lorsqu'il n'y a aucun résultat
            customButtonLabel: 'Choisir', // Personnaliser le label du bouton
            preselect: ['Action', 'Drame', 'Fantastique'] // Éléments présélectionnés
        });
    </script>
</body>
</html>
```

### Description des options

#### `liste`
- **Type**: `Array<String>`
- **Description**: La liste des éléments à afficher dans la liste déroulante.
- **Exemple**: `['Action', 'Comédie', 'Drame', 'Fantastique', 'Horreur', 'Romance', 'Science-fiction']`

#### `id`
- **Type**: `String`
- **Description**: L'identifiant unique de l'input text.
- **Exemple**: `'input1'`

#### `name`
- **Type**: `String`
- **Description**: Le nom de l'input text, utilisé lors de la soumission du formulaire.
- **Exemple**: `'elements1'`

#### `placeholder`
- **Type**: `String`
- **Description**: Le texte d'espace réservé pour l'input text.
- **Exemple**: `'Sélectionnez des éléments'`

#### `customClass`
- **Type**: `String`
- **Description**: Une classe CSS personnalisée à ajouter au conteneur de l'input.
- **Exemple**: `'my-custom-class'`

#### `required`
- **Type**: `Boolean`
- **Description**: Indique si le champ input est requis.
- **Exemple**: `true`

#### `requiredMax`
- **Type**: `Number`
- **Description**: Le nombre maximum de sélections autorisées.
- **Exemple**: `5`

#### `requiredMin`
- **Type**: `Number`
- **Description**: Le nombre minimum de sélections requises.
- **Exemple**: `1`

#### `searchable`
- **Type**: `Boolean`
- **Description**: Ajoute une barre de recherche pour filtrer les éléments de la liste.
- **Exemple**: `true`

#### `noResultsText`
- **Type**: `String`
- **Description**: Texte à afficher lorsqu'aucun résultat n'est trouvé dans la recherche.
- **Exemple**: `'Aucun résultat trouvé'`

#### `customButtonLabel`
- **Type**: `String`
- **Description**: Personnalise le label du bouton déroulant.
- **Exemple**: `'Choisir'`

#### `preselect`
- **Type**: `Array<String>`
- **Description**: Liste des éléments à présélectionner dans la liste déroulante.
- **Exemple**: `['Action', 'Drame', 'Fantastique']`

### Fonctionnement de la bibliothèque

1. **Création du conteneur** : La bibliothèque crée un conteneur pour l'input text, le bouton de la liste déroulante et la liste des éléments.
2. **Initialisation des éléments** : L'input text et la liste des éléments sont initialisés avec les options fournies.
3. **Gestion des événements** :
    - **Clic sur le bouton** : Ouvre ou ferme la liste déroulante.
    - **Recherche** : Filtre les éléments de la liste en fonction du texte saisi dans la barre de recherche.
    - **Sélection d'un élément** : Ajoute ou supprime un élément de la sélection.
    - **Clic en dehors** : Ferme la liste déroulante si un clic est détecté en dehors de celle-ci.
4. **Mise à jour des sélections** : Met à jour l'input text et l'input caché avec les éléments sélectionnés.
5. **Validation du formulaire** : Vérifie les contraintes `required`, `requiredMax` et `requiredMin` lors de la soumission du formulaire.

### Méthode d'utilisation

Pour utiliser la bibliothèque, vous devez appeler la fonction `InputListeDeroulante-1.0` et passer le conteneur cible ainsi qu'un objet de configuration contenant les options souhaitées. La fonction crée automatiquement l'interface utilisateur et gère les interactions utilisateur selon les options configurées.

Cette bibliothèque est utile pour créer des sélecteurs personnalisés et dynamiques avec des fonctionnalités avancées telles que la sélection multiple, la recherche et des contraintes personnalisées sur le nombre de sélections.

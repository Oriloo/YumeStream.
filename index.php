<?php
$CheminRedirection = "";
include('script/variables_bdd.php');
include("script/script_compte.php");
include("script/script_erreur.php");
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" href="element/image/logo/YumeStream-logo-yu256.png">
    <title>YumeStream.</title>

    <link rel="stylesheet" type="text/css" href="style.css">
    <link rel="stylesheet" type="text/css" href="element/navbar/navbar.css">
    <link rel="stylesheet" type="text/css" href="element/footer/footer.css">
    <link rel="stylesheet" type="text/css" href="bibliotheque/CarrouselRoll-1.0/CarrouselRoll.css" />
    <link rel="stylesheet" type="text/css" href="accueil/accueil.css">
</head>
<body>
<?php
$ProvenancePage = "niv0";
include("element/navbar/navbar.php");
include('accueil/listCarrouselRollBig.php');
?>

<div class="container1">
    <div id="carouselx" class="carouselRollBig-container">
        <button class="carousel-arrow left-arrow" aria-label="Précédent">‹</button>
        <div class="carousel-track-container">
            <div class="carousel-track">
                <?php foreach ($groupes as $groupe): ?>
                <div class="carousel-card">
                    <div class="fond-anime-card">
                        <img class="img-fond" src="<?php echo $groupe['lien_image']; ?>">
                        <div class="shadow-effect1"></div>
                        <div class="shadow-effect2"></div>
                    </div>
                    <div class="info-anime-card">
                        <a href="series/groupe/?id=<?php echo $groupe['groupe_id']; ?>">
                            <img class="img-logo" src="<?php echo $groupe['lien_logo']; ?>">
                        </a>
                        <br><br><span>Sous-titrer</span>
                        <p><?php echo $groupe['synopsis_groupe']; ?></p>
                        <div class="zone-btn">
                            <a href="series/groupe/?id=<?php echo $groupe['groupe_id']; ?>" class="btn-regarde">REGARDER</a>
                            <a class="btn-watchliste">∎</a>
                        </div>
                    </div>
                </div>
                <?php endforeach; ?>
            </div>
        </div>
        <button class="carousel-arrow right-arrow" aria-label="Suivant">›</button>

        <div id="barre-avancement" class="barre-avancement-carousel">
            <div id="barre-av1" class="barre-av active"></div>
            <div id="barre-av2" class="barre-av"></div>
            <div id="barre-av3" class="barre-av"></div>
            <div id="barre-av4" class="barre-av"></div>
            <div id="barre-av5" class="barre-av"></div>
            <div id="barre-av6" class="barre-av"></div>
        </div>
    </div>
</div>

<div class="page" id="carousel-container"></div>

<?php include("element/footer/footer.php"); ?>
<script src="bibliotheque/CarrouselRoll-1.0/CarrouselRoll.js"></script>
<script>
    // Initialize the main carousel
    CarrouselRollBig('carouselx', 'barre-avancement');

    let carouselIndex = 0;
    const maxCarousels = 20;

    // Function to load carousel content
    function loadCarouselContent(index) {
        if (index >= maxCarousels) {
            return;
        }
        fetch(`accueil/listCarrouselRoll.php?index=${index}`)
            .then(response => response.text())
            .then(html => {
                const container = document.createElement('div');
                container.classList.add('container', 'carousel-container');
                container.setAttribute('id', `carousel-container-${index}`);
                container.setAttribute('data-index', index);
                container.innerHTML = `
                    <h1>Sélection d'anime ${index + 1}</h1>
                    <div id="carousel${index}" class="carouselRoll-container" data-index="${index}">
                        <button class="carousel-arrow left-arrow" aria-label="Précédent">‹</button>
                        <div class="carousel-track-container">
                            <div class="carousel-track">${html}</div>
                        </div>
                        <button class="carousel-arrow right-arrow" aria-label="Suivant">›</button>
                    </div>
                `;
                document.getElementById('carousel-container').appendChild(container);
                CarrouselRoll(`carousel${index}`);
                observer.observe(container);
            })
            .catch(error => console.error('Error loading carousel content:', error));
    }

    // Intersection observer to load carousels on demand
    const observer = new IntersectionObserver((entries, observer) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                const index = parseInt(entry.target.dataset.index, 10);
                if (index === carouselIndex) {
                    loadCarouselContent(index + 1);
                    observer.unobserve(entry.target);
                    carouselIndex++;
                }
            }
        });
    }, {
        rootMargin: '0px 0px 200px 0px',
        threshold: 0.1
    });

    // Initial load
    loadCarouselContent(carouselIndex);

    // Start observing the first carousel container
    const initialContainer = document.createElement('div');
    initialContainer.classList.add('container', 'carousel-container');
    initialContainer.setAttribute('id', `carousel-container-${carouselIndex}`);
    initialContainer.setAttribute('data-index', carouselIndex);
    document.getElementById('carousel-container').appendChild(initialContainer);
    observer.observe(initialContainer);
</script>
</body>
</html>

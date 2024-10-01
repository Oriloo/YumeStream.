// fonction pour afficher ou cacher les formulaires
function toggleZone(zoneId) {
    var zone = document.getElementById(zoneId);
    if (zone.style.display === "" || zone.style.display === "none") {
        zone.style.display = "flex";
    } else {
        zone.style.display = "none";
    }
}

// Sélectionner les 'a1' au lancement de la page
toggleAction('ajouter-1', document.getElementById('a1-1'));
toggleAction('ajouter-2', document.getElementById('a1-2'));

// fonction permétant de choisire de faire un ajoue ou une modification
function toggleAction(action, element) {
    var choixDivs, searchInput, resultsDiv, selectDropdown;

    switch (action) {
        case 'ajouter-1':
        case 'modifier-1':
            choixDivs = document.querySelectorAll('.choix-1 a');
            searchInput = document.getElementById("search-1");
            resultsDiv = document.getElementById("results-1");
            selectDropdown = $('#ajou-modif-select-1');
            break;

        case 'ajouter-2':
        case 'modifier-2':
            choixDivs = document.querySelectorAll('.choix-2 a');
            searchInput = document.getElementById("search-2");
            resultsDiv = document.getElementById("results-2");
            selectDropdown = $('#ajou-modif-select-2');
            break;

        default:
            return; // Action non reconnue, sortir de la fonction
    }

    for (var i = 0; i < choixDivs.length; i++) {
        choixDivs[i].parentNode.classList.remove('choix-select');
    }
    element.parentNode.classList.add('choix-select');

    switch (action) {
        case 'ajouter-1':
        case 'ajouter-2':
            searchInput.disabled = true;
            resultsDiv.style.pointerEvents = "none";
            searchInput.value = ''; // Pour vider le champ de recherche
            $(resultsDiv).empty(); // Pour vider les résultats de recherche
            resetForm('form-' + action.slice(-1)); // Pour vider le formulaire correspondant
            selectDropdown.val('ajouter');
            break;

        case 'modifier-1':
        case 'modifier-2':
            searchInput.disabled = false;
            resultsDiv.style.pointerEvents = "auto";
            selectDropdown.val('modifier');
            break;
    }
}

// Fonction qui vide le formulaire
function resetForm(form) {
    switch (form) {
        case 'form-1':
            $('#id-groupe-select-1').val(''); // Pour vider le champ de l'ID du groupe
            $('#nom-groupe-1').val(''); // Pour vider le champ Nom du groupe
            $('#synopsis-groupe-1').val(''); // Pour vider le champ Synopsis du groupe
            $('#image-groupe-1').val(''); // Pour vider le champ image du logo du groupe
            $('#zone-image-groupe-1 img').attr('src', ''); // Pour vider l'image
            $('#lien-groupe-1').val(''); // Pour vider le champ Lien du logo du groupe
            $('#zone-logo-groupe-1 img').attr('src', ''); // Pour vider l'image du logo
            break;
        case 'form-2':
            $('#id-anime-select-2').val(''); // Pour vider le champ de l'ID de l'anime
            $('#nom-anime1-2').val(''); // Pour vider le champ Titre original de l'anime
            $('#nom-anime2-2').val(''); // Pour vider le champ Titre latiniser de l'anime
            $('#nom-anime3-2').val(''); // Pour vider le champ Titre anglais de l'anime
            $('#nom-anime4-2').val(''); // Pour vider le champ Titre français de l'anime
            $('#saisons-anime-2').val('0'); // Pour vider le champ Saison de l'anime
            $('#episodes-anime-2').val('0'); // Pour vider le champ Episodes de l'anime
            $('#duree-anime-2').val('0'); // Pour vider le champ Durée de l'anime
            $('#type-anime-2').val(''); // Pour vider le select Type de l'anime
            $('#status-anime-2').val(''); // Pour vider le select Statut de l'anime
            $('#start_date-anime-2').val(''); // Pour vider la date de début de l'anime
            $('#end_date-anime-2').val(''); // Pour vider la date de fin de l'anime
            $('#studios-anime-2').val(''); // Pour vider le champ Studios de l'anime
            $('#synopsis-anime-2').val(''); // Pour vider le champ Synopsis de l'anime
            $('#anime-groupe-2').val(''); // Pour vider le champ Groupe de l'anime
            $('#lien-anime-2').val(''); // Pour vider le champ Lien de l'affiche de l'anime
            $('#zone-affiche-anime-2 img').attr('src', ''); // Pour vider l'image de l'affiche
            $('#results-groupe-2').empty().css('display', 'none');
            $('#search-container').css('display', 'none');
            $('#search-query').val('');
            
            // Effacer les sélections précédentes pour genres et thèmes
            $('#anime-genres-input').empty();
            $('#anime-themes-input').empty();
            
            // Réinitialiser les listes déroulantes avec des valeurs pré-sélectionnées vides
            InputListeDeroulante(document.querySelector('#anime-genres-input'), {
                liste: liste_genres,
                id: 'genre-anime-2',
                name: 'genre-anime-2',
                customClass: 'my-custom-class',
                searchable: true,
                noResultsText: 'Aucun résultat trouvé',
                preselect: []
            });

            InputListeDeroulante(document.querySelector('#anime-themes-input'), {
                liste: liste_themes,
                id: 'theme-anime-2',
                name: 'theme-anime-2',
                customClass: 'my-custom-class',
                searchable: true,
                noResultsText: 'Aucun résultat trouvé',
                preselect: []
            });
            break;
    }
}

// function qui attend que la page soit pret
$(document).ready(function() {
    // Function to fetch results for groups
    function fetchResults(query) {
        $.ajax({
            url: 'script/search.php',
            method: 'POST',
            data: { query: query, type: 'group' },
            success: function(data) {
                $('#results-1').html(data);
                addResultItemClickEvent();
            }
        });
    }

    // Function to fetch results for animes
    function fetchResultsAnime(query) {
        $.ajax({
            url: 'script/search.php',
            method: 'POST',
            data: { query: query, type: 'anime' },
            success: function(data) {
                $('#results-2').html(data);
                addResultAnimeItemClickEvent();
            }
        });
    }

    // Function to fetch results for anime groups
    function searchAnimeGroup() {
        var query = $('#search-query').val();
        if (query.length > 0) {
            $.ajax({
                url: 'script/search.php',
                method: 'POST',
                data: { query: query, type: 'anime_group' },
                success: function(data) {
                    if (data.trim() === "") {
                        data = "<p>Aucun résultat trouvé</p>";
                    }
                    $('#results-groupe-2').html(data).css('display', 'block');
                    addResultAnimeGroupClickEvent();
                }
            });
        } else {
            $('#results-groupe-2').html("<p>Aucun résultat trouvé</p>").css('display', 'block');
        }
    }

    // Function to handle click event for anime group search results
    function addResultAnimeGroupClickEvent() {
        $('.result-item-groupe-2').on('click', function() {
            var groupName = $(this).find('p').text();
            var groupId = $(this).find('input[name="groupe_id"]').val();

            $('#anime-groupe-2').val(groupName);
            // $('#id-anime-select-2').val(groupId);
            $('#search-query').val('');
            $('#search-container').css('display', 'none');
            $('#results-groupe-2').empty().css('display', 'none');
        });
    }

    function addResultItemClickEvent() {
        $('.result-item-groupe-1').on('click', function() {
            var name_1 = $(this).find('p').text();
            var id_1 = $(this).find('input[name="groupe_id"]').val();
            var synopsis_1 = $(this).find('input[name="synopsis_groupe"]').val();
            var logoLink_1 = $(this).find('img').attr('src');
            var imageLink_1 = $(this).find('input[name="lien_image"]').val();

            $('#nom-groupe-1').val(name_1);
            $('#synopsis-groupe-1').val(synopsis_1);
            $('#lien-groupe-1').val(logoLink_1);
            $('#logo-preview-1').attr('src', logoLink_1);
            $('#zone-logo-groupe-1 img').attr('src', logoLink_1);
            $('#id-groupe-select-1').val(id_1);
            $('#image-groupe-1').val(imageLink_1);
            $('#image-preview-1').attr('src', imageLink_1);
        });
    }

    // Function to handle click event for anime search results
    function addResultAnimeItemClickEvent() {
        $('.result-item-anime-2').on('click', function() {
            var animeId = $(this).find('input[name="anime_id"]').val();
            var groupeId = $(this).find('input[name="groupe_id"]').val();
            var tOriginal = $(this).find('input[name="t_original"]').val();
            var tLatiniser = $(this).find('input[name="t_latiniser"]').val();
            var tAnglais = $(this).find('input[name="t_anglais"]').val();
            var tFrancais = $(this).find('input[name="t_francais"]').val();
            var lienImage = $(this).find('input[name="lien_image"]').val();
            var type = $(this).find('input[name="type"]').val();
            var status = $(this).find('input[name="status"]').val();
            var studios = $(this).find('input[name="studios"]').val();
            var saisons = $(this).find('input[name="saisons"]').val();
            var episodes = $(this).find('input[name="episodes"]').val();
            var duree = $(this).find('input[name="duree"]').val();
            var startDate = $(this).find('input[name="start_date"]').val();
            var endDate = $(this).find('input[name="end_date"]').val();
            var genre = $(this).find('input[name="genre"]').val();
            var theme = $(this).find('input[name="theme"]').val();
            var synopsis = $(this).find('input[name="synopsis"]').val();

            $('#id-anime-select-2').val(animeId);
            $('#nom-anime1-2').val(tOriginal);
            $('#nom-anime2-2').val(tLatiniser);
            $('#nom-anime3-2').val(tAnglais);
            $('#nom-anime4-2').val(tFrancais);
            $('#lien-anime-2').val(lienImage);
            $('#zone-affiche-anime-2 img').attr('src', lienImage);
            $('#type-anime-2').val(type);
            $('#status-anime-2').val(status);
            $('#studios-anime-2').val(studios);
            $('#saisons-anime-2').val(saisons);
            $('#episodes-anime-2').val(episodes);
            $('#duree-anime-2').val(duree);
            $('#start_date-anime-2').val(startDate);
            $('#end_date-anime-2').val(endDate);
            $('#synopsis-anime-2').val(synopsis);

            // Fetch group name using AJAX
            $.ajax({
                url: 'script/get_group_name.php',
                method: 'POST',
                data: { groupe_id: groupeId },
                dataType: 'json',
                success: function(response) {
                    var groupName = response.nom_groupe;
                    var displayName = groupName + '#' + groupeId;
                    $('#anime-groupe-2').val(displayName);
                },
                error: function(xhr, status, error) {
                    console.error('Error fetching group name:', error);
                }
            });

            // Split genre and theme values and preselect them
            var genreIds = genre.split('&');
            var themeIds = theme.split('&');

            var preselectGenres = [];
            var preselectThemes = [];

            genreIds.forEach(function(id) {
                var genreItem = liste_genres.find(item => item.split('#')[1] === id);
                if (genreItem) {
                    preselectGenres.push(genreItem);
                }
            });

            themeIds.forEach(function(id) {
                var themeItem = liste_themes.find(item => item.split('#')[1] === id);
                if (themeItem) {
                    preselectThemes.push(themeItem);
                }
            });

            // Clear previous selections
            $('#anime-genres-input').empty();
            $('#anime-themes-input').empty();

            // Reinitialize InputListeDeroulante with preselected values
            InputListeDeroulante(document.querySelector('#anime-genres-input'), {
                liste: liste_genres,
                id: 'genre-anime-2',
                name: 'genre-anime-2',
                customClass: 'my-custom-class',
                searchable: true,
                noResultsText: 'Aucun résultat trouvé',
                preselect: preselectGenres
            });

            InputListeDeroulante(document.querySelector('#anime-themes-input'), {
                liste: liste_themes,
                id: 'theme-anime-2',
                name: 'theme-anime-2',
                customClass: 'my-custom-class',
                searchable: true,
                noResultsText: 'Aucun résultat trouvé',
                preselect: preselectThemes
            });
        });
    }

    // Function to toggle search container
    function toggleSearch() {
        var searchContainer = $('#search-container');
        if (searchContainer.css('display') === 'none') {
            searchContainer.css('display', 'block');
            searchAnimeGroup(); // Show "Aucun résultat trouvé" initially
        } else {
            searchContainer.css('display', 'none');
            $('#results-groupe-2').empty().css('display', 'none');
        }
    }

    // Function to clear search input and results
    function clearSearch() {
        $('#search-query').val('');
        $('#anime-groupe-2').val('');
        $('#results-groupe-2').html("<p>Aucun résultat trouvé</p>").css('display', 'block');
    }

    // Expose functions globally if needed
    window.searchAnimeGroup = searchAnimeGroup;
    window.toggleSearch = toggleSearch;
    window.clearSearch = clearSearch;
    window.resetForm = resetForm;

    // Update image preview when the user modifies the link
    $('#image-groupe-1').on('input', function() {
        var imageLink_1 = $(this).val();
        $('#zone-image-groupe-1 img').attr('src', imageLink_1);
    });

    // Update image preview when the user modifies the link
    $('#lien-groupe-1').on('input', function() {
        var logoLink_1 = $(this).val();
        $('#zone-logo-groupe-1 img').attr('src', logoLink_1);
    });

    $('#lien-anime-2').on('input', function() {
        var imageLink = $(this).val();
        $('#zone-affiche-anime-2 img').attr('src', imageLink);
    });

    // Fetch results on search input change
    $('#search-1').on('input', function() {
        var query = $(this).val();
        if (query.length > 0) {
            fetchResults(query);
        } else {
            $('#results-1').empty();
        }
    });

    $('#search-2').on('input', function() {
        var query = $(this).val();
        if (query.length > 0) {
            fetchResultsAnime(query);
        } else {
            $('#results-2').empty();
        }
    });

    // Ensure a group is selected when submitting the form
    $('#groupeForm-1').on('submit', function(event) {
        var action = $('#ajou-modif-select-1').val();
        if (action === 'modifier' && $('#id-groupe-select-1').val() === '') {
            alert("Veuillez sélectionner un groupe à modifier.");
            event.preventDefault();
        }
    });

    $('#groupeForm-2').on('submit', function(event) {
        var action = $('#ajou-modif-select-2').val();
        if (action === 'modifier' && $('#id-anime-select-2').val() === '') {
            alert("Veuillez sélectionner un anime à modifier.");
            event.preventDefault();
        }
    });
});

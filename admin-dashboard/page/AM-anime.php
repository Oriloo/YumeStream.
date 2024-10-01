<div class="container-form" id="form-2">
	<div class="zone1">
		<h2>Ajouter/Modifier un Anime</h2>
		<button id="btn-2" onclick="toggleZone('zone2-2')">Afficher/Cacher</button>
	</div>
	<div class="zone2" id="zone2-2">
        <div class="zone2-recherche">
            <div class="choix choix-2">
                <div class="a1 choix-select"><a id="a1-2" onclick="toggleAction('ajouter-2', this)">ajouter</a></div>
                <div class="a2"><a id="a2-2" onclick="toggleAction('modifier-2', this)">modifier</a></div>
            </div>
            <div class="bar-recherche" id="bar-recherche-2">
                <input type="text" name="recherche-2" id="search-2" placeholder="rechercher un groupe *" disabled>
            </div>
            <div class="affiche-recherche" id="results-2" style="pointer-events: none;"></div>
        </div>
		<div class="zone2-form">
			<form id="groupeForm-2" action="script/save_anime.php" method="post">
                <input type="hidden" name="ajou-modif-select-2" id="ajou-modif-select-2" value="ajouter" required />
                <input type="hidden" name="id-anime-select-2" id="id-anime-select-2" value="" />
				<div class="sous-colonne">
				<div class="colonnes">
					<div class="champ-form-plusieurs">
						<div><label>Titres de l'anime :</label></div>
						<div class="champ-form">
							<label for="nom-anime1-2">Original *</label>
							<input type="text" name="nom-anime1-2" id="nom-anime1-2" maxlength="300" required>
						</div>
						<div class="champ-form">
							<label for="nom-anime2-2">Latiniser</label>
							<input type="text" name="nom-anime2-2" id="nom-anime2-2" maxlength="300">
						</div>
						<div class="champ-form">
							<label for="nom-anime3-2">Anglais</label>
							<input type="text" name="nom-anime3-2" id="nom-anime3-2" maxlength="300">
						</div>
						<div class="champ-form">
							<label for="nom-anime4-2">Français</label>
							<input type="text" name="nom-anime4-2" id="nom-anime4-2" maxlength="300">
						</div>
					</div>
					<div class="champ-form-plusieurs">
						<label>Le format de l'anime :</label>
						<div class="champ-form">
							<label for="saisons-anime-2">La saison</label>
							<input type="number" name="saisons-anime-2" id="saisons-anime-2" min="0" max="120" value="0">
						</div>
						<div class="champ-form">
							<label for="episodes-anime-2">Épisodes</label>
							<input type="number" name="episodes-anime-2" id="episodes-anime-2" min="0" max="32000" value="0">
						</div>
						<div class="champ-form">
							<label for="episodes-anime-2">Durée (min)</label>
							<input type="number" name="duree-anime-2" id="duree-anime-2" min="0" max="32000" value="0">
						</div>
						<div class="champ-form">
							<label for="type-anime-2">Le type</label>
							<select name="type-anime-2" id="type-anime-2">
								<option value="">Choisissez un type</option>
								<option value="tv">TV</option>
								<option value="ona">ONA</option>
								<option value="film">Film</option>
								<option value="short">TV Short</option>
								<option value="oav">OAV</option>
								<option value="special">Special</option>
							</select>
						</div>
						<div class="champ-form">
							<label for="status-anime-2">Le statut *</label>
							<select name="status-anime-2" id="status-anime-2" required>
								<option value="">Choisissez un status</option>
								<option value="cours">En cours</option>
								<option value="termine">Terminé</option>
								<option value="pause">En pause</option>
								<option value="venir">À venir</option>
								<option value="annule">Annulé</option>
							</select>
						</div>
					</div>
					<div class="champ-form-plusieurs">
						<label>Dates de l'anime :</label>
						<div class="champ-form">
							<label for="start_date-anime-2">Début :</label>
							<input type="date" name="start_date-anime-2" id="start_date-anime-2">
						</div>
						<div class="champ-form">
							<label for="end_date-anime-2">Fin :</label>
							<input type="date" name="end_date-anime-2" id="end_date-anime-2">
						</div>
					</div>
					<div class="champ-form">
						<label for="studios-anime-2">Le studios qui a produit l'anime :</label>
						<br><input type="text" name="studios-anime-2" id="studios-anime-2" maxlength="100">
					</div>
					<div class="champ-form">
						<label for="synopsis-anime-2">Le synopsis de l'anime :</label>
						<br><textarea name="synopsis-anime-2" id="synopsis-anime-2" maxlength="2000"></textarea>
					</div>
				</div>
				<div class="colonnes">
					<div class="champ-form">
						<label for="anime-groupe-2">Groupe de l'anime : *</label>
						<div class="bar-recherche">
							<input type="text" name="anime-groupe-2" id="anime-groupe-2" maxlength="300" readonly required>
							<button type="button" onclick="toggleSearch()">▼</button>
						</div>
						<div class="affiche-recherche" id="search-container" style="display: none;">
							<div class="search-container">
								<input type="text" id="search-query" placeholder="Rechercher un groupe" oninput="searchAnimeGroup()">
								<button type="button" class="clear-button" onclick="clearSearch()">Clear</button>
							</div>
							<div id="results-groupe-2"></div>
						</div>
					</div>
					<div class="champ-form">
						<label for="genre-anime-2">Les genres de l'anime :</label>
						<br><div id="anime-genres-input"></div>
					</div>
					<div class="champ-form">
						<label for="theme-anime-2">Les thèmes de l'anime :</label>
						<br><div id="anime-themes-input"></div>
					</div>
					<div class="champ-form">
						<label for="lien-anime-2">Lien de l'affiche de l'anime :</label>
						<br><input type="text" name="lien-anime-2" id="lien-anime-2" maxlength="500">
						<div class="zone-affiche-anime" id="zone-affiche-anime-2">
							<img src="...">
						</div>
					</div>
				</div>
				</div>
                <div class="btn-group">
                    <div class="btn-sub"><button type="button" onclick="resetForm('form-2')">Annuler</button></div>
                    <div class="btn-sub"><button type="submit" id="submit-2">Valider</button></div>
                </div>
			</form>
		</div>
	</div>
</div>

<script>
<?php
$host = 'my_db';
$username = 'root';
$password = 'rootpassword';
$dbname = 'yumestream';

// Créer une connexion
$conn = new mysqli($host, $username, $password, $dbname);

// Vérifier la connexion
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Récupérer les genres et thèmes
$genres = [];
$themes = [];

$sql = "SELECT `g-t-id`, `g-ou-t`, `g-t-nom` FROM `genres-themes`";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // Parcourir les résultats et les ajouter aux tableaux appropriés
    while($row = $result->fetch_assoc()) {
        $item = $row['g-t-nom'] . '#' . $row['g-t-id'];
        if ($row['g-ou-t'] === 'genre') {
            $genres[] = $item;
        } else if ($row['g-ou-t'] === 'theme') {
            $themes[] = $item;
        }
    }
}

$conn->close();
?>

// Récupérer les genres et thèmes depuis PHP
const liste_genres = <?php echo json_encode($genres); ?>;
const liste_themes = <?php echo json_encode($themes); ?>;

// Initialiser les listes déroulantes
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
</script>

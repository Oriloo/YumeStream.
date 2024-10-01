<style type="text/css"> 
	.div-erreur, .div-succes {
		position: relative;

		.erreur, .succes {
			position: absolute;
			background-color: #FF6666;
			top: 10px;
			left: calc(50vw - 33vw/2);
			width: 33vw;
			height: 85px;
			padding: 10px;
			border-radius: 10px;
			border: 5px solid #CC3333;
			box-sizing: border-box;
			overflow: auto;
			font-weight: bold;

			a { color: #FFFFFF; }
		}
	}

	.div-succes .succes {
		background-color: #33CC33;
		border-color: #66FF66;
		a { color: #FFFFFF; }
	}

	.erreur_succes {
		position: relative;

		#erreur_succes_x {
			position: absolute;
			top: 16px;
			left: calc(50vw + 33vw/2 - 1.8vw);
			cursor: pointer;
			font-size: 20px;
			a { color: #FFFFFF; }
		}
	}
</style>

<?php
// Vérification de l'existence du paramètre erreur dans l'URL
if(isset($_GET['erreur'])) {
	// Connexion à la base de données
	$conn = new mysqli($BDDservername, $BDDusername, $BDDpassword, $BDDname);
	
	// Vérification de la connexion
	if ($conn->connect_error) {
		die("Erreur de connexion à la base de données : " . $conn->connect_error);
	}
	
	// Préparation de la requête SQL pour récupérer la description de l'erreur
	$erreurCode = $_GET['erreur'];
	$sql = "SELECT description FROM erreur_code WHERE code = ?";
	
	// Préparation de la requête avec une déclaration préparée pour éviter les injections SQL
	if($stmt = $conn->prepare($sql)) {
		// Liaison des paramètres
		$stmt->bind_param("s", $erreurCode);
		
		// Exécution de la requête
		$stmt->execute();
		
		// Récupération du résultat
		$stmt->bind_result($description);
		
		// Affichage du résultat
		if($stmt->fetch()) {
			echo "
			<div class='div-erreur'>
				<div class='erreur'>
					<a>Code d'erreur : $erreurCode<br>$description</a>
				</div>
			</div>";
		} else {
			echo "
			<div class='div-erreur'>
				<div class='erreur'>
					<a>Aucune description trouvée pour le code d'erreur : ".htmlspecialchars($erreurCode)."</a>
				</div>
			</div>";
		}
		
		// Fermeture du statement
		$stmt->close();
	} else {
		echo "
		<div class='div-erreur'>
			<div class='erreur'>
				<a>Erreur dans la préparation de la requête SQL</a>
			</div>
		</div>";
	}
	
	// Fermeture de la connexion
	$conn->close();
} elseif(isset($_GET['succes'])) {
	// Affichage du div pour le cas de succès
	echo "
	<div class='div-succes'>
		<div class='succes'>
			<a>Opération réussie!</a>
		</div>
	</div>";
} else {
	// Aucun code d'erreur spécifié dans l'URL et aucun succès
}

if (isset($_GET['erreur']) || isset($_GET['succes'])) {
	echo "<div class='erreur_succes'><div id='erreur_succes_x'><a>X</a></div></div>";
}
?>

<script type="text/javascript">
	document.getElementById('erreur_succes_x').addEventListener('click', cacherErreurSucces);

	function cacherErreurSucces() {
		var divErreur = document.querySelector('.div-erreur');
		var divSucces = document.querySelector('.div-succes');
		if (divErreur) { divErreur.style.display = 'none'; }
		if (divSucces) { divSucces.style.display = 'none'; }
		document.querySelector('.erreur_succes').style.display = 'none';
	}
</script>

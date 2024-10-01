// Fonction pour les boutons du pseudo
function s0(e) {
	document.getElementById("modif-pseudo").style.display = e ? "none" : "inline-block";
	document.getElementById("cancel-pseudo").style.display = e ? "inline-block" : "none";
	document.getElementById("save-pseudo").style.display = e ? "inline-block" : "none";
	document.getElementById("pseudo").disabled = !e;
	document.getElementById("pseudo").value = user_name;
}
// Fonction pour les boutons de la photo de profil
function s1(e) {
	document.getElementById("modif-pp").style.display = e ? "none" : "inline-block";
	document.getElementById("cancel-pp").style.display = e ? "inline-block" : "none";
	document.getElementById("save-pp").style.display = e ? "inline-block" : "none";
	document.getElementById("photo").disabled = !e;
	document.querySelector(".liste-pp").style.display = e ? "block" : "none";
	document.getElementById("photo").value = user_pp;
	document.getElementById("main-image").src = "../../Element/image/pp/" + user_pp;
}
// Fonction pour les boutons de l'adresse du profil
function s2(e) {
	document.getElementById("modif-adresse").style.display = e ? "none" : "inline-block";
	document.getElementById("cancel-adresse").style.display = e ? "inline-block" : "none";
	document.getElementById("save-adresse").style.display = e ? "inline-block" : "none";
	document.getElementById("adresse").disabled = !e;
	document.getElementById("adresse").value = user_adresse;
}
// Fonction pour les boutons du mot de passe
function s3(e) {
	document.getElementById("modif-mdp").style.display = e ? "none" : "inline-block";
	document.getElementById("cancel-mdp").style.display = e ? "inline-block" : "none";
	document.getElementById("save-mdp").style.display = e ? "inline-block" : "none";
	document.querySelectorAll("#mdp1, #mdp2, #mdp3").forEach(mdp => mdp.disabled = !e);
	document.querySelectorAll("#mdp1, #mdp2, #mdp3").forEach(mdp => mdp.value = '');
	document.querySelectorAll("#but1-mdp, #but2-mdp, #but3-mdp").forEach(mdp => mdp.disabled = !e);
	fermerOeil(butto_mdb1, input_mdb1);
	fermerOeil(butto_mdb2, input_mdb2);
	fermerOeil(butto_mdb3, input_mdb3);
}
// Fonction pour les boutons de l'adresse e-mail
function s4(e) {
	document.getElementById("modif-mail").style.display = e ? "none" : "inline-block";
	document.getElementById("cancel-mail").style.display = e ? "inline-block" : "none";
	document.getElementById("save-mail").style.display = e ? "inline-block" : "none";
	document.getElementById("mdp4").disabled = !e;
	document.getElementById("mdp4").value = '';
	document.getElementById("mail").disabled = !e;
	document.getElementById("mail").value = user_mail;
	document.getElementById("but4-mdp").disabled = !e;
	fermerOeil(butto_mdb4, input_mdb4);
}
// Fonction pour les boutons pour supprimer le compte
function s5(e) {
	document.getElementById("supprimer-compte").style.display = e ? "none" : "inline-block";
	document.getElementById("supprimer-cancel").style.display = e ? "inline-block" : "none";
	document.getElementById("supprimer-valide").style.display = e ? "inline-block" : "none";
	document.getElementById("mdp5").disabled = !e;
	document.getElementById("mdp5").value = '';
	document.getElementById("but5-mdp").disabled = !e;
	fermerOeil(butto_mdb5, input_mdb5);
}

// Écouteurs d'événements pour les boutons "Modifier" et "Annuler" du pseudo
document.getElementById("modif-pseudo").addEventListener("click", () => s0(true));
document.getElementById("cancel-pseudo").addEventListener("click", () => s0(false));
// Écouteurs d'événements pour les boutons "Modifier" et "Annuler" de la photo de profil
document.getElementById("modif-pp").addEventListener("click", () => s1(true));
document.getElementById("cancel-pp").addEventListener("click", () => s1(false));
// Écouteurs d'événements pour les boutons "Modifier" et "Annuler" de l'adresse du profil
document.getElementById("modif-adresse").addEventListener("click", () => s2(true));
document.getElementById("cancel-adresse").addEventListener("click", () => s2(false));
// Écouteurs d'événements pour les boutons "Modifier" et "Annuler" du mot de passe
document.getElementById("modif-mdp").addEventListener("click", () => s3(true));
document.getElementById("cancel-mdp").addEventListener("click", () => s3(false));
// Écouteurs d'événements pour les boutons "Modifier" et "Annuler" de l'adresse e-mail
document.getElementById("modif-mail").addEventListener("click", () => s4(true));
document.getElementById("cancel-mail").addEventListener("click", () => s4(false));
// Écouteurs d'événements pour les boutons "Modifier" et "Annuler" de la suppression
document.getElementById("supprimer-compte").addEventListener("click", () => s5(true));
document.getElementById("supprimer-cancel").addEventListener("click", () => s5(false));

/****************************************************************************************************/
/****************************************************************************************************/

// Au chargement de la page, cacher la liste de photos de profil
document.addEventListener("DOMContentLoaded", function() {
	document.querySelector(".liste-pp").style.display = "none";
});

// Mise à jour de l'image principale et de la valeur de l'input pour la photo de profil
function updateImageAndInput(imageName) {
	document.getElementById('main-image').src = '../../Element/image/pp/' + imageName;
	document.getElementById('photo').value = imageName;
};

/****************************************************************************************************/
/****************************************************************************************************/

document.addEventListener("DOMContentLoaded", () => {
	// Sélection des éléments nécessaires
	const inputAdresse = document.getElementById("adresse");
	const spanAdresse = document.getElementById("lien-adresse");

	// Fonction pour mettre à jour le contenu du span
	const mettreAJourSpan = () => { spanAdresse.textContent = inputAdresse.value; };

	// Écouteur d'événement pour mettre à jour le span
	window.addEventListener("load", mettreAJourSpan);
	inputAdresse.addEventListener("input", mettreAJourSpan);
	document.getElementById("cancel-adresse").addEventListener("click", mettreAJourSpan);
});

/****************************************************************************************************/
/****************************************************************************************************/

function demanderConfirmation() {
	if (confirm("Êtes-vous sûr de vouloir supprimer votre compte ?\nCette action est irréversible, vous ne pourrez jamais récupérer votre compte et ses données, ce qui comprend l'Anime Liste, l'Historique et les Critiques.")) {
		// Récupérer la valeur du champ de mot de passe
		var mdp5Value = document.getElementById("mdp5").value;

		// Créer un formulaire
		var form = document.createElement("form");
		form.setAttribute("method", "post");
		form.setAttribute("action", "suppression_compte.php");

		// Ajout du champ caché contenant l'ID de l'utilisateur
		var hiddenInputUserId = document.createElement("input");
		hiddenInputUserId.setAttribute("type", "hidden");
		hiddenInputUserId.setAttribute("name", "user_id");
		hiddenInputUserId.setAttribute("value", "<?php echo $user_id; ?>");
		form.appendChild(hiddenInputUserId);

		// Ajouter le champ de mot de passe
		var hiddenInputPassword = document.createElement("input");
		hiddenInputPassword.setAttribute("type", "hidden");
		hiddenInputPassword.setAttribute("name", "mdp5");
		hiddenInputPassword.setAttribute("value", mdp5Value);
		form.appendChild(hiddenInputPassword);

		// Ajouter le formulaire au corps du document
		document.body.appendChild(form);

		// Soumettre le formulaire
		form.submit();
	} else {
		// Si l'utilisateur clique sur "Annuler"
		alert("Suppression du compte annulée.");
	}
}

// Ajouter un gestionnaire d'événements au clic sur le bouton de validation de la suppression
document.getElementById("supprimer-valide").addEventListener("click", function() {
	// Appeler la fonction demanderConfirmation
	demanderConfirmation();
});

/****************************************************************************************************/
/****************************************************************************************************/

const input_mdb1 = document.getElementById('mdp1');
const butto_mdb1 = document.getElementById('but1-mdp');
const input_mdb2 = document.getElementById('mdp2');
const butto_mdb2 = document.getElementById('but2-mdp');
const input_mdb3 = document.getElementById('mdp3');
const butto_mdb3 = document.getElementById('but3-mdp');
const input_mdb4 = document.getElementById('mdp4');
const butto_mdb4 = document.getElementById('but4-mdp');
const input_mdb5 = document.getElementById('mdp5');
const butto_mdb5 = document.getElementById('but5-mdp');

document.addEventListener("DOMContentLoaded", function() {
	ChangerSvgMdp(butto_mdb1, input_mdb1);
	ChangerSvgMdp(butto_mdb2, input_mdb2);
	ChangerSvgMdp(butto_mdb3, input_mdb3);
	ChangerSvgMdp(butto_mdb4, input_mdb4);
	ChangerSvgMdp(butto_mdb5, input_mdb5);
});

// Définition des SVG
const eyeOpenSVG = '<svg class="svg-mdp" viewBox="0 0 24 24"><path d="M15.0007 12C15.0007 13.6569 13.6576 15 12.0007 15C10.3439 15 9.00073 13.6569 9.00073 12C9.00073 10.3431 10.3439 9 12.0007 9C13.6576 9 15.0007 10.3431 15.0007 12Z"/><path d="M12.0012 5C7.52354 5 3.73326 7.94288 2.45898 12C3.73324 16.0571 7.52354 19 12.0012 19C16.4788 19 20.2691 16.0571 21.5434 12C20.2691 7.94291 16.4788 5 12.0012 5Z"/></svg>';
const eyeClosedSVG = '<svg class="svg-mdp" viewBox="0 0 24 24"><path d="M2.99902 3L20.999 21M9.8433 9.91364C9.32066 10.4536 8.99902 11.1892 8.99902 12C8.99902 13.6569 10.3422 15 11.999 15C12.8215 15 13.5667 14.669 14.1086 14.133M6.49902 6.64715C4.59972 7.90034 3.15305 9.78394 2.45703 12C3.73128 16.0571 7.52159 19 11.9992 19C13.9881 19 15.8414 18.4194 17.3988 17.4184M10.999 5.04939C11.328 5.01673 11.6617 5 11.9992 5C16.4769 5 20.2672 7.94291 21.5414 12C21.2607 12.894 20.8577 13.7338 20.3522 14.5"/></svg>';

// Fonction pour changer l'icône SVG du mot de passe
function ChangerSvgMdp(buttoPass, inputPass) {
	// Remplacer le bouton vide par le SVG fermé
	buttoPass.innerHTML = eyeClosedSVG;

	// Ajouter un événement de clic pour basculer entre le mot de passe et le texte en clair
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

// Fonction pour fermer l'œil
function fermerOeil(buttoPass, inputPass) {
	inputPass.type = 'password';
	buttoPass.innerHTML = eyeClosedSVG;
}

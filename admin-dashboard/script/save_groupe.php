<?php
$servername = "my_db";
$username = "root";
$password = "rootpassword";
$dbname = "yumestream";

// Création de la connexion
$conn = new mysqli($servername, $username, $password, $dbname);

// Vérification de la connexion
if ($conn->connect_error) {
    // Redirection vers une page d'erreur ou afficher un message
    header("Location: ../error_page.php?error=erreur+de+connexion");
    exit();
}

// Vérification des valeurs
if (isset($_POST['ajou-modif-select-1']) && ($_POST['ajou-modif-select-1'] == "ajouter" || $_POST['ajou-modif-select-1'] == "modifier")) {
    $ajou_modif_select = $_POST['ajou-modif-select-1'];
    $nom_groupe = $_POST['nom-groupe-1'];
    $lien_logo = $_POST['lien-groupe-1'];
    $synopsis_groupe = $_POST['synopsis-groupe-1'];
    $image_groupe = $_POST['image-groupe-1'];

    if ($ajou_modif_select == "ajouter") {
        // Vérifier si le groupe existe déjà
        $check_sql = "SELECT * FROM groupes WHERE nom_groupe = ?";
        $check_stmt = $conn->prepare($check_sql);
        if ($check_stmt === false) {
            trigger_error('Erreur de préparation de la requête SQL : ' . $conn->error, E_USER_ERROR);
        }
        $check_stmt->bind_param("s", $nom_groupe);
        $check_stmt->execute();
        $result = $check_stmt->get_result();

        if ($result->num_rows > 0) {
            echo "Erreur : Un groupe avec ce nom existe déjà.";
            $check_stmt->close();
            // Redirection vers une page d'erreur ou afficher un message
            header("Location: ../error_page.php?error=un+groupe+avec+ce+nom+existe+deja");
            exit();
        } else {
            // Créer une nouvelle ligne dans la table
            $sql = "INSERT INTO groupes (nom_groupe, lien_logo, synopsis_groupe, lien_image) VALUES (?, ?, ?, ?)";
            $stmt = $conn->prepare($sql);
            if ($stmt === false) {
                trigger_error('Erreur de préparation de la requête SQL : ' . $conn->error, E_USER_ERROR);
            }
            $stmt->bind_param("ssss", $nom_groupe, $lien_logo, $synopsis_groupe, $image_groupe);
            
            if ($stmt->execute()) {
                echo "Nouvelle ligne ajoutée avec succès";
                // Redirection vers le tableau de bord après succès
                header("Location: ../admin_dashboard.php"); // ?message=group_added
                exit();
            } else {
                echo "Erreur: " . $stmt->error;
            }
            
            $stmt->close();
        }

        $check_stmt->close();
    } elseif ($ajou_modif_select == "modifier") {
        $id_groupe_select = $_POST['id-groupe-select-1'];
        // Modifier la ligne correspondante dans la table
        $sql = "UPDATE groupes SET nom_groupe=?, lien_logo=?, synopsis_groupe=?, lien_image=? WHERE groupe_id=?";
        $stmt = $conn->prepare($sql);
        if ($stmt === false) {
            trigger_error('Erreur de préparation de la requête SQL : ' . $conn->error, E_USER_ERROR);
        }
        $stmt->bind_param("ssssi", $nom_groupe, $lien_logo, $synopsis_groupe, $image_groupe, $id_groupe_select);
        
        if ($stmt->execute()) {
            echo "Ligne mise à jour avec succès";
            // Redirection vers le tableau de bord après succès
            header("Location: ../admin_dashboard.php"); // ?message=group_updated
            exit();
        } else {
            echo "Erreur lors de la mise à jour: " . $stmt->error;
        }
        
        $stmt->close();
    }
} else {
    // Redirection vers une page d'erreur ou afficher un message
    header("Location: ../error_page.php?error=aucune+valeur+reçue+ou+valeur+incorrecte");
    exit();
}

// Fermer la connexion
$conn->close();
?>

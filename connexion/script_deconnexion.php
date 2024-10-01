<?php
// Supprimer le cookie en définissant une expiration passée
setcookie("user_id", "", time() - 3600, "/");

// Rediriger vers la page de connexion
header("Location: ../connexion/");
exit();
?>

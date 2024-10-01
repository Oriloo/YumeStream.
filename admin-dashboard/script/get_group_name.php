<?php
$servername = "my_db";
$username = "root";
$password = "rootpassword";
$dbname = "yumestream";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if (isset($_POST['groupe_id'])) {
    $groupeId = intval($_POST['groupe_id']);

    $sql = "SELECT nom_groupe FROM groupes WHERE groupe_id = ?";
    $stmt = $conn->prepare($sql);
    if ($stmt === false) {
        die("Error in preparing the SQL statement: " . $conn->error);
    }

    $stmt->bind_param("i", $groupeId);
    $stmt->execute();
    $stmt->bind_result($nom_groupe);
    $stmt->fetch();

    $response = array('nom_groupe' => $nom_groupe);
    echo json_encode($response);

    $stmt->close();
}

$conn->close();
?>

<?php
// Database credentials
include("../../script/variables_bdd.php");

// Create connection
$conn = new mysqli($BDDservername, $BDDusername, $BDDpassword, $BDDname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Retrieve parameters
$anime_id = isset($_GET['anime_id']) ? intval($_GET['anime_id']) : 0;
$vf_episode = isset($_GET['vf_episode']) ? intval($_GET['vf_episode']) : 0;

$sql = "SELECT episode_id, anime_id, nb_episode, titre_episode, lien_episode, date_episode 
        FROM episodes 
        WHERE anime_id = $anime_id AND vf_episode = $vf_episode 
        ORDER BY nb_episode ASC";

$result = $conn->query($sql);

$episodes = [];
if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        $episodes[] = $row;
    }
}
$conn->close();

echo json_encode($episodes);
?>

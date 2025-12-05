<?php
require_once 'config.php';

$idhabitat = $_POST['id'];

$sql = "DELETE FROM habitats WHERE id = $idhabitat";

if (mysqli_query($conn, $sql)) {
    echo "habitat supprimé avec succès";
} else {
    echo "Erreur : " . mysqli_error($conn);
}
?>

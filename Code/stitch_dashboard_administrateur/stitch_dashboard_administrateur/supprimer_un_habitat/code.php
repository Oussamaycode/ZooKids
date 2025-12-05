<?php
require_once 'config.php';

$idhab = $_POST['id'];

$sql1 = "DELETE FROM animaux WHERE id_hab = $idhab;";

$sql2 = "DELETE FROM habitats WHERE id = $idhab";

if (mysqli_query($conn, $sql2)) {
    echo "habitat supprimé avec succès";
} else {
    echo "Erreur : " . mysqli_error($conn);
}
?>
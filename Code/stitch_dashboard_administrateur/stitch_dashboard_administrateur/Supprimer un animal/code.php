<?php
require_once 'config.php';

$idAnimal = $_POST['id'];

$sql = "DELETE FROM animaux WHERE id = $idAnimal";

if (mysqli_query($conn, $sql)) {
    echo "Animal supprimé avec succès";
} else {
    echo "Erreur : " . mysqli_error($conn);
}
?>

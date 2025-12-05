<?php
session_start();
require_once 'config.php';


error_reporting(E_ALL);
ini_set('display_errors', 1);

if (isset($_POST['submit'])) {

    $nom = $_POST['nom'];
    $typealimentaire = $_POST['type_alimentaire'];
    $Idhabitat = (int) $_POST['habitat'];

    if (isset($_FILES['image']) && $_FILES['image']['error'] === 0) {

        $imageName = $_FILES['image']['name'];
        $imageTmp  = $_FILES['image']['tmp_name'];

        $targetDir = "uploads/";
        if (!is_dir($targetDir)) {
            mkdir($targetDir, 0777, true); // create folder if it doesn't exist
        }

        $targetFile = $targetDir . basename($imageName);

        if (move_uploaded_file($imageTmp, $targetFile)) {

            $sql = "INSERT INTO animaux (nom, Type_alimentaire, id_hab, imgsrc)
                    VALUES ('$nom', '$typealimentaire', $Idhabitat, '$targetFile')";

            if (mysqli_query($conn, $sql)) {
                echo "Animal ajouté avec succès !";
                 header("Location: ../liste_des_animaux/code.html");
                 exit();
            } else {
                die("Erreur SQL : " . mysqli_error($conn));
            }

        } else {
            die("Erreur: Impossible d'uploader l'image.");
        }

    } else {
        die("Erreur: Aucun fichier envoyé ou fichier invalide.");
    }
}
?>


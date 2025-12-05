<?php
require_once 'config.php';


$Idhabitat = $_POST['id'] ;


if (isset($_POST['submit'])) {

    $nom = $_POST['nom'];
    $description = $_POST['description'];

    $sql = "UPDATE habitats SET 
                nom = '$nom',
                description = '$description'";

    
    if (isset($_FILES['image']) && $_FILES['image']['error'] === 0) {
        $imageName = $_FILES['image']['name'];
        $imageTmp  = $_FILES['image']['tmp_name'];
        $targetDir = "uploads/";
        if (!is_dir($targetDir)) mkdir($targetDir, 0777, true);
        $targetFile = $targetDir . basename($imageName);

        if (move_uploaded_file($imageTmp, $targetFile)) {
            $sql .= ", imgsrc = '$targetFile'";
        } else {
            die("Erreur: Impossible d'uploader l'image.");
        }
    }

    $sql .= " WHERE id = $idHabitat";

    if (mysqli_query($conn, $sql)) {
        header("Location: ../liste_des_animaux/code.php");
        exit();
    } else {
        die("Erreur SQL : " . mysqli_error($conn));
    }
}

?>




<!DOCTYPE html>
<html lang="fr">
<head>
<meta charset="UTF-8">
<title>Ajouter un Habitat</title>
<script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gradient-to-r from-green-50 to-green-100 min-h-screen flex items-center justify-center p-6">

<form action="" method="POST" enctype="multipart/form-data" class="bg-white shadow-xl rounded-2xl p-8 w-full max-w-lg">
    <h1 class="text-2xl font-extrabold mb-6 text-center text-green-700">Modifier un Habitat</h1>

    <div class="mb-5">
        <label class="block mb-2 font-semibold text-gray-700">Nom de l'habitat</label>
        <input type="text" name="nom" required placeholder="Ex: Savane" 
               class="w-full border border-gray-300 rounded-xl px-4 py-3 focus:outline-none focus:ring-2 focus:ring-green-300 transition">
    </div>

    <div class="mb-5">
        <label class="block mb-2 font-semibold text-gray-700">Image</label>
        <input type="file" name="image" accept="image/*" required
               class="w-full text-gray-600 file:border-0 file:bg-green-100 file:text-green-700 file:px-4 file:py-2 file:rounded-xl file:cursor-pointer hover:file:bg-blue-200 transition">
    </div>

    <div class="mb-6">
        <label class="block mb-2 font-semibold text-gray-700">Description</label>
        <textarea name="description" required placeholder="Décrivez l'habitat..." rows="5"
                  class="w-full border border-gray-300 rounded-xl px-4 py-3 focus:outline-none focus:ring-2 focus:ring-green-300 transition"></textarea>
    </div>

    <button name="submit" type="submit" 
            class="w-full bg-green-600 text-white font-bold py-3 rounded-xl hover:bg-green-700 transition">
        Ajouter
    </button>
</form>

</body>
</html>
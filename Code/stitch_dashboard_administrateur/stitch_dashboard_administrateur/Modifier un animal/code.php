<?php
require_once 'config.php';


$idAnimal = $_POST['id'] ;


if (isset($_POST['submit'])) {

    $nom = $_POST['nom'];
    $typealimentaire = $_POST['type_alimentaire'];
    $Idhabitat = (int) $_POST['habitat'];

    $sql = "UPDATE animaux SET 
                nom = '$nom',
                Type_alimentaire = '$typealimentaire',
                id_hab = $Idhabitat";

    
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

    $sql .= " WHERE id = $idAnimal";

    if (mysqli_query($conn, $sql)) {
        header("Location: ../liste_des_animaux/code.php");
        exit();
    } else {
        die("Erreur SQL : " . mysqli_error($conn));
    }
}


$sql = "SELECT * FROM animaux WHERE id = $idAnimal";
$resultat = $conn->query($sql);

if ($resultat->num_rows > 0) {
    $animal = $resultat->fetch_assoc();
} else {
    die("Aucun animal trouvé avec cet ID.");
}
?>


<!DOCTYPE html>
<html class="light" lang="fr">
<head>
<meta charset="utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1.0" />
<title>Modifier un Animal</title>
<script src="https://cdn.tailwindcss.com?plugins=forms,container-queries"></script>
<link href="https://fonts.googleapis.com/css2?family=Lexend:wght@100..900&display=swap" rel="stylesheet" />
<link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&display=swap" rel="stylesheet" />
<style>
.material-symbols-outlined { font-variation-settings: 'FILL' 0, 'wght' 400, 'GRAD' 0, 'opsz' 24; }
.form-select:focus, .form-input:focus { --tw-ring-opacity:0; border-color:#d1e6d1; }
</style>
</head>
<body class="font-display bg-background-light">

<div class="px-4 sm:px-10 md:px-20 lg:px-40 py-5">

<h1 class="text-4xl font-black text-[#0e1b0e] pb-2">Modifier un Animal</h1>
<p class="text-[#509550] pb-6">Remplissez les informations ci-dessous.</p>

<form action="" method="POST" class="space-y-8" enctype="multipart/form-data">

    <input type="hidden" name="id" value="<?= $animal['id']; ?>">

    <!-- Nom -->
    <label class="flex flex-col">
        <span class="pb-2">Nom de l'Animal</span>
        <input type="text" name="nom" value="<?= htmlspecialchars($animal['nom']); ?>" class="form-input w-full rounded-xl border border-[#d1e6d1] h-14 p-4" required>
    </label>

    <!-- Type alimentaire -->
    <label class="flex flex-col">
        <span class="pb-2">Type Alimentaire</span>
        <select name="type_alimentaire" class="form-select w-full rounded-xl border border-[#d1e6d1] h-14 p-4" required>
            <option value="">Sélectionnez le type alimentaire</option>
            <option value="Carnivore" <?= ($animal['Type_alimentaire']=='Carnivore')?'selected':'' ?>>Carnivore</option>
            <option value="Herbivore" <?= ($animal['Type_alimentaire']=='Herbivore')?'selected':'' ?>>Herbivore</option>
            <option value="Omnivore" <?= ($animal['Type_alimentaire']=='Omnivore')?'selected':'' ?>>Omnivore</option>
        </select>
    </label>

    <!-- Habitat -->
    <label class="flex flex-col">
        <span class="pb-2">Habitat</span>
        <select name="habitat" class="form-select w-full rounded-xl border border-[#d1e6d1] h-14 p-4" required>
            <option value="">Sélectionnez l'habitat</option>
            <option value="1" <?= ($animal['id_hab']==1)?'selected':'' ?>>Jungle</option>
            <option value="2" <?= ($animal['id_hab']==2)?'selected':'' ?>>Savane</option>
            <option value="3" <?= ($animal['id_hab']==3)?'selected':'' ?>>Forêt</option>
            <option value="4" <?= ($animal['id_hab']==4)?'selected':'' ?>>Océan</option>
        </select>
    </label>

    <!-- Image -->
    <label class="flex flex-col">
        <span class="pb-2">Image de l'Animal</span>
        <input type="file" name="image">
        <?php if(!empty($animal['imgsrc'])): ?>
            <p class="text-sm mt-2">Image actuelle:</p>
            <img src="<?= htmlspecialchars($animal['imgsrc']); ?>" alt="Animal" class="w-48 h-auto rounded-xl mt-2 border border-[#d1e6d1]">
            <?php endif; ?>

    </label>

    <div class="flex gap-4 pt-4">
        <a href="../liste_des_animaux/code.php" class="px-6 py-2 border rounded-full text-[#509550] font-bold">Annuler</a>
        <button type="submit" name="submit" class="px-6 py-2 rounded-full bg-primary text-[#0e1b0e] font-bold">Mettre à jour l'Animal</button>
    </div>

</form>
</div>
</body>
</html>

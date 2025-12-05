<?php
require_once 'config.php';

// Fetch all habitats
$sql = "SELECT * FROM habitats";
$result = mysqli_query($conn, $sql);
?>

<!DOCTYPE html>
<html class="light" lang="fr">
<head>
<meta charset="utf-8"/>
<meta content="width=device-width, initial-scale=1.0" name="viewport"/>
<title>Liste des Habitats</title>
<script src="https://cdn.tailwindcss.com?plugins=forms,container-queries"></script>
<link href="https://fonts.googleapis.com/css2?family=Lexend:wght@100..900&display=swap" rel="stylesheet"/>
<link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&display=swap" rel="stylesheet"/>
<style>
.material-symbols-outlined {
    font-variation-settings: 'FILL' 1, 'wght' 400, 'GRAD' 0, 'opsz' 48;
}
</style>
<script id="tailwind-config">
tailwind.config = {
    darkMode: "class",
    theme: {
        extend: {
            colors: {
                "primary": "#0df20d",
                "background-light": "#f5f8f5",
                "background-dark": "#102210",
            },
            fontFamily: {
                "display": ["Lexend", "sans-serif"]
            },
            borderRadius: {
                "DEFAULT": "0.5rem",
                "lg": "1rem",
                "xl": "1.5rem",
                "full": "9999px"
            },
        },
    },
}
</script>
</head>
<body class="font-display bg-background-light dark:bg-background-dark text-[#0d1c0d] dark:text-background-light">
<div class="relative flex h-auto min-h-screen w-full flex-col group/design-root overflow-x-hidden">
<div class="layout-container flex h-full grow flex-col">
<div class="px-4 sm:px-8 md:px-20 lg:px-40 flex flex-1 justify-center py-5">
<div class="layout-content-container flex flex-col max-w-[960px] flex-1">

<!-- TopNavBar -->
<header class="flex items-center justify-between whitespace-nowrap border-b border-solid border-primary/20 dark:border-primary/30 px-4 sm:px-10 py-3">
<a class="flex items-center gap-4 text-[#0d1c0d] dark:text-background-light" href="#">
<div class="size-6 text-primary">
<svg fill="none" viewbox="0 0 48 48" xmlns="http://www.w3.org/2000/svg">
<!-- Your SVG content -->
</svg>
</div>
<h2 class="text-[#0d1c0d] dark:text-background-light text-lg font-bold leading-tight tracking-[-0.015em]">ZooLearn</h2>
</a>
<div class="flex flex-1 justify-end gap-8">
<div class="hidden sm:flex items-center gap-9">
<a class="text-primary dark:text-background-light text-sm font-medium leading-normal hover:text-primary dark:hover:text-primary" href="../liste_des_habitats/code.php">Habitats</a>
<a class="text-[#0d1c0d] dark:text-primary text-sm font-medium leading-normal hover:text-primary dark:hover:text-primary" href="../accueil_du_zoo/code.html">Accueil</a>
<a class="text-[#0d1c0d] dark:text-background-light text-sm font-medium leading-normal hover:text-primary dark:hover:text-primary" href="../liste_des_animaux/code.html">Animaux</a>
</div>
</div>
</header>

<main class="flex-grow">
<!-- PageHeading -->
<div class="flex flex-wrap justify-between gap-3 p-4 sm:p-6 md:p-8 text-center">
<div class="flex w-full flex-col gap-3">
<p class="text-[#0d1c0d] dark:text-background-light text-4xl font-black leading-tight tracking-[-0.033em]">Explore les Maisons des Animaux</p>
<p class="text-green-700 dark:text-green-300 text-base font-normal leading-normal">Clique sur une maison pour voir les animaux qui y vivent.</p>
</div>
</div>

<!-- BUTTON: Ajouter un Habitat -->
<div class="flex justify-end px-6 mb-4">
    <a href="../ajouter_un_habitat/code.php"
       class="px-5 py-3 rounded-full bg-green-600 text-white text-sm font-semibold shadow hover:bg-green-700">
       + Ajouter un Habitat
    </a>
</div>

<!-- GRID DES HABITATS -->
<div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6 p-4">

<?php while($habitat = mysqli_fetch_assoc($result)) : ?>
    <div class="group relative flex flex-col items-center gap-4 rounded-xl bg-primary/10 dark:bg-primary/20 p-8 text-center transition hover:-translate-y-1 hover:shadow-2xl hover:shadow-primary/20">
        
        <!-- Icon: optional column in DB, fallback -->
        
    <img src="../ajouter_un_animal/<?php echo $habitat['image']; ?>" class="h-full w-full object-cover">

        <div>
            <p class="text-[#0d1c0d] dark:text-background-light text-xl font-bold">
                <?php echo $habitat['nom']; ?>
            </p>
            <p class="text-green-800 dark:text-green-200 text-sm">
                <?php echo $habitat['description']; ?>
            </p>
        </div>

        <!-- ACTIONS -->
        <div class="absolute inset-0 hidden group-hover:flex flex-col justify-center items-center gap-3 bg-black/40 rounded-xl">
            <form method="POST" action="../Modifier_un_habitat/code.php">
                <input type="hidden" name="id" value="<?php echo $habitat['id']; ?>">
                <button class="px-4 py-2 bg-green-600 text-white rounded-full text-sm hover:bg-green-700">Modifier</button>
            </form>
            <form method="POST" action="supprimer_habitat.php">
                <input type="hidden" name="id" value="<?php echo $habitat['id']; ?>">
                <button class="px-4 py-2 bg-red-600 text-white rounded-full text-sm hover:bg-red-700">Supprimer</button>
            </form>
        </div>
    </div>
<?php endwhile; ?>

</div>
</main>

<!-- Footer -->
<footer class="flex flex-col gap-6 px-5 py-10 mt-10 text-center @container border-t border-solid border-primary/20 dark:border-primary/30">
<div class="flex flex-wrap items-center justify-center gap-6 @[480px]:flex-row @[480px]:justify-around">
<a class="text-green-700 dark:text-green-300 text-base font-normal leading-normal min-w-40 hover:text-primary dark:hover:text-primary" href="#">Contact</a>
<a class="text-green-700 dark:text-green-300 text-base font-normal leading-normal min-w-40 hover:text-primary dark:hover:text-primary" href="#">Ressources pour Éducateurs</a>
<a class="text-green-700 dark:text-green-300 text-base font-normal leading-normal min-w-40 hover:text-primary dark:hover:text-primary" href="#">Politique de Confidentialité</a>
</div>
<p class="text-green-700 dark:text-green-300 text-sm font-normal leading-normal">© 2024 ZooLearn App. Tous droits réservés.</p>
</footer>

</div>
</div>
</div>
</div>

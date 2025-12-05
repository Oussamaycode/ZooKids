<?php
require_once 'config.php';



$q1 = mysqli_query($conn, "SELECT COUNT(*) AS total FROM animaux");
$total_animaux = mysqli_fetch_assoc($q1)['total'];

$q2 = mysqli_query($conn, "SELECT COUNT(*) AS total FROM habitats");
$total_habitats = mysqli_fetch_assoc($q2)['total'];

$q3 = mysqli_query($conn, "
    SELECT id_hab, COUNT(*) AS total
    FROM animaux
    GROUP BY id_hab
");

$animaux_par_hab = [];
$habitat_plus_peuple_id = null;
$habitat_plus_peuple_total = 0;

while ($row = mysqli_fetch_assoc($q3)) {
    $animaux_par_hab[$row['id_hab']] = $row['total'];

    if ($row['total'] > $habitat_plus_peuple_total) {
        $habitat_plus_peuple_total = $row['total'];
        $habitat_plus_peuple_id = $row['id_hab'];
    }
}

$habitats = [];
$q4 = mysqli_query($conn, "SELECT id, nom FROM habitats");
while ($row = mysqli_fetch_assoc($q4)) {
    $habitats[$row['id']] = $row['nom'];
}

$habitat_plus_peuple_nom = $habitats[$habitat_plus_peuple_id] ?? "Aucun";


$q5 = mysqli_query($conn, "
    SELECT type_alimentaire, COUNT(*) AS total
    FROM animaux
    GROUP BY type_alimentaire
");

$types = [];
while ($row = mysqli_fetch_assoc($q5)) {
    $types[$row['type_alimentaire']] = $row['total'];
}

$herbivore = $types['Herbivore'] ?? 0;
$carnivore = $types['Carnivore'] ?? 0;
$omnivore  = $types['Omnivore'] ?? 0;

$herb_pct = $total_animaux ? round($herbivore / $total_animaux * 100) : 0;
$carn_pct = $total_animaux ? round($carnivore / $total_animaux * 100) : 0;
$omni_pct = $total_animaux ? round($omnivore / $total_animaux * 100) : 0;
?>

<!DOCTYPE html>
<html lang="fr">
<head>
<meta charset="UTF-8">
<title>Tableau de Bord</title>
<script src="https://cdn.tailwindcss.com"></script>

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

<header>
  <div class="flex items-center gap-4">
<div class="size-6 text-text-light dark:text-text-dark">
<svg fill="currentColor" viewbox="0 0 48 48" xmlns="http://www.w3.org/2000/svg">
<path d="M13.8261 17.4264C16.7203 18.1174 20.2244 18.5217 24 18.5217C27.7756 18.5217 31.2797 18.1174 34.1739 17.4264C36.9144 16.7722 39.9967 15.2331 41.3563 14.1648L24.8486 40.6391C24.4571 41.267 23.5429 41.267 23.1514 40.6391L6.64374 14.1648C8.00331 15.2331 11.0856 16.7722 13.8261 17.4264Z"></path>
<path clip-rule="evenodd" d="M39.998 12.236C39.9944 12.2537 39.9875 12.2845 39.9748 12.3294C39.9436 12.4399 39.8949 12.5741 39.8346 12.7175C39.8168 12.7597 39.7989 12.8007 39.7813 12.8398C38.5103 13.7113 35.9788 14.9393 33.7095 15.4811C30.9875 16.131 27.6413 16.5217 24 16.5217C20.3587 16.5217 17.0125 16.131 14.2905 15.4811C12.0012 14.9346 9.44505 13.6897 8.18538 12.8168C8.17384 12.7925 8.16216 12.767 8.15052 12.7408C8.09919 12.6249 8.05721 12.5114 8.02977 12.411C8.00356 12.3152 8.00039 12.2667 8.00004 12.2612C8.00004 12.261 8 12.2607 8.00004 12.2612C8.00004 12.2359 8.0104 11.9233 8.68485 11.3686C9.34546 10.8254 10.4222 10.2469 11.9291 9.72276C14.9242 8.68098 19.1919 8 24 8C28.8081 8 33.0758 8.68098 36.0709 9.72276C37.5778 10.2469 38.6545 10.8254 39.3151 11.3686C39.9006 11.8501 39.9857 12.1489 39.998 12.236ZM4.95178 15.2312L21.4543 41.6973C22.6288 43.5809 25.3712 43.5809 26.5457 41.6973L43.0534 15.223C43.0709 15.1948 43.0878 15.1662 43.104 15.1371L41.3563 14.1648C43.104 15.1371 43.1038 15.1374 43.104 15.1371L43.1051 15.135L43.1065 15.1325L43.1101 15.1261L43.1199 15.1082C43.1276 15.094 43.1377 15.0754 43.1497 15.0527C43.1738 15.0075 43.2062 14.9455 43.244 14.8701C43.319 14.7208 43.4196 14.511 43.5217 14.2683C43.6901 13.8679 44 13.0689 44 12.2609C44 10.5573 43.003 9.22254 41.8558 8.2791C40.6947 7.32427 39.1354 6.55361 37.385 5.94477C33.8654 4.72057 29.133 4 24 4C18.867 4 14.1346 4.72057 10.615 5.94478C8.86463 6.55361 7.30529 7.32428 6.14419 8.27911C4.99695 9.22255 3.99999 10.5573 3.99999 12.2609C3.99999 13.1275 4.29264 13.9078 4.49321 14.3607C4.60375 14.6102 4.71348 14.8196 4.79687 14.9689C4.83898 15.0444 4.87547 15.1065 4.9035 15.1529C4.91754 15.1762 4.92954 15.1957 4.93916 15.2111L4.94662 15.223L4.95178 15.2312ZM35.9868 18.996L24 38.22L12.0131 18.996C12.4661 19.1391 12.9179 19.2658 13.3617 19.3718C16.4281 20.1039 20.0901 20.5217 24 20.5217C27.9099 20.5217 31.5719 20.1039 34.6383 19.3718C35.082 19.2658 35.5339 19.1391 35.9868 18.996Z" fill-rule="evenodd"></path>
</svg>
</div>
<h2 class="text-lg font-bold leading-tight tracking-[-0.015em]">ZooLearn</h2>
</div>
<div class="flex flex-1 justify-end gap-8">
<div class="hidden sm:flex items-center gap-9">
<a class="text-primary dark:text-background-light text-sm font-medium leading-normal hover:text-primary dark:hover:text-primary" href="../tableau_de_bord_statistiques/code.php">Statistiques</a>
<a class="text-[#0d1c0d] dark:text-primary text-sm font-medium leading-normal hover:text-primary dark:hover:text-primary"  href="../liste_des_animaux/code.php">Animaux</a>
<a class="text-[#0d1c0d] dark:text-primary text-sm font-medium leading-normal hover:text-primary dark:hover:text-primary" href="../accueil_du_zoo/code.html">Accueil</a>
<a class="text-[#0d1c0d] dark:text-background-light text-sm font-medium leading-normal hover:text-primary dark:hover:text-primary" href="../liste_des_habitats/code.php">Habitats</a>
</div>
</header>

<body class="bg-gray-100 p-10 font-sans">

<h1 class="text-4xl font-bold mb-8">📊 Tableau de Bord</h1>

<!-- CARDS -->
<div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-10">
    <div class="bg-white p-6 rounded shadow">
        <p class="text-gray-500">Total Animaux</p>
        <p class="text-4xl font-bold"><?= $total_animaux ?></p>
    </div>

    <div class="bg-white p-6 rounded shadow">
        <p class="text-gray-500">Total Habitats</p>
        <p class="text-4xl font-bold"><?= $total_habitats ?></p>
    </div>

    <div class="bg-green-100 p-6 rounded shadow border border-green-400">
        <p class="text-gray-500">Habitat le plus peuplé</p>
        <p class="text-3xl font-bold"><?= $habitat_plus_peuple_nom ?></p>
        <p class="text-green-700"><?= $habitat_plus_peuple_total ?> animaux</p>
    </div>
</div>

<!-- BAR CHART -->
<div class="bg-white p-6 rounded shadow mb-10">
<h2 class="text-2xl font-bold mb-4">Animaux par habitat</h2>

<?php foreach ($habitats as $id => $nom): 
    $count = $animaux_par_hab[$id] ?? 0;
    $width = $total_animaux ? ($count / $total_animaux) * 100 : 0;
?>
<div class="flex items-center gap-3 mb-3">
    <div class="w-24 text-right font-medium"><?= $nom ?></div>
    <div class="flex-1 bg-gray-200 h-6 rounded">
        <div class="bg-green-500 h-full rounded text-white text-xs flex items-center justify-end pr-2"
             style="width: <?= $width ?>%">
            <?= $count ?>
        </div>
    </div>
</div>
<?php endforeach; ?>
</div>
<!-- FOOD TYPE STATS -->
<div class="bg-white p-6 rounded shadow">
<h2 class="text-2xl font-bold mb-4">Animaux par type alimentaire</h2>

<p>🌿 Herbivore : <strong><?= $herbivore ?></strong> (<?= $herb_pct ?>%)</p>
<p>🥩 Carnivore : <strong><?= $carnivore ?></strong> (<?= $carn_pct ?>%)</p>
<p>🍽 Omnivore : <strong><?= $omnivore ?></strong> (<?= $omni_pct ?>%)</p>

</div>

</body>
</html>

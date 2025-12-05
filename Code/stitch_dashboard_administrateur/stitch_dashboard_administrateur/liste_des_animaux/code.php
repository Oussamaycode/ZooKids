
<?php
require_once 'config.php';


$sql = "SELECT * FROM animaux";
$result = mysqli_query($conn, $sql);

 
?>


<!DOCTYPE html>

<html class="light" lang="fr"><head>
<meta charset="utf-8"/>
<meta content="width=device-width, initial-scale=1.0" name="viewport"/>
<title>Liste des Animaux</title>
<script src="https://cdn.tailwindcss.com?plugins=forms,container-queries"></script>
<link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;700;800&amp;display=swap" rel="stylesheet"/>
<link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&amp;display=swap" rel="stylesheet"/>
<style>
      .material-symbols-outlined {
        font-variation-settings:
        'FILL' 1,
        'wght' 400,
        'GRAD' 0,
        'opsz' 24
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
              "surface-light": "#e7f4e7",
              "surface-dark": "#1a2e1a",
              "text-light": "#0d1c0d",
              "text-dark": "#e7f4e7",
              "text-muted-light": "#499c49",
              "text-muted-dark": "#a3d3a3",
            },
            fontFamily: {
              "display": ["Plus Jakarta Sans", "Noto Sans", "sans-serif"]
            },
            borderRadius: {"DEFAULT": "1rem", "lg": "2rem", "xl": "3rem", "full": "9999px"},
          },
        },
      }
    </script>
</head>
<body class="font-display bg-background-light dark:bg-background-dark text-text-light dark:text-text-dark">
<div class="relative flex h-auto min-h-screen w-full flex-col group/design-root overflow-x-hidden">
<div class="layout-container flex h-full grow flex-col">
<header class="flex items-center justify-between whitespace-nowrap border-b border-solid border-surface-light dark:border-surface-dark px-6 md:px-10 lg:px-20 py-3">
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
<a class="text-primary dark:text-background-light text-sm font-medium leading-normal hover:text-primary dark:hover:text-primary" href="../liste_des_animaux/code.html">Animaux</a>
<a class="text-[#0d1c0d] dark:text-primary text-sm font-medium leading-normal hover:text-primary dark:hover:text-primary" href="../accueil_du_zoo/code.html">Accueil</a>
<a class="text-[#0d1c0d] dark:text-background-light text-sm font-medium leading-normal hover:text-primary dark:hover:text-primary" href="../liste_des_habitats/code.php">Habitats</a>
</div>
</header>
<main class="flex flex-1 flex-col md:flex-row">
<aside class="w-full md:w-72 lg:w-80 flex-shrink-0 p-6 border-b md:border-b-0 md:border-r border-solid border-surface-light dark:border-surface-dark">
<div class="flex flex-col gap-8">
<div>
<label class="flex flex-col min-w-40 h-12 w-full">
<div class="flex w-full flex-1 items-stretch rounded-full h-full">
<div class="text-text-muted-light dark:text-text-muted-dark flex border-none bg-surface-light dark:bg-surface-dark items-center justify-center pl-4 rounded-l-full border-r-0">
<span class="material-symbols-outlined !fill-0 !wght-400">search</span>
</div>
<input class="form-input flex w-full min-w-0 flex-1 resize-none overflow-hidden rounded-full text-text-light dark:text-text-dark focus:outline-0 focus:ring-0 border-none bg-surface-light dark:bg-surface-dark focus:border-none h-full placeholder:text-text-muted-light dark:placeholder:text-text-muted-dark px-4 rounded-l-none border-l-0 pl-2 text-base font-normal leading-normal" placeholder="Cherche un animal..." value=""/>
</div>
</label>
</div>
<div class="flex flex-col gap-4">
<h3 class="text-lg font-bold leading-tight tracking-[-0.015em]">Filter par Habitat</h3>
<div class="flex flex-col gap-2">
<button class="flex w-full items-center gap-4 p-3 rounded-lg bg-primary/20 dark:bg-primary/30">
<span class="material-symbols-outlined text-text-light dark:text-text-dark">forest</span>
<span class="text-sm font-medium">Forêt</span>
</button>
<button class="flex w-full items-center gap-4 p-3 rounded-lg hover:bg-primary/20 dark:hover:bg-primary/30 transition-colors">
<span class="material-symbols-outlined text-text-light dark:text-text-dark">emoji_nature</span>
<span class="text-sm font-medium">Jungle</span>
</button>
<button class="flex w-full items-center gap-4 p-3 rounded-lg hover:bg-primary/20 dark:hover:bg-primary/30 transition-colors">
<span class="material-symbols-outlined text-text-light dark:text-text-dark">water</span>
<span class="text-sm font-medium">Océan</span>
</button>
</div>
</div>
<div class="flex flex-col gap-4">
<h3 class="text-lg font-bold leading-tight tracking-[-0.015em]">Filter par Alimentation</h3>
<div class="flex flex-col gap-2">
<button class="flex w-full items-center gap-4 p-3 rounded-lg hover:bg-primary/20 dark:hover:bg-primary/30 transition-colors">
<span class="material-symbols-outlined text-text-light dark:text-text-dark">kebab_dining</span>
<span class="text-sm font-medium">Carnivore</span>
</button>
<button class="flex w-full items-center gap-4 p-3 rounded-lg hover:bg-primary/20 dark:hover:bg-primary/30 transition-colors">
<span class="material-symbols-outlined text-text-light dark:text-text-dark">eco</span>
<span class="text-sm font-medium">Herbivore</span>
</button>
<button class="flex w-full items-center gap-4 p-3 rounded-lg hover:bg-primary/20 dark:hover:bg-primary/30 transition-colors">
<span class="material-symbols-outlined text-text-light dark:text-text-dark">restaurant</span>
<span class="text-sm font-medium">Omnivore</span>
</button>
</div>
</div>
<button id="addananimal1" class="flex min-w-[84px] max-w-[480px] cursor-pointer items-center justify-center overflow-hidden rounded-full h-10 px-4 bg-primary text-text-light text-sm font-bold leading-normal tracking-[0.015em] mt-4">
<span class="truncate">Add an animal</span>
</button>
</div>
</aside>
<div class="flex-1 p-6 md:p-10">
<div class="flex flex-wrap justify-between gap-3 mb-8">
<div class="flex min-w-72 flex-col gap-1">
<p class="text-4xl font-black leading-tight tracking-[-0.033em]">Liste des Animaux</p>
<p class="text-text-muted-light dark:text-text-muted-dark text-base font-normal leading-normal">Clique sur un animal pour en savoir plus!</p>
</div>
</div>
<div  class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6">

<?php
if ($result && mysqli_num_rows($result) > 0) {
    while ($row = mysqli_fetch_assoc($result)) {
        ?>

      <a id="animal1" class="group flex flex-col gap-4 cursor-pointer" href="../détails_de_l'animal/code.html">
<div  class="bg-surface-light dark:bg-surface-dark aspect-square w-full rounded-lg overflow-hidden flex items-center justify-center transition-transform group-hover:scale-105">
    <img src="../ajouter_un_animal/<?php echo $row['imgsrc']; ?>" class="h-full w-full object-cover">
</div>
<p name="nom" class="text-center text-lg font-bold"><?php echo htmlspecialchars($row['nom']); ?></p>
<div class="flex gap-2 justify-center mt-2">
   <form action="../Modifier un animal/code.php" method="POST">
    <input type="hidden" name="id" value="<?php echo $row['id']; ?>">
     <button class=" px-3 py-1 text-xs font-bold rounded-full bg-green-500 text-white delete-btn" > 
       Modifier
    </button>
   </form>

   <form action="../Supprimer un animal/code.php" method="POST" onsubmit="return confirm('Êtes-vous sûr de vouloir supprimer cet animal ?');">
    <input type="hidden" name="id" value="<?php echo $row['id']; ?>">
    <button 
       class=" px-3 py-1 text-xs font-bold rounded-full bg-red-500 text-white delete-btn">
       Supprimer
    </button>

    </form>
</div>

</a>
        <?php
    }
} else {
    echo "<p>Aucun animal trouvé.</p>";
}
?>


</div>
</div>
</main>
</div>
</div>
<script src="code.js"></script>
</body></html>
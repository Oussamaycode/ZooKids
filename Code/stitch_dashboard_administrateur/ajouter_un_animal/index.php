<!DOCTYPE html>
<html class="light" lang="fr">

<head>
    <meta charset="utf-8" />
    <meta content="width=device-width, initial-scale=1.0" name="viewport" />
    <title>Ajouter un Animal</title>
    <script src="https://cdn.tailwindcss.com?plugins=forms,container-queries"></script>
    <link href="https://fonts.googleapis.com" rel="preconnect" />
    <link crossorigin="" href="https://fonts.gstatic.com" rel="preconnect" />
    <link href="https://fonts.googleapis.com/css2?family=Lexend:wght@100..900&display=swap" rel="stylesheet" />
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&display=swap" rel="stylesheet" />

    <style>
        .material-symbols-outlined {
            font-variation-settings: 'FILL' 0, 'wght' 400, 'GRAD' 0, 'opsz' 24;
        }

        .form-select:focus {
            --tw-ring-opacity: 0;
            border-color: #d1e6d1;
        }

        .form-input:focus {
            --tw-ring-opacity: 0;
            border-color: #d1e6d1;
        }
    </style>

    <script id="tailwind-config">
        tailwind.config = {
            darkMode: "class",
            theme: {
                extend: {
                    colors: {
                        "primary": "#4ce64c",
                        "background-light": "#f8fbf8",
                        "background-dark": "#112111",
                    },
                    fontFamily: {
                        "display": ["Lexend", "sans-serif"]
                    },
                    borderRadius: {
                        "DEFAULT": "1rem",
                        "lg": "2rem",
                        "xl": "3rem",
                        "full": "9999px"
                    },
                },
            },
        }
    </script>
</head>

<body class="font-display">
<div class="relative flex h-auto min-h-screen w-full flex-col bg-background-light dark:bg-background-dark overflow-x-hidden">

<div class="layout-container flex h-full grow flex-col">
<div class="px-4 sm:px-10 md:px-20 lg:px-40 flex flex-1 justify-center py-5">
<div class="layout-content-container flex flex-col max-w-[960px] flex-1">

<header class="flex items-center justify-between whitespace-nowrap border-b border-solid border-b-[#e8f3e8] dark:border-b-primary/20 px-4 sm:px-10 py-3">
    <div class="flex items-center gap-4 text-[#0e1b0e] dark:text-background-light">
        <div class="size-6 text-primary">
            <svg fill="currentColor" viewBox="0 0 48 48">
                <path d="M24 4H6V17.3333V30.6667H24V44H42V30.6667V17.3333H24V4Z"></path>
            </svg>
        </div>
        <h2 class="text-lg font-bold">Zoo Learning App</h2>
    </div>
</header>

<main class="flex-grow p-4 md:p-10">

<!-- 🌟 THE FORM STARTS HERE -->
<form action="addananimal.php" method="POST" class="w-full space-y-8" enctype="multipart/form-data">

    <div class="flex flex-col gap-3 pb-8">
        <p class="text-[#0e1b0e] dark:text-background-light text-4xl font-black">Ajouter un Animal</p>
        <p class="text-[#509550] dark:text-primary/80 text-base">Remplissez les informations ci-dessous.</p>
    </div>

    <!-- Animal Name -->
    <div class="flex flex-col md:flex-row flex-wrap gap-8">
        <label class="flex flex-col min-w-40 flex-1">
            <p class="text-base pb-2">Nom de l'Animal</p>
            <input name="nom"  required
                class="form-input w-full rounded-xl border border-[#d1e6d1] bg-background-light h-14 p-[15px]"
                placeholder="ex: Lion" />
        </label>
    </div>

    <!-- FOOD TYPE + HABITAT -->
    <div class="flex flex-col md:flex-row flex-wrap gap-8">

        <!-- Type Alimentaire -->
        <label class="flex flex-col min-w-40 flex-1">
            <p class="pb-2">Type Alimentaire</p>
            <div class="relative flex items-center">
                <span class="material-symbols-outlined absolute left-4 text-[#509550]">kebab_dining</span>
                <select name="type_alimentaire" required
                    class="form-select w-full rounded-xl border border-[#d1e6d1] bg-background-light h-14 pl-12 pr-4">
                    <option value="">Sélectionnez le type alimentaire</option>
                    <option value="Carnivore">Carnivore</option>
                    <option value="Herbivore">Herbivore</option>
                    <option value="Omnivore">Omnivore</option>
                </select>
                <span class="material-symbols-outlined absolute right-4 text-[#509550]">unfold_more</span>
            </div>
        </label>

        <!-- Habitat -->
        <label class="flex flex-col min-w-40 flex-1">
            <p class="pb-2">Habitat</p>
            <div class="relative flex items-center">
                <span class="material-symbols-outlined absolute left-4 text-[#509550]">park</span>
                <select name="habitat" required
                    class="form-select w-full rounded-xl border border-[#d1e6d1] bg-background-light h-14 pl-12 pr-4">
                    <option value="">Sélectionnez l'habitat</option>
                    <option value="1">Jungle</option>
                    <option value="2">Savane</option>
                    <option value="3">Forêt</option>
                    <option value="4">Océan</option>
                </select>
                <span class="material-symbols-outlined absolute right-4 text-[#509550]">unfold_more</span>
            </div>
        </label>

    </div>

    <!-- IMAGE UPLOAD -->
    <div>
        <p class="pb-2">Image de l'Animal</p>
        <div class="flex items-center justify-center w-full">
            <label for="image" class="flex flex-col items-center justify-center w-full h-64 border-2 border-dashed rounded-lg cursor-pointer">
                <span class="material-symbols-outlined text-4xl text-[#509550]">cloud_upload</span>
                <p class="text-sm text-[#509550]"><span class="font-semibold">Cliquez</span> ou glissez-déposez</p>
                <p class="text-xs text-[#509550]/80">PNG, JPG, GIF</p>
                <input id="image" name="image" type="file" class="hidden" required />
            </label>
        </div>
    </div>

    <!-- Buttons -->
    <div class="flex flex-col sm:flex-row items-center justify-end gap-4 pt-4">
        <a href="../liste_des_animaux/code.html"
            class="flex w-full sm:w-auto h-12 px-6 rounded-full border border-[#d1e6d1] text-[#509550] font-bold text-center items-center justify-center">
            Annuler
        </a>

        <button type="submit" name="submit"
            class="flex w-full items-center sm:w-auto h-12 px-8 rounded-full bg-primary text-[#0e1b0e] font-bold">
            Ajouter l'Animal
        </button>
    </div>

</form>
<!-- 🌟 THE FORM ENDS HERE -->

</main>
</div>
</div>
</div>

<script src="code.js"></script>
</body>
</html>

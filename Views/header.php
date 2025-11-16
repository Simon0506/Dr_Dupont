<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dr Dupont</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="flex flex-col min-h-screen">
    <header class="bg-blue-50 text-blue-900 shadow-md">
        <div class="max-w-6xl mx-auto px-4 py-4 flex justify-between items-center gap-6">
            <a href="index.php" class="text-xl font-bold italic text-blue-900">Dr Dupont</a>
            <nav class="space-x-3">
                <a href="index.php?page=home">Accueil</a>
                <a href="index.php?page=services">Nos services</a>
                <a href="index.php?page=about">A propos</a>
                <a href="index.php?page=news">Actualités</a>
                <?php if (!isset($_SESSION["user_id"])) { ?>
                    <a href="index.php?page=login">Connexion</a>
                    <a href="index.php?page=register">Créer un compte</a>
                <?php } else { ?>
                    <?php if (isset($_SESSION["user_id"]) && $_SESSION["user_role"] === "patient") { ?>
                        <a href="index.php?page=appointment">Prendre rendez-vous</a>
                    <?php } else { ?>
                        <a href="index.php?page=admin">Admin</a>
                    <?php } ?>
                    <a href="index.php?page=logout">Déconnexion</a>
                <?php } ?>
            </nav>
        </div>
    </header>
    <main class="max-w-7xl mx-auto px-4 pt-10 grow">
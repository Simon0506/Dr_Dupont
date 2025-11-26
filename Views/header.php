<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dr Dupont</title>
    <link rel="stylesheet" href="style.css">
    <script src="https://kit.fontawesome.com/274d342162.js" crossorigin="anonymous"></script>
    <script src="script.js" defer></script>
</head>

<body>
    <header>
        <nav>
            <a href="index.php" class="logo">
                <i class="fa-solid fa-tooth">DR DUPONT</i>
            </a>
            <div class="burger" id="burger">
                <span></span>
                <span></span>
                <span></span>
            </div>
            <div class="navbar" id="menu">
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
            </div>
        </nav>
    </header>
    <main>
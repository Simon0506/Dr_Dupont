<?php include 'header.php'; ?>

<div class="login">
    <h1 class="title">Connexion</h1>
    <?php
    if (isset($_GET['error']) && $_GET['error'] === 'credentials') { ?>
        <div class="error">Identifiants invalides
        </div>
    <?php } ?>
    <?php
    if (isset($_GET['error']) && $_GET['error'] === 'fields') { ?>
        <div class="error">Merci de remplir tous les champs
        </div>
    <?php } ?>
    <form action="index.php?page=login-valid" method="POST">
        <input type="email" name="email" placeholder="Email" class="input">
        <input type="password" name="password" placeholder="Mot de passe" class="input">
        <button class="button">Se connecter</button>
    </form>
    <p class="loginAlt">Compte créé par le cabinet ? <a href="index.php?page=first-login" class="link">Première
            connexion</a></p>
    <p class="loginAlt">Pas encore de compte ? <a href="index.php?page=register" class="link">Créer un
            compte</a></p>
</div>

<?php include 'footer.php'; ?>
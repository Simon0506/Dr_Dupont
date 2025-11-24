<?php include 'header.php'; ?>

<div class="login">
    <h1 class="title">Créez votre mot de passe</h1>
    <?php
    if (isset($_GET['error']) && $_GET['error'] === 'fields') { ?>
        <div class="error">Merci de renseigner tous les
            champs
        </div>
    <?php } else if (isset($_GET['error']) && $_GET['error'] === 'credentials') { ?>
            <div class="error">Email inconnu
            </div>
    <?php } ?>
    <form action="index.php?page=first-login-valid" method="POST">
        <input type="email" name="email" placeholder="Email" class="input">
        <input type="password" name="password" placeholder="Mot de passe" class="input">
        <button class="button">Enregistrer</button>
    </form>
</div>

<?php include 'footer.php'; ?>
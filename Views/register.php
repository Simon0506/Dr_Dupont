<?php include 'header.php'; ?>

<div class="login">
    <h1 class="title">Créer un compte</h1>
    <?php
    if (isset($_GET['error']) && $_GET['error'] === 'email-format') { ?>
        <div class="error">Format d'email invalide
        </div>
    <?php } ?>
    <?php
    if (isset($_GET['error']) && $_GET['error'] === 'email-used') { ?>
        <div class="error">Email déjà utilisée
        </div>
    <?php } ?>
    <?php
    if (isset($_GET['error']) && $_GET['error'] === 'fields') { ?>
        <div class="error">Merci de remplir tous les champs
        </div>
    <?php } ?>
    <form action="index.php?page=register-valid" method="POST">
        <div class="gridInput">
            <label for="name">Nom complet : </label>
            <input type="text" id="name" name="name" placeholder="Nom complet" class="input">
        </div>
        <div class="gridInput">
            <label for="email">Email : </label>
            <input type="email" id="email" name="email" placeholder="Email" class="input">
        </div>
        <div class="gridInput">
            <label for="password">Mot de passe : </label>
            <input type="password" id="password" name="password" placeholder="Mot de passe" class="input">
        </div>
        <div class="gridInput">
            <label for="DOB">Date de naissance : </label>
            <input type="date" id="DOB" name="dateOfBirth" class="date">
        </div>
        <div class="gridInput">
            <label for="SSN">Sécurité sociale : </label>
            <input type="text" id="SSN" pattern="\d{15}" maxlength="15" name="SSN"
                placeholder="Numéro de Sécurité sociale (15 chiffres)" class="input">
        </div>
        <div class="gridInput">
            <label for="phone">Téléphone : </label>
            <input type="text" id="phone" name="phone" placeholder="Téléphone" class="input">
        </div>
        <button class="button">S’inscrire</button>
    </form>
</div>

<?php include 'footer.php'; ?>
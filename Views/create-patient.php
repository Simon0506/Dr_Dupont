<?php include 'header.php'; ?>

<div class="addPage">
    <h1 class="title">Ajouter un nouveau patient</h1>
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
    <form action="index.php?page=create-patient-valid" method="POST" class="addForm">
        <div class="gridInput">
            <label for="name">Nom complet : </label>
            <input type="text" id="name" name="name" placeholder="Nom complet" class="input">
        </div>
        <div class="gridInput">
            <label for="email">Email : </label>
            <input type="email" id="email" name="email" placeholder="Email" class="input">
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
        <div>
            <a href="index.php?page=patientsAdmin" class="button">Annuler</a>
            <button class="button">Ajouter le patient</button>
        </div>
    </form>
</div>

<?php include 'footer.php'; ?>
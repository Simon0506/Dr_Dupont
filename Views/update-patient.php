<?php include 'header.php'; ?>

<div class="updatePage">
    <h1 class="title">Modifier les infos d'un patient</h1>
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
    <form class="updateForm" action="index.php?page=update-patient-valid&id=<?php echo $_GET['id']; ?>" method="POST">
        <div class="gridInput">
            <label for="name">Nom complet : </label>
            <input type="text" id="name" name="name" placeholder="Nom complet" class="input"
                value="<?php echo $patient->getName(); ?>">
        </div>
        <div class="gridInput">
            <label for="email">Email : </label>
            <input type="email" id="name" name="email" placeholder="Email" class="input"
                value="<?php echo $patient->getEmail(); ?>" disabled>
        </div>
        <div class="gridInput">
            <label for="DOB">Date de naissance : </label>
            <input type="date" name="dateOfBirth" placeholder="Date de naissance" class="date"
                value="<?php echo $patient->getDateOfBirth(); ?>">
        </div>
        <div class="gridInput">
            <label for="SSN">Sécurité sociale : </label>
            <input type="text" id="SSN" pattern="\d{15}" maxlength="15" name="SSN"
                placeholder="Numéro de Sécurité sociale (15 chiffres)" class="input"
                value="<?php echo $patient->getSSN(); ?>">
        </div>
        <div class="gridInput">
            <label for="phone">Téléphone : </label>
            <input type="text" id="phone" name="phone" placeholder="Téléphone" class="input"
                value="<?php echo $patient->getPhone(); ?>">
        </div>
        <div>
            <a href="index.php?page=patientsAdmin" class="button">Annuler</a>
            <button class="button">Modifier</button>
        </div>
    </form>
</div>

<?php include 'footer.php'; ?>
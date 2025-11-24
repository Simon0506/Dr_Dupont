<?php include 'header.php'; ?>
<div class="addPage">
    <h1 class="title">Ajouter un nouveau service</h1>
    <?php
    if (isset($_GET['error'])) { ?>
        <div class="error">Merci de saisir le nom du service à
            ajouter
        </div>
    <?php } ?>

    <form class="addForm" method="post" action="index.php?page=create-service-valid" enctype="multipart/form-data">
        <input type="text" name="name" placeholder="Nom du service" class="input">
        <textarea name="description" placeholder="Description du service" class="input"></textarea>
        <div>
            <a href="index.php?page=servicesAdmin" class="button">Annuler</a>
            <button class="button">Ajouter</button>
        </div>
    </form>
</div>

<?php include 'footer.php'; ?>
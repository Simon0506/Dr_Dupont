<?php include 'header.php'; ?>

<div class="updatePage">
    <h1 class="title">Modifier un service</h1>
    <?php
    if (isset($_GET['error']) && $_GET['error'] === 'fields') { ?>
        <div class="error">Merci de renseigner le nom du
            service
        </div>
    <?php } ?>
    <form class="updateForm" action="index.php?page=update-service-valid&id=<?php echo $_GET['id']; ?>" method="POST">
        <input type="text" name="name" placeholder="Nom du service" class="input"
            value="<?php echo $service->getName(); ?>">
        <textarea name="description" placeholder="Description du service"
            class="input"><?php echo $service->getDescription(); ?></textarea>
        <div>
            <a href="index.php?page=servicesAdmin" class="button">Annuler</a>
            <button class="button">Modifier</button>
        </div>
    </form>
</div>

<?php include 'footer.php'; ?>
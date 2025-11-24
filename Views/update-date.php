<?php include 'header.php'; ?>

<div class="updatePage">
    <h1 class="title">Horaires d'ouverture du cabinet</h1>
    <?php
    if (isset($_GET['error']) && $_GET['error'] === 'noId') { ?>
        <div class="error">Une erreur est survenue dans la
            mise à
            jour des horaires
        </div>
    <?php } else if (isset($_GET['updated'])) { ?>
            <div class="updated">Horaires du
            <?php echo $_GET['updated']; ?> mis à jour
            </div>
    <?php } ?>
    <?php foreach ($days as $day) { ?>
        <form class="updateForm" method="post" action="index.php?page=update-date-valid&id=<?php echo $day->getId(); ?>"
            enctype="multipart/form-data">
            <div class="schedulesData">
                <input type="text" name="name" placeholder="Jour de la semaine" value="<?php echo $day->getName(); ?>"
                    class="input" disabled>
                <div>
                    <label for="start">Ouverture</label>
                    <input type="time" id="start" name="start" class="date" value="<?php echo $day->getStart(); ?>">
                </div>
                <div>
                    <label for="end">Fermeture</label>
                    <input type="time" id="end" name="end" class="date" value="<?php echo $day->getEnd(); ?>">
                </div>

                <button class="button">Modifier</button>

            </div>
        </form>
    <?php } ?>
</div>

<?php include 'footer.php'; ?>
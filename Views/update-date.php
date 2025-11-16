<?php include 'header.php'; ?>

<h1 class="text-3xl font-bold mb-6 text-center">Horaires d'ouverture du cabinet</h1>
<?php
if (isset($_GET['error']) && $_GET['error'] === 'noId') { ?>
    <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-3">Une erreur est survenue dans la mise à
        jour des horaires
    </div>
<?php } else if (isset($_GET['updated'])) { ?>
        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-3">Horaires du
        <?php echo $_GET['updated']; ?> mis à jour
        </div>
<?php } ?>
<?php foreach ($days as $day) { ?>
    <form class="bg-blue-100 p-4 rounded-lg shadow space-y-4 my-6" method="post"
        action="index.php?page=update-date-valid&id=<?php echo $day->getId(); ?>" enctype="multipart/form-data">
        <div class="flex items-center justify-between gap-6">
            <input type="text" name="name" placeholder="Jour de la semaine" value="<?php echo $day->getName(); ?>"
                class="w-[25%] border rounded-lg" disabled>
            <div class="flex flex-col w-[25%]">
                <label for="start">Ouverture</label>
                <input type="time" id="start" name="start" class="border rounded-lg mt-3"
                    value="<?php echo $day->getStart(); ?>">
            </div>
            <div class="flex flex-col w-[25%]">
                <label for="end">Fermeture</label>
                <input type="time" id="end" name="end" class="border rounded-lg mt-3" value="<?php echo $day->getEnd(); ?>">
            </div>
            <button class="bg-blue-900 text-white px-6 py-2 rounded-lg hover:bg-blue-500">Modifier</button>
        </div>
    </form>
<?php } ?>

<?php include 'footer.php'; ?>
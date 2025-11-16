<?php include 'header.php'; ?>

<h1 class="text-3xl font-bold mb-6 text-center">Formulaire de prise de rendez-vous</h1>
<?php
if (isset($_GET['error'])) { ?>
    <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-3">Merci de saisir complètement le
        formulaire</div>
<?php } ?>
<div class="bg-blue-100 p-6 rounded-lg shadow space-y-4">
    <form class="space-y-4" method="POST"
        action="index.php?page=appointment-date-valid&id=<?php echo $user->getId(); ?>" enctype="multipart/form-data">
        <div class="flex items-center">
            <label for="name">Nom:</label>
            <input type="text" id="name" name="name" placeholder="Votre nom" class="w-full border rounded-lg p-3"
                value="<?php echo $user->getName(); ?>" disabled>
        </div>
        <div class="flex items-center">
            <label for="date">Jour du rendez-vous</label>
            <?php if (isset($_GET['date'])) { ?>
                <input type="date" id="date" name="date" value="<?php echo $_GET['date'] ?>"
                    class="w-full border rounded-lg p-3" required>
            <?php } else { ?>
                <input type="date" id="date" name="date" value="" class="w-full border rounded-lg p-3" required>
            <?php } ?>
        </div>
        <button class="bg-blue-900 text-white px-6 py-2 rounded-lg hover:bg-blue-500">Voir les créneaux
            disponibles</button>
    </form>
    <?php if (isset($_GET['date'])) { ?>
        <form class="space-y-4" action="index.php?page=appointment-valid" method="POST">
            <div>
                <label for="hour">Heure du rendez-vous : </label>
                <select name="hour" id="hour" class="border-2 rounded-lg" required>
                    <?php for ($time = $day->getStart(); $time < $day->getEnd(); $time->add(new DateInterval("PT30M"))) { ?>
                        <!-- <option value="<?php echo date('H:i:s', strtotime($time)) ?>"><?php echo $time->format('G\hi'); ?></option> -->
                    <?php } ?>
                </select>
            </div>
            <div>
                <label for="service">Motif du rendez-vous :</label>
                <select name="service" id="service" class="border-2 rounded-lg" required>
                    <?php foreach ($services as $service) { ?>
                        <option value="<?php echo $service->getId(); ?>"><?php echo $service->getName(); ?></option>
                    <?php } ?>
                </select>
            </div>
            <button class="bg-blue-900 text-white px-6 py-2 rounded-lg hover:bg-blue-500">Valider le rendez-vous</button>
            <?php echo $day->getEnd(); ?>
        </form>
    <?php } ?>
</div>



<?php include 'footer.php'; ?>
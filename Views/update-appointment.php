<?php include 'header.php'; ?>

<div class="appointmentPage">
    <h1 class="title">Formulaire de prise de rendez-vous</h1>
    <?php
    if (isset($_GET['error']) && $_GET['error'] === 'closed') { ?>
        <div class="error">Le cabinet dentaire est fermé le
            <?php echo date('d/m/Y', strtotime($_GET['error'])); ?>. Merci de choisir une autre date.
        </div>
    <?php } ?>
    <?php
    if (isset($_GET['error']) && $_GET['error'] === 'slotUsed') { ?>
        <div class="error">Le créneau souhaité n'est plus disponible.
        </div>
    <?php } ?>
    <div class="appointment">
        <form method="POST" action="index.php?page=appointment-date-valid&id_slot=<?php echo $_GET['id_slot']; ?>"
            enctype="multipart/form-data">
            <div class="data">
                <label for="name">Nom :</label>
                <select name="name" id="name" class="input">
                    <?php foreach ($users as $user) { ?>
                        <option value="<?php echo $user->getId(); ?>" <?php if ($user->getId() === $patient->getId()) { ?>selected<?php } ?>><?php echo $user->getName(); ?></option>
                    <?php } ?>
                </select>
            </div>
            <div class="data">
                <label for="date">Jour du rendez-vous :</label>
                <input type="date" id="date" name="date" value="<?php echo $_GET['date'] ?>" class="input" required>
            </div>
            <div class="appointmentBtn">
                <?php if (isset($_GET['date'])) { ?>
                    <button class="button">Actualiser</button>
                <?php } else { ?>
                    <a href="index.php?page=admin" class="button">Annuler</a>
                    <button class="button">Voir les créneaux disponibles</button>
                <?php } ?>
            </div>
        </form>
        <form
            action="index.php?page=update-appointment-valid&id_slot=<?php echo $id_slot; ?>&date=<?php echo $date; ?>&id=<?php echo $_GET['id'] ?? $patient->getId(); ?>"
            method="POST">
            <div class="hour">
                <label for="hour">Créneaux disponibles le <?php echo date('d/m/Y', strtotime($_GET['date'])); ?> :
                </label>
                <select name="hour" id="hour" class="input" required>
                    <?php for ($time = new DateTime($day->getStart()); $time < new DateTime($day->getEnd()); $time->add(new DateInterval('PT30M'))) { ?>
                        <?php if (in_array($time->format('H:i:s'), $bookedHours) || (date('Y-m-d', strtotime($_GET['date'])) === date('Y-m-d') && $time->format('H:i:s') < date('H:i:s')))
                            continue; ?>
                        <option value="<?php echo $time->format('H:i:s') ?>">
                            <?php echo $time->format('G\hi'); ?>
                        </option>
                    <?php } ?>
                </select>
            </div>
            <div class="data">
                <label for="service">Motif du rendez-vous :</label>
                <select name="service" id="service" class="input" required>
                    <?php foreach ($services as $service) { ?>
                        <option value="<?php echo $service->getId(); ?>" <?php if ($service->getId() === $serve->getId()) { ?>selected<?php } ?>><?php echo $service->getName(); ?></option>
                    <?php } ?>
                </select>
            </div>
            <div class="appointmentBtn">
                <a href="index.php?page=admin" class="button">Annuler</a>
                <button class="button">Valider le rendez-vous</button>
            </div>
        </form>
    </div>
</div>


<?php include 'footer.php'; ?>
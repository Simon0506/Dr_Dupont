<?php include 'header.php'; ?>

<div class="appointmentPage">
    <h1 class="title">Formulaire de prise de rendez-vous</h1>
    <?php
    if (isset($_GET['error']) && $_GET['error'] === 'closed') { ?>
        <div class="error">Le cabinet dentaire est fermé le
            <?php echo date('d/m/Y', strtotime($_GET['date'])); ?>. Merci de choisir une autre date.
        </div>
    <?php } ?>
    <?php
    if (isset($_GET['error']) && $_GET['error'] === 'slotUsed') { ?>
        <div class="error">Le créneau souhaité n'est plus disponible.
        </div>
    <?php } ?>
    <div class="appointment">
        <form method="POST" action="index.php?page=appointment-date-valid" enctype="multipart/form-data">
            <div class="data">
                <label for="name">Nom :</label>
                <select name="name" id="name" class="input">
                    <?php foreach ($patients as $patient) { ?>
                        <option value="<?php echo $patient->getId(); ?>" <?php if (isset($_GET['id']) && $patient->getId() === (int) $_GET['id']) { ?>selected<?php } ?>><?php echo $patient->getName(); ?>
                        </option>
                    <?php } ?>
                </select>
            </div>
            <div class="data">
                <label for="date">Jour du rendez-vous :</label>
                <?php if (isset($_GET['date'])) { ?>
                    <input type="date" id="date" name="date" value="<?php echo $_GET['date'] ?>" class="date" required>
                <?php } else { ?>
                    <input type="date" id="date" name="date" value="" class="date" required>
                <?php } ?>
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
        <?php if (isset($_GET['date'])) { ?>
            <form action="index.php?page=appointment-valid&id=<?php echo $id; ?>&date=<?php echo $date; ?>" method="POST">
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
                            <option value="<?php echo $service->getId(); ?>"><?php echo $service->getName(); ?></option>
                        <?php } ?>
                    </select>
                </div>
                <div class="appointmentBtn">
                    <a href="index.php?page=admin" class="button">Annuler</a>
                    <button class="button">Valider le rendez-vous</button>
                </div>
            </form>
        <?php } ?>
    </div>
</div>


<?php include 'footer.php'; ?>
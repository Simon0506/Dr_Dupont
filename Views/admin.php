<?php include 'header.php'; ?>

<?php if (isset($_GET['dateValidated'])) { ?>
    <p class="validated">Rendez-vous du <?php echo date('d/m/Y', strtotime($_GET['dateValidated'])); ?> à
        <?php echo date('G\hi', strtotime($_GET['hour'])); ?> pour <?php echo $user->getName(); ?> validé !
    </p>
<?php } ?>
<?php if (isset($_GET['dateUpdated'])) { ?>
    <p class="updated">Rendez-vous du <?php echo date('d/m/Y', strtotime($_GET['dateUpdated'])); ?> à
        <?php echo date('G\hi', strtotime($_GET['hour'])); ?> pour <?php echo $user->getName(); ?> mis à jour !
    </p>
<?php } ?>

<div class="adminPage">
    <div>
        <h1 class="title">Rendez-vous de la journée du
            <?php echo date('d/m/Y', strtotime($_GET['date'] ?? $today->format('Y-m-d'))); ?>
        </h1>
        <form class="adminForm" action="index.php?page=list" method="POST">
            <div class="gridInput">
                <label for="date">Changer de date : </label>
                <input type="date" id="date" class="date" name="date"
                    value="<?php echo date('Y-m-d', strtotime($date)); ?>">
            </div>
            <button class="button">Actualiser</button>
        </form>
        <table class="list">
            <thead>
                <tr>
                    <th>
                        Heure</th>
                    <th>Nom du patient</th>
                    <th>Motif</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($data as $entry) { ?>
                    <tr
                        class="<?php if (date('Y-m-d', strtotime($date)) < $today->format('Y-m-d') || (date('Y-m-d', strtotime($date)) === $today->format('Y-m-d') && date('H:i:s', strtotime($entry['hour'])) < date('H:i:s'))) { ?> rowPast <?php } ?>">
                        <td>
                            <?php echo date('G\hi', strtotime($entry['hour'])); ?>
                        </td>
                        <td><?php echo $entry['patient']->getName(); ?></td>
                        <td><?php echo $entry['service']->getName(); ?></td>
                        <td class="actions">
                            <a href="index.php?page=update-appointment&id_slot=<?php echo $entry['id_slot']; ?>&date=<?php echo date('Y-m-d', strtotime($_GET['date'] ?? $today->format('Y-m-d'))); ?>"
                                class="update">Modifier</a>
                            <a href="index.php?page=delete-appointment&id=<?php echo $entry['id_slot']; ?>"
                                class="delete">Supprimer</a>
                        </td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>
    <div>
        <h2>Paramètres</h2>
        <div class="settings">
            <a href="index.php?page=appointmentAdmin" class="button setting1">
                Ajouter un RDV
            </a>
            <a href="index.php?page=patientsAdmin" class="button">
                Patients
            </a>
            <a href="index.php?page=servicesAdmin" class="button">
                Services
            </a>
            <a href="index.php?page=postsAdmin" class="button">
                Actualités
            </a>
            <a href="index.php?page=update-date" class="button">
                Horaires
            </a>
        </div>
    </div>
</div>

<?php include 'footer.php'; ?>
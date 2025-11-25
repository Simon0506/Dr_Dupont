<?php include 'header.php'; ?>

<div class="patientsAdmin">
    <h1 class="title">Gestion des patients</h1>
    <div class="add">
        <a href="index.php?page=create-patient" class="button">Nouveau patient</a>
    </div>
    <?php if (!$patients) { ?>
        <p>Aucun patient.</p>
    <?php } else { ?>
        <?php
        if (isset($_GET['error']) && $_GET['error'] === 'nofile') { ?>
            <div class="error">Dossier patient introuvable
            </div>
        <?php } ?>
        <div class="table-scroll">
            <table class="list">
                <thead>
                    <tr>
                        <th>Nom du patient</th>
                        <th>Date de naissance</th>
                        <th>Email</th>
                        <th>Numéro de téléphone</th>
                        <th>Numéro de sécurité sociale</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($patients as $patient) { ?>
                        <tr>
                            <td><?php echo $patient->getName(); ?></td>
                            <td><?php echo date('d/m/Y', strtotime($patient->getDateOfBirth())); ?></td>
                            <td><?php echo $patient->getEmail(); ?></td>
                            <td><?php echo $patient->getPhone(); ?></td>
                            <td><?php echo $patient->getSSN(); ?></td>
                            <td class="actions">
                                <a href="index.php?page=update-patient&id=<?php echo $patient->getId(); ?>"
                                    class="update">Modifier</a>
                                <a href="index.php?page=delete-patient&id=<?php echo $patient->getId(); ?>"
                                    class="delete">Supprimer</a>
                            </td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    <?php } ?>
</div>

<?php include 'footer.php'; ?>
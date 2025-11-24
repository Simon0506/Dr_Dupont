<?php include 'header.php'; ?>

<div class="servicesAdmin">
    <h1 class="title">Gestion des services</h1>
    <div class="add">
        <a href="index.php?page=create-service" class="button">Nouveau service</a>
    </div>

    <?php if (!$services) { ?>
        <p>Aucun service.</p>
    <?php } else { ?>
        <table class="list">
            <thead>
                <tr>
                    <th>Service</th>
                    <th>Description</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($services as $service) { ?>
                    <tr>
                        <td><?php echo $service->getName(); ?></td>
                        <td><?php echo $service->getDescription(); ?></td>
                        <td class="actions">
                            <a href="index.php?page=update-service&id=<?php echo $service->getId(); ?>"
                                class="update">Modifier</a>
                            <a href="index.php?page=delete-service&id=<?php echo $service->getId(); ?>"
                                class="delete">Supprimer</a>
                        </td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    <?php } ?>
</div>

<?php include 'footer.php'; ?>
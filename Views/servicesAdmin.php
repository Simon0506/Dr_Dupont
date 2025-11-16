<?php include 'header.php'; ?>

<h1 class="text-3xl font-bold mb-6  min-w-[700px] text-center">Gestion des services</h1>
<a href="index.php?page=create-service"
    class="mb-6 inline-block bg-blue-900 text-white px-6 py-2 rounded-lg hover:bg-blue-500">Nouveau service</a>
<?php if (!$services) { ?>
    <p>Aucun service.</p>
<?php } else { ?>
    <table class="w-full bg-white shadow rounded-lg">
        <thead class="bg-gray-100 text-left">
            <tr>
                <th class="p-4">Nom du service</th>
                <th class="p-4">Description</th>
                <th class="p-4">Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($services as $service) { ?>
                <tr class="border-t">
                    <td class="p-4"><?php echo $service->getName(); ?></td>
                    <td class="p-4"><?php echo $service->getDescription(); ?></td>
                    <td class="p-4 text-center space-x-2">
                        <a href="index.php?page=update-service&id=<?php echo $service->getId(); ?>"
                            class="text-blue-900 hover:underline">Modifier</a>
                        <a href="index.php?page=delete-service&id=<?php echo $service->getId(); ?>"
                            class="text-red-600 hover:underline">Supprimer</a>
                    </td>
                </tr>
            <?php } ?>
        </tbody>
    </table>
<?php } ?>

<?php include 'footer.php'; ?>
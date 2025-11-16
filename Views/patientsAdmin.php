<?php include 'header.php'; ?>

<h1 class="text-3xl font-bold mb-6  min-w-[700px] text-center">Gestion des patients</h1>
<a href="index.php?page=create-patient"
    class="mb-6 inline-block bg-blue-900 text-white px-6 py-2 rounded-lg hover:bg-blue-500">Nouveau patient</a>
<?php if (!$patients) { ?>
    <p>Aucun patient.</p>
<?php } else { ?>
    <?php
    if (isset($_GET['error']) && $_GET['error'] === 'nofile') { ?>
        <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-3">Dossier patient introuvable
        </div>
    <?php } ?>
    <table class="w-full bg-white shadow rounded-lg">
        <thead class="bg-gray-100 text-left">
            <tr>
                <th class="p-4">Nom du patient</th>
                <th class="p-4">Date de naissance</th>
                <th class="p-4">Email</th>
                <th class="p-4">Numéro de téléphone</th>
                <th class="p-4">Numéro de sécurité sociale</th>
                <th class="p-4">Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($patients as $patient) { ?>
                <tr class="border-t">
                    <td class="p-4"><?php echo $patient->getName(); ?></td>
                    <td class="p-4"><?php echo date('d/m/Y', strtotime($patient->getDateOfBirth())); ?></td>
                    <td class="p-4"><?php echo $patient->getEmail(); ?></td>
                    <td class="p-4"><?php echo $patient->getPhone(); ?></td>
                    <td class="p-4"><?php echo $patient->getSSN(); ?></td>
                    <td class="p-4 text-center space-x-2">
                        <a href="index.php?page=update-patient&id=<?php echo $patient->getId(); ?>"
                            class="text-blue-900 hover:underline">Modifier</a>
                        <a href="index.php?page=delete-patient&id=<?php echo $patient->getId(); ?>"
                            class="text-red-600 hover:underline">Supprimer</a>
                    </td>
                </tr>
            <?php } ?>
        </tbody>
    </table>
<?php } ?>

<?php include 'footer.php'; ?>
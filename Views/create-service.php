<?php include 'header.php'; ?>

<h1 class="text-3xl font-bold mb-6">Ajouter un nouveau service</h1>
<?php
if (isset($_GET['error'])) { ?>
    <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-3">Merci de saisir le nom du service à
        ajouter
    </div>
<?php } ?>
<form class="bg-white p-6 rounded-lg shadow space-y-4" method="post" action="index.php?page=create-service-valid"
    enctype="multipart/form-data">
    <input type="text" name="name" placeholder="Nom du service" class="w-full border rounded-lg p-3">
    <textarea name="description" placeholder="Description du service"
        class="w-full border rounded-lg p-3 h-40"></textarea>
    <button class="bg-blue-900 text-white px-6 py-2 rounded-lg hover:bg-blue-500">Publier</button>
</form>

<?php include 'footer.php'; ?>
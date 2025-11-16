<?php include 'header.php'; ?>

<div class="bg-white p-8 rounded-xl shadow-md w-full max-w-md mx-auto my-12">
    <h1 class="text-2xl font-bold mb-6">Modifier un service</h1>
    <?php
    if (isset($_GET['error']) && $_GET['error'] === 'fields') { ?>
        <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-3">Merci de renseigner le nom du
            service
        </div>
    <?php } ?>
    <form class="space-y-4" action="index.php?page=update-service-valid&id=<?php echo $_GET['id']; ?>" method="POST">
        <input type="text" name="name" placeholder="Nom du service" class="w-full border rounded-lg p-3"
            value="<?php echo $service->getName(); ?>">
        <textarea name="description" placeholder="Description du service"
            class="w-full border rounded-lg p-3 h-40"><?php echo $service->getDescription(); ?></textarea>
        <button class="w-full bg-blue-900 text-white px-6 py-3 rounded-lg hover:bg-blue-500">Modifier</button>
    </form>
</div>

<?php include 'footer.php'; ?>
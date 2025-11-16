<?php include 'header.php'; ?>

<h1 class="text-3xl font-bold mb-8 text-center">Services proposés par le Dr Dupont</h1>
<div class="grid md:grid-cols-2 gap-10">
    <?php foreach ($services as $service) { ?>
        <div class="bg-blue-100 shadow rounded-xl p-6">
            <h2 class="text-xl font-semibold mb-2 text-center"><?php echo $service->getName(); ?></h2>
            <p class="mb-4 text-justify"><?php echo $service->getDescription(); ?></p>
        </div>
    <?php } ?>
</div>

<?php include 'footer.php'; ?>
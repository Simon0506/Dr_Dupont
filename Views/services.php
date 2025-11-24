<?php include 'header.php'; ?>
<div class="servicePage">
    <h1 class="title">Services proposés par le Dr Dupont</h1>
    <div class="gridCards">
        <?php foreach ($services as $service) { ?>
            <div class="card">
                <h2 class="titlecard"><?php echo $service->getName(); ?></h2>
                <p><?php echo $service->getDescription(); ?></p>
            </div>
        <?php } ?>
    </div>
</div>
<?php include 'footer.php'; ?>
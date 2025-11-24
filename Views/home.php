<?php include "header.php"; ?>

<?php if (isset($_GET['dateValidated'])) { ?>
    <p class="validated">Votre rendez-vous du
        <?php echo date('d/m/Y', strtotime($_GET['dateValidated'])); ?> à
        <?php echo date('G\hi', strtotime($_GET['hour'])); ?> est
        validé !
    </p>
<?php } ?>
<section class="home">

    <div class="intro">
        <div class="descriptionHome">
            <h1 class="title fa-solid fa-tooth">DR DUPONT</h1>
            <p>Passionné par la santé bucco-dentaire et le bien-être de ses patients, le Dr Dupont
                accompagne adultes et enfants avec une approche à la fois professionnelle et bienveillante.
                <br><br>Soucieux
                d’offrir des soins de qualité, il privilégie l’écoute, la pédagogie et des techniques modernes pour
                garantir
                un traitement confortable et adapté à chacun. <br><br>Son objectif : redonner à chaque sourire toute sa
                confiance.
            </p>
        </div>
        <img class="photo" src="assets/Image_11_52_42.png" alt="image de fond">
        <div>
            <h2><i class="fa-regular fa-clock"></i> Horaires d'ouverture</h2>
            <?php foreach ($days as $day) { ?>
                <p class="schedules"><?php echo $day->getName(); ?> de
                    <?php echo date('G\hi', strtotime($day->getStart())); ?> à
                    <?php echo date('G\hi', strtotime($day->getEnd())); ?>
                </p>
            <?php } ?>
        </div>
    </div>

    <div>
        <h2><i class="fa-solid fa-hand-holding-medical"></i> Nos services </h2>
        <div class="gridCards">
            <?php foreach ($services as $service) { ?>
                <div class="card">
                    <h3 class="titlecard"><?php echo $service->getName(); ?></h3>
                </div>
            <?php } ?>
        </div>
    </div>
    <a href="index.php?page=appointment" class="button btnHome">Prendre
        rendez-vous</a>
</section>

<?php include "footer.php"; ?>
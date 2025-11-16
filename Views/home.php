<?php include "header.php"; ?>

<h1 class="text-3xl font-bold mb-8 text-center text-blue-900">Cabinet du Dr Dupont</h1>
<p class="text-justify">Lorem ipsum, dolor sit amet consectetur adipisicing elit. Accusantium, omnis amet
    aperiam quos
    facilis suscipit doloribus possimus, animi illo nesciunt libero ullam similique accusamus minus odio, cum ipsam
    distinctio fugiat.
    Maiores rem minus corrupti eaque, dolore odit voluptatibus magni nemo similique deleniti dolores. Quibusdam quidem
    cum veritatis, nemo temporibus amet recusandae ipsam, rem, debitis nisi neque atque reprehenderit ducimus autem.
    Similique doloremque excepturi temporibus fugit, quam debitis, obcaecati, nihil ducimus ratione vel dolores eligendi
    sunt laudantium ipsam? Nobis, dicta velit, minima dolorem dolor totam eius dolorum ea ex fugit nesciunt?</p>
<div class="flex items-center justify-center space-x-10 py-6">
    <img class="rounded-lg max-w-[30%]"
        src="assets/freepik__the-style-is-candid-image-photography-with-natural__60860.jpg" alt="Accueil du cabinet">
    <img class="rounded-lg max-w-[30%]"
        src="assets/freepik__the-style-is-candid-image-photography-with-natural__60861.jpg" alt="Accueil du cabinet">
    <img class="rounded-lg max-w-[30%]"
        src="assets/freepik__the-style-is-candid-image-photography-with-natural__60859.jpg" alt="Accueil du cabinet">
</div>
<section>
    <h2 class="text-center py-6 text-2xl font-bold text-blue-900">Nos services</h2>
    <p>Au sein de son cabinet, le Dr Dupont vous reçoit pour différents types de soins :</p>
    <div class=" ml-10 py-4">
        <?php foreach ($services as $service) { ?>
            <p class="mt-5 font-semibold underline"><?php echo $service->getName(); ?> : </p>
            <p><?php echo $service->getDescription(); ?></p>
        <?php } ?>
    </div>
    <p>Si vous avez besoin de l'une de ces prestations, n'hésitez pas à prendre rendez-vous en cliquant sur le bouton
        situé en bas de page.</p>
</section>
<section>
    <h2 class="text-center py-6 text-2xl font-bold text-blue-900">Horaires d'ouverture</h2>
    <ul class="mx-auto text-center">
        <?php foreach ($days as $day) { ?>
            <li><?php echo $day->getName(); ?> de <?php echo date('G\hi', strtotime($day->getStart())); ?> à
                <?php echo date('G\hi', strtotime($day->getEnd())); ?>
            </li>
        <?php } ?>
    </ul>
    <div class="flex items-center justify-center">
        <a href="index.php?page=appointment"
            class="my-10 bg-blue-900 text-white text-xl font-semibold py-5 px-10 border rounded-2xl cursor-pointer hover:bg-blue-500">Prendre
            rendez-vous</a>
    </div>

</section>

<?php include "footer.php"; ?>
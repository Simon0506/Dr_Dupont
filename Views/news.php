<?php include 'header.php'; ?>

<h1 class="text-3xl font-bold mb-8 text-center">Actualités de la santé</h1>
<?php foreach ($articles as $article) { ?>
    <article class="bg-blue-50 shadow rounded-xl p-6">
        <h2 class="text-xl font-semibold mb-2"><?php echo $article->getTitle(); ?></h2>
        <div class="flex space-x-10">
            <p class="text-gray-600 mb-4 text-justify"><?php echo $article->getContent(); ?></p>
            <?php if ($article->getImage()) { ?>
                <img class="rounded-lg mb-4" src="assets/<?php echo $article->getImage(); ?>"
                    alt="<?php echo $article->getTitle(); ?>">
            <?php } ?>
        </div>
        <div class="flex justify-between text-sm text-gray-500 gap-10">
            <span>Par <?php echo $article->getAuthor(); ?></span>
            <a href="<?php echo $article->getUrl(); ?>" target="_blank" class="text-blue-900 hover:text-blue-500">En savoir
                plus -></a>
        </div>
    </article>
<?php } ?>

<?php include 'footer.php'; ?>
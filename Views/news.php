<?php include 'header.php'; ?>
<div class="newsPage">
    <h1 class="title">Actualités de la santé</h1>
    <div class="articles">
        <?php foreach ($articles as $article) { ?>
            <article class="card">
                <h2 class="titlecard"><a href="index.php?page=article&id=<?php echo $article->getId(); ?>"
                        class="link"><?php echo $article->getTitle(); ?></a></h2>
                <div class="articleCard">
                    <?php if ($article->getImage()) { ?>
                        <img class="articleImg" src="assets/<?php echo $article->getImage(); ?>"
                            alt="<?php echo $article->getTitle(); ?>">
                    <?php } ?>
                    <p><?php echo $article->getDescription(); ?></p>
                </div>
                <span class="author">Par <?php echo $article->getAuthor(); ?></span>
            </article>
        <?php } ?>
    </div>

</div>


<?php include 'footer.php'; ?>
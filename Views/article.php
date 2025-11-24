<?php include 'header.php'; ?>
<div class="newsPage">
    <h1 class="title">Actualités de la santé</h1>
    <article class="card">
        <h2 class="titlecard"><?php echo $article->getTitle(); ?></h2>
        <div class="articleCard">
            <?php if ($article->getImage()) { ?>
                <img class="articleImg" src="assets/<?php echo $article->getImage(); ?>"
                    alt="<?php echo $article->getTitle(); ?>">
            <?php } ?>
            <p><?php echo $article->getContent(); ?></p>
        </div>
        <div class="author">
            <span>Par <?php echo $article->getAuthor(); ?></span>
            <a href="<?php echo $article->getUrl(); ?>" target="_blank" class="link">Visiter le site source <i
                    class="fa-solid fa-up-right-from-square"></i></a>
        </div>
    </article>
    <div class="back">
        <a href="index.php?page=news" class="button">Retour aux actualités</a>
    </div>
</div>


<?php include 'footer.php'; ?>
<?php include 'header.php'; ?>

<div class="updatePage">
    <h1 class="title">Modifier l’actualité</h1>
    <?php
    if (isset($_GET['error'])) { ?>
        <div class="error">Merci de saisir complètement le
            formulaire
        </div>
    <?php } ?>
    <form class="updateForm" method="post" action="index.php?page=update-post-valid&id=<?php echo $_GET['id']; ?>"
        enctype="multipart/form-data">
        <input type="text" name="title" placeholder="Titre de l’actualité" class="input"
            value="<?php echo $article->getTitle(); ?>" required>
        <input type="text" name="author" placeholder="Nom de l'auteur ou du site" class="input"
            value="<?php echo $article->getAuthor(); ?>" required>
        <?php if ($article->getImage()) { ?>
            <img class="articleImg" src="assets/<?php echo $article->getImage(); ?>"
                alt="<?php echo $article->getTitle(); ?>">
        <?php } ?>
        <div class="addImage input">
            <label for="image">Changer l'image :</label>
            <input type="file" id="image" name="image" accept="image/*">
        </div>
        <textarea name="content" placeholder="Contenu de l’actualité" class="input"
            required><?php echo $article->getContent(); ?></textarea>
        <input type="text" name="url" placeholder="Lien vers la page internet" class="input"
            value="<?php echo $article->getUrl(); ?>">
        <div>
            <a href="index.php?page=postsAdmin" class="button">Annuler</a>
            <button class="button">Publier</button>
        </div>
    </form>
</div>

<?php include 'footer.php'; ?>
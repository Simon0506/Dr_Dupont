<?php include 'header.php'; ?>

<h1 class="text-3xl font-bold mb-6">Modifier l’actualité</h1>
<?php
if (isset($_GET['error'])) { ?>
    <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-3">Merci de saisir complètement le
        formulaire
    </div>
<?php } ?>
<form class="bg-white p-6 rounded-lg shadow space-y-4" method="post"
    action="index.php?page=update-post-valid&id=<?php echo $_GET['id']; ?>" enctype="multipart/form-data">
    <input type="text" name="title" placeholder="Titre de l’actualité" class="w-full border rounded-lg p-3"
        value="<?php echo $article->getTitle(); ?>">
    <input type="text" name="author" placeholder="Nom de l'auteur ou du site" class="w-full border rounded-lg p-3"
        value="<?php echo $article->getAuthor(); ?>">
    <?php if ($article->getImage()) { ?>
        <img class="rounded-lg mb-4" src="assets/<?php echo $article->getImage(); ?>"
            alt="<?php echo $article->getTitle(); ?>">
    <?php } ?>
    <label for="image">Insérer une nouvelle image pour remplacer l'actuelle :</label>
    <input type="file" id="image" name="image" placeholder="Image de l’article" class="w-full border rounded-lg p-3"
        accept="image/*">
    <textarea name="content" placeholder="Contenu de l’actualité"
        class="w-full border rounded-lg p-3 h-40"><?php echo $article->getContent(); ?></textarea>
    <input type="text" name="url" placeholder="Lien vers la page internet" class="w-full border rounded-lg p-3"
        value="<?php echo $article->getUrl(); ?>">
    <button class="bg-blue-900 text-white px-6 py-2 rounded-lg hover:bg-blue-500">Publier</button>
</form>

<?php include 'footer.php'; ?>
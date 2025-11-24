<?php include 'header.php'; ?>

<div class="addPage">
    <h1 class="title">Ajouter une nouvelle actualité</h1>
    <?php
    if (isset($_GET['error'])) { ?>
        <div class="error">Merci de saisir complètement le
            formulaire
        </div>
    <?php } ?>
    <form class="addForm" method="post" action="index.php?page=create-post-valid" enctype="multipart/form-data">
        <input type="text" name="title" placeholder="Titre de l’actualité" class="input" required>
        <input type="text" name="author" placeholder="Nom de l'auteur ou du site" class="input" required>
        <textarea name="content" placeholder="Contenu de l’actualité" class="input" required></textarea>
        <div class="addImage input">
            <label for="image">Ajouter une image (facultatif)</label>
            <input type="file" name="image" id="image" class="" accept="image/*">
        </div>
        <input type="text" name="url" placeholder="Lien vers la page internet (facultatif)" class="input">
        <div>
            <a href="index.php?page=postsAdmin" class="button">Annuler</a>
            <button class="button">Publier</button>
        </div>
    </form>
</div>

<?php include 'footer.php'; ?>
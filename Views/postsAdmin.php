<?php include 'header.php'; ?>

<div class="postsAdmin">
    <h1 class="title">Gestion des actualités</h1>
    <div class="add">
        <a href="index.php?page=create-post" class="button">Nouvelle actualité</a>
    </div>

    <?php if (!$articles) { ?>
        <p>Aucune actualité pour le moment.</p>
    <?php } else { ?>
        <table class="list">
            <thead>
                <tr>
                    <th>Titre</th>
                    <th>Auteur</th>
                    <th>Source</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($articles as $article) { ?>
                    <tr>
                        <td><?php echo $article->getTitle(); ?></td>
                        <td><?php echo $article->getAuthor(); ?></td>
                        <td><?php echo $article->getUrl(); ?></td>
                        <td class="actions">
                            <a href="index.php?page=update-post&id=<?php echo $article->getId(); ?>" class="update">Modifier</a>
                            <a href="index.php?page=delete-post&id=<?php echo $article->getId(); ?>"
                                class="delete">Supprimer</a>
                        </td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    <?php } ?>
</div>

<?php include 'footer.php'; ?>
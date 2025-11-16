<?php include 'header.php'; ?>

<h1 class="text-3xl font-bold mb-6  min-w-[700px] text-center">Gestion des actualités</h1>
<a href="index.php?page=create-post"
    class="mb-6 inline-block bg-blue-900 text-white px-6 py-2 rounded-lg hover:bg-blue-500">Nouvelle actualité</a>
<?php if (!$articles) { ?>
    <p>Aucune actualité pour le moment.</p>
<?php } else { ?>
    <table class="w-full bg-white shadow rounded-lg">
        <thead class="bg-gray-100 text-left">
            <tr>
                <th class="p-4">Titre</th>
                <th class="p-4">Auteur</th>
                <th class="p-4">Source</th>
                <th class="p-4">Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($articles as $article) { ?>
                <tr class="border-t">
                    <td class="p-4"><?php echo $article->getTitle(); ?></td>
                    <td class="p-4"><?php echo $article->getAuthor(); ?></td>
                    <td class="p-4"><?php echo $article->getUrl(); ?></td>
                    <td class="p-4 text-center space-x-2">
                        <a href="index.php?page=update-post&id=<?php echo $article->getId(); ?>"
                            class="text-blue-900 hover:underline">Modifier</a>
                        <a href="index.php?page=delete-post&id=<?php echo $article->getId(); ?>"
                            class="text-red-600 hover:underline">Supprimer</a>
                    </td>
                </tr>
            <?php } ?>
        </tbody>
    </table>
<?php } ?>

<?php include 'footer.php'; ?>
<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ajouter un Livre</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">

</head>

<body>

    <?php
    include("component/navbar.php");
    navbar();
    ?>
    <div class="container">
        <h2>Ajouter un Livre</h2>
        <form action="traitement_ajout.php" method="post" enctype="multipart/form-data">
            <div class="form-group">
                <label for="titre">Titre:</label>
                <input type="text" class="form-control" id="titre" name="titre" required>
            </div>
            <div class="form-group">
                <label for="auteur">Auteur:</label>
                <input type="text" class="form-control" id="auteur" name="auteur">
            </div>
            <div class="form-group">
                <label for="description">Description:</label>
                <textarea class="form-control" id="description" name="description"></textarea>
            </div>
            <div class="form-group">
                <label for="image_url">URL de l'Image:</label>
                <input type="text" class="form-control" id="image_url" name="image_url">
            </div>
            <div class="form-group">
                <label for="pdf">Télécharger le PDF:</label>
                <input type="file" class="form-control-file" id="pdf" name="pdf" accept=".pdf" required>
            </div>
            <button type="submit" class="btn btn-primary">Ajouter le Livre</button>
        </form>
    </div>
</body>

</html>
<?php
include('config.php');
include('component/navbar.php');
?>
<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ma Bibliothèque Virtuelle</title>
    <!-- Lien vers Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">

</head>

<body>
    <?php
    navbar();
    ?>
    <div class="container mt-3 mt-lg-5">
        <div class="row justify-content-center">
            <div class="col-lg-8 col-md-10 col-sm-12">
                <!-- Card principal -->
                <div class="card">
                    <div class="card-header text-center">
                        <h1>Bienvenue dans ma bibliothèque virtuelle</h1>
                    </div>
                    <div class="card-body">
                        <h4 class="card-title text-center">Choisissez une option :</h4>
                        <div class="row">
                            <!-- Voir les livres -->
                            <div class="col-md-6 text-center mb-4">
                                <a href="lister_livres.php" class="btn btn-primary btn-lg">Voir mes livres</a>
                            </div>
                            <!-- Ajouter un livre -->
                            <div class="col-md-6 text-center mb-4">
                                <a href="ajouter_livre.php" class="btn btn-secondary btn-lg">Ajouter un livre</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="position-absolute fixed-bottom d-flex justify-content-end p-3">
        <button type="button" class="btn btn-outline-dark" data-bs-toggle="modal" data-bs-target="#exampleModal">
            +
        </button>
    </div>


    <!-- Modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-scrollable">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Modal title</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
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
                            <button type="submit" class="btn btn-primary mt-1">Ajouter le Livre</button>
                        </form>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fermer</button>
                </div>
            </div>
        </div>
    </div>



    <!-- Script Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.min.js"></script>
</body>

</html>
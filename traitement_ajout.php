<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">

</head>

<body>




    <?php

    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
    error_reporting(E_ALL);
    include('config.php');
    include('createImagePdf.php');



    // Vérifier si le formulaire a été soumis
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Récupérer les données du formulaire
        $titre = $_POST['titre'];
        $auteur = $_POST['auteur'];
        $description = $_POST['description'];
        $image_url = "";

        // Gérer le téléchargement du fichier PDF
        $pdf_dir = 'pdf/'; // Dossier où le PDF sera stocké
        $pdf_file = $pdf_dir . basename($_FILES["pdf"]["name"]);
        $uploadOk = 1;
        // Affiche les erreurs et informations de débogage
        echo "<pre>";
        print_r($_FILES);
        echo "</pre>";


        // Vérifier si le fichier est un PDF
        $fileType = pathinfo($pdf_file, PATHINFO_EXTENSION);
        if ($fileType != "pdf") {
            echo "<div class='alert alert-danger'>Désolé, seul les fichiers PDF sont autorisés. </div>";
            $uploadOk = 0;
        }

        // Vérifier si le fichier peut être téléchargé
        if ($uploadOk == 1) {
            if (move_uploaded_file($_FILES["pdf"]["tmp_name"], $pdf_file)) {
                echo "
            <div class='container'><h1>Le fichier " . htmlspecialchars(basename($_FILES["pdf"]["name"])) . " a été téléchargé.</h1></div>";
            $image_url = createImagePdf($pdf_file, basename($_FILES["pdf"]["name"]));
            } else {
                echo "Désolé, une erreur est survenue lors du téléchargement de votre fichier. Erreur " . $_FILES["pdf"]["error"];
                $uploadOk = 0;
            }
        }

        // Si le téléchargement est réussi, insérer les données dans la base de données
        if ($uploadOk == 1) {
            // Préparer une requête pour insérer le livre dans la base de données
            $sql = "INSERT INTO livres (titre, auteur, description, image_url, pdf_url) VALUES (?, ?, ?, ?, ?)";
            $stmt = $conn->prepare($sql);

            if ($stmt) {
                // Lier les paramètres
                $pdf_url = $pdf_file; // URL du PDF
                $stmt->bind_param("sssss", $titre, $auteur, $description, $image_url, $pdf_url);

                // Exécuter la requête
                if ($stmt->execute()) {
                    echo "Livre ajouté avec succès.";
                } else {
                    echo "Erreur lors de l'ajout du livre: " . $stmt->error;
                }

                // Fermer la déclaration
                $stmt->close();
            } else {
                echo "Erreur de préparation de la requête: " . $conn->error;
            }
        }
    }
    // Fermer la connexion
    $conn->close();
    ?>
    <a class="btn" href="/">retour à l'acceuil</a>

</body>

</html>
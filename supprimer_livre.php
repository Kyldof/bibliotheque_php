<?php
include('config.php');

// Vérifier si l'ID du livre est passé en paramètre
if (isset($_GET['id'])) {
    $livre_id = $_GET['id'];

    // Requête pour supprimer le livre de la base de données
    $SQLRequest_file = "SELECT pdf_url from livres where id = ?";
    $Request_file = $conn->prepare($SQLRequest_file);
    if ($Request_file) {
        $Request_file->bind_param("i", $livre_id);
        $Request_file->execute();
        $Request_file->bind_result($pdf_url);
        $Request_file->fetch();
        $Request_file->close();

    }

    if (file_exists($pdf_url)) {
        if (unlink($pdf_url)) {
            echo "fichier supprimé avec succès";
        } else {
            echo "impossible de supprimer le fichier";
        }


    } else {
        echo "Erreur, le fichier $pdf_url n'existe pas";
    }
    $sql = "DELETE FROM livres WHERE id = ?";

    $stmt = $conn->prepare($sql);

    if ($stmt) {
        // Lier l'ID et exécuter la requête
        $stmt->bind_param("i", $livre_id);
        if ($stmt->execute()) {
            echo "Le livre a été supprimé avec succès.";

        } else {
            echo "Erreur lors de la suppression du livre.";
        }

        // Fermer la déclaration
        $stmt->close();
    } else {
        echo "Erreur de préparation de la requête.";
    }

    // Rediriger vers la page d'accueil après la suppression
    header('Location: lister_livres.php');
    exit();
} else {
    echo "ID du livre non spécifié.";
}

$conn->close();
?>
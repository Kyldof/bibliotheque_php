<?php

function createImagePdf($pdf_path, $name) : string {
    // Chemin du PDF et du dossier d'images
$image_path = 'imagepdf/'.substr($name, 0, -3)."png";


// Créer une instance Imagick et charger le PDF
$imagick = new Imagick();
$imagick->setResolution(150, 150); // Résolution de l'image
$imagick->readImage($pdf_path . '[0]'); // Lire uniquement la première page

// Convertir en JPEG et enregistrer l'image
$imagick->setImageFormat('jpeg');
$imagick->writeImage($image_path);
return $image_path;


    
}

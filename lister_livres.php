<?php
include('config.php');
include('component/navbar.php');

$search = "";
if (isset($_GET['search'])) {

    $search = $conn->real_escape_string($_GET['search']);

    $sql = "SELECT * from livres WHERE titre LIKE '%$search%'";
} else {
    $sql = "SELECT * FROM livres";
}

// Requête pour récupérer tous les livres

$res = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Liste des Livres</title>
    <!-- Lien vers Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">

</head>

<body>
    <?php
    navbarSearch();
    ?>
    <div id="contextMenu" class="context-menu" style="display:none; position:absolute; z-index:2">
        <ul class="list-group">
            <li style="cursor:pointer" class="list-group-item btn-outline-dark" onclick="deleteBook()">Supprimer</li>
        </ul>
    </div>

    <div class="container mt-3 mt-lg-5">
        <div class="row justify-content-center">
            <div class="col-lg-12 col-md-12 col-sm-12">
                <div class="card">
                    <div class="card-header text-center">
                        <h1>Liste des Livres</h1>
                    </div>
                    <div class="card-body">
                        <div class="row justify-content-center">

                            <?php
                            if (isset($_GET['search']) && $_GET['search'] != '') {
                                echo '<div class="col-10"><h4 class="text-center mb-4">Voici les livres trouvées pour la recherche : </h4></div>';
                                printf(
                                    "<div class='col'>
                                    <h5 col class='text-center mb-4'>%s</h5>
                                    <
                                </div>",
                                    $_GET["search"]
                                );

                            } else {
                                echo '<h4 class="card-title text-center mb-4">Voici les livres disponibles :</h4>';

                            }
                            ?>
                        </div>

                        <?php if ($res->num_rows > 0): ?>
                            <div class="row livre-item">
                                <?php while ($livre = $res->fetch_assoc()): ?>
                                    <div id='<?php echo $livre["id"] ?>' class="col-md-4 mb-4" style="cursor:pointer;"
                                        onclick="window.location.href='<?php echo $livre["pdf_url"] ?>';">

                                        <img src="<?php echo $livre['image_url']; ?>" class="img-fluid" alt="Image du livre">
                                        <!-- à enlever plus tard -->
                                        <!-- <p><?php echo $livre["titre"] ?></p> -->

                                    </div>

                                <?php endwhile; ?>
                            </div>
                        <?php else: ?>
                            <p>Aucun livre trouvé.</p>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Script Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.min.js"></script>
    <script>
        // Afficher le menu contextuel lors du clic droit
        document.addEventListener("contextmenu", function (event) {
            event.preventDefault();
            var target = event.target;

            // Vérifie si le clic droit est sur un élément de livre
            if (target.closest(".livre-item")) {
                // Enregistre l'élément de livre cible
                window.bookToDelete = target.closest(".livre-item");

                var contextMenu = document.getElementById("contextMenu");
                contextMenu.style.display = "block";
                contextMenu.style.left = event.pageX + "px";
                contextMenu.style.top = event.pageY + "px";
            }
        });

        // Masquer le menu contextuel lorsqu'on clique ailleurs
        document.addEventListener("click", function () {
            document.getElementById("contextMenu").style.display = "none";
        });

        // Fonction pour supprimer le livre
        function deleteBook() {
            var bookElement = window.bookToDelete;
            var bookId = bookElement.querySelector("div").id; // Assurez-vous que chaque élément de livre a un data-book-id
            console.log("bookid : ", bookId);
            console.log("bookElement : ", bookElement);
            // Faire une requête AJAX pour supprimer le livre
            var xhr = new XMLHttpRequest();
            xhr.open("POST", "supprimer_livre.php", true);
            xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
            xhr.onreadystatechange = function () {
                if (xhr.readyState === 4 && xhr.status === 200) {
                    // Supprimer l'élément de livre du DOM
                    bookElement.remove();
                }
            };
            xhr.send("id=" + bookId);
        }
    </script>

</body>

</html>

<?php
$conn->close();
?>
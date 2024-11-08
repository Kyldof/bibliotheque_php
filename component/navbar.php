<?php

function navbar(): void
{
    echo '<nav class="navbar navbar-dark bg-dark">
        <div class="container">
            <a class="navbar-brand" href="/">Acceuil</a>
        </div>
    </nav>';
}

function navbarSearch(): void
{
    echo '
    <nav class="navbar navbar-dark navbar-expand-lg bg-dark">
  <div class="container-fluid">
    <a class="navbar-brand" href="/">Acceuil</a>
    <button class="navbar-toggler " type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
               
        
        
      </ul>
      <form class="d-flex" role="search" method="GET" action="lister_livres.php">
        <input class="form-control me-2" type="search" placeholder="..." aria-label="Search" name="search">
        <button class="btn btn-outline-success" type="submit">rechercher</button>
        <a href="?" class="btn btn-outline-danger ms-2">Réinitialiser</a>
      </form>
    </div>
  </div>
</nav>';
}



?>
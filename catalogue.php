<?php 
    $catalogue = true; 
    include_once("header.php");
    include_once("main.php");
?>

<div class="container">
    <div class="row">
        <div class="col-md-10 mx-auto">
            <h1 class="mt-5">Catalogue de Livres</h1>
            <p class="lead">Découvrez notre vaste sélection de livres disponibles à la lecture.</p>
            <div class="row">
                <!-- Vous pouvez boucler ici sur les livres de votre base de données pour les afficher -->
                <div class="col-md-4 mb-4">
                    <div class="card">
                        <img src="images/livre1.jpg" class="card-img-top" alt="...">
                        <div class="card-body">
                            <h5 class="card-title">Titre du Livre</h5>
                            <p class="card-text">Description du livre. Vous pouvez inclure ici un résumé ou des informations sur l'auteur.</p>
                            <a href="#" class="btn btn-primary">Voir Détails</a>
                        </div>
                    </div>
                </div>
                <!-- Fin de la boucle -->
            </div>
        </div>
    </div>
</div>

<?php include_once("footer.php"); ?>

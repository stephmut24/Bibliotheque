<?php
ob_start();

$abonne = true;
include_once("header.php");
include_once("main.php");
if (!empty($_GET["id"])) {
    $query = "SELECT * FROM livre WHERE numeroLivre=:id";
    $pdostmt = $pdo->prepare($query);
    $pdostmt->execute(["id" => $_GET["id"]]);
    while ($row = $pdostmt->fetch(PDO::FETCH_ASSOC)) :


?>

        <h1 class="mt-5">Modifier un Livre</h1>
        <form class="row g-3" method="POST">
            <input type="hidden" name="myid" value="<?php echo $row["numeroLivre"] ?>">
            <div class="col-md-6">
                <label for="Titre" class="form-label">Titre</label>
                <input type="text" class="form-control" id="Titre" name="Titre" value="<?php echo $row["Titre"] ?>" required>
            </div>
            <div class="col-md-6">
                <label for="centre" class="form-label">Centre</label>
                <input type="number" class="form-control" id="centre" name="centre" value="<?php echo $row["centre"] ?>" required>
            </div>
            <div class="col-12">
                <label for="Editeur" class="form-label">Editeur</label>
                <input type="text" class="form-control" id="Editeur" name="Editeur" value="<?php echo $row["Editeur"] ?>" required>
            </div>
            <div class="col-12">
                <label for="Etat" class="form-label">Etat</label>
                <input type="text" class="form-control" id="Etat" name="Etat" value="<?php echo $row["Etat"] ?>" required>
            </div>
            <div class="col-12">
                <label for="DateAhat" class="form-label">Date d'achat</label>
                <input type="date" class="form-control" id="DateAhat" name="DateAhat" value="<?php echo $row["DateAhat"] ?>" required>
            </div>
            <div class="col-12">
                <button type="submit" class="btn btn-primary" name=>Ajouter</button>
            </div>
        </form>
        </div>
        </main>
<?php
    endwhile;
    $pdostmt->closeCursor();
}


if (!empty($_POST)) {
    $query = "UPDATE livre SET Titre=:Titre, centre=:centre, Editeur=:Editeur, Etat=:Etat, DateAhat=:DateAhat WHERE numeroLivre=:id";
    $pdostmt = $pdo->prepare($query);
    $pdostmt->execute(["Titre" => $_POST["Titre"], "centre" => $_POST["centre"], "Editeur" => $_POST["Editeur"], "Etat"=> $_POST["Etat"], "DateAhat"=>$_POST["DateAhat"], "id" => $_POST["myid"]]);
    header("Location:livre.php");
}
ob_end_flush(); ?>

<?php
include_once("footer.php"); ?>
<?php
ob_start();

$abonne = true;
include_once("header.php");
include_once("main.php");
if (!empty($_GET["id"])) {
    $query = "SELECT * FROM abonne WHERE numAb=:id";
    $pdostmt = $pdo->prepare($query);
    $pdostmt->execute(["id" => $_GET["id"]]);
    while ($row = $pdostmt->fetch(PDO::FETCH_ASSOC)) :


?>

        <h1 class="mt-5">Modifier un Abonné</h1>
        <form class="row g-3" method="POST">
            <input type="hidden" name="myid" value="<?php echo $row["numAb"]?>">
            <div class="col-md-6">
                <label for="Nom" class="form-label">Nom</label>
                <input type="text" class="form-control" id="Nom" name="Nom" value="<?php echo $row["Nom"] ?>" required>
            </div>
            <div class="col-md-6">
                <label for="Prenom" class="form-label">Prenom</label>
                <input type="text" class="form-control" id="Prenom" name="Prenom" value="<?php echo $row["Prenom"] ?>" required>
            </div>
            <div class="col-12">
                <label for="Adresse" class="form-label">Address</label>
                <input type="text" class="form-control" id="Adresse" name="Adresse" value="<?php echo $row["Adresse"] ?>" required>
            </div>
            <div class="col-12">
                <button type="submit" class="btn btn-primary" name=>Modifier</button>
            </div>
        </form>
        </div>
        </main>
<?php
    endwhile;
    $pdostmt->closeCursor();
}


if (!empty($_POST)) {
    $query = "UPDATE abonne SET Nom=:Nom, Prenom=:Prenom, Adresse=:Adresse WHERE numAb=:id";
    $pdostmt = $pdo->prepare($query);
    $pdostmt->execute(["Nom" => $_POST["Nom"], "Prenom" => $_POST["Prenom"], "Adresse" => $_POST["Adresse"], "id" => $_POST["myid"]]);
    header("Location:abonne.php");
}
ob_end_flush(); ?>

<?php
include_once("footer.php"); ?>
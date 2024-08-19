<?php
ob_start();
$emprunt = true;
include_once("header.php");
include_once("main.php");

if (!empty($_POST["numeroLivre"]) && !empty($_POST["abonne"])) {
    // Date d'emprunt actuelle
    $dateRetour = date("Y-m-d");

    // Date de retour (7 jours après la date d'emprunt)
    //$dateRetour = date("Y-m-d", strtotime("+7 days", strtotime($dateEmprunt)));

    $query = "UPDATE emprunt SET date_retour=:dateRetour WHERE abonne_id=:abonne_id AND livre_id=:livre_id";
    $pdostmt = $pdo->prepare($query);
    $pdostmt->execute([
        "livre_id" => $_POST["numeroLivre"],
        "abonne_id" => $_POST["abonne"],
        "dateRetour" => $dateRetour,
    ]);
    $pdostmt->closeCursor();
    header("Location:emprunts.php");
}
ob_end_flush();
?>

<h1 class="mt-5">Retourner un Livre</h1>
<form class="row g-3" method="POST">
    <div class="col-md-6">
        <div class="col-md-6">
            <label for="abonne" class="form-label">Sélectionner un Abonné</label>
            <select class="form-control" id="abonne" name="abonne" required>
                <option value="" selected></option>
                <?php
                $query = "SELECT a.numAb AS idAB, a.Nom AS NomAb FROM emprunt e JOIN abonne a ON e.abonne_id=a.numAb WHERE e.date_retour IS NULL";
                $pdostmt = $pdo->query($query);
                if ($pdostmt->rowCount() > 0) {
                    while ($row = $pdostmt->fetch(PDO::FETCH_ASSOC)) {
                        echo '<option value="' . $row['idAB'] . '">' . $row['NomAb'] . '</option>';
                    }
                }
                ?>
            </select>
        </div>
        <label for="numeroLivre" class="form-label">Sélectionner un Livre</label>
        <select class="form-control" id="numeroLivre" name="numeroLivre" required>
            <option value="" selected></option>
            <?php
            $query = "SELECT DISTINCT l.numeroLivre AS idLi, l.Titre AS TiLi FROM emprunt e JOIN livre l ON e.livre_id=l.numeroLivre WHERE e.date_retour IS NULL";
            $pdostmt = $pdo->query($query);
            if ($pdostmt->rowCount() > 0) {
                while ($row = $pdostmt->fetch(PDO::FETCH_ASSOC)) {
                    echo '<option value="' . $row['idLi'] . '">' . $row['TiLi'] . '</option>';
                }
            }
            ?>
        </select>
    </div>



    <div class="col-12">
        <button type="submit" class="btn btn-primary">Retourner le Livre</button>
    </div>
</form>

</div>
</main>

<?php include_once("footer.php"); ?>
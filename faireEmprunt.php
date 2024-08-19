<?php 
ob_start();
$emprunt = true;
include_once("header.php");
include_once("main.php");

if (!empty($_POST["numeroLivre"]) && !empty($_POST["abonne"])) {
    // Date d'emprunt actuelle
    $dateEmprunt = date("Y-m-d");
    
    // Date de retour (7 jours après la date d'emprunt)
    $dateRetour = date("Y-m-d", strtotime("+7 days", strtotime($dateEmprunt)));

    $query = "INSERT INTO emprunt(livre_id, abonne_id, date_emprunt, date_retour) VALUES(:livre_id, :abonne_id, :date_emprunt, :date_retour)";
    $pdostmt = $pdo->prepare($query);
    $pdostmt->execute([
        "livre_id" => $_POST["numeroLivre"],
        "abonne_id" => $_POST["abonne"],
        "date_emprunt" => $dateEmprunt,
        "date_retour" => null
    ]);
    $pdostmt->closeCursor();
    header("Location:emprunts.php");
}
ob_end_flush();
?>

<h1 class="mt-5">Effectuer un Emprunt</h1>
<form class="row g-3" method="POST">
  <div class="col-md-6">
    <label for="numeroLivre" class="form-label">Sélectionner un Livre</label>
    <select class="form-control" id="numeroLivre" name="numeroLivre" required>
        <option value="" selected></option>
        <?php 
         $query= "SELECT DISTINCT numeroLivre, Titre FROM livre ORDER BY Titre";
         $pdostmt = $pdo->query($query);
         if ($pdostmt->rowCount() > 0) {
             while ($row = $pdostmt->fetch(PDO::FETCH_ASSOC)) {
                 echo '<option value="' . $row['numeroLivre'] . '">' . $row['Titre'] . '</option>';
             }
         }
        ?>
    </select>
  </div>
 
  <div class="col-md-6">
    <label for="abonne" class="form-label">Sélectionner un Abonné</label>
    <select class="form-control" id="abonne" name="abonne" required>
        <option value="" selected></option>
        <?php 
         $query= "SELECT numAb, Nom FROM abonne ORDER BY Nom";
         $pdostmt = $pdo->query($query);
         if ($pdostmt->rowCount() > 0) {
             while ($row = $pdostmt->fetch(PDO::FETCH_ASSOC)) {
                 echo '<option value="' . $row['numAb'] . '">' . $row['Nom'] . '</option>';
             }
         }
        ?>
    </select>
  </div>
  
  <div class="col-12">
    <button type="submit" class="btn btn-primary">Effectuer l'emprunt</button>
  </div>
</form>

</div>
</main>

<?php include_once("footer.php");?>

<?php 
ob_start();
$abonne = true;
include_once("header.php");
include_once("main.php");
if (!empty($_POST["Nom"]) && !empty($_POST["Prenom"]) && !empty($_POST["Adresse"])) {
    $query = "INSERT INTO abonne(Nom, Prenom, caution, Adresse) VALUES(:Nom, :Prenom, :caution, :Adresse)";
    $pdostmt = $pdo->prepare($query);
    $pdostmt->execute([
        "Nom" => $_POST["Nom"],
        "Prenom" => $_POST["Prenom"],
        "caution" => $_POST["caution"],
        "Adresse" => $_POST["Adresse"]
    ]);
    $pdostmt->closeCursor();
    header("Location:abonne.php");
}
ob_end_flush();?>

<h1 class="mt-5">Ajouter un Abonné</h1>
<form class="row g-3" method="POST">
  <div class="col-md-6">
    <label for="Nom" class="form-label">Nom</label>
    <input type="text" class="form-control" id="Nom" name="Nom" required>
  </div>
  <div class="col-md-6">
    <label for="Prenom" class="form-label">Prenom</label>
    <input type="text" class="form-control" id="Prenom" name="Prenom" required>
  </div>
  <div class="col-12">
    <label for="Caution" class="form-label">Caution</label>
    <input type="number" class="form-control" id="Caution" name="Caution" required>
  </div>
  <div class="col-12">
    <label for="Adresse" class="form-label">Address</label>
    <input type="text" class="form-control" id="Adresse" name="Adresse" required>
  </div>
  <div class="col-12">
    <button type="submit" class="btn btn-primary" name=>Ajouter</button>
  </div>
</form>
</div>
</main>

<?php include_once("footer.php");?>
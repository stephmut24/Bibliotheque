<?php 
ob_start();
$livre = true;
include_once("header.php");
include_once("main.php");
if (!empty($_POST["Titre"]) && !empty($_POST["centre"]) && !empty($_POST["Editeur"]) && !empty($_POST["Etat"]) && !empty($_POST["DateAhat"])) {
    $query = "INSERT INTO livre(Titre, centre, Editeur, Etat, DateAhat ) VALUES(:Titre, :centre, :Editeur, :Etat, :DateAhat)";
    $pdostmt = $pdo->prepare($query);
    $pdostmt->execute([
        "Titre" => $_POST["Titre"],
        "centre" => $_POST["centre"],
        "Editeur" => $_POST["Editeur"],
        "Etat" => $_POST["Etat"],
        "DateAhat" => $_POST["DateAhat"]
    ]);
    $pdostmt->closeCursor();
    header("Location:livre.php");
}
ob_end_flush();?>

<h1 class="mt-5">Ajouter un Livre</h1>
<form class="row g-3" method="POST">
  <div class="col-md-6">
    <label for="Titre" class="form-label">Titre</label>
    <input type="text" class="form-control" id="Titre" name="Titre" required>
  </div>
  <div class="col-md-6">
    <label for="centre" class="form-label">Centre</label>
    <input type="number" class="form-control" id="centre" name="centre" required>
  </div>
  <div class="col-12">
    <label for="Editeur" class="form-label">Editeur</label>
    <input type="text" class="form-control" id="Editeur" name="Editeur" required>
  </div>
  <div class="col-12">
    <label for="Etat" class="form-label">Etat</label>
    <input type="text" class="form-control" id="Etat" name="Etat" required>
  </div>
  <div class="col-12">
    <label for="DateAhat" class="form-label">Date d'achat</label>
    <input type="date" class="form-control" id="DateAhat" name="DateAhat" required>
  </div>
  <div class="col-12">
    <button type="submit" class="btn btn-primary" name=>Ajouter</button>
  </div>
</form>
</div>
</main>

<?php include_once("footer.php");?>
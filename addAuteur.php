<?php 
ob_start();
$auteur = true;
include_once("header.php");
include_once("main.php");
if (!empty($_POST["numeroLivre"]) && !empty($_POST["auteur"])) {
    $query = "INSERT INTO auteur(numeroLivre, auteur) VALUES(:numeroLivre, :auteur)";
    $pdostmt = $pdo->prepare($query);
    $pdostmt->execute([
        "numeroLivre" => $_POST["numeroLivre"],
        "auteur" => $_POST["auteur"],
    ]);
    $pdostmt->closeCursor();
    header("Location:auteur.php");
}
ob_end_flush();?>

<h1 class="mt-5">Ajouter un Auteur</h1>
<form class="row g-3" method="POST">
  <div class="col-md-6">
    <label for="numeroLivre" class="form-label">Nom du Livre</label>
    <select class="form-control" id="numeroLivre" name="numeroLivre" required>
        <option value=""selected></option>
        <?php 
         $query= "SELECT numeroLivre, Titre FROM livre ORDER BY Titre";
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
    <label for="auteur" class="form-label">Auteur</label>
    <input type="text" class="form-control" id="auteur" name="auteur" required>
  </div>
  <div class="col-12">
    <button type="submit" class="btn btn-primary" name=>Ajouter</button>
  </div>
</form>
</div>
</main>

<?php include_once("footer.php");?>
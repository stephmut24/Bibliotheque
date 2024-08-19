<?php
$auteur = true;
include_once("header.php");
include_once("main.php")
?>

<h1 class="mt-5">Auteur</h1>
<a href="addAuteur.php" class="btn btn-primary" style="float:right; margin-bottom:20px;">
    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-person-plus-fill" viewBox="0 0 16 16">
        <path d="M1 14s-1 0-1-1 1-4 6-4 6 3 6 4-1 1-1 1zm5-6a3 3 0 1 0 0-6 3 3 0 0 0 0 6" />
        <path fill-rule="evenodd" d="M13.5 5a.5.5 0 0 1 .5.5V7h1.5a.5.5 0 0 1 0 1H14v1.5a.5.5 0 0 1-1 0V8h-1.5a.5.5 0 0 1 0-1H13V5.5a.5.5 0 0 1 .5-.5" />
    </svg>
</a>
<?php
$query = "SELECT l.Titre AS Titre_livre, a.auteur, a.IdAuteur FROM auteur a JOIN livre l ON a.numeroLivre=l.numeroLivre";
$pdostmt = $pdo->prepare($query);
$pdostmt->execute();
?>

<table id="maTable" class="display">
    <thead>
        <tr>
            
            <th>Nom du Livre</th>
            <th>Auteur</th>
        </tr>
    </thead>
    <tbody>
        <?php while ($ligne = $pdostmt->fetch(PDO::FETCH_ASSOC)):?>
            <tr>
                
                <td><?php echo $ligne["Titre_livre"]; ?></td>
                <td><?php echo $ligne["auteur"]; ?></td>
            </tr>
        <?php endwhile;?>
    </tbody>
</table>
</div>
</main>

<?php
include_once("footer.php");
?>

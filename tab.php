<?php 
    $tab=true;
    include_once("header.php");
    include_once("main.php")
?>

<!-- Begin page content -->
<main class="flex-shrink-0">
  <div class="container">
    <h1 class="mt-5">Historique Bibliothèque</h1>
    <?php
        $query = "SELECT e.id, e.date_emprunt, e.date_retour, l.Titre AS Titre_livre, a.Nom AS Nom_abonne
        FROM emprunt e
        JOIN abonne a ON e.abonne_id = a.numAb
        JOIN livre l ON e.livre_id = l.numeroLivre";
        $pdostmt = $pdo->prepare($query);
        $pdostmt->execute([]);
    //var_dump(($pdostmt->fetchAll(PDO::FETCH_ASSOC)));
    ?>
         <table id="maTable" class="display">
            <thead>
                <tr>
                   
                    <th>Nom du Livre</th>
                    <th>Nom de l'abonne</th>
                    <th>Date d'emprunt</th>
                    <th>Date retour</th>
                   
                </tr>
            </thead>
            <tbody>
            <?php while ($ligne = $pdostmt->fetch(PDO::FETCH_ASSOC)):?>
                <tr>
                   
                    <td><?php echo $ligne["Titre_livre"]; ?></td>
                    <td><?php echo $ligne["Nom_abonne"]; ?></td>
                    <td><?php echo $ligne["date_emprunt"]; ?></td>
                    <td><?php echo $ligne["date_retour"]; ?></td>
                    
                    
                </tr>
                <?php endwhile;?>
            </tbody>
        </table>
        
            <a href="faireEmprunt.php" class="btn btn-primary mt-3" style="float:right"></a>
            

</main>

<?php
    include_once("footer.php");
?> 
 
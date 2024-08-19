<?php
// Connexion à la base de données
include_once("header.php");
include_once("main.php");

if (isset($_GET['numeroLivre'])) {
    $numeroLivre = $_GET['numeroLivre'];

    // Requête SQL pour récupérer les détails de l'emprunt basé sur le numéro de livre
    $query = "SELECT e.id, e.date_emprunt, e.date_retour, a.Nom AS nom_abonne, l.Titre AS titre_livre
              FROM emprunt e
              JOIN abonne a ON e.abonne_id = a.numAb
              JOIN livre l ON e.livre_id = l.numeroLivre
              WHERE e.livre_id = :livre_id";
    $pdostmt = $pdo->prepare($query);
    $pdostmt->execute([':livre_id' => $numeroLivre]);

    // Vérifier s'il y a des résultats
    if ($pdostmt->rowCount() > 0) {
        $detailsEmprunt = $pdostmt->fetch(PDO::FETCH_ASSOC);

        // Vérifier si l'emprunt est en retard
        $dateRetour = strtotime($detailsEmprunt['date_retour']);
        $dateActuelle = strtotime(date('Y-m-d'));
        $retard = $dateActuelle > $dateRetour;

        // Ajouter la propriété "retard" à $detailsEmprunt
        $detailsEmprunt['retard'] = $retard;

        // Envoyer les détails de l'emprunt au format JSON
        echo json_encode($detailsEmprunt);
    } else {
        // Aucun emprunt trouvé pour le livre spécifié
        echo json_encode(['error' => 'Aucun emprunt trouvé pour ce livre.']);
    }
} else {
    // Paramètre manquant dans la requête GET
    echo json_encode(['error' => 'Paramètre manquant : numéro de livre.']);
}
?>

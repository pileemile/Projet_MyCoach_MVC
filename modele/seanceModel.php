<?php
// Fonction pour récupérer les séances en fonction du jour sélectionné
function getSeances($connexion, $jourSelectionne) {
    if ($jourSelectionne === '*') {
        $reqSeance = "SELECT seance.horraire, seance.jour, niveau.niveau, sport.Nom AS sport_nom, salle.Nom AS salle_nom, salle.Adresse, salle.CP, salle.Ville
                    FROM seance
                    INNER JOIN sport ON seance.id_sport = sport.ID
                    INNER JOIN niveau ON seance.id_niveau = niveau.id
                    INNER JOIN salle ON seance.id_salle = salle.ID
                    ORDER BY sport_nom";
    } else {
        // Requête pour récupérer les séances du jour sélectionné
        $reqSeance = "SELECT seance.horraire, seance.jour, niveau.niveau, sport.Nom AS sport_nom, salle.Nom AS salle_nom, salle.Adresse, salle.CP, salle.Ville
                    FROM seance
                    INNER JOIN sport ON seance.id_sport = sport.ID
                    INNER JOIN niveau ON seance.id_niveau = niveau.id
                    INNER JOIN salle ON seance.id_salle = salle.ID
                    WHERE jour = '$jourSelectionne'";
    }
    
    // Exécution de la requête
    $result = $connexion->query($reqSeance);
    if (!$result) {
        // Gestion des erreurs SQL
        $errorInfo = $connexion->errorInfo();
        echo "Erreur SQL : " . $errorInfo[2];
        return false;
    } else {
        // Récupération des séances et retour
        $seances = $result->fetchAll(PDO::FETCH_ASSOC);
        return $seances;
    }
}
?>

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
        // Requête pour récupérer les séances du jour sélectionné avec paramètre préparé
        $reqSeance = "SELECT seance.horraire, seance.jour, niveau.niveau, sport.Nom AS sport_nom, salle.Nom AS salle_nom, salle.Adresse, salle.CP, salle.Ville
                    FROM seance
                    INNER JOIN sport ON seance.id_sport = sport.ID
                    INNER JOIN niveau ON seance.id_niveau = niveau.id
                    INNER JOIN salle ON seance.id_salle = salle.ID
                    WHERE jour = :jourSelectionne";
    }
    
    // Préparation de la requête
    $stmt = $connexion->prepare($reqSeance);
    
    // Liaison du paramètre
    if ($jourSelectionne !== '*') {
        $stmt->bindParam(':jourSelectionne', $jourSelectionne);
    }
    
    // Exécution de la requête
    $result = $stmt->execute();
    
    if (!$result) {
        // Gestion des erreurs SQL
        $errorInfo = $stmt->errorInfo();
        echo "Erreur SQL : " . $errorInfo[2];
        return false;
    } else {
        // Récupération des séances et retour
        $seances = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $seances;
    }
}
function inscriptionSeance($connexion, $id_seance, $nom, $prenom) {
    // Requête pour inscrire l'utilisateur à la séance
    $reqInscription = "INSERT INTO inscriptionSeance (idSeance, nom, prenom) VALUES (:idSeance, :nom, :prenom)";

    // Préparation de la requête
    $stmt = $connexion->prepare($reqInscription);

    // Liaison des paramètres
    $stmt->bindParam(':idSeance', $id_seance);
    $stmt->bindParam(':nom', $nom);
    $stmt->bindParam(':prenom', $prenom);

    // Exécution de la requête
    $result = $stmt->execute();

    // Retournez true si l'inscription réussit, sinon retournez false
    return $result;
}

?>

<?php
// Fonction pour récupérer les séances en fonction du jour sélectionné
function getSeances($connexion, $jourSelectionne) {
    if ($jourSelectionne === '*') {
        $reqSeance = "SELECT seance.id,seance.horraire, seance.jour, niveau.niveau, sport.Nom AS sport_nom, salle.Nom AS salle_nom, salle.Adresse, salle.CP, salle.Ville
                    FROM seance
                    INNER JOIN sport ON seance.id_sport = sport.ID
                    INNER JOIN niveau ON seance.id_niveau = niveau.id
                    INNER JOIN salle ON seance.id_salle = salle.ID
                    ORDER BY sport_nom";
    } else {
        // Requête pour récupérer les séances du jour sélectionné avec paramètre préparé
        $reqSeance = "SELECT seance.id,seance.horraire, seance.jour, niveau.niveau, sport.Nom AS sport_nom, salle.Nom AS salle_nom, salle.Adresse, salle.CP, salle.Ville
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
    $_SESSION['id_seance'] = $result['id'];
    
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
function inscriptionSeance($connexion, $id_seance, $id_utilisateur, $nom, $prenom) {
    // Requête pour inscrire l'utilisateur à la séance
    $reqInscription = "INSERT INTO inscriptionseance (id_seance, id_utilisateur, nom, prenom) VALUES (:id_seance, :id_utilisateur, :nom, :prenom)";

    // Préparation de la requête
    $stmt = $connexion->prepare($reqInscription);

    // Liaison des paramètres
    $stmt->bindParam(':id_seance', $id_seance);
    $stmt->bindParam(':id_utilisateur', $id_utilisateur);
    $stmt->bindParam(':nom', $nom);
    $stmt->bindParam(':prenom', $prenom);

    // Exécution de la requête
    $result = $stmt->execute();

    // Vérification de l'insertion
    if ($result) {
        // L'insertion a réussi
        return true;
    } else {
        // L'insertion a échoué
        return false;
    }
}
function dejaInscrit($connexion, $id_utilisateur, $id_seance) {
    // Requête pour vérifier si l'utilisateur est déjà inscrit à la séance
    $sql = "SELECT COUNT(*) AS count FROM inscriptionseance WHERE id_seance = :id_seance AND id_utilisateur = :id_utilisateur";
    
    // Préparation de la requête
    $stmt = $connexion->prepare($sql);
    
    // Liaison des paramètres
    $stmt->bindParam(':id_seance', $id_seance);
    $stmt->bindParam(':id_utilisateur', $id_utilisateur);
    
    // Exécution de la requête
    $stmt->execute();
    
    // Récupération du résultat
    $result = $stmt->fetch(PDO::FETCH_ASSOC);
    
    // Vérification du résultat
    if ($result['count'] > 0) {
        return true; // L'utilisateur est déjà inscrit à la séance
    } else {
        return false; // L'utilisateur n'est pas inscrit à la séance
    }
}
function getInscriptionsUtilisateur($connexion, $id_utilisateur) {
    // Requête pour récupérer les séances auxquelles l'utilisateur est inscrit
    $sql = "SELECT s.*, sport.Nom AS sport_nom, niveau.niveau AS niveau
    FROM seance s 
    INNER JOIN inscriptionseance i ON s.id = i.id_seance 
    INNER JOIN sport ON s.id_sport = sport.ID
    INNER JOIN niveau ON s.id_niveau = niveau.id
    WHERE i.id_utilisateur = :id_utilisateur";
    
    // Préparation de la requête
    $stmt = $connexion->prepare($sql);
    
    // Liaison des paramètres
    $stmt->bindParam(':id_utilisateur', $id_utilisateur);
    
    // Exécution de la requête
    $stmt->execute();
    
    // Récupération des résultats
    $inscriptions = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
    // Retourner les inscriptions de l'utilisateur
    return $inscriptions;
}


?>

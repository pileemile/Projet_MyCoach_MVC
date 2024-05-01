<?php
// Fonction pour inscrire un nouvel utilisateur
function inscrireUtilisateur($nom, $prenom, $mail, $mdp) {
    require 'bd.inc.php'; // Inclure le fichier de connexion à la base de données
    // Requête de sélection pour vérifier si l'e-mail existe déjà
    $sql = "SELECT * FROM utilisateur WHERE mail = :mail";
    // Préparation de la requête
    $stmt = $connexion->prepare($sql);
    // Liaison des paramètres
    $stmt->bindParam(':mail', $mail);
    // Exécution de la requête
    $stmt->execute();
    // Récupération du résultat
    $user = $stmt->fetch(PDO::FETCH_ASSOC);
    // Vérification du résultat
    if ($user) {
        // L'e-mail existe déjà
        return false;
    } else {
        // L'e-mail est unique, inscrire l'utilisateur
        $sql = "INSERT INTO utilisateur (nom, prenom, mail, mdp) VALUES (:nom, :prenom, :mail, :mdp)";
        // Préparation de la requête
        $stmt = $connexion->prepare($sql);
        // Liaison des paramètres
        $stmt->bindParam(':nom', $nom);
        $stmt->bindParam(':prenom', $prenom);
        $stmt->bindParam(':mail', $mail);
        $stmt->bindParam(':mdp', $mdp);
        // Exécution de la requête
        $stmt->execute();
        return true;
    }
}
?>

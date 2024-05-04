<?php
require_once 'bd.inc.php';
function inscriptionProcess() {
    $connexion = connexionPDO();
    // Vérifier si le formulaire a été soumis
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        // Récupération des données du formulaire
        $nom = $_POST['nom'];
        $prenom = $_POST['prenom'];
        $mail = $_POST['mail'];
        $mdp = $_POST['mdp'];

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
            // L'e-mail existe déjà, rediriger avec un message d'erreur
            $_SESSION['erreur_inscription'] = 'L\'adresse e-mail existe déjà.';
            header("Location: ../controleur/controller.php?action=inscription");
            exit;
        } else {
            // Hasher le mot de passe
        $mdp_hash = password_hash($mdp, PASSWORD_DEFAULT);
            // L'e-mail est unique, inscrire l'utilisateur
            $sql = "INSERT INTO utilisateur (nom, prenom, mail, mdp) VALUES (:nom, :prenom, :mail, :mdp)";
            // Préparation de la requête
            $stmt = $connexion->prepare($sql);
            // Liaison des paramètres
            $stmt->bindParam(':nom', $nom);
            $stmt->bindParam(':prenom', $prenom);
            $stmt->bindParam(':mail', $mail);
            $stmt->bindParam(':mdp', $mdp_hash);
            // Exécution de la requête
            $stmt->execute();
            
            // Définir $_SESSION['connecte'] sur true
            $_SESSION['connecte'] = true;
            
            // Redirection vers la page des séances
            header("Location: ../controleur/controller.php?action=seance");
            exit;
        }
    }
}
?>
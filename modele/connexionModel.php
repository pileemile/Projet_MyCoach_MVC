<?php
require_once 'bd.inc.php';
function loginProcess() {
    $connexion = connexionPDO();
    // Vérifier si le formulaire a été soumis
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        // Récupération de l'adresse e-mail et du mot de passe
        $mail = $_POST['mail'];
        $mdp = $_POST['mdp'];
        $_SESSION['mail'] = $mail; // Stockage de l'adresse e-mail dans la variable de session

        // Requête de sélection
        $sql = "SELECT * FROM utilisateur WHERE mail = :mail";

        // Préparation de la requête
        $stmt = $connexion->prepare($sql);

        // Liaison des paramètres
        $stmt->bindParam(':mail', $mail);

        // Exécution de la requête
        $stmt->execute();

        // Récupération du résultat
        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($user && password_verify($mdp, $user['mdp'])) {
            // L'utilisateur existe et le mot de passe est correct
            $_SESSION['id_utilisateur'] = $user['id'];
            $_SESSION['nom'] = $user['nom'];
            $_SESSION['prenom'] = $user['prenom'];
            $_SESSION['connecte'] = true; // Définition de la variable de session pour indiquer que l'utilisateur est connecté
            header("Location: ../controleur/controller.php?action=seance"); // Redirection vers la page des séances
            exit;
        } else {
            // Redirection vers la page de connexion avec un message d'erreur
            $errorMessage = "Identifiants incorrects";
            header("Location: ../controleur/controller.php?action=login&error=" . urlencode($errorMessage));
            exit;
        }
    }
}
?>
<?php
session_start();
include('connexionModel.php'); // Inclure le modèle

// Vérifier si le formulaire a été soumis
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Récupération de l'adresse e-mail et du mot de passe
    $mail = $_POST['mail'];
    $mdp = $_POST['mdp'];

    // Appel de la fonction du modèle pour connecter l'utilisateur
    $utilisateur = connecterUtilisateur($mail, $mdp);

    // Vérification de l'authentification
    if ($utilisateur) {
        // L'utilisateur est authentifié
        $_SESSION['utilisateur'] = $utilisateur;
        header("Location: seance.php");
        exit;
    } else {
        // L'authentification a échoué
        header("Location: login.php?error=1");
        exit;
    }
} else {
    // Afficher la vue
    include('view_connexion.php');
}
?>

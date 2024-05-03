<?php
require 'includes/conexion.php'; // Inclure le fichier de connexion à la base de données
session_start();

// Vérifier si $_SESSION['id_utilisateur'] est définie
if (!isset($_SESSION['id_utilisateur'])) {
    $_SESSION['id_utilisateur'] = null; // Initialiser la variable de session à null si elle n'est pas encore définie
}

function connecterUtilisateur($mail, $mdp) {
    global $connexion; // Utiliser la connexion à la base de données définie dans includes/conexion.php

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

    // Vérification du résultat
    if ($user) {
        // L'utilisateur existe
        // Vérification du mot de passe
        if ($user['mdp'] == $mdp) {
            // Le mot de passe correspond
            return $user;
        } else {
            return false; // Le mot de passe ne correspond pas
        }
    } else {
        return false; // L'utilisateur n'existe pas
    }
}
?>

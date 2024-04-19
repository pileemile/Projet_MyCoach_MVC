<?php
require 'includes/conexion.php'; // Inclure le fichier de connexion à la base de données

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

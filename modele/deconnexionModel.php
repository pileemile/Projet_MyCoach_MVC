<?php
function logout() {
    // Définir $_SESSION['connecte'] sur false
    $_SESSION['connecte'] = false;
    // Supprimer toutes les variables de session
    session_unset();
    // Détruire la session
    session_destroy();
    // Rediriger vers la page d'accueil
    header("Location: ../controleur/controller.php?action=index");
    exit();
}
?>
<?php
session_start();
require_once '../modele/coachModel.php';

$action = isset($_GET['action']) ? $_GET['action'] : 'index';

switch ($action) {
    case 'index':
        // Afficher la page d'accueil
        $presentation = getPresentation();
        $prestations = getPrestations();
        include('../vue/index.php');
        break;
    case 'login':
        // Afficher le formulaire de connexion
        include('../vue/login.php');
        break;
    case 'loginProcess':
        // Traiter la soumission du formulaire de connexion
        loginProcess();
        break;
    case 'logout':
        // Déconnecter l'utilisateur
        logout();
        break;
    default:
        // Gérer les cas d'action non valide
        break;
}

function loginProcess() {
    require '../modele/bd.inc.php';
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
        var_dump ($user);
        
        // Vérification du résultat
        if ($user) {
            // L'utilisateur existe 
            // Vérification du mot de passe
            if (($user['mdp'])==($mdp)) {
                // Le mot de passe correspond

                // Vous pouvez accéder aux valeurs de l'utilisateur
                $_SESSION['nom'] = $user['nom']; // Stockage du nom dans la variable de session
                $_SESSION['prenom'] = $user['prenom']; // Stockage du prénom dans la variable de session
                $_SESSION['connecte'] = true;
                header("Location: ../vue/seance.php");
                exit;
            } else {
                //redirection vers la page de connexion 
                header("Location: ../vue/login.php?error=" ).  $errorMessage;
                exit;

            }
        } else {
                //redirection vers la page de connexion 
                header("Location: ../vue/login.php?error=") .  $errorMessage;
                exit;
            }
    } // Erreur de syntaxe corrigée ici
}
function logout() {
    // Déconnexion de l'utilisateur
    if (isset($_SESSION['user'])) {
        // Supprimer toutes les variables de session
        session_unset();
        // Détruire la session
        session_destroy();
    }
    // Rediriger vers la page d'accueil
    header("Location: ../vue/index.php");
    exit();
}
?>

<?php
// Démarrez la session
session_start();

// Initialisez $_SESSION['connecte'] à false si ce n'est pas déjà défini
if (!isset($_SESSION['connecte'])) {
    $_SESSION['connecte'] = false;
}

require_once '../modele/coachModel.php';
require_once '../modele/seanceModel.php';
require_once '../modele/connexionModel.php';
require_once '../modele/utilisateurModel.php';
require_once '../modele/deconnexionModel.php';
require_once '../modele/bd.inc.php';

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
        // Appeler la fonction loginProcess
        loginProcess();
        break;
    case 'logout':
        // Déconnecter l'utilisateur
        logout();
        break;
    case 'seance':
        // Vérifier si l'utilisateur est connecté
        if (!isset($_SESSION['connecte']) || $_SESSION['connecte'] !== true) {
            // Si l'utilisateur n'est pas connecté, redirigez-le vers la page de connexion
            header("Location: ../controleur/controller.php?action=login");
            exit();
        }
        // L'utilisateur est connecté, continuez à récupérer les séances
        $connexion = connexionPDO();
        // Vérifier si $_POST['jour'] est défini
        if (isset($_POST['jour'])) {
            // Récupérer les séances en fonction du jour sélectionné
            $seances = getSeances($connexion, $_POST['jour']);
        } else {
            // Gérer le cas où $_POST['jour'] n'est pas défini
            // Peut-être rediriger l'utilisateur vers une autre page ou afficher un message d'erreur
        }
        // Inclure la vue seance.php
        include('../vue/seance.php');
        break;
    case 'inscription':
        // Afficher le formulaire d'inscription
        include('../vue/inscription.php');
        break;
    case 'inscriptionProcess':
        // Traiter la soumission du formulaire d'inscription
        inscriptionProcess();
        break;
    case 'inscriptionSeance':
        $connexion = connexionPDO();
        $id_seance = isset($_POST['id_seance']) ? $_POST['id_seance'] : null;
        $nom = isset($_POST['nom']) ? $_POST['nom'] : null;
        $prenom = isset($_POST['prenom']) ? $_POST['prenom'] : null;
        $id_utilisateur = isset($_POST['id_utilisateur']) ? $_POST['id_utilisateur'] : null;     
        // Appel de la fonction d'inscription à la séance depuis le modèle
        $resultatInscription = inscriptionSeance($connexion, $id_seance, $id_utilisateur, $nom, $prenom);
        if ($resultatInscription) {
            // Affichez un message de succès en utilisant JavaScript
            // Redirigez vers une page de confirmation ou autre
            header("Location: ../controleur/controller.php?action=seance");
            echo '<script>alert("Inscription réussie !");</script>';
            exit;
        } else {
            // Affichez un message d'échec en utilisant JavaScript
             echo '<script>alert("Échec de l\'inscription. Veuillez réessayer.");</script>';
        }
         break;
        case 'recapitulatifInscriptions':
        // Vérifier si l'utilisateur est connecté
            if (!isset($_SESSION['connecte']) || $_SESSION['connecte'] !== true) {
                // Si l'utilisateur n'est pas connecté, redirigez-le vers la page de connexion
                header("Location: ../controleur/controller.php?action=login");
                exit();
            }
        
        // Récupérer les inscriptions de l'utilisateur depuis le modèle
        $connexion = connexionPDO();
        $id_utilisateur = $_SESSION['id_utilisateur'];
        $inscriptions = getInscriptionsUtilisateur($connexion, $id_utilisateur);
        
        // Inclure la vue pour afficher le récapitulatif des inscriptions
        include('../vue/Recap_inscription.php');
        break;
        
    default:
        // Gérer les cas d'action non valide
        break;
}
?>

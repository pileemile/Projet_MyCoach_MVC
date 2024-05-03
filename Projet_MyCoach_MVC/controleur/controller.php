<?php
// Démarrez la session
session_start();

// Initialisez $_SESSION['connecte'] à false si ce n'est pas déjà défini
if (!isset($_SESSION['connecte'])) {
    $_SESSION['connecte'] = false;
}

require_once '../modele/coachModel.php';
require_once '../modele/seanceModel.php';
require_once '../modele/bd.inc.php';

$action = isset($_GET['action']) ? $_GET['action'] : 'index';

switch ($action) {
    case 'index':
        var_dump($_SESSION['connecte']);
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
    case 'seance':
        var_dump($_SESSION['connecte']);
        var_dump($_SESSION['id_utilisateur']);
        var_dump($_SESSION['nom']);
        var_dump($_SESSION['prenom']);
        var_dump($_SESSION['id_seance']);
        
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
             echo '<script>alert("Inscription réussie !");</script>';
            // Redirigez vers une page de confirmation ou autre
            header("Location: ../controleur/controller.php?action=seance");
            exit;
        } else {
            // Affichez un message d'échec en utilisant JavaScript
             echo '<script>alert("Échec de l\'inscription. Veuillez réessayer.");</script>';
            // Gérez l'échec de l'inscription
            // Peut-être afficher un message d'erreur ou rediriger vers une autre page
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
        $_SESSION['id_utilisateur'] = $user['id'];
        $_SESSION['nom'] = $user['nom'];
        $_SESSION['prenom'] = $user['prenom'];

        // Vérification du résultat
        if ($user && $user['mdp'] == $mdp) {
            // L'utilisateur existe et le mot de passe est correct
            // Vous pouvez accéder aux valeurs de l'utilisateur
            $_SESSION['nom'] = $user['nom']; // Stockage du nom dans la variable de session
            $_SESSION['prenom'] = $user['prenom']; // Stockage du prénom dans la variable de session
            $_SESSION['connecte'] = true; // Définition de la variable de session pour indiquer que l'utilisateur est connecté
            header("Location: ../controleur/controller.php?action=seance"); // Redirection vers la page des séances
            exit;
        } else {
            //redirection vers la page de connexion avec un message d'erreur
            header("Location: ../controleur/controller.php?action=login" . $errorMessage);
            exit;
        }
    }
}

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

function inscriptionProcess() {
    require '../modele/bd.inc.php';
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
            
            // Définir $_SESSION['connecte'] sur true
            $_SESSION['connecte'] = true;
            
            // Redirection vers la page des séances
            header("Location: ../controleur/controller.php?action=seance");
            exit;
        }
    }
}

?>

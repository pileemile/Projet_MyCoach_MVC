<?php
// Vérifier si la fonction connexionPDO() n'existe pas déjà
if (!function_exists('connexionPDO')) {
    function connexionPDO() {
        $login = "root";
        $mdp = "";
        $bd = "my_coach_mvc";
        $serveur = "localhost";

        try {
            $connexion = new PDO("mysql:host=$serveur;dbname=$bd", $login, $mdp, array(PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES \'UTF8\'')); 
            $connexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            return $connexion;
        } catch (PDOException $e) {
            print "Erreur de connexion PDO ";
            die();
        }
    }
}

if ($_SERVER["SCRIPT_FILENAME"] == __FILE__) {
    // prog de test
    header('Content-Type:text/plain');

    echo "connexionPDO() : \n";
    print_r(connexionPDO());
}
?>

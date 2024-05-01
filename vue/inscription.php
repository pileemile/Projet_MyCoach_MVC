<?php include('navbar.php'); ?>

<!DOCTYPE html>
<html>
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Inscription | MyCoach</title>
  <link rel="stylesheet" type="text/css" href="../css/login.css">
</head>
<body>
  <!-- formulaire d'inscription -->
  <section class="login-container">
    <h2>Inscription</h2>
    <?php
    // Affichage du message d'erreur s'il existe
    if (isset($_SESSION['erreur_inscription'])) {
        echo '<p class="erreur-message">' . $_SESSION['erreur_inscription'] . '</p>';
        unset($_SESSION['erreur_inscription']);
    }
    ?>
    <form action="../controleur/controller.php?action=inscriptionProcess" method="post">
      <label for="nom">Nom:</label>
      <input type="text" id="nom" name="nom" required>

      <label for="prenom">Prénom:</label>
      <input type="text" id="prenom" name="prenom" required>

      <label for="mail">Adresse email:</label>
      <input type="email" id="mail" name="mail" required>

      <label for="mdp">Mot de passe:</label>
      <input type="password" id="mdp" name="mdp" required>
      <input type="checkbox" onclick="voirMDP()"> <!-- Permet de checke pour voir le mot de passe-->
      <button type="submit">S'inscrire</button>
    </form>
  </section>
  <script>
    //script pour voir le mot de passe 
    function voirMDP() {
      var mdpInput = document.getElementById('mdp');
      if (mdpInput.type === 'password') {
        mdpInput.type = 'text';
      } else {
        mdpInput.type = 'password';
      }
    }
  </script>
  <?php include('footer.php'); ?>
</body>
</html>

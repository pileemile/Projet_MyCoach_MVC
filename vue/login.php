<!DOCTYPE html>
<?php 
include ('navbar.php')
?>
<html>
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Connexion | MyCoach</title>
  <link rel="stylesheet" type="text/css" href="../css/login.css">
</head>
<body>

   <!-- formulaire de connexion -->
   <section class="login-container">
    <h2>connexion</h2>
    <form action="../controleur/controller.php?action=loginProcess".php" method="post">
      <label for="mail">Adresse Mail:</label>
      <input type="text" id="mail" name="mail" required>

      <label for="mdp">mot de passe:</label>
      <input type="password" id="mdp" name="mdp" required>
      <input type="checkbox" onclick="voirMDP()"> <!-- Permet de checke pour voir le mot de passe-->
      <button type="submit">Connexion</button>
    </form>

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

  </section>
  <?php include('footer.php'); ?>
</body>
</html>


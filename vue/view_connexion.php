<!DOCTYPE html>
<html>
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Connexion | MyCoach</title>
  <link rel="stylesheet" type="text/css" href="../css/login.css">
</head>
<body>
  <section class="login-container">
    <h2>Connexion</h2>
    <form action="controller_connexion.php" method="post">
      <label for="mail">Identifiant:</label>
      <input type="text" id="mail" name="mail" required>

      <label for="mdp">Mot de passe:</label>
      <input type="password" id="mdp" name="mdp" required>

      <button type="submit">Connexion</button>
    </form>
  </section>
  <?php include('includes/footer.php'); ?>
</body>
</html>

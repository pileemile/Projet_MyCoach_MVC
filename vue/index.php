<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Accueil | MyCoach</title>
  <link rel="stylesheet" type="text/css" href="../css/style.css">
</head>
<body>
  <nav>
    <a href="#presentation">Présentation</a>
    <a href="#prestation">Mes Prestations</a>
  </nav>
  <section class="services-container">
    <h2 id="presentation">Présentation</h2>
    <div class="service">
      <p><?php echo $presentation; ?></p>
    </div>
  </section>
  <section class="services-container">
    <h2 id="prestation">Mes Prestations</h2>
    <?php foreach ($prestations as $prestation): ?>
      <div class="service">
        <h3><?php echo $prestation['title']; ?></h3>
        <p><?php echo $prestation['description']; ?></p>
      </div>
    <?php endforeach; ?>
  </section>
  <?php include('includes/footer.php'); ?>
</body>
</html>

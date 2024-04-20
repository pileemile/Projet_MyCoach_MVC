<!DOCTYPE html>
<?php 
include ('navbar.php')
?>
<html>
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Accueil | MyCoach</title>
  <link rel="stylesheet" type="text/css" href="../css/style.css">
</head>

<body>

  <section class="services-container">
    <h2>Présentation</h2>
    <div class="service">
      <p><?php echo $presentation; ?></p>
    </div>
  </section>
  <section class="services-container">
    <h2>Mes Prestations</h2>
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


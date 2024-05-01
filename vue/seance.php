<?php include('navbar.php'); ?>
<section class="services-container">
    <h1>Séances par jour</h1>
    <!-- Formulaire de sélection du jour -->
    <form method="post" id="seancesForm">
    <label for="jour">Sélectionnez un jour :</label>
    <select name="jour" id="jour" onchange="document.getElementById('seancesForm').submit()">
        <option value="">Sélectionnez un jour</option>
        <option value="Lundi">Lundi</option>
        <option value="Mardi">Mardi</option>
        <option value="Mercredi">Mercredi</option>
        <option value="Jeudi">Jeudi</option>
        <option value="Vendredi">Vendredi</option>
        <option value="Samedi">Samedi</option>
        <option value="Dimanche">Dimanche</option>
        <option value="*">Toutes les séances</option>
    </select>
</form>


    <!-- Affichage des séances -->
    <div id="service">
    <?php if(isset($seances) && is_array($seances)): ?>
        <?php foreach ($seances as $seance): ?>
            <h3>Sport : <?php echo $seance['sport_nom']; ?>, Niveau : <?php echo $seance['niveau']; ?></h3>
            <h4>Jour : <?php echo $seance['jour']; ?>, Horaire : <?php echo $seance['horraire']; ?></h4>
            <p>Salle : <?php echo $seance['salle_nom']; ?>, Adresse : <?php echo $seance['Adresse']; ?>, <?php echo $seance['CP']; ?> <?php echo $seance['Ville']; ?></p>
        <?php endforeach; ?>
    <?php else: ?>
        <p>Aucune séance trouvée.</p>
    <?php endif; ?>
    </div>
</section>
<?php include('footer.php'); ?>

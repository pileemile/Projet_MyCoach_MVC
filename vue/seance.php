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
            <?php 
                $_SESSION['id_seance'] = $seance['id']; 
                // Vérifier si l'utilisateur est déjà inscrit à cette séance
                $dejaInscrit = dejaInscrit($connexion, $_SESSION['id_utilisateur'], $seance['id']);
            ?>
            <h3>Sport : <?php echo $seance['sport_nom']; ?>, Niveau : <?php echo $seance['niveau']; ?></h3>
            <h4>Jour : <?php echo $seance['jour']; ?>, Horaire : <?php echo $seance['horraire']; ?></h4>
            <p>Salle : <?php echo $seance['salle_nom']; ?>, Adresse : <?php echo $seance['Adresse']; ?>, <?php echo $seance['CP']; ?> <?php echo $seance['Ville']; ?></p>
            <!-- Formulaire d'inscription à la séance -->
            <form method="post" action="../controleur/controller.php?action=inscriptionSeance">
                <input type="hidden" name="id_seance" value="<?php echo $seance['id']; ?>">
                <input type="hidden" name="id_utilisateur" value="<?php echo $_SESSION['id_utilisateur']; ?>">
                <input type="hidden" name="nom" value="<?php echo $_SESSION['nom']; ?>">
                <input type="hidden" name="prenom" value="<?php echo $_SESSION['prenom']; ?>">
                <?php if (!$dejaInscrit): ?>
                    <button type="submit">S'inscrire</button>
                <?php else: ?>
                    <button type="button" disabled>Déjà inscrit</button>
                <?php endif; ?>
            </form>
        <?php endforeach; ?>
    <?php else: ?>
        <p>Aucune séance trouvée.</p>
    <?php endif; ?>
    </div>
</section>
<?php include('footer.php'); ?>

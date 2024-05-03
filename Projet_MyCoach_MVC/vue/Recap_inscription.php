<?php include('navbar.php'); ?>
<section class="inscriptions-container">
    <h1>Récapitulatif des inscriptions</h1>
    <table>
        <tr>
            <th>Sport</th>
            <th>Niveau</th>
            <th>Jour</th>
            <th>Horraire</th>
        </tr>
        <?php foreach ($inscriptions as $inscription): ?>
            <tr>
                <td><?php echo $inscription['sport_nom']; ?></td>
                <td><?php echo $inscription['niveau']; ?></td>
                <td><?php echo $inscription['jour']; ?></td>
                <td><?php echo $inscription['horraire']; ?></td>
            </tr>
        <?php endforeach; ?>
    </table>
</section>
<?php include('footer.php'); ?>

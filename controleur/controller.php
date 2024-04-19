<?php
include('../modele/coachModel.php');

$presentation = getPresentation();
$prestations = getPrestations();

include('../vue/index.php');
?>

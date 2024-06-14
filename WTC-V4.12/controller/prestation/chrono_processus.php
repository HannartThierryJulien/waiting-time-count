<?php

require_once(__DIR__ . '/../../model/Chronometre.php');

if (isset($_POST['fonction'])) {
	$fonction = $_POST['fonction'];
	$objChronometre = new Chronometre();

	if ($fonction == "start") {
		$objChronometre->startTimer();

	} else if ($fonction == "pause") {
		$objChronometre->pauseTimer();
		
	} else if ($fonction == "stop") {
		$objChronometre->stopTimer();
	}
}

?>
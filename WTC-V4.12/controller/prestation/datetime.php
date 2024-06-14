<?php

require_once(__DIR__ . '/../../model/Chronometre.php');

$objChronometre = new Chronometre();

echo gmdate("H\h i\m s\s", intval(round($objChronometre->getFileContentInSeconds(), 2)));

?>
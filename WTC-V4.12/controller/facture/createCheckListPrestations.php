<?php
require_once(__DIR__ . '/../../model/Prestation.php');
require_once(__DIR__ . '/../prestation/DAOPrestation.php');

if (array_key_exists('clientId', $_POST)) {
    $clientId = $_POST['clientId'];

    $actionsDBPrestation = new DAOPrestation();
    $prestations = $actionsDBPrestation->getPrestationsDetailleesByClient($clientId);

    $html = "";
    foreach ($prestations as $prestation) {
        $html .= "<input type='checkbox' id='" . $prestation["id"] . "' name='" . $prestation["id"] . "' value='" . $prestation["id"] . "' onclick='updateIdsPrestations(this.id)' />";
        $html .= " <label for='" . $prestation["id"] . "'>" . $prestation["date"] . " - " . $prestation["nomClient"] . " " . $prestation["prenomClient"] . " - " . gmdate("H\h i\m s\s", intval($prestation['duree'])) . " - " . (($prestation["facturee"] == 1) ? "Facturée" : "Non facturée") ."</label><br>";
    }

    echo $html;
}
?>
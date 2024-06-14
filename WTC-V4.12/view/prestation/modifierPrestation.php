<?php

require_once(__DIR__ . '/../../model/Prestation.php');
require_once(__DIR__ . '/../../controller/prestation/DAOPrestation.php');

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $actionsDBPrestation = new DAOPrestation();
    $prestation = $actionsDBPrestation->getPrestationById($id);
}

if (isset($_POST['submit'])) {

    $newPrestation = new Prestation();

    $heures = intval(substr($_POST["duree"], 0, 2));
    $minutes = intval(substr($_POST["duree"], 3, 2));
    $secondes = intval(substr($_POST["duree"], 6, 2));
    $dureeFormatee = $heures * 3600 + $minutes * 60 + $secondes;

    $facturee = isset($_POST['facturee']) ? 1 : 0;

    $newPrestation->setAllAttributes($_POST["id"], $_POST["date"], $_POST["idClient"], $_POST["idTarif"], $dureeFormatee, $_POST["description"], $facturee);

    $actionsDBPrestation = new DAOPrestation();
    $actionsDBPrestation->updatePrestation($newPrestation);

    header("Location: afficherPrestations.php");
    exit;
}

?>

<!-- ------------------------------------------------------------------- -->
<!-- ------------------------------------------------------------------- -->

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <title>Modifier une prestation</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Framework Bootstrap 5 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM"
        crossorigin="anonymous"></script>
    <!-- CSS Custom-->
    <link href="../../config/global.css" rel="stylesheet">
    <!-- Javascript Custom-->
</head>

<body>
    <header>
        <?php
        include '../../autres/navBar.php';
        ?>
    </header>

    <main class="container py-5">
        <div class="row">
            <div class="col-lg-6 mx-auto">
                <div class="card border-0 shadow">
                    <div class="card-header bg-transparent text-center">
                        <h1 class="mb-0">Modifier une prestation</h1>
                    </div>
                    <div class="card-body">
                        <form action="" method="post">
                            <input type="hidden" name="id" value="<?php echo $prestation->getId(); ?>">
                            <div class="mb-3">
                                <label for="date" class="form-label">Date :</label>
                                <input type="text" id="date" name="date" class="form-control"
                                    value="<?php echo $prestation->getDate(); ?>">
                            </div>
                            <div class="mb-3">
                                <label for="idClient" class="form-label">Client :</label>
                                <select class="form-select" id="idClient" name="idClient" required>
                                    <?php
                                    require_once(__DIR__ . '/../../model/Client.php');
                                    require_once(__DIR__ . '/../../controller/DAOClient.php');

                                    $actionsDBClient = new DAOClient();
                                    $clients = $actionsDBClient->getClients();

                                    foreach ($clients as $client) {
                                        ?>
                                        <option value="<?php echo $client->getId(); ?>" <?php echo ($client->getId() == $prestation->getIdClient()) ? "selected" : "" ?>>
                                            <?php echo $client->getNom() . " " . $client->getPrenom(); ?>
                                        </option>
                                        <?php
                                    }
                                    ?>
                                </select>
                            </div>
                            <div class="mb-3">
                                <label for="idTarif" class="form-label">IdTarif :</label>
                                <select class="form-select" id="idTarif" name="idTarif" required>
                                    <?php
                                    require_once(__DIR__ . '/../../model/Tarif.php');
                                    require_once(__DIR__ . '/../../controller/DAOTarif.php');

                                    $daoTarif = new DAOTarif();
                                    $tarifs = $daoTarif->getTarifs();
                                    foreach ($tarifs as $tarif) {
                                        ?>
                                        <option value="<?php echo $tarif->getId(); ?>" <?php echo ($prestation->getIdTarif() == $tarif->getId() || $client->getId() == $prestation->getIdClient()) ? "selected" : ""; ?>>
                                            <?php echo $tarif->getNom() . " : " . $tarif->getMontantParHeure() . " €/h"; ?>
                                        </option>
                                        <?php
                                    }
                                    ?>
                                </select>
                            </div>
                            <div class="mb-3">
                                <label for="duree" class="form-label">Duree :</label>
                                <input type="text" id="duree" name="duree" class="form-control"
                                    value="<?php echo gmdate("H\hi\ms\s", intval($prestation->getDuree())); ?>">
                            </div>
                            <div class="mb-3">
                                <label for="description" class="form-label">Description :</label>
                                <textarea id="description" name="description"
                                    class="form-control"><?php echo $prestation->getDescription(); ?></textarea>
                            </div>
                            <div class="mb-3">
                                <label for="facturee" class="form-label">Facturee :</label>
                                <input type="checkbox" id="facturee" name="facturee" class="form-check-input" <?php echo ($prestation->isFacturee()) ? "checked" : ""; ?>>
                            </div>
                            <div class="d-grid gap-2">
                                <input type="submit" name="submit" class="btn" value="Enregistrer les modifications">
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </main>
</body>

</html>
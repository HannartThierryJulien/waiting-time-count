<?php

require_once(__DIR__ . '/../../model/Tarif.php');
require_once(__DIR__ . '/../../controller/DAOTarif.php');

if (array_key_exists('ajouterTarif', $_POST)) {

    $tarifToAdd = new Tarif();
    $tarifToAdd->setAttributesForInsert($_POST["nom"], $_POST["montantParHeure"], $_POST["description"]);

    $actionsDBTarif = new DAOTarif();
    $actionsDBTarif->addTarif($tarifToAdd);

    header("Location: afficherTarifs.php");
}

?>

<!-- ------------------------------------------------------------------- -->
<!-- ------------------------------------------------------------------- -->

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <title>Ajouter un tarif</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Framework Bootstrap 5 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM"
        crossorigin="anonymous"></script>
    <!-- CSS Custom-->
    <link href="../../config/global.css" rel="stylesheet">
</head>

<body>
    <header>
        <?php include '../../autres/navBar.php'; ?>
    </header>

    <main class="container py-5">
        <div class="row">
            <div class="col-lg-6 mx-auto">
                <div class="card border-0 shadow">
                    <div class="card-header bg-transparent text-center">
                        <h1 class="mb-0">Ajouter un tarif</h1>
                    </div>
                    <div class="card-body">
                        <form method="post">
                            <div class="mb-3">
                                <label for="nom" class="form-label">Nom :</label>
                                <input type="text" id="nom" name="nom" class="form-control" required>
                            </div>

                            <div class="mb-3">
                                <label for="montantParHeure" class="form-label">Montant par heure :</label>
                                <input type="number" step="0.01" id="montantParHeure" name="montantParHeure"
                                    class="form-control" placeholder="25" required>
                            </div>

                            <div class="mb-3">
                                <label for="description" class="form-label">Description :</label>
                                <textarea id="description" name="description" class="form-control"
                                    placeholder="Tarif appliqué lors de..." required></textarea>
                            </div>

                            <div class="mb-3">
                                <input type="submit" name="ajouterTarif" value="Ajouter" class="btn">
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </main>
</body>


</html>
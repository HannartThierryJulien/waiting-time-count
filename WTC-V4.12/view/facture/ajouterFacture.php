<?php

require_once(__DIR__ . '/../../model/Facture.php');
require_once(__DIR__ . '/../../controller/facture/DAOFacture.php');

if (array_key_exists('ajouterFacture', $_POST)) {

    $factureToAdd = new Facture();
    if (isset($_POST['payee'])) {
        $payee = 1;
    } else {
        $payee = 0;
    }

    $factureToAdd->setAttributesForInsert($_POST["idClient"], $_POST["idsPrestations"], $payee, $_POST["tva"]);

    $actionsDBFacture = new DAOFacture();
    $actionsDBFacture->addFacture($factureToAdd);

    header("Location: afficherFactures.php");
}

?>

<!-- ------------------------------------------------------------------- -->
<!-- ------------------------------------------------------------------- -->

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <title>Ajouter une facture</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Framework Bootstrap 5 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM"
        crossorigin="anonymous"></script>
    <!--Javascript JQuerry-->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>
    <!-- CSS Custom-->
    <link href="../../config/global.css" rel="stylesheet">
    <!-- Javascript Custom-->
    <script src="ajouterFacture.js"></script>
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
                        <h1 class="mb-0">Ajouter une facture</h1>
                    </div>
                    <div class="card-body">
                        <form method="post" class="mb-5">
                            <div class="mb-3">
                                <label for="clientsList" class="form-label">Client :</label>
                                <select class="form-select" id="clientsList" name="idClient"
                                    onchange="loadPrestations(this.value)" required>
                                    <option disabled selected value>Sélectionner un client</option>
                                    <?php
                                    require_once(__DIR__ . '/../../model/Client.php');
                                    require_once(__DIR__ . '/../../controller/DAOClient.php');

                                    $actionsDBClient = new DAOClient();
                                    $clients = $actionsDBClient->getClients();

                                    foreach ($clients as $client) {
                                        ?>
                                        <option value="<?php echo $client->getId(); ?>"><?php echo $client->getNom() . " " . $client->getPrenom(); ?></option>
                                        <?php
                                    }
                                    ?>
                                </select>
                            </div>

                            <div class="mb-3">
                                <label for="idsPrestations" class="form-label">Ids prestations :</label>
                                <input type="text" class="form-control" id="idsPrestations" name="idsPrestations"
                                    required readonly>
                            </div>

                            <div class="mb-3 form-check">
                                <input type="checkbox" class="form-check-input" id="payee" name="payee">
                                <label class="form-check-label" for="payee">Payée ?</label>
                            </div>

                            <div class="mb-3">
                                <label for="tva" class="form-label">TVA :</label>
                                <input type="number" class="form-control" id="tva" name="tva" min="1" required>
                            </div>

                            <button type="submit" name="ajouterFacture" class="btn">Ajouter</button>
                        </form>
                    </div>
                    <div class="card-footer">
                        <label class="form-label">Prestations :</label>
                        <div id="prestationsList"></div>
                    </div>
                </div>
            </div>
        </div>
    </main>
</body>


</html>
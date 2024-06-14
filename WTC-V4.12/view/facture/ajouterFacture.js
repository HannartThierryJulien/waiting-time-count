$(document).ready(function () {
    const idsPrestationsInput = document.getElementById("idsPrestations");

    idsPrestationsInput.addEventListener("blur", () => {
        const idsPrestations = idsPrestationsInput.value.trim();

        if (!idsPrestations.match(/^(\d+(, ?\d+)*)?$/)) {
            alert("Veuillez entrer une liste d'entiers séparés par des virgules (ex: 2, 5, 8)");
            idsPrestationsInput.value = "";
        }
    });
});


function loadPrestations(clientId) {
    // Envoie une requête AJAX pour récupérer les prestations du client sélectionné
    $.ajax({
        url: '../../controller/facture/createCheckListPrestations.php',
        type: 'POST',
        data: { clientId: clientId },
        success: function (response) {
            document.getElementById("prestationsList").innerHTML = response;
        },
        error: function () {
            alert("Une erreur est survenue lors de la récupération des prestations.");
        }
    });
}


function updateIdsPrestations(id) {
    // Récupère les cases à cocher
    var checkboxes = document.querySelectorAll('input[type=checkbox]');

    // Initialise un tableau vide pour stocker les id sélectionnés
    var selectedIds = [];

    // Parcourt les cases à cocher
    for (var i = 0; i < checkboxes.length; i++) {
        // Vérifie si la case à cocher est sélectionnée
        if (checkboxes[i].checked) {
            // Ajoute l'id de la prestation sélectionnée au tableau
            selectedIds.push(checkboxes[i].value);
        }
    }

    // Met à jour l'attribut idsPrestations avec les id sélectionnés
    document.getElementById("idsPrestations").value = selectedIds.join(",");
}
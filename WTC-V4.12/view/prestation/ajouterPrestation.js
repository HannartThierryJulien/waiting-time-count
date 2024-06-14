$(document).ready(function () {
    function update() {
        $.ajax({
            type: 'POST',
            url: '../../controller/prestation/datetime.php',
            timeout: 1000,
            success: function (data) {
                $("#timer").html(data);
                window.setTimeout(update, 1000);
            }
        });
    }
    update();
});


/*********************************************************************/
/*********************************************************************/


$(document).ready(function () {
    $("input[id=start], input[id=pause]").click(function () {
        var bouton = $(this).attr("id");
        console.log("ddddd");
        $.ajax({
            type: "POST",
            url: "../../controller/prestation/chrono_processus.php",
            data: { fonction: bouton }
        });
    });

    $("input[id=stop]").click(function () {
        $.ajax({
            type: "POST",
            url: "../../controller/prestation/chrono_processus.php",
            data: { fonction: "stop" }
        }).done(function (tempsChrono) {
            $("#chrono").val(tempsChrono);
        });
    });
});


/*********************************************************************/
/*********************************************************************/


function confirmSuppression(id) {
    if (confirm("Êtes-vous sûr de vouloir supprimer ce client ?")) {
        window.location.href = "supprimerClient.php?id=" + id;
    }
}


/*********************************************************************/
/*********************************************************************/


$(document).ready(function () {
    var startButton = $("#start");
    var pauseButton = $("#pause");
    var stopButton = $("#stop");
    var submitButton = $("button[type='submit']");

    startButton.click(function () {
        startButton.prop("disabled", true);
        pauseButton.prop("disabled", false);
        stopButton.prop("disabled", false);
    });

    pauseButton.click(function () {
        startButton.prop("disabled", false);
        pauseButton.prop("disabled", true);
        stopButton.prop("disabled", false);
    });

    stopButton.click(function () {
        startButton.prop("disabled", false);
        pauseButton.prop("disabled", true);
        stopButton.prop("disabled", true);
        submitButton.prop("disabled", false);
    });
});


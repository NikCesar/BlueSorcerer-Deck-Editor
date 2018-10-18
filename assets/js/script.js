function searchForCards(query) {
    delay(function () {
        callPhpFunction("searchForCards", "query=" + query, function (result) {
            // do something with the result.
            console.log(result);
        });
    }, 500);
}

// #region Helper methods
function callPhpFunction(functionName, param, successCallback) {
    $.ajax({
        type: "GET",
        url: "http://" + window.location.hostname + "/modules/requestHandler.php",
        data: "functionname=" + functionName + "&" + param,
        success: successCallback
    });
}

var delay = (function () {
    var timer = 0;
    return function (callback, ms) {
        clearTimeout(timer);
        timer = setTimeout(callback, ms);
    };
})();

// #endregion

function raceSelectEnabled() {

    typeSelectValue = document.getElementById("typeSelect").value;
    if (typeSelectValue == "Minion") {
        document.getElementById("raceSelectDiv").style.display = "block";
    }
    else {
        document.getElementById("raceSelectDiv").style.display = "none";
    }

}

function showModal() {
    var modal = document.getElementById("modal");
    modal.style.display = "block";

    //setTimeout(hideModal, 5000);
}

function hideModal() {
    var modal = document.getElementById("modal");
    modal.style.display = "none";
}

// When the user clicks anywhere outside of the modal, close it
window.onclick = function(event) {
    if (event.target == modal) {
        hideModal();
    }
}
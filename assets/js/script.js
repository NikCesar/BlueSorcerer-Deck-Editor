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
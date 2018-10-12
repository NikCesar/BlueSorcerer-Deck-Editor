function searchForCards(query) {
    delay(function () {
        callPhpFunction("searchForCards", "query=" + query, function (result) {
            // do something with the result.
            console.log(result);
        });
    }, 500);
}

function searchForCardsByQueries() {

    var nameSearchValue = document.getElementById("cardName").value;
    var ruleSearchValue = document.getElementById("cardText").value;
    var costSearchValue = document.getElementById("cardCost").value;
    var attackSearchValue = document.getElementById("cardAttack").value;
    var healthSearchValue = document.getElementById("cardHealth").value;
    var classSearchValue = document.getElementById("classSelect").value;
    var typeSearchValue = document.getElementById("typeSelect").value;
    var raceSearchValue = document.getElementById("raceSelect").value;
    var setSearchValue = document.getElementById("setSelect").value;

    var query = {};

    if (nameSearchValue !== "") {
        query['name'] = nameSearchValue;
    }
    if (ruleSearchValue !== "") {
        query['text'] = ruleSearchValue;
    }
    if (costSearchValue !== "") {
        query['cost'] = costSearchValue;
    }
    if (attackSearchValue !== "") {
        query['attack'] = attackSearchValue;
    }
    if (healthSearchValue !== "") {
        query['health'] = healthSearchValue;
    }
    if (classSearchValue !== "") {
        query['playerClass'] = classSearchValue;
    }
    if (typeSearchValue !== "") {
        query['type'] = typeSearchValue;
    }
    if (raceSearchValue !== "") {
        query['race'] = raceSearchValue;
    }
    if (setSearchValue !== "") {
        query['cardSet'] = setSearchValue;
    }

    var jsonRepresentation = JSON.stringify(query);

    callPhpFunction("searchForCardsByQueries", "queries=" + jsonRepresentation, function (result) {
        console.log(result);
    });
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
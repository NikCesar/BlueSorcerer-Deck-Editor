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

function addCardSearchValidation(failureTextCardCost, failureTextCardRace) {
    $("#cardSearchSubmit").on("click", function (e) {
        if ($("#cardCost").val() > 20) {
            alert(failureTextCardCost);
            e.preventDefault();
            return false;
        }

        if (($("#typeSelect").val() !== "" && $("#typeSelect").val() !== "Minion") && $("#raceSelect").val() !== "") {
            alert(failureTextCardRace);
            e.preventDefault();
            return false;
        }

        return true;
    })
}

function setCardSearchTooltips(cardNameTooltip, cardRuleTooltip, cardCostTooltip, cardAttackTooltip, cardHealthTooltip, cardClassTooltip, cardTypeTooltip, cardRaceTooltip, cardSetTooltip) {
    $("#cardName").opentip(cardNameTooltip, { delay: 1 });
    $("#cardText").opentip(cardRuleTooltip, {delay: 1 });
    $("#cardCost").opentip(cardCostTooltip, {delay: 1 });
    $("#cardAttack").opentip(cardAttackTooltip, {delay: 1 });
    $("#cardHealth").opentip(cardHealthTooltip, {delay: 1 });
    $("#classSelect").opentip(cardClassTooltip, {delay: 1 });
    $("#typeSelect").opentip(cardTypeTooltip, {delay: 1 });
    $("#raceSelect").opentip(cardRaceTooltip, {delay: 1 });
    $("#setSelect").opentip(cardSetTooltip, {delay: 1 });
}

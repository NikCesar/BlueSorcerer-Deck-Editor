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
    var cardSearchSubmitButton = $("#cardSearchSubmit");
    var cardCostInputElement = $("#cardCost");
    var cardTypeSelectElement = $("#typeSelect");
    var cardRaceSelectElement = $("#raceSelect");

    cardSearchSubmitButton.on("click", function (e) {
        if (cardCostInputElement.val() > 20) {
            alert(failureTextCardCost);
            e.preventDefault();
            return false;
        }

        if ((cardTypeSelectElement.val() !== "" && cardTypeSelectElement.val() !== "Minion") && cardRaceSelectElement.val() !== "") {
            alert(failureTextCardRace);
            e.preventDefault();
            return false;
        }

        return true;
    })
}
function setCardSearchTooltips(cardNameTooltip, cardRuleTooltip, cardCostTooltip, cardAttackTooltip, cardHealthTooltip, cardClassTooltip, cardTypeTooltip) {
    $("#cardName").opentip(cardNameTooltip, { delay: 0.5 });
    $("#cardText").opentip(cardRuleTooltip, {delay: 0.5 });
    $("#cardCost").opentip(cardCostTooltip, {delay: 0.5 });
    $("#cardAttack").opentip(cardAttackTooltip, {delay: 0.5 });
    $("#cardHealth").opentip(cardHealthTooltip, {delay: 0.5 });
    $("#classSelect").opentip(cardClassTooltip, {delay: 0.5 });
    $("#typeSelect").opentip(cardTypeTooltip, {delay: 0.5 });

}


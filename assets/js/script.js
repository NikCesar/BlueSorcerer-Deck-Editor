var deckManager = new DeckManager();

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

// #region deck manager
$(document).ready(function() {  
    // overwrite "add card to deck" button with JS deckManager.
    var $addButtons = $(".add-card");
    $addButtons.each(function(i, element) {
        $(element).on("click", function(event) { addToDeckWithoutPosting(event); });
    });

    // overwrite "remove card from deck" button with JS deckManager.
    var $removeButtons = $(".remove-card");
    $removeButtons.each(function(i, element) {
        $(element).on("click", function(event) { removeFromDeckWithoutPosting(event); });
    });
});

function addToDeckWithoutPosting(event) {
    var cardId = $(event.target).parent()[0].cardId.value;
    deckManager.addToDeck(cardId);

    event.preventDefault();
}

function removeFromDeckWithoutPosting(event) {
    var cardId = $(event.target).parent()[0].cardId.value;
    deckManager.removeFromDeck(cardId);

    event.preventDefault();
}

// #endregion
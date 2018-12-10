class DeckManager {
    constructor() {
        if (location.search.indexOf('deckId') <= 0) {
            return;
        }

        DeckManager.deckId = location.search.split('deckId=')[1].split("&")[0];
        DeckManager.deckList = [];

        startLoading();

        $.get({
            url: "/deckEditor/getJsDeck",
            data: { 
                deckId: DeckManager.deckId
            },
            success: function(response) { 
                console.log("received deck..", response);
                DeckManager.deckList = JSON.parse(response);
             },
            error: function() { console.log("error"); },
            complete: function() { stopLoading(); }
        });
    }

    addToDeck(cardId) {
        if (DeckManager.deckList[cardId] !== undefined) {
            if (DeckManager.deckList[cardId] >= 2) {
                console.log("already 2 in deck");
                return;
            }
        } else {
            DeckManager.deckList[cardId] = 0;
        }

        DeckManager.deckList[cardId] = DeckManager.deckList[cardId] === undefined ? 1 : DeckManager.deckList[cardId] + 1;
        this._addCardToSidebar(cardId, DeckManager.deckList[cardId]);
        this._saveCardToDeck(cardId, DeckManager.deckId);
    }

    removeFromDeck(cardId) {
        if (DeckManager.deckList[cardId] === undefined) {
            return;
        }

        var removeCompletely = false;

        DeckManager.deckList[cardId] -= 1;

        if (DeckManager.deckList[cardId] <= 0) {
            DeckManager.deckList[cardId] = 0;
            removeCompletely = true;
        }

        this._removeCardFromSidebar(cardId, DeckManager.deckList[cardId], removeCompletely);
        this._deleteCardFromDeck(cardId, DeckManager.deckId);
    }

// #region private methods

    _addCardToSidebar(cardId, count) {
        if ($("form#remove_" + cardId).length === 0) {
            
            var cardName = $("form#add_" + cardId + " input[name=cardName]").val();

            var html = '<li class="deckListElement">' +
            '    <label class="cardAmount">{count}</label>' +
            '    <label class="cardName">{cardName}</label>' +
            '    <form id="remove_{cardId}" action="/deckEditor/removeCard" method="POST">' +
            '        <input type="text" name="cardId" value="{cardId}" class="hidden">' +
            '        <input type="text" name="deckId" value="{deckId}" class="hidden">' +
            '        <input type="submit" value=" - " class="remove-card">' +
            '    </form>' +
            '</li>';

            var cardHtml = html.replace(/{cardId}/g, cardId).replace(/{count}/g, count).replace(/{deckId}/g, DeckManager.deckId).replace(/{cardName}/g, cardName);
            $("#deckList ul").append(cardHtml);

            $("form#remove_" + cardId + " input[type=submit]").on("click", function(event) { removeFromDeckWithoutPosting(event); });

        } else {
            $("form#remove_" + cardId).parent().find(".cardAmount").html(count);
        }
    }
    
    _removeCardFromSidebar(cardId, count, removeCompletely) {
        if (removeCompletely) {
            $("form#remove_" + cardId).parent().remove();
        } else {
            $("form#remove_" + cardId).parent().find(".cardAmount").val(count);
        }
    }

    _saveCardToDeck(cardId, deckId) {
        startLoading();

        $.post({
            url: "/deckEditor/addCard",
            data: { 
                cardId: cardId, 
                deckId: deckId,
            },
            success: function() { console.log("saved"); },
            error: function() { console.log("error"); },
            complete: function() { stopLoading(); }
        });
    }

    _deleteCardFromDeck(cardId, deckId) {
        startLoading();

        $.post({
            url: "/deckEditor/removeCard",
            data: { 
                cardId: cardId, 
                deckId: deckId
            },
            success: function() { console.log("removed"); },
            error: function() { console.log("error"); },
            complete: function() { stopLoading(); }
        });
    }

// #endregion
}

function startLoading() {
    $("#sideBarDeckList").addClass("loading");
}

function stopLoading() {
    $("#sideBarDeckList").removeClass("loading");
}


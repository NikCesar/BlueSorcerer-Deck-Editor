
class DeckManager {
    constructor() {
        this.deckId = location.search.split('deckId=')[1].split("&")[0];

        if (localStorage.deckList === "") {
            $.get({
                url: "/modules/requestHandler.php",
                data: { 
                    deckId: this.deckId,
                    functionname: "getSidebarDeck"
                },
                success: function(response) { 
                    debugger;
                    console.log("received deck..", response);
                    this.deckList = JSON.parse(response);
                    localStorage.deckList = response;
                 },
                error: function() { console.log("error"); }
            });
        } else {
            this.deckList = JSON.parse(localStorage.deckList) || [];
        }
    }

    addToDeck(cardId) {
        if (this.deckList[cardId] !== undefined) {
            if (this.deckList[cardId] >= 2) {
                console.log("already 2 in deck");
                return;
            }
        } else {
            this.deckList[cardId] = 0;
        }

        this.deckList[cardId] += 1;
        this._addCardToSidebar(cardId, this.deckList[cardId]);
        this._saveCardToDeck(cardId);

        localStorage.deckList = JSON.stringify(this.deckList);
    }

    removeFromDeck(cardId) {
        if (this.deckList[cardId] === undefined) {
            return;
        }

        var removeCompletely = false;

        this.deckList[cardId] -= 1;

        if (this.deckList[cardId] <= 0) {
            this.deckList.delete(cardId);
            removeCompletely = true;
        }

        this._removeCardFromSidebar(cardId, this.deckList[cardId], removeCompletely);
        this._deleteCardFromDeck(cardId);

        localStorage.deckList = JSON.stringify(this.deckList);
    }

// #region private methods

    _addCardToSidebar(cardId, count) {
        if ($("form#remove_" + cardId).length === 0) {
            var html = '<li class="deckListElement">' +
            '    <label class="cardAmount">{count}</label>' +
            '    <label class="cardName">{TODO}</label>' +
            '    <form id="remove_{cardId}" action="" method="POST">' +
            '        <input type="text" name="functionname" value="removeCard" class="hidden">' +
            '        <input type="text" name="cardId" value="{cardId}" class="hidden">' +
            '        <input type="text" name="deckId" value="{deckId}" class="hidden">' +
            '        <input type="submit" value=" - " onclick="maintainScrollPos();" class="remove-card">' +
            '    </form>' +
            '</li>';

            var cardHtml = html.replace("{cardId}", cardId).replace("{count}", count).replace("{deckId}", this.deckId);
            $("#deckList ul").append(cardHtml);

        } else {
            $("form#remove_" + cardId).parent().find(".cardAmount").val(count);
        }
    }
    
    _removeCardFromSidebar(cardId, count, removeCompletely) {
        if (removeCompletely) {
            $("form#remove_" + cardId).parent().remove();
        } else {
            $("form#remove_" + cardId).parent().find(".cardAmount").val(count);
        }
    }

    _saveCardToDeck(cardId) {
        $.post({
            url: "/modules/requestHandler.php",
            data: { 
                cardId: cardId, 
                deckId: this.deckId,
                functionname: "addCard"
            },
            success: function() { console.log("saved"); },
            error: function() { console.log("error"); }
        });
    }

    _deleteCardFromDeck(cardId) {
        $.post({
            url: "/modules/requestHandler.php",
            data: { 
                cardId: cardId, 
                deckId: this.deckId,
                functionname: "removeCard"
            },
            success: function() { console.log("removed"); },
            error: function() { console.log("error"); }
        });
    }

// #endregion
}


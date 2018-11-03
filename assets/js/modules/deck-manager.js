
class DeckManager {
    constructor() {
        this.deckList = JSON.parse(localStorage.deckList || "[]");
    
        this.deckId = location.search.split('deckId=')[1].split("&")[0];
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
        this._addCardToSidebar();
        this._saveCardToDeck(cardId);

        localStorage.deckList = this.deckList;
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

        this._removeCardFromSidebar(removeCompletely);
        this._deleteCardFromDeck(cardId);

        localStorage.deckList = this.deckList;
    }

// #region private methods

    _addCardToSidebar() {
        // TODO...
    }
    
    _removeCardFromSidebar(removeCompletely) {
        // TODO...
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


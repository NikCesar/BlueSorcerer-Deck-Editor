

class CardBasket {
    constructor() {
        this.deckList = JSON.parse(localStorage.deckList || "[]");
    
        this.deckId = location.search.split('deckId=')[1].split("&")[0];
    }

    addToBasket(cardId) {
        if (this.deckList[cardId] !== undefined) {
            if (this.deckList[cardId] >= 2) {
                return;
            }
        } else {
            this.deckList[cardId] = 0;
        }

        this.deckList[cardId] += 1;
        this._addCardToSidebard();
        this._saveCardToDeck(cardId);

        localStorage.deckList = this.deckList;
    }

// #region private methods

    _addCardToSidebard() {
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
            success: function(a,b,c) { console.log("saved",a,b,c); },
            error: function(a,b,c) { console.log("error",a,b,c); }
        });
    }

// #endregion
}


<?php

class DeckService
{
    function mapSideBarDeck($deckList, $deckListCards) {
        $cardCountMap = array();
        foreach ($deckList as $deckCard) {
            $cardCountMap[$deckCard->CardId] = $deckCard->Count;
        }

        $sideBarDeck = array();
        foreach ($deckListCards as $deckCardEntry) {
            array_push($sideBarDeck, (object)array("Name" => $deckCardEntry->name, "Count" => $cardCountMap[$deckCardEntry->id], "Id" => $deckCardEntry->id));
        }

        return $sideBarDeck;
    }
}

?>
<?php
$texts = array(
    "DeckEditor" => array("en" => "Deck Editor", "de"=> "Deck Editierer"),
    "Deck" => array("en" => "Deck", "de" => "Deck"),
    "NewestDecks"  => array("en" => "Newest Decks", "de" => "Neuste Decks"),
    "TopDecks" => array("en" => "Top Decks", "de" => "Top Decks"),
    "CardSearchName" => array("en" => "Card name contains ", "de" => "Kartenname enthält "),
    "CardSearchRule" => array("en" => "Rule text contains ", "de" => "Kartenregel enthält "),
    "CardSearchCost" => array("en" => "Manacost ", "de" => "Manakosten"),
    "CardSearchClass" => array("en" => "Belongs to class ", "de" => "Gehört zu Klasse "),
    "CardSearchType" => array("en" => "Card type ", "de" => "Kartentyp "),
    "ClassDruid" => array("en" => "Druid", "de" => "Druide"),
    "ClassHunter" => array("en" => "Hunter", "de" => "Jäger"),
    "ClassMage" => array("en" => "Mage", "de" => "Magier"),
    "ClassPaladin" => array("en" => "Paladin", "de" => "Paladin"),
    "ClassPriest" => array("en" => "Priest", "de" => "Priester"),
    "ClassRogue" => array("en" => "Rogue", "de" => "Schurke"),
    "ClassShaman" => array("en" => "Shaman", "de" => "Schamane"),
    "ClassWarlock" => array("en" => "Warlock", "de" => "Hexenmeister"),
    "ClassWarlock" => array("en" => "Warlock", "de" => "Hexenmeister"),
);
function test($key){
    return global $texts[$key][$_SESSION["language"]];
};
?>

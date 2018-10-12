<?php
    global $texts;
    $texts = array(
        "DeckEditor" => array("en" => "Deck Editor", "de"=> "Deck Editierer"),
        "Deck" => array("en" => "Deck", "de" => "Deck"),
        "NewestDecks"  => array("en" => "Newest Decks", "de" => "Neuste Decks"),
        "TopDecks" => array("en" => "Top Decks", "de" => "Top Decks"),
        "CardSearch" => array("en" => "Card Search", "de" => "Kartensuche"),
        "CardSearchName" => array("en" => "Card name contains ", "de" => "Kartenname enthält "),
        "CardSearchRule" => array("en" => "Rule text contains ", "de" => "Kartenregel enthält "),
        "CardSearchCost" => array("en" => "Manacost ", "de" => "Manakosten "),
        "CardSearchAttack" => array("en" => "Attack ", "de" => "Angriff "),
        "CardSearchHealth" => array("en" => "Health ", "de" => "Lebenspunkte "),
        "CardSearchClass" => array("en" => "Belongs to class ", "de" => "Gehört zu Klasse "),
        "CardSearchType" => array("en" => "Card type ", "de" => "Kartentyp "),
        "CardSearchRace" => array("en" => "Race ", "de" => "Rasse "),
        "CardSearchSet" => array("en" => "Belongs to set ", "de" => "Gehört zu Set "),
        "CardSearchSubmit" => array("en" => "Submit", "de" => "Suchen"),
        "ClassDruid" => array("en" => "Druid", "de" => "Druide"),
        "ClassHunter" => array("en" => "Hunter", "de" => "Jäger"),
        "ClassMage" => array("en" => "Mage", "de" => "Magier"),
        "ClassPaladin" => array("en" => "Paladin", "de" => "Paladin"),
        "ClassPriest" => array("en" => "Priest", "de" => "Priester"),
        "ClassRogue" => array("en" => "Rogue", "de" => "Schurke"),
        "ClassShaman" => array("en" => "Shaman", "de" => "Schamane"),
        "ClassWarlock" => array("en" => "Warlock", "de" => "Hexenmeister"),
        "CardRaceBeast" => array("en" => "Beast", "de" => "Wildtier"),
        "CardRaceDemon" => array("en" => "Demon", "de" => "Dämon"),
        "CardRaceDragon" => array("en" => "Dragon", "de" => "Drache"),
        "CardRaceElemental" => array("en" => "Elemental", "de" => "Elementar"),
        "CardRaceMech" => array("en" => "Mech", "de" => "Mechanisch"),
        "CardRaceMurloc" => array("en" => "Murloc", "de" => "Murloc"),
        "CardRacePirate" => array("en" => "Pirate", "de" => "Pirat"),
        "CardRaceTotem" => array("en" => "Totem", "de" => "Totem"),
        "CardTypeWeapon" => array("en" => "Weapon", "de" => "Waffe"),
        "CardTypeMinion" => array("en" => "Minion", "de" => "Diener"),
        "CardTypeSpell" => array("en" => "Spell", "de" => "Zauber"),
        "CardTypeHero" => array("en" => "Hero Card", "de" => "Heldenkarte"),
        "CardSetBasic" => array("en" => "Basic", "de" => "Basis"),
        "CardSetClassic" => array("en" => "Classic", "de" => "Klassik"),
        "CardSetHoF" => array("en" => "Hall of Fame", "de" => "Zeitlose Klassiker"),
        "CardSetNaxx" => array("en" => "Curse of Naxxramas", "de" => "Naxxramas"),
        "CardSetGvG" => array("en" => "Goblins vs Gnomes", "de" => "Goblins gegen Gnome"),
        "CardSetBRM" => array("en" => "Blackrock Mountain", "de" => "Der Schwarzfels"),
        "CardSetTgT" => array("en" => "The Grand Tournament", "de" => "Das Grosse Turnier"),
        "CardSetLoE" => array("en" => "League of Explorers", "de" => "Die Forscherliga"),
        "CardSetWOG" => array("en" => "Whispers of the Old Gods", "de" => "Das Flüstern der alten Götter"),
        "CardSetKara" => array("en" => "One Night in Karazhan", "de" => "Eine Nacht in Karazhan"),
        "CardSetMSG" => array("en" => "Mean Streets of Gadgetzan", "de" => "Strassen von Gadgetzan"),
        "CardSetUnGoro" => array("en" => "Journey to Un'Goro", "de" => "Reise nach Un'Goro"),
        "CardSetKFT" => array("en" => "Knights of the Frozen Throne", "de" => "Ritter des Frostthrohns"),
        "CardSetKaC" => array("en" => "Kobolds & Catacombs", "de" => "Kobolde & Katakomben"),
        "CardSetWood" => array("en" => "The Witchwood", "de" => "Der Hexenwald"),
        "CardSetBdP" => array("en" => "The Boomsday Project", "de" => "Dr. Booms Geheimlabor"),
        "loginSuccess" => array("en" => "The login was successful.", "de" => "Sie wurden erfolgreich eingeloggt."),
        "loginFail" => array("en" => "The login was not successful.", "de" => "Der Loginversuch ist fehlgeschlagen."),
        "logoutSuccess" => array("en" => "You sucessfully logged out.", "de" => "Sie wurden erfolgreich abgemeldet."),

    );

    function text($key){
        $language = $_SESSION["language"];
        return $GLOBALS["texts"][$key][$language];
    };
?>

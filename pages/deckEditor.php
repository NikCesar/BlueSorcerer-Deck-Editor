<?php
    redirectToLoginIfNotLoggedIn("deckEditor");
    $dbService = new DbService();
    $cardService = new CardService();
?>

<div class="content">
    <div id="content-header"></div>

    <?php
        if (!isset($_GET["deckId"])) {
            echo "<span class='validation-error'>" . text("NoDeckSpecified") . "</span>";
            exit;
        }
    
        $deck = $dbService->getDeckById($_GET["deckId"]);
    
        if ($deck === null) {
            echo "<span class='validation-error'>" . text("NoDeckFound") . "</span>";
            exit;
        }
    
        if ($deck->UserId !== $_SESSION["user"]->Id) {
            echo "<span class='validation-error'>" . text("NotYourDeck") . "</span>";
            exit;
        }

        $deckList = $dbService->getCardsByDeckId($deck->Id);
        $cards = $cardService->getCardsByDecklist($deckList);
    ?>    

    <section id="deckEditor">
        <h1><?php echo text("EditDeck"); ?></h1>

        <form id="editDeckForm" action="" method="POST">
            <input type="text" name="functionname" value="addDeck" class="hidden">
            <input type="text" name="page" value="deckEditor" class="hidden">

            <div>
                <label><?php echo text("DeckName"); ?></label>
                <input type="text" name="deckName" value="<?php echo $deck->Name; ?>" />
            </div>
            <div>
                <label><?php echo text("DeckDescription"); ?></label>
                <textarea type="text" name="deckDescription" form="editDeckForm"><?php echo $deck->Description; ?></textarea>
            </div>
            <div>
                <label><?php echo text("DeckClass"); ?></label>
                <select name="deckClass" value="<?php echo $deck->Class; ?>">
                    <option value=""></option>
                    <option value="Druid" <?php echo $deck->Class === "Druid"?"selected=selected":""; ?> ><?php echo text("ClassDruid"); ?></option>
                    <option value="Hunter" <?php echo $deck->Class === "Hunter"?"selected=selected":""; ?> ><?php echo text("ClassHunter"); ?></option>
                    <option value="Mage" <?php echo $deck->Class === "Mage"?"selected=selected":""; ?> ><?php echo text("ClassMage"); ?></option>
                    <option value="Paladin" <?php echo $deck->Class === "Paladin"?"selected=selected":""; ?> ><?php echo text("ClassPaladin"); ?></option>
                    <option value="Priest" <?php echo $deck->Class === "Priest"?"selected=selected":""; ?> ><?php echo text("ClassPriest"); ?></option>
                    <option value="Rogue" <?php echo $deck->Class === "Rogue"?"selected=selected":""; ?> ><?php echo text("ClassRogue"); ?></option>
                    <option value="Shaman" <?php echo $deck->Class === "Shaman"?"selected=selected":""; ?> ><?php echo text("ClassShaman"); ?></option>
                    <option value="Warlock" <?php echo $deck->Class === "Warlock"?"selected=selected":""; ?> ><?php echo text("ClassWarlock"); ?></option>
                </select>
            </div>

            <input type="submit" value="<?php echo text("Save"); ?>" />            
        </form>
    </section>

    <section id="deckList">
        <?php foreach ($cards as $card): ?>
            <div class="displayedCard">
                <img src="<?php echo $card->imgLink; ?>" title="<?php echo $card->name; ?>" />
            </div>
        <?php endforeach; ?>
    </section>

    <hr/>

    <?php require "pages/partials/_cardSearchFilterPanel.php"; ?>

    <hr/>

    <section>
        <h3><?php echo text("ClickCardToAdd"); ?></h3>
    </section>

    <section id="searchedCards">
        <?php if (isset($_SESSION["searchResult"])): ?>
            <?php $searchResult = $_SESSION["searchResult"];
            foreach ($searchResult as $card): ?>
                <div class="displayedCard">
                    <img src="<?php echo $card->imgLink; ?>" title="<?php echo $card->name; ?>" />
                </div>
            <?php endforeach; ?>
        <?php endif; ?>
    </section>

</div>
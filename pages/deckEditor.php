<?php
    redirectToLoginIfNotLoggedIn("deckEditor");
    $dbService = new DbService();
    $cardService = new CardService();
    $deckService = new DeckService();
?>

<div class="content editor-content">
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
    ?>    

    <section id="deckEditor">
        <h1><?php echo text("EditDeck"); ?></h1>

        <form id="editDeckForm" action="/?page=deckEditor&deckId=<?php echo $deck->Id ?>" method="POST">
            <input type="text" name="functionname" value="saveDeck" class="hidden">

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

    <?php require "pages/partials/_sideBarDeckList.php"; ?>

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
                <div class="displayedCard hover-plus">
                    <form id="add_<?php echo $card->id ?>" action="" method="POST">
                        <input type="text" name="functionname" value="addCard" class="hidden" />
                        <input type="text" name="cardId" value="<?php echo $card->id ?>" class="hidden" />
                        <input type="text" name="cardName" value="<?php echo $card->name ?>" class="hidden" />
                        <input type="text" name="deckId" value="<?php echo $deck->Id ?>" class="hidden" />
                        <input type="submit" value="+" onclick="maintainScrollPos();" class="add-card" />
                    </form>
                    <img src="<?php echo getCardImgLink($card->id); ?>" />
                </div>
            <?php endforeach; ?>
        <?php endif; ?>
    </section>

</div>

<script type="text/javascript">
    function maintainScrollPos() {
        localStorage.scrollPos = $(window).scrollTop();
    }

    $(document).ready(function() {
        $(window).scrollTop(localStorage.scrollPos);
    });
</script>
<div class="content">
    <div id="content-header"></div>
    
    <section id="deckEditor">
        <h1><?php echo text("EditDeck"); ?></h1>

        <form id="editDeckForm" action="" method="POST">
            <input type="text" name="functionname" value="saveDeck" class="hidden">
            <input type="text" name="page" value="cardSearch" class="hidden">

            <div>
                <label><?php echo text("DeckName"); ?></label>
                <input type="text" name="deckName" />
            </div>
            <div>
                <label><?php echo text("DeckDescription"); ?></label>
                <textarea type="text" name="deckDescription" form="editDeckForm"></textarea>
            </div>
            <div>
                <label><?php echo text("DeckClass"); ?></label>
                <select name="deckClass">
                    <option value=""></option>
                    <option value="Druid"><?php echo text("ClassDruid"); ?></option>
                    <option value="Hunter"><?php echo text("ClassHunter"); ?></option>
                    <option value="Mage"><?php echo text("ClassMage"); ?></option>
                    <option value="Paladin"><?php echo text("ClassPaladin"); ?></option>
                    <option value="Priest"><?php echo text("ClassPriest"); ?></option>
                    <option value="Rogue"><?php echo text("ClassRogue"); ?></option>
                    <option value="Shaman"><?php echo text("ClassShaman"); ?></option>
                    <option value="Warlock"><?php echo text("ClassWarlock"); ?></option>
                </select>
            </div>

        </form>
    </section>

    <hr/>

    <?php require "pages/partials/_cardSearchFilterPanel.php"; ?>

    <hr/>

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
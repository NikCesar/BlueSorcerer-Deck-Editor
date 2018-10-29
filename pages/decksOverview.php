<?php 
    redirectToLoginIfNotLoggedIn();

    $dbService = new DbService();

    $decks = $dbService->getDecksByUserId($_SESSION["user"]->Id);
?>

<div class="content">
    <div id="content-header"></div>
    
    <section id="decksOverview">
        <h1><?php echo text("MyDecks"); ?></h1>

        <?php foreach($decks as $index=>$deck): ?>
            <div class="deck-listing">
                <h3><?php echo $deck->Name ?></h3>
                <div class="description"><?php echo $deck->Description ?></div>
                <div class="class"><?php echo $deck->Class ?></div>

                <form id="editDeck_<?php echo $deck->Id ?>" action="" method="GET">
                    <input type="text" name="page" value="deckEditor" class="hidden" />
                    <input type="text" name="deckId" value="<?php echo $deck->Id ?>" class="hidden" />

                    <input type="submit" value="<?php echo text("Edit") ?>" />
                </form>

            </div>
        <?php endforeach; ?>
    </section>

    <hr/>

    <section id="createDeck">
        <h1><?php echo text("CreateDeck"); ?></h1>

        <form id="createDeckForm" action="" method="POST">
            <input type="text" name="functionname" value="addDeck" class="hidden">
            <input type="text" name="page" value="deckEditor" class="hidden">

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

            <?php echo validationMessageFor("creationFailed") ?>

            <input type="submit" value="<?php echo text("Create"); ?>" />            
        </form>
    </section>

</div>
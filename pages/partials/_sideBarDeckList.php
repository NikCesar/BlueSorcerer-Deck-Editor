<?php

$deckListCards = $cardService -> getCardsByDecklist($deckList);

$sideBarDeck = $deckService -> mapSideBarDeck($deckList, $deckListCards);
?>

<div id="sideBarDeckList">
<div class="load-container"><div class="loader">Loading...</div></div>

    <section id="deckList">
        <ul>
            <?php foreach ($sideBarDeck as $deckEntry): ?>
                <li class="deckListElement">
                    <label class="cardAmount"><?php echo $deckEntry->Count ?></label>
                    <label class="cardName"><?php echo $deckEntry->Name ?></label>
                    <form id="remove_<?php echo $deckEntry->Id ?>" action="" method="POST">
                        <input type="text" name="functionname" value="removeCard" class="hidden" />
                        <input type="text" name="cardId" value="<?php echo $deckEntry->Id ?>" class="hidden" />
                        <input type="text" name="deckId" value="<?php echo $deck->Id ?>" class="hidden" />
                        <input type="submit" value=" - " onclick="maintainScrollPos();" class="remove-card" />
                    </form>
                </li>
            <?php endforeach; ?>
        </ul>
    </section>
</div>
<div class="content">
    <div id="content-header"></div>


    <?php require "pages/partials/_cardSearchFilterPanel.php"; ?>
            var cardRaceTooltip = <?php echo json_encode(text("cardRaceTooltip"))?>;
            var cardSetTooltip = <?php echo json_encode(text("cardSetTooltip"))?>;
            setCardSearchTooltips(cardNameTooltip, cardRuleTooltip, cardCostTooltip, cardAttackTooltip, cardHealthTooltip, cardClassTooltip, cardTypeTooltip, cardRaceTooltip, cardSetTooltip);

    <hr/>

    <section id="searchedCards">
        <?php if (isset($_SESSION["searchResult"])): ?>
            <?php $searchResult = $_SESSION["searchResult"];
            foreach ($searchResult as $card): ?>
                <div class="displayedCard">
                    <img src="<?php echo $card->imgLink; ?>">
                </div>
            <?php endforeach; ?>
        <?php endif; ?>
    </section>
</div>
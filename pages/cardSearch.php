<div class="content">
    <div id="content-header"></div>


    <?php require "pages/partials/_cardSearchFilterPanel.php"; ?>

    <hr/>

    <section id="searchedCards">
        <?php if (isset($_SESSION["searchResult"])): ?>
            <?php $searchResult = $_SESSION["searchResult"];
            foreach ($searchResult as $card): ?>
                <div class="displayedCard">
                    <img src="<?php echo getCardImgLink($card->id); ?>">
                </div>
            <?php endforeach; ?>
        <?php endif; ?>
    </section>
</div>
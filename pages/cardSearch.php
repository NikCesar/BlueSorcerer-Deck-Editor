<div class="content">
    <div id="content-header"></div>


    <?php require "pages/partials/_cardSearchFilterPanel.php"; ?>

    <hr/>

    <section id="searchedCards">
        <?php if (isset($searchResult)): ?>
            <?php $searchResult->render(); ?>
        <?php endif; ?>
    </section>
</div>
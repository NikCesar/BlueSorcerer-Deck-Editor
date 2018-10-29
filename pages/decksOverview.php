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
                
            </div>
        <?php endforeach; ?>
    </section>

</div>
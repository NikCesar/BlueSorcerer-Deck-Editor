<?php
    include "modules/requestHandler.php";

    $newestDecks = array(
        (object) array("name" => "Temp burn aggro damage deck",
              "description" => "My new super aggressive top tier deck! Check it out.",
              "class" => "Hunter",
              "score" => 92),
        (object)  array("name" => "Rakdos Burn",
              "description" => "I got gud, now look at my deck!",
              "class" => "Mage",
              "score" => -1),
    );

    $topDecks = $newestDecks;
?>
<!doctype html>
<html>
    <head>
        <?php include "pages/partials/_scripts.php"; ?>
    </head>

    <body>
        <?php include "pages/partials/_topBar.php"; ?>

       <div class="content">
            <section id="newestDecks">
                <input type="text" onkeyup="searchForCards(this.value);" />
                
                <?php foreach($newestDecks as $index=>$deck): ?>
                    <div class="deck-listing">
                        <h3><?php echo $deck->name ?></h3>
                        <div class="description"><?php echo $deck->description ?></div>
                        <div class="class"><?php echo $deck->class ?></div>
                        <div class="score"><?php echo $deck->score ?></div>
                    </div>
                <?php endforeach; ?>
            </section>
    
            <section id="topDecks">
                <?php foreach($topDecks as $index=>$deck): ?>
                    <div class="deck-listing">
                        <h3><?php echo $deck->name ?></h3>
                        <div class="description"><?php echo $deck->description ?></div>
                        <div class="class"><?php echo $deck->class ?></div>
                        <div class="score"><?php echo $deck->score ?></div>
                    </div>
                <?php endforeach; ?>
            </section>
       </div>

        <footer></footer>
    </body>
</html>
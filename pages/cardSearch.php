<?php
session_start();
?>

<!doctype html>

<html>
    <head>
        <?php include "partials/_scripts.php"; ?>
    </head>

    <body>
        <?php include "partials/_topBar.php"; ?>

        <div class="content">
            <section id="cardFilter">
                <div>
                    <label><?php echo $GLOBALS["texts"]["CardSearchName"][$_SESSION["language"]]; ?></label>
                    <input type="text" id="cardName" />
                </div>

                <div>
                    <label><?php echo $texts["CardSearchRule"][$_SESSION["language"]]; ?></label>
                    <input type="text" id="cardText" />
                </div>

                <div>
                    <label><?php echo $texts["CardSearchCost"][$_SESSION["language"]]; ?></label>
                    <input type="number" id="cardCost" />
                </div>

                <div>
                    <label><?php echo $texts["CardSearchClass"][$_SESSION["language"]]; ?></label>
                    <select id="classSelect">
                        <option value=""></option>
                        <option value="Druid"><?php echo $texts["ClassDruid"][$_SESSION["language"]]; ?></option>
                        <option value="Hunter"><?php echo $texts["ClassHunter"][$_SESSION["language"]]; ?></option>
                        <option value="Mage"><?php echo $texts["ClassMage"][$_SESSION["language"]]; ?></option>
                        <option value="Paladin"><?php echo $texts["ClassPaladin"][$_SESSION["language"]]; ?></option>
                        <option value="Priest"><?php echo $texts["ClassPriest"][$_SESSION["language"]]; ?></option>
                        <option value="Rogue"><?php echo $texts["ClassRogue"][$_SESSION["language"]]; ?></option>
                        <option value="Shaman"><?php echo $texts["ClassShaman"][$_SESSION["language"]]; ?></option>
                        <option value="Warlock"><?php echo $texts["ClassWarlock"][$_SESSION["language"]]; ?></option>
                    </select>
                </div>

                <div>
                    <label><?php echo $texts["CardSearchType"][$_SESSION["language"]]; ?> </label>
                    <select id="typeSelect" onchange="raceSelectEnabled()">
                        <option value=""></option>
                        <option value="Weapon">Weapon</option>
                        <option value="Minion">Minion</option>
                        <option value="Spell">Spell</option>
                        <option value="Hero">Hero Card</option> <!-- collectible == true, else we also get the unplayable heroes -->
                    </select>
                </div>

                <div id="raceSelectDiv" style="display: none">
                    <label>Race </label>
                    <select id="raceSelect">
                        <option value="Beast">Beast</option>
                        <option value="Demon">Demon</option>
                        <option value="Dragon">Dragon</option>
                        <option value="Mech">Mech</option>
                        <option value="Murloc">Murloc</option>
                        <option value="Pirate">Pirate</option>
                        <option value="Totem">Totem</option>
                        <option value="Elemental">Elemental</option>
                    </select>
                </div>

                <div>
                    <label>Belongs to set </label>
                    <select id="setSelect">
                        <option value="Basic">Basic</option>
                        <option value="Classic">Classic</option>
                        <option value="Goblins vs Gnomes">Goblins vs Gnomes</option>
                        <option value="The Grand Tournament">The Grand Tournament</option>
                        <option value="Whispers of the Old Gods">Whispers of the Old Gods</option>
                        <option value="Mean Streets of Gadgetzan">Mean Streets of Gadgetzan</option>
                        <option value="Journey to Un'Goro">Journey to Un'Goro</option>
                        <option value="Knights of the Frozen Throne">Knights of the Frozen Throne</option>
                        <option value="Kobolds & Catacombs">Kobolds & Catacombs</option>
                        <option value="The Witchwood">The Witchwood</option>
                        <option value="The Boomsday Project">The Boomsday Project</option>
                    </select>
                </div>

                <input type="submit" value="search"/>
            </section>

            <hr />

            <p>Card 1</p>
            <p>Card 2</p>
            <p>Card 3</p>
            <p>Card 4</p>
            <p>Card 5</p>
            <p>Card 6</p>
            <p>Card 7</p>
            <p>Card 8</p>
            <p>Card 9</p>
            <p>Card 10</p>
            <p>Card 1</p>
            <p>Card 2</p>
            <p>Card 3</p>
            <p>Card 4</p>
            <p>Card 5</p>
            <p>Card 6</p>
            <p>Card 7</p>
            <p>Card 8</p>
            <p>Card 9</p>
            <p>Card 10</p>
        </div>

        <footer></footer>
    </body>
</html>
<section id="cardFilter">
    <h1><?php echo text("SearchForCards"); ?></h1>


    <form action="" method="POST">
        <input type="text" name="functionname" value="searchForCardsByQueries" style="display:none">

        <input type="text" name="page" value="cardSearch" style="display: none">

        <div>
            <label><?php echo text("CardSearchName"); ?></label>
            <input type="text" name="cardName" id="cardName"/>
        </div>

        <div>
            <label><?php echo text("CardSearchRule"); ?></label>
            <input type="text" name="cardText" id="cardText"/>
        </div>

        <div>
            <label><?php echo text("CardSearchCost"); ?></label>
            <input type="number" min="0" name="cardCost" id="cardCost"/>
        </div>

        <div>
            <label><?php echo text("CardSearchAttack"); ?></label>
            <input type="number" min="0" name="cardAttack" id="cardAttack"/>
        </div>

        <div>
            <label><?php echo text("CardSearchHealth"); ?></label>
            <input type="number" min="1" name="cardHealth" id="cardHealth"/>
        </div>

        <div>
            <label><?php echo text("CardSearchClass"); ?></label>
            <select name="classSelect" id="classSelect">
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

        <div>
            <label><?php echo text("CardSearchType"); ?> </label>
            <select name="typeSelect" id="typeSelect">
                <option value="">-</option>
                <option value="Weapon"><?php echo text("CardTypeWeapon"); ?></option>
                <option value="Minion"><?php echo text("CardTypeMinion"); ?></option>
                <option value="Spell"><?php echo text("CardTypeSpell"); ?></option>
                <option value="Hero"><?php echo text("CardTypeHero"); ?></option>
            </select>
        </div>

        <div id="raceSelectDiv">
            <label><?php echo text("CardSearchRace"); ?> </label>
            <select name="raceSelect" id="raceSelect">
                <option value="">-</option>
                <option value="Beast"><?php echo text("CardRaceBeast"); ?></option>
                <option value="Demon"><?php echo text("CardRaceDemon"); ?></option>
                <option value="Dragon"><?php echo text("CardRaceDragon"); ?></option>
                <option value="Elemental"><?php echo text("CardRaceElemental"); ?></option>
                <option value="Mech"><?php echo text("CardRaceMech"); ?></option>
                <option value="Murloc"><?php echo text("CardRaceMurloc"); ?></option>
                <option value="Pirate"><?php echo text("CardRacePirate"); ?></option>
                <option value="Totem"><?php echo text("CardRaceTotem"); ?></option>
            </select>
        </div>

        <div>
            <label><?php echo text("CardSearchSet"); ?> </label>
            <select name="setSelect" id="setSelect">
                <option value="">-</option>
                <option value="CORE"><?php echo text("CardSetBasic"); ?></option>
                <option value="EXPERT1"><?php echo text("CardSetClassic"); ?></option>
                <option value="HOF"><?php echo text("CardSetHoF"); ?></option>
                <option value="NAXX"><?php echo text("CardSetNaxx"); ?></option>
                <option value="GVG"><?php echo text("CardSetGvG"); ?></option>
                <option value="BRM"><?php echo text("CardSetBRM"); ?></option>
                <option value="TGT"><?php echo text("CardSetTgT"); ?></option>
                <option value="LOE"><?php echo text("CardSetLoE"); ?></option>
                <option value="OG"><?php echo text("CardSetWOG"); ?></option>
                <option value="KARA"><?php echo text("CardSetKara"); ?></option>
                <option value="GANGS"><?php echo text("CardSetMSG"); ?></option>
                <option value="UNGORO"><?php echo text("CardSetUnGoro"); ?></option>
                <option value="ICECROWN"><?php echo text("CardSetKFT"); ?></option>
                <option value="LOOTAPALOOZA"><?php echo text("CardSetKaC"); ?></option>
                <option value="GILNEAS"><?php echo text("CardSetWood"); ?></option>
                <option value="BOOMSDAY"><?php echo text("CardSetBdP"); ?></option>
            </select>
        </div>
        <input id="cardSearchSubmit" type="submit" value="<?php echo text("CardSearchSubmit"); ?>"/>
    </form>
    <script type="text/javascript">
        var failureTextCardCost = <?php echo json_encode(text("cardSearchCostFailure"))?>;
        var failureTextCardRace = <?php echo json_encode(text("cardSearchRaceFailure"))?>;
        addCardSearchValidation(failureTextCardCost, failureTextCardRace);

        var cardNameTooltip = <?php echo json_encode(text("cardNameTooltip"))?>;
        var cardRuleTooltip = <?php echo json_encode(text("cardRuleTooltip"))?>;
        var cardCostTooltip = <?php echo json_encode(text("cardCostTooltip"))?>;
        var cardAttackTooltip = <?php echo json_encode(text("cardAttackTooltip"))?>;
        var cardHealthTooltip = <?php echo json_encode(text("cardHealthTooltip"))?>;
        var cardClassTooltip = <?php echo json_encode(text("cardClassTooltip"))?>;
        var cardTypeTooltip = <?php echo json_encode(text("cardTypeTooltip"))?>;

        setCardSearchTooltips(cardNameTooltip, cardRuleTooltip, cardCostTooltip, cardAttackTooltip, cardHealthTooltip, cardClassTooltip, cardTypeTooltip);
    </script>
</section>
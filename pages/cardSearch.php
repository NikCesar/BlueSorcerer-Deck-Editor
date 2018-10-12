<div class="content">
    <section id="cardFilter">
        <div>
                    <label><?php echo text("CardSearchName"); ?></label>
            <input type="text" id="cardName" />
        </div>

        <div>
            <label><?php echo text("CardSearchRule"); ?></label>
            <input type="text" id="cardText" />
        </div>

        <div>
            <label><?php echo text("CardSearchCost"); ?></label>
            <input type="number" id="cardCost" />
        </div>

        <div>
                    <label><?php echo text("CardSearchAttack"); ?></label>
                    <input type="number" id="cardAttack" />
                </div>

                <div>
                    <label><?php echo text("CardSearchHealth"); ?></label>
                    <input type="number" id="cardHealth" />
                </div>

                <div>
            <label><?php echo text("CardSearchClass"); ?></label>
            <select id="classSelect">
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
            <select id="typeSelect" onchange="raceSelectEnabled()">
                        <option value="">-</option>
                        <option value="Weapon"><?php echo text("CardTypeWeapon"); ?></option>
                        <option value="Minion"><?php echo text("CardTypeMinion"); ?></option>
                        <option value="Spell"><?php echo text("CardTypeSpell"); ?></option>
                        <option value="Hero"><?php echo text("CardTypeHero"); ?></option> <!-- collectible == true, else we also get the unplayable heroes -->
            </select>
        </div>

        <div id="raceSelectDiv" style="display: none">
                    <label><?php echo text("CardSearchRace"); ?> </label>
            <select id="raceSelect">
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
            <select id="setSelect">
                        <option value="">-</option>
                        <option value="CORE"><?php echo text("CardSetBasic"); ?></option>
                        <option value="Classic"><?php echo text("CardSetClassic"); ?></option>
                        <option value="Hall of Fame"><?php echo text("CardSetHoF"); ?></option>
                        <option value="Naxxramas"><?php echo text("CardSetNaxx"); ?></option>
                        <option value="GVG"><?php echo text("CardSetGvG"); ?></option>
                        <option value="Blackrock Mountain"><?php echo text("CardSetBRM"); ?></option>
                        <option value="TGT"><?php echo text("CardSetTgT"); ?></option>
                        <option value="LOE"><?php echo text("CardSetLoE"); ?></option>
                        <option value="OG"><?php echo text("CardSetWOG"); ?></option>
                        <option value="One Night in Karazhan"><?php echo text("CardSetKara"); ?></option>
                        <option value="Mean Streets of Gadgetzan"><?php echo text("CardSetMSG"); ?></option>
                        <option value="UNGORO"><?php echo text("CardSetUnGoro"); ?></option>
                        <option value="Knights of the Frozen Throne"><?php echo text("CardSetKFT"); ?></option>
                        <option value="Kobolds & Catacombs"><?php echo text("CardSetKaC"); ?></option>
                        <option value="The Witchwood"><?php echo text("CardSetWood"); ?></option>
                        <option value="BOOMSDAY"><?php echo text("CardSetBdP"); ?></option>
            </select>
        </div>

                <input type="submit" value="<?php echo text("CardSearchSubmit"); ?>" onclick="searchForCardsByQueries()"/>
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
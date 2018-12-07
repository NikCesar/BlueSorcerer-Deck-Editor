<div id="topBar">
    <header>
        <a href="http://<?php echo $_SERVER['SERVER_NAME']; ?>">
            <h1>Blue Sorcerer</h1>
            <h3><?php echo text("DeckEditor"); ?></h3>
            <img id="headerImage" src="http://<?php echo $_SERVER['SERVER_NAME']; ?>/assets/img/sorcerer_header.png" />
        </a>
    </header>
        
    <nav>
        <ul>
            <li><a href="/cardSearch"><?php echo text("CardSearch")?></a></li>
            <li><a href="/deckOverview"><?php echo text("DeckEditor")?></a></li>
            <?php if (isLoggedIn()) {
                    echo '<li id="loginItem"><a href="/userProfile">User profile</a></li>';
                } else {
                    echo '<li id="loginItem"><a href="/login">Login</a></li>';
                }
            ?>
        </ul>
        <div style="clear: both"></div>
    </nav>
</div>
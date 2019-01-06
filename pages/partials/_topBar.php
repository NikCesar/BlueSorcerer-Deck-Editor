<div id="topBar">
    <header>
        <a href="http://<?php echo $_SERVER['SERVER_NAME']; ?>">
            <h1>Blue Sorcerer</h1>
            <h3><?php echo text("DeckEditor"); ?></h3>
            <img id="headerImage" src="http://<?php echo $_SERVER['SERVER_NAME']; ?>/assets/img/sorcerer_header.png" />
        </a>
        <form id="changeLanguage" action="/home/changeLanguage" method="POST">
            <input type="submit" value="<?php echo text("ChangeLanguage"); ?>"/>
        </form>
    </header>
        
    <nav>
        <ul>
            <li><a href="/cardSearch"><?php echo text("CardSearch")?></a></li>
            <li><a href="/decksOverview"><?php echo text("DeckEditor")?></a></li>
            <?php if (isLoggedIn()) {
                    echo '<li id="loginItem"><a href="/userProfile">'.text("UserProfile").'</a></li>';
                } else {
                    echo '<li id="loginItem"><a href="/login">'.text("Login").'</a></li>';
                }
            ?>
            <?php if (isLoggedIn() && $_SESSION["user"]->IsAdmin) {
                    echo '<li id="loginItem"><a href="/admin">'.text("Admin").'</a></li>';
                }
            ?>
        </ul>
        <div style="clear: both"></div>
    </nav>
</div>
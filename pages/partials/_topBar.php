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
            <li id="cardSearch"><a href="/?page=cardSearch"><?php echo text("CardSearch")?></a></li>
            <li><a href="#">Link 2</a></li>
            <li><a href="#">Link 3</a></li>
            <li><a href="#">Link 4</a></li>
            <?php if (isLoggedIn()) {
                    echo '<li id="loginItem"><a href="/?page=userProfile">User profile</a></li>';
                } else {
                    echo '<li id="loginItem"><a href="/?page=login">Login</a></li>';
                }
            ?>
        </ul>
        <div style="clear: both"></div>
    </nav>
</div>
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
            <li id="cardSearch"><a href="/?page=cardSearch">Card Search</a></li>
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

<div id="modal">
    <div class="modal-content">
    <div class="modal-header">
        <span class="close" onclick="hideModal();">&times;</span>
        <?php if (hasAnyMessage() && strpos(strtolower($_GET["message"]), "success") !== false) {
                echo "<span class='success'>Success!</span>";
            } else {
                echo "<span class='fail'>Failed!</span>";
            }
        ?>
    </div>
    <div class="modal-body">
        <p><?php 
            if (hasAnyMessage()) {
                echo text($_GET["message"]);
            }
        ?></p>
    </div>
    <div class="modal-footer">
        <span>This window closes automatically...</span>
    </div>
    </div>
</div>

<?php 
    if (hasAnyMessage()) {
        echo '<script type="text/javascript">showModal();</script>';
    }
?>
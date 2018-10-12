<?php 
    function isMessageVisible() {
        if (hasMessage("loginFail")) {
            echo "block";
        } else {
            echo "none";
        }
    }
?>

<div class="content small-content">
    <div class="centered">
        <form action="" method="POST">
            <input type="text" name="functionname" value="login" style="display:none" />

            <section>
                <label>Username: </label>
                <input id="username" name="username" />
            </section>

            <section>
                <label>Password: </label>
                <input id="password" name="password" type="password" />
            </section>

            <section style="display: <?php echo isMessageVisible(); ?>;">
                <label>YOU FAILED THE LOGIN!</label>
            </section>

            <input type="submit" value="Login" />
        </form>
    </div>

    <div id="register">
        <div>
            <a href="#">Forgot Password?</a>
        </div>
        <div>
            <a href="#">No Account? Register now!</a>
        </div>
    </div>
</div>
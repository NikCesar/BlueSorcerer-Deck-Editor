<!doctype html>

<html>
    <head>
        <?php include "partials/_scripts.php"; ?>
    </head>

    <body>
        <?php include "partials/_topBar.php"; ?>

        <div class="content small-content">
            <div class="centered">
                <section id="username">
                    <label id="usernameLabel">Username: </label>
                    <input id="usernameTextArea">
                </section>

                <section id="password">
                    <label id="pwLabel">Password: </label>
                    <input id="pw" type="password">
                </section>
                <button id="loginButton">Login</button>
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

        <footer></footer>
    </body>
</html>
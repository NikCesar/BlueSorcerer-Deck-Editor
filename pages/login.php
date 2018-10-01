<!doctype html>

<html>
    <head>
        <?php include "partials/_scripts.php"; ?>
    </head>

    <body>
        <?php include "partials/_topBar.php"; ?>

        <div class="content small-content">
            <div class="centered">
                <section>
                    <label>Username: </label>
                    <input id="username" />
                </section>

                <section>
                    <label>Password: </label>
                    <input id="password" type="password" />
                </section>

                <input type="submit" value="Login" />
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
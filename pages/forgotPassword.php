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
                    <input type="text" value="<email address OR username>" disabled="disabled" />
                </section>

                <section>
                    <label>new password: </label>
                    <input id="newPassword" type="password" />
                </section>

                <section>
                    <label>confirm password: </label>
                    <input id="newPasswordConfirm" type="password" />
                </section>

                <input type="submit" value="submit" />
            </div>
        </div>

        <footer></footer>
    </body>
</html>
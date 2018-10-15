<?php
    if (!(isset($_SESSION["isLoggedIn"]) && $_SESSION["isLoggedIn"] == true)) {
        header("Location: http://" . $_SERVER["SERVER_NAME"] . "?page=login");
        exit;
    }
?>

<div class="content">
    <section class="<?php echo (isset($_POST["isEditMode"]) && $_POST["isEditMode"]) ? "isEditMode" : "isReadMode" ?>">
        <form action="" method="POST">
            <input type="text" name="functionname" value="saveUserProfile" class="hidden" />
            <div>
                <label>Id: </label>
                <label class="readMode"><?php echo $_SESSION["user"]->Id; ?></label>
                <input class="editMode" type="text" name="Id" value="<?php echo $_SESSION["user"]->Id; ?>" disabled="disabled" />
            </div>
            <div>
                <label>Username: </label>
                <label class="readMode"><?php echo $_SESSION["user"]->Username; ?></label>
                <input class="editMode" type="text" name="Username" value="<?php echo $_SESSION["user"]->Username; ?>" />
            </div>
            <div>
                <label>Email: </label>
                <label class="readMode"><?php echo $_SESSION["user"]->Email; ?></label>
                <input class="editMode" type="text" name="Email" value="<?php echo $_SESSION["user"]->Email; ?>" />
            </div>

            <input class="editMode" type="button" value="Cancel" onclick="window.location.href = window.location.href;" />
            <input class="editMode" type="submit" value="Save" />
        </form>

        <form action="/?page=userProfile" method="POST">
            <input class="readMode hidden" type="text" name="isEditMode" value="true" />
            <input class="readMode" type="submit" value="Edit" />
        </form>

    </section>
</div>
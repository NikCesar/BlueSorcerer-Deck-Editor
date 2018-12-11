<?php
class UserProfileView {

    private $isEditMode;

    public function __construct()
    {
        $this->isEditMode = (isset($_POST["isEditMode"]) && $_POST["isEditMode"]) ? "isEditMode" : "isReadMode";
    }

    public function renderUserProfile() {
            echo "<section class=\"" . $this->isEditMode . "\">";
            echo "<form action=\"/userProfile/saveUserProfile\" method=\"POST\">";
            echo "    <div>";
            echo "        <label>Id: </label>";
            echo "        <label class=\"readMode\">" . $_SESSION["user"]->Id . "</label>";
            echo "        <input class=\"editMode\" type=\"text\" name=\"Id\" value=\"" . $_SESSION["user"]->Id . "\" disabled=\"disabled\" />";
            echo "    </div>";
            echo "    <div>";
            echo "        <label>Username: </label>";
            echo "        <label class=\"readMode\">" . $_SESSION["user"]->Username . "</label>";
            echo "        <input class=\"editMode\" type=\"text\" name=\"Username\" value=\"" . $_SESSION["user"]->Username . "\" />";
            echo "    </div>";
            echo "    <div>";
            echo "        <label>Email: </label>";
            echo "        <label class=\"readMode\">" . $_SESSION["user"]->Email . "</label>";
            echo "        <input class=\"editMode\" type=\"text\" name=\"Email\" value=\"" . $_SESSION["user"]->Email . "\" />";
            echo "    </div>";

            echo "    <input class=\"editMode\" type=\"button\" value=\"Cancel\" onclick=\"window.location.href = window.location.href;\" />";
            echo "    <input class=\"editMode\" type=\"submit\" value=\"Save\" />";
            echo "</form>";

            echo "<form action=\"/userProfile\" method=\"POST\">";
            echo "    <input class=\"readMode hidden\" type=\"text\" name=\"isEditMode\" value=\"true\" />";
            echo "    <input class=\"readMode\" type=\"submit\" value=\"Edit\" />";
            echo "</form>";

            echo "<form action=\"/userProfile/logout\" method=\"GET\">";
            echo "    <input type=\"submit\" value=\"Logout\" />";
            echo "</form>";
            echo "</section>";
    }   
}
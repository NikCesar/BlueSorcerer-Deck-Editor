<?php
class AdminView {

    private $editModeForUserId;

    public function __construct()
    {
        $this->editModeForUserId = (isset($_POST["editModeForUserId"]) && $_POST["editModeForUserId"] !== -1) ? (int)$_POST["editModeForUserId"] : -1;  
    }

    public function renderUsers($users) {

        foreach($users as $user) {
            echo "<section class=\"" . ($this->editModeForUserId == $user->Id ? "isEditMode" : "isReadMode") . "\">";
            echo "<form action=\"/admin/saveUser\" method=\"POST\">";
            echo "    <div>";
            echo "        <label>Id: </label>";
            echo "        <label class=\"readMode\">{$user->Id}</label>";
            echo "        <input class=\"editMode\" type=\"text\" name=\"Id\" value=\"{$user->Id}\" readonly=\"readonly\" />";
            echo "    </div>";
            echo "    <div>";
            echo "        <label>Username: </label>";
            echo "        <label class=\"readMode\">{$user->Username}</label>";
            echo "        <input class=\"editMode\" type=\"text\" name=\"Username\" value=\"{$user->Username}\" />";
            echo "    </div>";
            echo "    <div>";
            echo "        <label>Email: </label>";
            echo "        <label class=\"readMode\">{$user->Email}</label>";
            echo "        <input class=\"editMode\" type=\"text\" name=\"Email\" value=\"{$user->Email}\" />";
            echo "    </div>";
            echo "    <div>";
            echo "        <label>Role: </label>";
            echo "        <label class=\"readMode\">{$user->RoleId}</label>";
            echo "        <input class=\"editMode\" type=\"text\" name=\"RoleId\" value=\"{$user->RoleId}\" />";
            echo "    </div>";

            echo "    <input class=\"editMode\" type=\"button\" value=\"Cancel\" onclick=\"window.location.href = window.location.href;\" />";
            echo "    <input class=\"editMode\" type=\"submit\" value=\"Save\" />";
            echo "</form>";

            echo "<form action=\"/admin\" method=\"POST\">";
            echo "    <input class=\"readMode hidden\" type=\"text\" name=\"editModeForUserId\" value=\"{$user->Id}\" />";
            echo "    <input class=\"readMode\" type=\"submit\" value=\"Edit\" />";
            echo "</form>";
            echo "</section>";
        }
    }   
}
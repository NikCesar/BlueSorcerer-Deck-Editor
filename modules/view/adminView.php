<?php
class AdminView {

    private $editModeForUserId;

    public function __construct()
    {
        $this->editModeForUserId = (isset($_POST["editModeForUserId"]) && $_POST["editModeForUserId"] !== -1) ? (int)$_POST["editModeForUserId"] : -1;  
    }

    public function renderUsers($users, $roles) {

        validationMessageFor("resetPasswordSuccess");

        foreach($users as $user) {

            $roleName = $this->getRoleNameByRoleId($user->RoleId, $roles);
            
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
            echo "        <label class=\"readMode\">".text("Role_".$roleName)."</label>";
            echo "        <select class=\"editMode\" name=\"RoleId\" value=\"$user->RoleId\">";
            foreach ($roles as $role) {
            echo "          <option value=\"{$role->Id}\" ". ($user->RoleId === $role->Id ? "selected=selected" : "").">".text("Role_".$role->Name)."</option>";
            }
            echo "        </select>";
            echo "    </div>";

            echo "    <input class=\"editMode\" type=\"button\" value=\"Cancel\" onclick=\"window.location.href = window.location.href;\" />";
            echo "    <input class=\"editMode\" type=\"submit\" value=\"Save\" />";
            echo "</form>";

            validationMessageFor("updateUserBadMail{$user->Id}", "updateUserBadMail");

            echo "<form action=\"/admin\" method=\"POST\">";
            echo "    <input class=\"readMode hidden\" type=\"text\" name=\"editModeForUserId\" value=\"{$user->Id}\" />";
            echo "    <input class=\"readMode\" type=\"submit\" value=\"Edit\" />";
            echo "</form>";
            echo "</section>";
        }

        // render "create new user".

        echo "<hr/>";

        echo "<section>";
        echo "  <h1>" . text("CreateUser") . "</h1>";

        echo "  <form id=\"createUserForm\" action=\"/admin/createUser\" method=\"POST\">";
        echo "      <div>";
        echo "          <label>" . text("Username") . "</label>";
        echo "          <input type=\"text\" name=\"username\" />";
        echo "      </div>";
        echo "      <div>";
        echo "          <label>" . text("Email") . "</label>";
        echo "          <input type=\"text\" name=\"email\" />";
        echo "      </div>";
        echo "      <div>";
        echo "          <label>" . text("Role") . "</label>";
        echo "        <select name=\"roleId\">";
        foreach ($roles as $role) {
        echo "          <option value=\"{$role->Id}\">".text("Role_".$role->Name)."</option>";
        }
        echo "        </select>";
        echo "      </div>";

        validationMessageFor("createUserFail");
        validationMessageFor("createUserBadMail");

        echo "      <input type=\"submit\" value=\"" . text("Create") . "\" />";          
        echo "  </form>";
        echo "</section>";
    }
    
    private function getRoleNameByRoleId($roleId, $roles) {
        foreach ($roles as $key => $role) {
            if ($role->Id === $roleId) {
                return $role->Name;
            }
        }
        return "NotFound";
    }

    public function renderPasswordReset($userId) {
        echo "<div class=\"centered small-centered\">";
        echo "<h2>".text("ResetPassword")."</h2>";
        echo "<form action=\"/admin/doResetPassword\" method=\"POST\">";
        echo "    <input type=\"text\" class=\"hidden\" name=\"userId\" value=\"{$userId}\">";
        echo "    <input type=\"text\" class=\"hidden\" name=\"token\" value=\"{$_GET["token"]}\">";
        echo "    <section>";
        echo "        <label>".text("Password").": </label>";
        echo "        <input type=\"password\" name=\"password\" />";
        echo "    </section>";
        echo "    <section>";
        echo "        <label>".text("PasswordConfirm").": </label>";
        echo "        <input type=\"password\" name=\"passwordConfirm\" />";
        echo "    </section>";
       
        echo "    <input type=\"submit\" value=\"".text("Confirm")."\" style=\"margin-bottom: 10px\" />";
        echo "</form>";
        
        validationMessageFor("resetPasswordBadInput");
        validationMessageFor("resetPasswordFail");

        echo "</div>";
    }
}
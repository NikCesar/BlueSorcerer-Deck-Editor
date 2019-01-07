<?php
class LoginView {

    public function __construct()
    {
    }

    public function renderLogin() {
        echo "<div class=\"centered small-centered\">";
        echo "  <form action=\"/login/doLogin\" method=\"POST\">";
        echo "      <section>";
        echo "          <label>Username: </label>";
        echo "          <input type=\"text\" id=\"username\" name=\"username\" />";
        echo "      </section>";

        echo "      <section>";
        echo "          <label>Password: </label>";
        echo "          <input id=\"password\" name=\"password\" type=\"password\" />";
        echo "     </section>";

        validationMessageFor("loginFail");
        validationMessageFor("registerSuccess");

        echo "      <input type=\"submit\" value=\"Login\" />";
        echo "  </form>";

        echo "  <div id=\"register\">";
        echo "      <div>";
        echo "          <a href=\"/admin/renderPasswordForgot\">Forgot Password?</a>";
        echo "      </div>";
        echo "      <div>";
        echo "          <a href=\"/login/register\">No Account? Register now!</a>";
        echo "      </div>";
        echo "  </div>";
        echo "</div>";
    } 
    
    public function renderRegister($roles) {
        echo "<hr/>";

        echo "<div class=\"centered small-centered\">";
        echo "  <h1>" . text("RegisterUser") . "</h1>";

        echo "  <form id=\"registerForm\" action=\"/login/doRegister\" method=\"POST\">";
        echo "      <section>";
        echo "          <label>" . text("Username") . "</label>";
        echo "          <input type=\"text\" name=\"username\" />";
        echo "      </section>";
        echo "      <section>";
        echo "          <label>" . text("Email") . "</label>";
        echo "          <input type=\"text\" name=\"email\" />";
        echo "      </section>";
        echo "      <section>";
        echo "        <label>".text("Password")." </label>";
        echo "        <input type=\"password\" name=\"password\" />";
        echo "      </section>";
        echo "      <section>";
        echo "        <label>".text("PasswordConfirm")." </label>";
        echo "        <input type=\"password\" name=\"passwordConfirm\" />";
        echo "      </section>";
        echo "      <section>";
        echo "        <label>" . text("Role") . "</label>";
        echo "        <select name=\"roleId\">";
        foreach ($roles as $role) {
        echo "          <option value=\"{$role->Id}\">".text("Role_".$role->Name)."</option>";
        }
        echo "        </select>";
        echo "      </section>";

        validationMessageFor("createUserFail");
        validationMessageFor("registerBadInput");

        echo "      <input type=\"submit\" value=\"" . text("Create") . "\" />";          
        echo "  </form>";
        echo "</div>";
    }
}
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
        echo "          <input id=\"username\" name=\"username\" />";
        echo "      </section>";

        echo "      <section>";
        echo "          <label>Password: </label>";
        echo "          <input id=\"password\" name=\"password\" type=\"password\" />";
        echo "     </section>";

        validationMessageFor("loginFail");

        echo "      <input type=\"submit\" value=\"Login\" />";
        echo "  </form>";

        echo "  <div id=\"register\">";
        echo "      <div>";
        echo "          <a href=\"#\">Forgot Password?</a>";
        echo "      </div>";
        echo "      <div>";
        echo "          <a href=\"#\">No Account? Register now!</a>";
        echo "      </div>";
        echo "  </div>";
        echo "</div>";
    }   
}
<?php

class UserProfileController {

    private $userProfileModel;
    private $userProfileView;

    function __construct() {
        $this->userProfileModel = new UserProfileModel();
        $this->userProfileView = new UserProfileView();
    }

    /** @view method */
    public function index() {
        $this->userProfileView->renderUserProfile();
    }

    public function updateUserProfile() {
        $id = $_SESSION["user"]->Id;
        $username = strip_tags($_POST["Username"]);
        $email = strip_tags($_POST["Email"]);

        $updatedUser = $this->userProfileModel->updateUser($id, $username, $email);

        $_SESSION["user"] = $updatedUser;
    }

    public function logout() {
        if (isLoggedIn()) {
            $_SESSION["user"] = null;
            $_SESSION["isLoggedIn"] = false;

            redirect("home", "message=logoutSuccess");
        }
    }

}
?>
<?php

require_once "$_SERVER[DOCUMENT_ROOT]/modules/view/userProfileView.php";
require_once "$_SERVER[DOCUMENT_ROOT]/modules/models/userProfileModel.php";

class UserProfileController {

    private $userProfileModel;
    private $userProfileView;

    public $defaultAction = "index";

    function __construct() {
        $this->userProfileModel = new UserProfileModel();
        $this->userProfileView = new UserProfileView();
    }

    /** @view method */
    public function index() {
        $this->userProfileView->renderUserProfile();
    }

    public function saveUserProfile() {
        $id = $_SESSION["user"]->Id;
        $username = strip_tags($_POST["Username"]);
        $email = strip_tags($_POST["Email"]);
        $roleId = $_SESSION["user"]->RoleId;

        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            redirect("userProfile", "index", "message=updateUserBadMail");
        }

        $updatedUser = $this->userProfileModel->updateUser($id, $username, $email, $roleId);

        $_SESSION["user"] = $updatedUser;

        redirect("userProfile", "index");
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
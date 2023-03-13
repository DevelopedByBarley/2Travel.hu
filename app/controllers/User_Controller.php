<?php
require 'app/models/User_Model.php';

class UserController
{
    private $renderer;
    private $userModel;

    public function __construct()
    {
        $this->userModel = new UserModel();
        $this->renderer = new Renderer();
    }

    public function user()
    {

        session_start();
        $errors = isset($_SESSION["errors"]) ?  json_decode(base64_decode($_SESSION["errors"]), true) : "";
        $values = isset($_SESSION["values"]) ?  json_decode(base64_decode($_SESSION["values"]), true) : "";
        $validator = new Validator();
        $errorMessages = $validator->getErrorMessages($validator->userSchema(), $errors);


        if (!isset($_COOKIE["userId"])) {
            echo $this->renderer->render("Layout.php", [
                "content" => $this->renderer->render("pages/user/User_Subscription_Form.php", [
                    "isRegistered" => $_GET["isRegistered"] ?? null,
                    "errorMessages" => $errorMessages,
                    "values" => $values
                ])
            ]);
            return;
        }

        $_SESSION["userId"] = $_COOKIE["userId"];
        header("Location: /");

    }


    public function registerUser()
    {
        $this->userModel->registerUser($_POST);
    }

    public function loginUser()
    {
        $this->userModel->loginUser($_POST);
    }

    public function logoutUser()
    {
        $this->userModel->logoutUser();
    }

    public function userAuthenticator()
    {

        echo $this->renderer->render("Layout.php", [
            "content" => $this->renderer->render("pages/user/User_Authentication_Form.php", [
                "userId" => $_GET["id"] ?? null
            ])
        ]);
    }

    public function authenticateUser()
    {
        $this->userModel->authenticate($_POST);
    }

    public function profile()
    {
        $this->userModel->checkUserIsLoggedInOrRedirect();
        $user = $this->userModel->getProfile($_SESSION["userId"]);
        $userImage = $this->userModel->getUserImage($user["id"]);


        echo $this->renderer->render("Layout.php", [
            "content" => $this->renderer->render("pages/user/User_Profile.php", [
                "user" => $user,
                "userImage" => $userImage["userImageName"]
            ]),
            "isLoggedIn" => $_SESSION["userId"] ?? null
        ]);
    }
}

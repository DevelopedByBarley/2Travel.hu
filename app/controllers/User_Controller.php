<?php
    require 'app/models/User_Model.php';

    class UserController {
        private $renderer;
        private $userModel;
        
        public function __construct()
        {
            $this->userModel = new UserModel();
            $this->renderer = new Renderer();
        }

        public function user() {
            echo $this->renderer->render("Layout.php", [
                "content" => $this->renderer->render("pages/User_Subscription_Form.php", [])
            ]);
        }


        public function registerUser() { 
            $this->userModel->registerUser($_POST);
        }

        public function loginUser() {
            $this->userModel->loginUser($_POST);
        }

        public function logoutUser() {
            $this->userModel->logoutUser();
        }
    }
?>
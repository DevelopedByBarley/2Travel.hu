<?php

    require 'app/models/Homes_Model.php';
    class HomesController {
        private $userModel;
        private $homeModel;
        private $renderer;

        public function __construct()
        {
            $this->userModel = new UserModel();
            $this->renderer = new Renderer();
            $this->homeModel = new HomeModel();
        }

        public function homes()
        {
    
            $this->userModel->checkUserIsLoggedInOrRedirect();
            $homes = $this->homeModel->getHomes();

            
            
            echo $this->renderer->render("Layout.php", [
                "content" => $this->renderer->render("pages/user/Homes.php", []),
                "isLoggedIn" => $_SESSION["userId"] ?? null,
                "homes" => $homes
            ]);
        }
    
    }
?>
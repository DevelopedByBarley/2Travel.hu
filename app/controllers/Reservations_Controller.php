<?php
    class ReservationsController {
        private $userModel;
        private $renderer;
        
        public function __construct()
        {
            $this->userModel = new UserModel();
            $this->renderer = new Renderer();
        }

        public function reservations()
        {
            $this->userModel->checkUserIsLoggedInOrRedirect();
            echo $this->renderer->render("Layout.php", [
                "content" => $this->renderer->render("pages/user/Reservations.php", []),
                "isLoggedIn" => $_SESSION["userId"] ?? null
            ]);
        }
    
    }

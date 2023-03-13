<?php
    class HomeModel {
        private $pdo;
        private $mailer;
        private $fileSaver;
        private $userModel;
    
        public function __construct()
        {
            $db = new Database();
            $this->pdo = $db->getConnect();
            $this->userModel = new UserModel();
        }

        public function getHomes() {
            $this->userModel->checkUserIsLoggedInOrRedirect();
            var_dump(session_id());
            $stmt = $this->pdo->prepare("SELECT * FROM `homes`");
            $stmt->execute();
            $homes = $stmt->fetchAll(PDO::FETCH_ASSOC);

            return $homes;
            
        }
        
    }
?>
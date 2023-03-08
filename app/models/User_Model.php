<?php

class UserModel
{
    private $pdo;
    private $mailer;

    public function __construct()
    {
        $db = new Database();
        $this->pdo = $db->getConnect();
        $this->mailer = new Mailer();
    }

    public function registerUser($body)
    {
        $password =  password_hash($body["password"], PASSWORD_DEFAULT);
        $userImage = isset($body['userImage']) ?  $body['userImage'] : "https://via.placeholder.com/500x500.png?text=Placeholder+Image";

        $stmt = $this->pdo->prepare("INSERT INTO `user` VALUES
             (NULL, 
             :firstName, 
             :lastName, 
             :email, 
             :password, 
             :userImage, 
             :age, 
             :nationality, 
             :country, 
             :address, 
             :phoneNumber, 
             :sex, 
             :createdAt);");

        $stmt->bindParam(':firstName', $body['firstName']);
        $stmt->bindParam(':lastName', $body['lastName']);
        $stmt->bindParam(':email', $body['email']);
        $stmt->bindParam(':password', $password);
        $stmt->bindParam(':userImage', $userImage);
        $stmt->bindParam(':age', $body['age']);
        $stmt->bindParam(':nationality', $body['nationality']);
        $stmt->bindParam(':country', $body['country']);
        $stmt->bindParam(':address', $body['address']);
        $stmt->bindParam(':phoneNumber', $body['phoneNumber']);
        $stmt->bindParam(':sex', $body['sex']);
        $stmt->bindParam(':createdAt', $body['createdAt']);

        $stmt->execute();

        var_dump("Everything was fine");
    }






    public function loginUser($body)
    {
        $stmt = $this->pdo->prepare("SELECT * FROM `user` WHERE email = ?");

        $stmt->execute([
            $body["email"]
        ]);
        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        if (!$user) {
            echo "User doesn't exist!";
            return;
        }


        $isVerified = password_verify($body["password"], $user["password"]);


        if (!$isVerified) {
            echo "password is doesn't exist!";
            return;
        }

        $authenticationNumber = rand(0, 9999);

        $this->mailer->send($body["email"], "Hello");



        session_start();
        $_SESSION["userId"] = $user["id"];

        header("Location: /");
    }


    public function logoutUser()
    {
        session_start();
        session_destroy();

        $cookieParams = session_get_cookie_params();
        setcookie(session_name(), "", 0, $cookieParams["path"], $cookieParams["domain"], $cookieParams["secure"], isset($cookieParams["httponly"]));

        header('Location: /');
    }

    private function isLoggedIn()
    {
        if (!isset($_COOKIE[session_name()])) return false;
        session_start();
        if (!isset($_SESSION["userId"])) return false;
        return true;
    }


    public function checkUserIsLoggedInOrRedirect()
    {
        if ($this->isLoggedIn()) {
            return;
        };
        header("Location: /");
        exit;
    }
}

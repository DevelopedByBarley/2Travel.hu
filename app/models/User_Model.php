<?php

require_once 'app/helpers/Validate.php';
require_once 'app/helpers/FileSaver.php';

class UserModel
{
    private $pdo;
    private $mailer;
    private $fileSaver;

    public function __construct()
    {
        $db = new Database();
        $this->pdo = $db->getConnect();
        $this->mailer = new Mailer();
        $this->fileSaver = new FileSaver();
    }

    public function registerUser($body)
    {
        $validator = new Validator();
        $errors = $validator->validate($validator->userSchema(), $body);


        foreach ($errors as $error) {

            if (!empty($error)) {
                session_start();
                $_SESSION["errors"] = base64_encode(json_encode($errors));
                $_SESSION["values"] = base64_encode(json_encode($body));
                header("Location: /user");
                return;
            }
        }



        $password =  password_hash($body["password"], PASSWORD_DEFAULT);
        $createdAt =  time();



        $stmt = $this->pdo->prepare("INSERT INTO `users` VALUES
             (NULL, 
             :firstName, 
             :lastName, 
             :email, 
             :password, 
             :age, 
             :nationality, 
             :country,
             :createdAt);");

        $stmt->bindParam(':firstName', $body['firstName']);
        $stmt->bindParam(':lastName', $body['lastName']);
        $stmt->bindParam(':email', $body['email']);
        $stmt->bindParam(':password', $password);
        $stmt->bindParam(':age', $body['age']);
        $stmt->bindParam(':nationality', $body['nationality']);
        $stmt->bindParam(':country', $body['country']);
        $stmt->bindParam(':createdAt', $createdAt);

        $stmt->execute();

        $userId = $this->pdo->lastInsertId();
        $userImage = $this->fileSaver->saver($_FILES["files"], "userImages", null);
        $this->saveUserImage($userImage, $userId);


        header("Location: /user?isRegistered=1");
    }

    public function loginUser($body)
    {
        $stmt = $this->pdo->prepare("SELECT * FROM `users` WHERE email = ?");

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
        session_start();
        $_SESSION["authenticationCode"] = $authenticationNumber;
        $emailBody = "
            <div>
                <h3>Megerősitő kód</h3>
                <h1>$authenticationNumber</h1>
            </div>
        ";

        $this->mailer->send($body["email"], $emailBody);
        setcookie("userId", $user["id"], time() + (86400 * 1), "/");

        header("Location: /user/authenticator?id=" . $user["id"]);
    }

    public function authenticate($body)
    {
        session_start();
        $authenticationCode = $_SESSION["authenticationCode"];
        var_dump($body["code"]);
        var_dump($authenticationCode);
        if ((int)$body["code"] !== (int)$authenticationCode) {
            header('Location: /?fail=true');
            return;
        }
        $_SESSION["userId"] = $_GET["id"];
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
        if (session_id() == '') {
            session_start();
        }
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

    public function getProfile($userId)
    {
        $stmt = $this->pdo->prepare("SELECT * FROM `users` WHERE id = :userId");
        $stmt->bindParam(':userId', $userId);
        $stmt->execute();

        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        return $user;
    }

    public function getUserImage($userId)
    {

        $stmt = $this->pdo->prepare("SELECT * FROM `userimages` WHERE userRefId = :userId");
        $stmt->bindParam(':userId', $userId);
        $stmt->execute();
        $userImage = $stmt->fetch(PDO::FETCH_ASSOC);
        return $userImage;
    }


    private function saveUserImage($userImage, $userRefId)
    {
        $stmt = $this->pdo->prepare("INSERT INTO `userimages` (`userImageId`, `userImageName`, `userRefId`) VALUES (NULL, :userImageName, :userRefId);");
        $stmt->bindParam(':userImageName', $userImage);
        $stmt->bindParam(':userRefId', $userRefId);
        $stmt->execute();
    }
}

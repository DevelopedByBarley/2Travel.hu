<?php
require './app/models/Home_Model.php';

class HomeController
{

    private $renderer;

    public function __construct()
    {
        $this->renderer = new Renderer();
    }

    function home() {

        session_start();
        echo $this->renderer->render("Layout.php" , [
            "content" => $this->renderer->render("pages/Content.php", []),
            "isLoggedIn" => $_SESSION["userId"] ?? null
        ]);
    }

}

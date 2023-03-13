<?php

class MainPage
{

    private $renderer;

    public function __construct()
    {
        $this->renderer = new Renderer();
    }

    function mainPage() {

        session_start();
        echo $this->renderer->render("Layout.php" , [
            "content" => $this->renderer->render("pages/Main_Page.php", []),
            "isLoggedIn" => $_SESSION["userId"] ?? null
        ]);
    }

}

<?php
    require __DIR__."/vendor/autoload.php";

    use CoffeeCode\Router\Router;

    $router = new Router(ROOT);

    /*
     * Controllers
     */
    $router->namespace("Source\Controllers");

    /*
     * Web
     * home
     */
    $router->group(null);
    $router->get("/", "Web:home","web.index");
    $router->get("/friend/{id}", "Web:friend","web.friend");
    $router->get("/match/{id}", "Web:match","web.match");
    $router->post("/match-create", "Web:matchCreate");
    /*
     * Web
     * api
     */
    $router->group('/api');
    $router->post("/friends", "Api:friends");
    $router->post("/match-loser/{id}", "Api:matchLoser");
    $router->post("/ranking", "Api:ranking");
    $router->post("/matches", "Api:matches");
    $router->post("/matches/{id_friend_win}", "Api:matches");







    /*
     * Error
     * pageError
     */
    $router->group("ooops");
    $router->get("/{errcode}", "Error:pageError");


    $router->dispatch();

    if($router->error()){
        $router->redirect("/ooops/{$router->error()}");
    }
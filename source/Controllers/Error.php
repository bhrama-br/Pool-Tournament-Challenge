<?php


namespace Source\Controllers;


class Error
{
    public function pageError($data){
        echo "<h1>{$data["errcode"]}</h1>";
        var_dump($data);
    }
}
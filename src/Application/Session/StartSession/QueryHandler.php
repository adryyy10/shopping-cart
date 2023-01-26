<?php

namespace App\Application\Session\StartSession;

class QueryHandler
{

    // Magic method that is called when we call and object as a function
    public function __invoke()
    {
        if(!isset($_SESSION)) { 
            session_start(); 
        }
    }

}

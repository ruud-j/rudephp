<?php namespace App\Router;

use App\Controller\ExampleController;
use RudePHP\Routing\Router;

class DefaultRouter extends Router
{
    public function start()
    {
        $this->get('/', function() {
            return ExampleController::call('show', 'Hello world!');
        });
    }
}
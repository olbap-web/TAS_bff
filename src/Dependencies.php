<?php

use DI\Container;
use Slim\Factory\AppFactory; 

$container = new Container();
AppFactory::setContainer($container);

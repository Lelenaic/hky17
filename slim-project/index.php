<?php
/**
 * Step 1: Require the Slim Framework
 *
 * If you are not using Composer, you need to require the
 * Slim Framework and register its PSR-0 autoloader.
 *
 * If you are using Composer, you can skip this step.
 */
require 'Slim/Slim.php';

\Slim\Slim::registerAutoloader();

$app = new \Slim\Slim([
    'templates.path' => 'templates/'
]);


$app->get('/(:page)(/)(:action)(/)(:id)(/)', function ($page = 'index', $action = null, $id = null) use ($app) {
    $app->render('includes/includes.php', compact('page', 'action', 'id'));
});


$app->run();

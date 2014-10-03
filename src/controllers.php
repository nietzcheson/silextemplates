<?php

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

//Request::setTrustedProxies(array('127.0.0.1'));


$app->register(new Silex\Provider\DoctrineServiceProvider(), array(
  'dbs.options' => array (
        'mysql_read' => array(
            'driver'    => 'pdo_mysql',
            'host'      => 'localhost',
            'dbname'    => 'sisfc',
            'user'      => 'sisfc',
            'password'  => 'sisfc',
            'charset'   => 'utf8',
        ),
    ),
));


$app->get('/', function () use ($app) {
    $sql = "SELECT nombre FROM usuarios";
    $usuarios = $app["db"]->fetchAll($sql);

    return $app['twig']->render('views/index.html', array("usuarios" => $usuarios));
})
->bind('homepage')
;

$app->get('/note', function () use ($app) {
    return $app['twig']->render('views/note.html', array());
})
->bind('note')
;

$app->get('/calendar', function () use ($app) {
    return $app['twig']->render('views/calendar.html', array());
})
->bind('calendar')
;

$app->get('/contactos', function () use ($app) {
    return $app['twig']->render('views/contactos.html', array());
})
->bind('contactos')
;

$app->error(function (\Exception $e, $code) use ($app) {
    if ($app['debug']) {
        return;
    }

    // 404.html, or 40x.html, or 4xx.html, or error.html
    $templates = array(
        'errors/'.$code.'.html',
        'errors/'.substr($code, 0, 2).'x.html',
        'errors/'.substr($code, 0, 1).'xx.html',
        'errors/default.html',
    );

    return new Response($app['twig']->resolveTemplate($templates)->render(array('code' => $code)), $code);
});

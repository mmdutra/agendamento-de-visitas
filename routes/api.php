<?php

use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface;

$app->get('/', function (Request $request, ResponseInterface $response) use ($app) {
    $response->getBody()->write('Olá, mundo!');
    
    return $response->withStatus(200);
});
<?php
// Application middleware

// e.g: $app->add(new \Slim\Csrf\Guard);
$app->get('/users', function ($request, $response, $args) {
    // You can add a security layer here
    return $response;
});

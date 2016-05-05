<?php
// Routes

//$app->get('/api/photos', 'App\Action\PhotoAction:fetch');
//$app->get('/api/photos/{slug}', 'App\Action\PhotoAction:fetchOne');

// Create user in Stormpath
$app->post('/api/v1.0/users', 'App\Action\UserAction:create');

// Get user information from Stormpath
$app->get('/api/v1.0/users', 'App\Action\UserAction:get');

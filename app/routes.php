<?php
// Routes

// Create user
$app->post('/api/v1/users', 'App\Action\UserAction:createAccount');

// Authenticate user
$app->post('/api/v1/authenticate', 'App\Action\UserAction:authenticateAccount');

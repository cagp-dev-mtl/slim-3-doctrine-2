<?php
// DIC configuration

$container = $app->getContainer();

// -----------------------------------------------------------------------------
// Service providers
// -----------------------------------------------------------------------------

// Twig
$container['view'] = function ($c) {
    $settings = $c->get('settings');
    $view = new \Slim\Views\Twig($settings['view']['template_path'], $settings['view']['twig']);

    // Add extensions
    $view->addExtension(new Slim\Views\TwigExtension($c->get('router'), $c->get('request')->getUri()));
    $view->addExtension(new Twig_Extension_Debug());

    return $view;
};

// Flash messages
$container['flash'] = function ($c) {
    return new \Slim\Flash\Messages;
};

// -----------------------------------------------------------------------------
// Service factories
// -----------------------------------------------------------------------------

// monolog
$container['logger'] = function ($c) {
    $settings = $c->get('settings');
    $logger = new \Monolog\Logger($settings['logger']['name']);
    $logger->pushProcessor(new \Monolog\Processor\UidProcessor());
    $logger->pushHandler(new \Monolog\Handler\StreamHandler($settings['logger']['path'], \Monolog\Logger::DEBUG));
    return $logger;
};

// Doctrine
$container['em'] = function ($c) {
    $settings = $c->get('settings');
    $config = \Doctrine\ORM\Tools\Setup::createAnnotationMetadataConfiguration(
        $settings['doctrine']['meta']['entity_path'],
        $settings['doctrine']['meta']['auto_generate_proxies'],
        $settings['doctrine']['meta']['proxy_dir'],
        $settings['doctrine']['meta']['cache'],
        false
    );
    return \Doctrine\ORM\EntityManager::create($settings['doctrine']['connection'], $config);
};

// Stormpath Application
// Reference http://docs.stormpath.com/php/product-guide/w
$container['stormpathInitialize'] = function ($c) {
    $settings = $c->get('settings');
    $apiKeyFile = $settings['stormpath']['api_key_file'];
    Stormpath\Client::$apiKeyFileLocation = $apiKeyFile;
};

// Stormpath Application
// Reference http://docs.stormpath.com/php/product-guide/w
$container['stormpathApp'] = function ($c) {
    $settings = $c->get('settings');
    $c->get('stormpathInitialize');
    $apiBaseUrl = $settings['stormpath']['api_base_url'];
    $applicationEndpoint = $settings['stormpath']['application_endpoint'];
    $application = Stormpath\Resource\Application::get($apiBaseUrl . $applicationEndpoint);

    return $application;
};

// Stormpath Client
$container['stormpathClient'] = function ($c) {
    $c->get('stormpathInitialize');

    return Stormpath\Client::getInstance();
};

// -----------------------------------------------------------------------------
// Action factories
// -----------------------------------------------------------------------------

$container['App\Action\UserAction'] = function ($c) {
    $userResource = new \App\Resource\UserResource($c->get('em'));

    return new App\Action\UserAction(
        $userResource,
        $c->get('logger'),
        $c->get('stormpathApp'),
        $c->get('stormpathClient')
    );
};

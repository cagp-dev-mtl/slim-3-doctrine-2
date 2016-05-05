<?php
namespace App\Action;

use App\Resource\UserResource;
use Psr\Log\LoggerInterface;

final class UserAction
{
    private $userResource;
    private $logger;

    public function __construct(UserResource $userResource, LoggerInterface $logger)
    {
        $this->userResource = $userResource;
        $this->logger = $logger;
    }

    /**
     * Get user information from Stormpath
     *
     * @param Slim\Http\Request $request A request object
     * @param Slim\Http\Response $response A response object
     * @param Array $args An array of arguments
     * @return string
     */
    public function get($request, $response, $args)
    {
        echo "User action";
        $this->logger->info("Logger test");
        /*
        $photo = $this->photoResource->get($args['slug']);
        if ($photo) {
            return $response->withJSON($photo);
        }
        */
        return $response->withStatus(404, 'No photo found with that slug.');
    }

    /**
     * Create a user in Stormpath
     *
     * @param Slim\Http\Request $request A request object
     * @param Slim\Http\Response $response A response object
     * @param Array $args An array of arguments
     * @return string
     */
    public function post($request, $response, $args)
    {
        echo "User action";
        /*
        $photo = $this->photoResource->get($args['slug']);
        if ($photo) {
            return $response->withJSON($photo);
        }
        */
        return $response->withStatus(404, 'No photo found with that slug.');
    }
}

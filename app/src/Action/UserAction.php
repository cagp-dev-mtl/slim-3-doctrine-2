<?php
namespace App\Action;

use App\Resource\UserResource;
use Psr\Log\LoggerInterface;
use Stormpath\Resource\Application as StormpathApp;
use Stormpath\Client as StormpathClient;

final class UserAction
{
    private $userResource;
    private $logger;

    /**
     * Constructor
     *
     * @param UserResource $userResource An user resource object
     * @param LoggerInterface $logger A logger object
     * @param Stormpath\Resource\Application|StormpathApp $stormpathApplication A stormpath client object
     * @param Stormpath\Client|StormpathClient StormpathClient A stormpath client
     */
    public function __construct(UserResource $userResource, LoggerInterface $logger, StormpathApp $stormpathApplication, StormpathClient $stormpathClient)
    {
        $this->userResource = $userResource;
        $this->logger = $logger;
        $this->stormpathApplication = $stormpathApplication;
        $this->stormpathClient = $stormpathClient;
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
        return $response->withStatus(404, 'Empty action.');
    }

    /**
     * Authenticate a given user
     *
     * @param Slim\Http\Request $request A request object
     * @param Slim\Http\Response $response A response object
     * @param Array $args An array of arguments
     * @return string
     */
    public function authenticateAccount($request, $response, $args)
    {
        try {
            $username = $request->getParam('username');
            $password =$request->getParam('password');
            $result = $this->stormpathApplication->authenticate($username, $password);
            $account = $result->account;

        } catch (\Stormpath\Resource\ResourceError $re)
        {
            return $response->withJSON(
                array(
                    'Status' => $re->getStatus(),
                    'Code' => $re->getErrorCode(),
                    'Message' => $re->getMessage(),
                    'Developer message' => $re->getDeveloperMessage(),
                    'Additional information' => $re->getMoreInfo(),
                )
            );
        }

        return $response->withJSON(
            array(
                'Status' => $account->getStatus()
            )
        );
    }

    /**
     * Create an user account in stormpath
     *
     * @param Slim\Http\Request $request A request object
     * @param Slim\Http\Response $response A response object
     * @param Array $args An array of arguments
     * @return string
     */
    public function createAccount($request, $response, $args)
    {
        $email = $request->getParam('email');
        $username = $request->getParam('username');
        $password =$request->getParam('password');
        $surname = $request->getParam('surname');
        $givenName = $request->getParam('given_name');

        try {
            $account = $this->stormpathApplication->dataStore->instantiate(\Stormpath\Stormpath::ACCOUNT);
            $account->email = $email;
            $account->username = $username;
            $account->password =$password;
            $account->surname = $surname;
            $account->givenName = $givenName;
            $account = $this->stormpathApplication->createAccount($account);
        } catch (\Stormpath\Resource\ResourceError $re) {
            $this->logger->info($re->getMessage());
            return $response->withJSON(array('Error message' => $re->getMessage()));
        }

        // Return the URL to the newly created account
        return $response->withJSON(array('Status' => $account->getHref()));
    }
}

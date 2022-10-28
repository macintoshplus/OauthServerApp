<?php
/**
 * @copyright Macintoshplus (c) 2022
 * Added by : Macintoshplus at 28/10/2022 17:43
 */

declare(strict_types=1);

namespace App\Controller;


use League\OAuth2\Server\AuthorizationServer;
use Symfony\Bridge\PsrHttpMessage\HttpFoundationFactoryInterface;
use Symfony\Bridge\PsrHttpMessage\HttpMessageFactoryInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

final class AccessTokenController extends AbstractController
{
    #[Route(path: '/access_token')]
    public function __invoke(
        Request $request,
        AuthorizationServer $server,
        HttpFoundationFactoryInterface $factoryToSymfony,
        HttpMessageFactoryInterface $factoryToPsr7
    ) {

        $responsePsr = $factoryToPsr7->createResponse(new Response());
        try {
            $psr7Request = $factoryToPsr7->createRequest($request);

            // Try to respond to the request
            return $factoryToSymfony->createResponse($server->respondToAccessTokenRequest($psr7Request, $responsePsr));

        } catch (\League\OAuth2\Server\Exception\OAuthServerException $exception) {

            // All instances of OAuthServerException can be formatted into a HTTP response
            return $factoryToSymfony->createResponse($exception->generateHttpResponse($responsePsr));

        }
    }
}

<?php

namespace App\Middleware;

use Psr\Http\Server\MiddlewareInterface as Middleware;
use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Http\Server\RequestHandlerInterface as RequestHandler;
use Psr\Http\Message\ResponseInterface as Response;
use Slim\Exception\HttpUnauthorizedException;
use Firebase\JWT\JWT;

class AuthMw implements Middleware
{
    /**
     * {@inheritdoc}
     */
    public function process(Request $request, RequestHandler $handler): Response {
        $jwtHeader = $request->getHeaderLine('Authorization');
        $jwt_GET = isset($_GET["token"]) ? $_GET["token"] : false;
        if (!$jwtHeader && !$jwt_GET) {
            throw new HttpUnauthorizedException($request,'El token de autenticación es requerido.');
        }
        if (!$jwtHeader && $jwt_GET) {
            $jwtHeader = 'Bearer ' . $jwt_GET;
        }
        $jwt = explode('Bearer ', $jwtHeader);
        if (!isset($jwt[1])) {
            throw new HttpUnauthorizedException($request,'El token de autenticación es inválido. Ejm: Bearer *token*.');
        }
        $this->checkToken($request, $jwt[1]);

        return $handler->handle($request);
    }

    protected function checkToken(Request $request, $token) {
        try {
            return JWT::decode($token, config('app.jwt_secret_key'), ['HS256']);
        } catch (HttpUnauthorizedException $e) {
            throw new HttpUnauthorizedException($request, 'Acceso restringido: no tienes permisos para ver este recurso.');
        }
    }
}

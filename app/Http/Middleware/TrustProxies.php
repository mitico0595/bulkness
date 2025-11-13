<?php

namespace App\Http\Middleware;

use Illuminate\Http\Middleware\TrustProxies as Middleware;
use Symfony\Component\HttpFoundation\Request;

class TrustProxies extends Middleware
{
    /**
     * Los proxies en los que confía Laravel.
     * '*' significa "confía en todos" (útil detrás de Traefik o Nginx)
     */
    protected $proxies = '*';

    /**
     * Encabezados que Laravel debe usar para detectar el esquema correcto.
     */
    protected $headers =
        Request::HEADER_X_FORWARDED_FOR |
        Request::HEADER_X_FORWARDED_HOST |
        Request::HEADER_X_FORWARDED_PORT |
        Request::HEADER_X_FORWARDED_PROTO;
}

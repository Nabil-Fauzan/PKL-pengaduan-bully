<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class SecurityHeaders
{
    /**
     * Handle an incoming request and attach recommended security headers.
     */
    public function handle(Request $request, Closure $next): Response
    {
        /** @var Response $response */
        $response = $next($request);

        $response->headers->set('X-Frame-Options', 'SAMEORIGIN');
        $response->headers->set('X-Content-Type-Options', 'nosniff');
        $response->headers->set('X-XSS-Protection', '1; mode=block');
        $response->headers->set('Referrer-Policy', 'strict-origin-when-cross-origin');
        $response->headers->set('Permissions-Policy', 'camera=(), microphone=(), geolocation=()');

        $csp = "default-src 'self'; "
            . "script-src 'self' 'unsafe-inline' https://www.google.com https://www.gstatic.com https://cdnjs.cloudflare.com https://cdn.jsdelivr.net; "
            . "style-src 'self' 'unsafe-inline' https://fonts.googleapis.com https://cdnjs.cloudflare.com https://cdn.jsdelivr.net; "
            . "font-src 'self' data: https://fonts.gstatic.com https://cdnjs.cloudflare.com; "
            . "img-src 'self' data: https:; "
            . "frame-src 'self' https://www.google.com https://www.gstatic.com; "
            . "frame-ancestors 'self'; "
            . "connect-src 'self' https: ws: wss:;";

        $response->headers->set('Content-Security-Policy', $csp);

        return $response;
    }
}

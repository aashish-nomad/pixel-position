<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class PasswordProtect
{
    public function handle(Request $request, Closure $next): Response
    {
        // Check if the request is from a browser (i.e., has a User-Agent header)
        if ($request->header('User-Agent') && !$this->isApiRequest($request)) {
            $username = 'admin';
            $password = 'helloworld'; // Change this to your desired password

            // Check if the username and password match
            if ($request->getUser() === $username && $request->getPassword() === $password) {
                return $next($request);
            }

            // If not authorized, return 401 response
            return response('Unauthorized to view the page.', 401, ['WWW-Authenticate' => 'Basic realm="My Laravel App"']);
        }

        // Allow other requests (e.g., API, payment gateways) to pass without authentication
        return $next($request);
    }

    // Helper function to check if the request is an API request
    private function isApiRequest(Request $request)
    {
        return $request->is('api/*');
    }
}

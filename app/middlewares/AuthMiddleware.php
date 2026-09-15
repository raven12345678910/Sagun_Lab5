<?php
defined('PREVENT_DIRECT_ACCESS') OR exit('No direct script access allowed');
/**
 * AuthMiddleware
 * Performs authorization check before allowing route execution.
 */
class AuthMiddleware
{
    /**
     * Handle the incoming request
     *
     * @param Closure $next
     * @return mixed
     */
    public function handle(Closure $next)
    {
        // Try to use Session library if available
        try {
            $session = load_class('Session', 'libraries');
        } catch (Exception $e) {
            $session = null;
        }

        // Example logic: check if user is logged in via session
        if ($session && $session->get('user_id')) {
            return $next();
        }

        // Fallback: check Authorization header (bearer token)
        $headers = function_exists('getallheaders') ? getallheaders() : [];
        $authHeader = $headers['Authorization'] ?? $headers['authorization'] ?? (isset($_SERVER['HTTP_AUTHORIZATION']) ? $_SERVER['HTTP_AUTHORIZATION'] : null);

        if ($authHeader) {
            if (preg_match('/Bearer\s+(.*)$/i', $authHeader, $matches)) {
                $token = $matches[1];
                // If you have an API library to validate JWT, call it here.
                // For now, assume token present means authorized.
                return $next();
            }
        }

        // Determine if this is an API request (Accept JSON or path starts with /api)
        $accept = $_SERVER['HTTP_ACCEPT'] ?? '';
        $request_uri = $_SERVER['REQUEST_URI'] ?? '';

        if (stripos($accept, 'application/json') !== false || strpos($request_uri, '/api') === 0) {
            http_response_code(401);
            header('Content-Type: application/json');
            echo json_encode(['error' => 'Unauthorized']);
            return;
        }

        // Otherwise redirect to login if possible
        $login_url = '/auth/login';
        if (headers_sent() === false) {
            header('Location: ' . $login_url);
            return;
        }

        return;
    }
}

<?php


namespace App\Http\Middleware;


use App\Models\Auth\ServerCredentials;
use App\Traits\Api\ApiResponse;
use Closure;
use Illuminate\Http\Request;

class ApiAuthentication
{
    use ApiResponse;

    const API_KEY = 'x-api-key';


    public function handle(Request $request, Closure $next)
    {

        $token = $request->header(self::API_KEY);

        if ($token === null) {
            return $this->sendError( 'Unauthorized.', 401);
        }

        $user = ServerCredentials::where('auth_token', $token)->first();

        if (is_null($user)) {
            return $this->sendError('Unauthorized.', 401);
        }

        return $next($request);
    }

}

<?php

namespace App\Http\Middleware;

use App\Models\Employee;
use App\Models\EmpSession;
use App\Models\Session;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Firebase\JWT\JWT;
use Firebase\JWT\Key;

class EmpApiAuth
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */

    protected $jwtSecret = '7ebd52dd6a0163141edd3a7c1fa72e85e69b01b1fbb046b4c74bc4f74d308eaf885e1a5131c41c04186d9e8ad15f49ba1558f450daaca49dde561bdcaed04dea'; // Replace with your actual secret key

    public function handle(Request $request, Closure $next)
    {
        // Get the Authorization header
        $apiToken = $request->header('Authorization');

        if ($apiToken) {
            try {
                $token = str_replace('Bearer ', '', $apiToken);
                $decoded = JWT::decode($token, new Key($this->jwtSecret, 'HS256'));

                $sessionId = $decoded->sub;
                $session = EmpSession::find($sessionId);

                if (!$session) {
                    return response()->json(['message' => 'Expired session'], 401);
                }

                if (!$session['user_id'])
                    return response()->json(['message' => 'Session not found'], 404);

                $user = Employee::find($session['user_id']);
                if (!$user) {
                    return response()->json(['message' => 'User not found'], 404);
                }

                $request->attributes->set('user', $user);
                return $next($request);
            } catch (\Exception $e) {
                Log::error('JWT Decode Error: ', ['message' => $e->getMessage()]);
                return response()->json(['message' => 'Unauthorized'], 401);
            }
        }

        return response()->json(['message' => 'Unauthorized'], 401);
    }
    /**
     * Custom authentication logic.
     *
     * @param  string  $apiToken
     * @return \App\Models\User|null
     */
    protected function checkCustomAuth($apiToken)
    {
        return Session::where('api_token', $apiToken)->first();
    }
}

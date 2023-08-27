<?php
namespace App\Http\Middleware;
use Closure;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use JWTAuth;
class Admin
{
    /**
     * Handle an incoming request.
     *
     * @param \Illuminate\Http\Request $request
     * @param \Closure $next
     * @param string|null $guard
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        $user = auth()->user();
        if ($user == null || $user->role != "admin") {
            return response()->json(['user not in role admin'], 401);
        }
        return $next($request);
    }
}

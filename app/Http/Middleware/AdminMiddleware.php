<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;

class AdminMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (Auth::check()) {
            $user = Auth::user();
    
            // Check if the user is active and of the allowed types
            if ($user->isActive && ($user->type === 'admin')) {
                return $next($request);
            }
        }
    
        // Redirect to landing page with an error message if conditions are not met
        return redirect()->route('adminlogin')->withErrors('You do not have access to this page.');
    }


    
}

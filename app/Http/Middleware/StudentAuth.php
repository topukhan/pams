<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class StudentAuth
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next)
    {
        if (!Auth::guard('student')->check()) {
            return redirect(route('student.login'));
        }
    
        // $user = Auth::guard('student')->user();
    
        // Pass the $user object to the view
        // $request->attributes->add(['user' => $user]);
    
        return $next($request);
    }
}

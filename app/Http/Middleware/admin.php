<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class admin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
      // Authenticatation Gate
      if (auth()->user()){
          // User Role Gate
          if (auth()->user()->role_type === 'admin'){
              return $next($request);
          }
          return redirect('/admin/login');
      }
      return redirect('/admin/login');

    }
}

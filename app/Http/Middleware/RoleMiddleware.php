<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use PhpParser\Node\Stmt\Return_;
use Symfony\Component\HttpFoundation\Response;

use function PHPUnit\Framework\returnSelf;

class RoleMiddleware
{
    
    public function handle(Request $request, Closure $next, $role): Response
    {
        if(!Auth::check()) return redirect('/login');
        if(Auth::user()->role !==$role) abort(403);
        
        return $next($request);
    }
}
